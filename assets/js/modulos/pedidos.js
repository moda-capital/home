let tblPendientes, tblFinalizados, tblProceso;
const myModal = new bootstrap.Modal(document.getElementById('modalPedidos'))
document.addEventListener('DOMContentLoaded', function () {
tblPendientes = $('#tblPendientes').DataTable( {
     ajax: {
        url: base_url + 'pedidos/listarPedidos',
        dataSrc: "",
    },
    columns: [
        { data: 'id_transaccion' },
        { data: 'monto' },
        { data: 'estado' },
        { data: 'fecha' },
        { data: 'email' },
        { data: 'nombre' },
        { data: 'apellido' },
        {data: 'direccion'},
        {data: 'ciudad'},
        {data: 'accion'}
    ],
    languaje,
    dom,
    buttons
    } );
    tblProceso = $('#tblProceso').DataTable( {
     ajax: {
        url: base_url + 'pedidos/listarProceso',
        dataSrc: "",
    },
    columns: [
        { data: 'id_transaccion' },
        { data: 'monto' },
        { data: 'estado' },
        { data: 'fecha' },
        { data: 'email' },
        { data: 'nombre' },
        { data: 'apellido' },
        {data: 'direccion'},
        {data: 'ciudad'},
        {data: 'accion'}
    ],
    languaje,
    dom,
    buttons
    } );
    tblFinalizados = $('#tblFinalizados').DataTable( {
     ajax: {
        url: base_url + 'pedidos/listarFinalizados',
        dataSrc: "",
    },
    columns: [
        { data: 'id_transaccion' },
        { data: 'monto' },
        { data: 'estado' },
        { data: 'fecha' },
        { data: 'email' },
        { data: 'nombre' },
        { data: 'apellido' },
        {data: 'direccion'},
        {data: 'ciudad'},
        {data: 'accion'}
    ],
    languaje,
    dom,
    buttons
    } );



});

//proceso pedidos
function cambiarProceso(idPedido, proceso) {
    Swal.fire({
  title: "Aviso",
  text: "¡Esta seguro/a de cambiar el estado!",
  icon: "warning",
  showCancelButton: true,
  confirmButtonColor: "#a9c52f",
  cancelButtonColor: "#2d9de8",
  confirmButtonText: "Si, cambiar"
}).then((result) => {
  if (result.isConfirmed) {
     const url = base_url + "pedidos/update/" + idPedido + "/" + proceso;
    const http = new XMLHttpRequest();
    http.open("GET", url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            const res = JSON.parse(this.responseText);
            if (res.icono == "success") {
              //se recarga la tabla
                tblPendientes.ajax.reload();
                tblProceso.ajax.reload();
                tblFinalizados.ajax.reload();
            }
            Swal.fire("Aviso", res.msg.toUpperCase(), res.icono);
        }
    }
  }
});
}
function verPedido(idPedido) {
  const url = base_url + "clientes/verPedido/" + idPedido ;
    const http = new XMLHttpRequest();
    http.open('GET', url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            const res = JSON.parse(this.responseText);  
            let html = '';
            res.productos.forEach(row => {
                html += `<tr>
                <td>${row.producto}</td>
                <td>
                    <span class="badge bg-warning">${res.moneda + ' ' + parseFloat(row.precio).toFixed(3)}</span>

                </td>
                <td>
                    <span class="badge bg-info">${row.cantidad}</span>
                </td>
                <td>${(parseFloat(row.precio) * parseInt(row.cantidad)).toFixed(3)}</td>

            </tr>`;
            
            });
            document.querySelector('#tablePedidos tbody').innerHTML = html; 
            myModal.show();
        }
    }
  
}


