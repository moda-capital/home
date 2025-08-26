
const nuevo = document.querySelector('#nuevo_registro');
const frm = document.querySelector('#frmRegistro');
const titleModal = document.querySelector('#titleModal');
const btnAccion = document.querySelector('#btnAccion');
const myModal = new bootstrap.Modal(document.getElementById('nuevoModal'))
let tblCategorias;
document.addEventListener('DOMContentLoaded', function () {
tblCategorias = $('#tblCategorias').DataTable( {
     ajax: {
        url: base_url + 'categorias/listar',
        dataSrc: "",
    },
    columns: [
        { data: 'id' },
        { data: 'categoria' },
        { data: 'imagen' },
        {data: 'accion'}
    ],
    languaje,
    dom,
    buttons
    } );


//Levantar Modal
    nuevo.addEventListener('click', function () {
        document.querySelector('#id').value = '';
        document.querySelector('#imagen_actual').value = '';
        document.querySelector('#imagen').value = '';
        titleModal.textContent = 'NUEVA CATEGORIA';
        btnAccion.textContent = 'Registrar';
        frm.reset();
        myModal.show();
    });


//submit categorias
    frm.addEventListener("submit", function(e) {
        e.preventDefault();
        let data = new FormData(this);
        const url = base_url + "categorias/registrar";
        const http = new XMLHttpRequest();
        http.open("POST", url, true);
        http.send(data);
        http.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                console.log(this.responseText);
                const res = JSON.parse(this.responseText);
                if (res.icono == "success") {
                    myModal.hide();
                    tblCategorias.ajax.reload();
                    document.querySelector('#imagen').value = '';
                }
                Swal.fire("Aviso?", res.msg.toUpperCase(), res.icono);
            }
        }
    });
});

//desactivar usuarios
function eliminarCat(editCat) {
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
     const url = base_url + "categorias/delete/" + editCat;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            const res = JSON.parse(this.responseText);
            if (res.icono == "success") {
                tblCategorias.ajax.reload(); //se recarga la tabla
            }
            Swal.fire("Aviso", res.msg.toUpperCase(), res.icono);
        }
    }
  }
});
}


//modificar usuarios
function editCat(editCat) {
        const url = base_url + "categorias/edit/" + editCat;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            const res = JSON.parse(this.responseText);
            document.querySelector('#id').value = res.id;
            document.querySelector('#categoria').value = res.categoria;
            document.querySelector('#imagen_actual').value = res.imagen;
            btnAccion.textContent = 'Modificar';
            titleModal.textContent = 'MODIFICAR CATEGORIA';
            myModal.show();
        }
    }
}

