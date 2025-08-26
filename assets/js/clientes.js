const tableLista = document.querySelector('#tableListaProductos tbody');
const tblpendientes = document.querySelector('#tblpendientes');
productosjson = [];
let tblCalificacion;
const estadoEnviado = document.querySelector('#estadoEnviado');
const estadoProceso = document.querySelector('#estadoProceso');
const estadoCompletado = document.querySelector('#estadoCompletado');

document.addEventListener('DOMContentLoaded', function () {
    if (tableLista) {
        getListaProductos();
    }
     //cargar datos pendientes  con Data Tables
    $('#tblpendientes').DataTable( {
     ajax: {
        url: base_url + 'clientes/listarpendientes',
        dataSrc: ''
    },
    columns: [
        { data: 'id_transaccion' },
        { data: 'monto' },
        { data: 'fecha' },
        {data: 'accion'}
    ],
    languaje,
    dom,
    buttons
    } );

    //cargar datos productios con data tables
        tblCalificacion = $('#tblProductos').DataTable( {
     ajax: {
        url: base_url + 'clientes/listarProductos',
        dataSrc: ''
    },
    columns: [
        { data: 'id_producto' },
        { data: 'producto' },
        { data: 'precio' },
        {data: 'cantidad'},
        {data: 'calificacion'}
    ],
    languaje,
    dom,
    buttons
    } );


});

function getListaProductos() {
    let html = '';
    productosjson = []; // Reiniciamos la lista
    const url = base_url + 'principal/listaProductos';
    const http = new XMLHttpRequest();
    http.open('POST', url, true);
    http.send(JSON.stringify(listaCarrito));
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            if (res.totalPaypal > 0) {
                res.productos.forEach(producto => {
                    html += `<tr>
                        <td>
                            <img class="img-thumbnail rounded-circle" src="${producto.imagen}" alt="" width="100">
                        </td>
                        <td>${producto.nombre}</td>
                        <td>
                            <span class="badge bg-warning">${res.moneda + ' ' + producto.precio}</span>
                        </td>
                        <td>
                            <span class="badge bg-info">${producto.cantidad}</span>
                        </td>
                        <td>${producto.subTotal}</td>
                    </tr>`;

                    //Formato correcto para PayPal
                    let json = {
                        name: producto.nombre,
                        unit_amount: {
                            currency_code: "USD",
                            value: parseFloat(producto.precio).toFixed(2)
                        },
                        quantity: producto.cantidad.toString(),
                        category: "PHYSICAL_GOODS"
                    };

                    productosjson.push(json);
                });

                tableLista.innerHTML = html;
                document.querySelector('#totalProducto').textContent = 'TOTAL A PAGAR: ' + res.moneda + ' ' + res.total;

                console.log('productosjson:', productosjson); //Depuración

                //Limpiar PayPal antes de renderizar de nuevo
                document.querySelector('#paypal-button-container').innerHTML = '';
                botonPaypal(res.totalPaypal);

            } else {
                tableLista.innerHTML = `<tr>
                    <td colspan="5" class="text-center">CARRITO VACÍO</td>
                </tr>`;
            }
        }
    }
}

function botonPaypal(total) {
    paypal.Buttons({
        style: {
            color: 'blue',
            shape: 'pill',
            label: 'pay',
            height: 40
        },

        createOrder: (data, actions) => {
            return actions.order.create({
                application_context: {
                    shipping_preference: "NO_SHIPPING"
                },
                purchase_units: [{
                    amount: {
                        currency_code: 'USD',
                        value: total,
                        breakdown: {
                            item_total: {
                                currency_code: 'USD',
                                value: total
                            },
                            shipping: {
                                currency_code: 'USD',
                                value: "0.00"
                            }
                        }
                    },
                    items: productosjson
                }]
            });
        },

        onApprove: (data, actions) => {
            return actions.order.capture().then(function (orderData) {
                registrarPedido(orderData)
            });
        }

    }).render('#paypal-button-container');
}

function registrarPedido(datos) {
    const url = base_url + 'clientes/registrarPedido';
    const http = new XMLHttpRequest();
    http.open('POST', url, true);
    http.send(JSON.stringify({
        pedidos: datos,
        productos: listaCarrito
    }));
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            const res = JSON.parse(this.responseText);
            Swal.fire(
                'Aviso',
                res.msg,
                res.icono
            )
            if (res.icono == 'success') {
                localStorage.removeItem('listaCarrito')
                setTimeout(() => {
                    window.location.reload();
                }, 2000);
            }
        }
    }
}

function verPedido(idPedido) {
    estadoEnviado.classList.remove('services-icon-wap');
    estadoProceso.classList.remove('services-icon-wap');
    estadoCompletado.classList.remove('services-icon-wap');
    var mPedido = new bootstrap.Modal(document.getElementById('modalPedido'))
    const url = base_url + 'clientes/VerPedido/' + idPedido;
    const http = new XMLHttpRequest();
    http.open('GET', url, true);
    http.send();
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            const res = JSON.parse(this.responseText);  
            let html = '';
            if (res.pedido.proceso == 1) {
                estadoEnviado.classList.add('services-icon-wap');
            } else if (res.pedido.proceso == 2) {
                estadoProceso.classList.add('services-icon-wap');
            }else{
                estadoCompletado.classList.add('services-icon-wap');
            }
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
            mPedido.show();
        }
    }
    
}

function agregarCalificacion(id_producto, cantidad) {
     const url = base_url + 'clientes/agregarCalificacion';
    const http = new XMLHttpRequest();
    http.open('POST', url, true);
    http.send(JSON.stringify({
        id_producto: id_producto,
        cantidad: cantidad
    }));
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            const res = JSON.parse(this.responseText);
            Swal.fire(
                'Aviso',
                res.msg,
                res.icono
            )
            if (res.icono == 'success') {
                tblCalificacion.ajax.reload();
            }
        }
    }
}
