const frm = document.querySelector('#frmRegistro');
const btnAccion = document.querySelector('#btnAccion');
const containerGaleria = document.querySelector('#containerGaleria');
let editorDesc;
let tblProductos;

let language = {
    url: "//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json"
};

  var firstTabEl = document.querySelector('#myTab li:last-child button')
  var firstTab = new bootstrap.Tab(firstTabEl);

  var modalGaleria = new bootstrap.Modal(document.getElementById('modalGaleria'))

  let desc;

  const btnProcesar = document.querySelector('#btnProcesar');
  
document.addEventListener('DOMContentLoaded', function () {
    
    //editor text area
ClassicEditor
    .create(document.querySelector('#descripcion'))
    .then(editor => {
        // guardamos la instancia en la variable
        editorDesc = editor;
    })
    .catch(error => {
        console.error(error);
    });



    tblProductos = $("#tblProductos").DataTable({
        ajax: {
            url: base_url + "productos/listar",
            dataSrc: "",
        },
        columns: [
            { data: 'id' },
        { data: 'nombre' },
        { data: 'descripcion' },
        { data: 'precio' },
        { data: 'cantidad' },
        { data: 'color' },
        { data: 'imagen' },
        {data: 'accion'}
        ],
        language,
        dom,
        buttons,
    });


//submit productos
       frm.addEventListener("submit", function(e) {
    e.preventDefault();
    let data = new FormData(this);

    // usamos la instancia para obtener el contenido del editor
    data.append('descripcion', editorDesc.getData()); 

    const url = base_url + "productos/registrar";
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send(data);

    http.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            if (res.icono == "success") {
                frm.reset();
                tblProductos.ajax.reload();
                document.querySelector('#imagen').value = '';
            }
            Swal.fire("Aviso", res.msg.toUpperCase(), res.icono);
        }
    }
});

    //galeria de imagenes
    let myDropzone = new Dropzone(".dropzone", {
        dictDefaultMessage: "Arrastar y Soltar Imagenes",
        acceptedFiles: ".png, .jpg, .jpeg",
        maxFiles: 10,
        addRemoveLinks: true,
        autoProcessQueue: false,
        parallelUploads: 10
    });
    btnProcesar.addEventListener("click", function() {
        myDropzone.processQueue();
    });
    myDropzone.on("complete", function(file) {
        myDropzone.removeFile(file);
        Swal.fire("Aviso", 'IMAGENES SUBIDAS', 'success');
        setTimeout(() => {
            modalGaleria.hide();
        }, 1500);
    });
});


//desactivar productos
function eliminarPro(idPro) {
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
     const url = base_url + "productos/delete/" + idPro;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            const res = JSON.parse(this.responseText);
            if (res.icono == "success") {
                tblProductos.ajax.reload(); //se recarga la tabla
            }
            Swal.fire("Aviso", res.msg.toUpperCase(), res.icono);
        }
    }
  }
});
}


//modificar productos
function editPro(idPro) {
        const url = base_url + "productos/edit/" + idPro;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            const res = JSON.parse(this.responseText);
            document.querySelector('#id').value = res.id;
            document.querySelector('#nombre').value = res.nombre;
            document.querySelector('#precio').value = res.precio;
            document.querySelector('#cantidad').value = res.cantidad;
            document.querySelector('#color').value = res.color;
            document.querySelector('#categoria').value = res.id_categoria;
            document.querySelector('#descripcion').value = res.descripcion;
            document.querySelector('#imagen_actual').value = res.imagen;
            btnAccion.textContent = 'Modificar';
            firstTab.show();
        }
    };
}

//Multiples imagenes
function agregarImagenes(idPro) {
            const url = base_url + "productos/verGaleria/" + idPro; //ajax
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            const res = JSON.parse(this.responseText);
            document.querySelector('#idProducto').value = idPro; //levantar modal
             let html = '';
             let destino = base_url + 'assets/images/productos/' + idPro + '/';
             for (let i = 0; i < res.length; i++) {
                html += `                            <div class="col-md-3">
                                <img class="img-thumbnail" src="${destino + res[i]}">
                                                                <div class="d-grid">
                                    <button class="btn btn-danger btnEliminarImagen" type="button"  data-id="${idPro}" data-name="${idPro + '/' + res[i]}" >Eliminar</button>
                                </div>
                            </div>`;
             }
             containerGaleria.innerHTML = html;
             eliminarImagen();
            modalGaleria.show(); //mostrar modal
        }
    };
    
}

function eliminarImagen(params) {
    let lista =document.querySelectorAll('.btnEliminarImagen');
    for (let i = 0; i < lista.length; i++) {
        lista[i].addEventListener('click', function name(params) {
            let idPro = lista[i].getAttribute('data-id');
            let nombre = lista[i].getAttribute('data-name');
            eliminar(idPro, nombre);
        })
        
    }
}
//eliminar imagen de galeria

function eliminar(idPro, nombre) {
            const url = base_url + "productos/eliminarImg";
    const http = new XMLHttpRequest();
    http.open("POST", url, true);
    http.send(JSON.stringify({
        url: nombre
    }));
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            const res = JSON.parse(this.responseText);
            Swal.fire("Aviso", res.msg, res.icono);
            if (res.icono == 'success') {
                agregarImagenes(idPro);
            }
        }
    };
}