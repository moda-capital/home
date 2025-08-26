const nuevo = document.querySelector('#nuevo_registro');
const frm = document.querySelector('#frmRegistro');
const titleModal = document.querySelector('#titleModal');
const btnAccion = document.querySelector('#btnAccion');
const myModal = new bootstrap.Modal(document.getElementById('nuevoModal'))
let tblUsuario;
document.addEventListener('DOMContentLoaded', function () {
tblUsuario = $('#tblUsuarios').DataTable( {
     ajax: {
        url: base_url + 'usuarios/listar',
        dataSrc: "",
    },
    columns: [
        { data: 'id' },
        { data: 'nombre' },
        { data: 'apellido' },
        { data: 'correo' },
        {data: 'perfil'},
        {data: 'accion'}
    ],
    languaje,
    dom,
    buttons
    } );
    //Levantar Modal
    nuevo.addEventListener('click', function () {
        document.querySelector('#id').value = '';
        titleModal.textContent = 'NUEVO USUARIO';
        btnAccion.textContent = 'Registrar';
        frm.reset();
        document.querySelector('#clave').removeAttribute('readonly');
        myModal.show();
    });
//submit usuarios
frm.addEventListener("submit", function(e) {
    e.preventDefault();
    let data = new FormData(this);
    const url = base_url + "usuarios/registrar";
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send(data);
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            const res = JSON.parse(this.responseText);
            if (res.icono == "success") {
                myModal.hide(); //se esconde la ventana
                tblUsuario.ajax.reload(); //se recarga la tabla
            }
            Swal.fire("Aviso", res.msg.toUpperCase(), res.icono);
        }
    }
});
});

//desactivar usuarios
function eliminarUser(idUser) {
    Swal.fire({
  title: "¿Estas seguro/a?",
  text: "¡Eliminar registro!",
  icon: "warning",
  showCancelButton: true,
  confirmButtonColor: "#a9c52f",
  cancelButtonColor: "#2d9de8",
  confirmButtonText: "Si, Eliminar"
}).then((result) => {
  if (result.isConfirmed) {
     const url = base_url + "usuarios/delete/" + idUser;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            const res = JSON.parse(this.responseText);
            if (res.icono == "success") {
                tblUsuario.ajax.reload(); //se recarga la tabla
            }
            Swal.fire("Aviso", res.msg.toUpperCase(), res.icono);
        }
    }
  }
});
}


//modificar usuarios
function editUser(idUser) {
        const url = base_url + "usuarios/edit/" + idUser;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            const res = JSON.parse(this.responseText);
            document.querySelector('#id').value = res.id;
            document.querySelector('#nombre').value = res.nombres;
            document.querySelector('#apellido').value = res.apellidos;
            document.querySelector('#correo').value = res.correo;
            document.querySelector('#clave').setAttribute('readonly', 'readonly');
            btnAccion.textContent = 'Modificar';
            titleModal.textContent = 'MODIFICAR USUARIO';
            myModal.show();
        }
    }
}