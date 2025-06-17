<x-app-layout>
    <!-- CSS de Select2 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

    <!-- JS de Select2 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    @if (session('success'))
        <script>
            Swal.fire({
                icon: "success",
                title: '¡Éxito!',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 1500
            });
        </script>
    @endif
    @if (session('error'))
        <script>
            Swal.fire({
                icon: "error",
                title: '¡Error!',
                text: '{{ session('error') }}',
                showConfirmButton: false,
                timer: 1500
            });
        </script>
    @endif


    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center mb-6">
                        <h1 class="text-3xl font-extrabold text-gray-900 leading-tight">Gestión de Ventas</h1>

                        <button type="button"
                            class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150"
                            data-bs-toggle="modal" data-bs-target="#ventaModal">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Nueva Venta
                        </button>
                        <!-- Modal de Registro de Venta -->
                        <div class="modal fade" id="ventaModal" tabindex="-1" aria-labelledby="ventaModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <form action="{{ route('ventas.store') }}" method="POST">
                                        @csrf
                                        <div class="modal-header bg-primary text-white">
                                            <h5 class="modal-title" id="ventaModalLabel">Registrar Nueva Venta</h5>
                                            <button type="button" class="btn-close btn-close-white"
                                                data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- Input para escanear código -->
                                            <div class="mb-3">
                                                <label for="codigo-barras" class="form-label">Escanea el código de
                                                    barras</label>
                                                <input type="text" id="codigo-barras" class="form-control"
                                                    placeholder="Escanea el código..." autofocus>
                                            </div>

                                            <!-- Tabla dinámica -->
                                            <div class="table-responsive mb-3">
                                                <table class="table table-bordered" id="tabla-productos">
                                                    <thead class="table-primary">
                                                        <tr>
                                                            <th>Producto</th>
                                                            <th width="120">Cantidad</th>
                                                            <th width="120">Precio</th>
                                                            <th width="120">Subtotal</th>
                                                            <th width="50">Acción</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody></tbody>
                                                </table>
                                            </div>

                                            <!-- Sección del Total -->
                                            <div class="row justify-content-end">
                                                <div class="col-md-4">
                                                    <div class="card border-primary">
                                                        <div class="card-body">
                                                            <h5 class="card-title text-end">Total de la Compra</h5>
                                                            <h3 class="text-end text-primary" id="total-compra">$0.00
                                                            </h3>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                <i class="fas fa-times me-1"></i> Cancelar
                                            </button>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-check-circle me-1"></i> Registrar Venta
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="entradaModal" tabindex="-1" aria-labelledby="entradaModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <form action="{{ route('ventas.store') }}" method="POST">
                                        @csrf

                                        <div class="modal-header">
                                            <h5 class="modal-title" id="entradaModalLabel">Registrar Nueva Venta</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-striped" id="productos-table">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Producto</th>
                                                            <th scope="col">Cantidad</th>
                                                            <th scope="col" class="text-center"
                                                                style="width: 100px;">
                                                                <button type="button" class="btn btn-success btn-sm"
                                                                    id="add-row">
                                                                    <svg class="w-4 h-4 mr-2" fill="none"
                                                                        stroke="currentColor" viewBox="0 0 24 24"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                        <path stroke-linecap="round"
                                                                            stroke-linejoin="round" stroke-width="2"
                                                                            d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                                                    </svg> </button>
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <select name="productos[0][producto_id]"
                                                                    class="form-select" required>
                                                                    <option value="">Seleccione</option>
                                                                    @foreach ($productos as $producto)
                                                                        <option value="{{ $producto->id }}">
                                                                            {{ $producto->nombre }} (Stock:
                                                                            {{ $producto->stock }})
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <input type="number" name="productos[0][cantidad]"
                                                                    class="form-control" min="1" required>
                                                            </td>
                                                            <td></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Cancelar</button>
                                            <button type="submit" class="btn btn-primary">Registrar Venta</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Id
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Total
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Fecha
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Acciones
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($ventas as $venta)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{ $venta->id }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                ${{ $venta->total }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $venta->created_at->format('d/m/Y H:i') }}
                                            </td>
                                            <td class=" py-2 whitespace-nowrap text-sm text-gray-500">
                                                 <form action="{{ route('ventas.show', $venta->id) }}" method="GET">
                                                <button title="Agregar Stock"
                                                    class="px-4 py-2 text-white rounded-md hover:bg-blue-300 focus:outline-none focus:ring-2 focus:ring-blue-300 focus:ring-offset-2 transition duration-150 ease-in-out"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#agregarStockModal{{ $producto->id }}">
                                                    <?xml version="1.0" encoding="utf-8"?><svg fill="#000000" width="25px" height="25px"
                                                            viewBox="0 0 24 24" id="file-search"
                                                            data-name="Line Color" xmlns="http://www.w3.org/2000/svg"
                                                            class="icon line-color">
                                                            <path id="secondary"
                                                                d="M14,19a4,4,0,1,0-4-4A4,4,0,0,0,14,19Zm7,2-4-3.4"
                                                                style="fill: none; stroke: rgb(44, 169, 188); stroke-linecap: round; stroke-linejoin: round; stroke-width: 2;">
                                                            </path>
                                                            <path id="primary"
                                                                d="M8,20H4a1,1,0,0,1-1-1V4A1,1,0,0,1,4,3h8.59a1,1,0,0,1,.7.29l3.42,3.42a1,1,0,0,1,.29.7V8"
                                                                style="fill: none; stroke: rgb(0, 0, 0); stroke-linecap: round; stroke-linejoin: round; stroke-width: 2;">
                                                            </path>
                                                        </svg>
                                                </button>
                                                 </form>

                                               
                                                   
                                               

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="mt-6">
                                {{ $ventas->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function() {
            $('.btn-ver-detalle').on('click', function() {
                var ventaId = $(this).data('id');

                $('#contenidoDetalleVenta').html('Cargando...');

                $.get('/ventas/' + ventaId, function(data) {
                    $('#contenidoDetalleVenta').html(data);
                    $('#modalDetalleVenta').modal('show');
                }).fail(function() {
                    $('#contenidoDetalleVenta').html(
                        '<div class="alert alert-danger">Error al cargar el detalle.</div>');
                });
            });
        });
    </script>
    <script>
        const productos = @json($productos); // Asumes que viene del controlador
        let rowCount = 0;

        document.getElementById('codigo-barras').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                const codigo = this.value.trim();
                this.value = '';

                const producto = productos.find(p => p.codigo_barras === codigo);

                if (!producto) {
                    alert('Producto no encontrado');
                    return;
                }

                const existe = document.querySelector(`#producto-${producto.id}`);
                if (existe) {
                    const cantidadInput = existe.querySelector('.cantidad');
                    cantidadInput.value = parseInt(cantidadInput.value) + 1;
                    actualizarSubtotal(existe);
                    return;
                }
                const tbody = document.querySelector('#tabla-productos tbody');
                const row = document.createElement('tr');
                row.id = `producto-${producto.id}`;
                row.innerHTML = `
                <td>
                    ${producto.nombre}
                    <input type="hidden" name="productos[${rowCount}][producto_id]" value="${producto.id}">
                </td>
                <td>
                    <input type="number" name="productos[${rowCount}][cantidad]" class="form-control cantidad" value="1" min="1">
                </td>
                <td>${producto.precio_venta}</td>
                <td class="subtotal">${producto.precio_venta}</td>
                <td><button type="button" class="btn btn-danger btn-sm eliminar">X</button></td>
            `;
                tbody.appendChild(row);
                actualizarEventos(row);
                rowCount++;
            }
        });

        function actualizarEventos(row) {
            row.querySelector('.cantidad').addEventListener('input', function() {
                actualizarSubtotal(row);

            });
            calcularTotal(); // Agrega esta línea al final

            row.querySelector('.eliminar').addEventListener('click', function() {
                row.remove();
                calcularTotal(); // Agrega esta línea al final

            });
        }

        function actualizarSubtotal(row) {
            const cantidad = parseInt(row.querySelector('.cantidad').value);
            const precio = parseFloat(row.children[2].innerText);
            row.querySelector('.subtotal').innerText = (cantidad * precio).toFixed(2);
            calcularTotal(); // Agrega esta línea al final
        }

        function calcularTotal() {
            let total = 0;
            document.querySelectorAll('#tabla-productos tbody tr').forEach(row => {
                const subtotalText = row.querySelector('td:nth-child(4)').textContent;
                const subtotal = parseFloat(subtotalText.replace(/[^0-9.-]+/g, "")) || 0;
                total += subtotal;
            });

            // Actualizar el display del total
            document.getElementById('total-compra').textContent = `$${total.toFixed(2)}`;
            return total;
        }
    </script>
    <style>
        #total-compra {
            font-weight: bold;
            font-size: 1.5rem;
        }

        .card-title {
            font-size: 1rem;
            color: #6c757d;
        }

        .card {
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }
    </style>
</x-app-layout>
