<x-app-layout>
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

    <div class="p-6 bg-gray-100 min-h-screen">
        <div class="max-w-7xl mx-auto bg-white p-8 rounded-lg shadow-md">
            <div class="flex flex-col md:flex-row justify-between items-center mb-6">
                <h1 class="text-3xl font-extrabold text-gray-800 mb-4 md:mb-0">Gestión de Productos</h1>

                <div class="flex flex-col md:flex-row items-center gap-4">
                    <form method="GET" action="{{ route('productos.index') }}" class="flex items-center gap-2">
                        <input type="text" name="buscar" value="{{ request('buscar') }}"
                            placeholder="Buscar por nombre o código"
                            class="shadow-sm border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm w-64" />
                        <button type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-150 ease-in-out">
                            <i class="fas fa-search mr-1"></i> Buscar
                        </button>
                        @if (request('buscar'))
                            <button type="button"
                                class="px-3 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 transition duration-150 ease-in-out"
                                onclick="location.href='{{ route('productos.index') }}'">
                                <svg width="24px" height="24px" viewBox="0 0 48 48" version="1"
                                    xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 48 48">
                                    <g fill="#1565C0">
                                        <path
                                            d="M13,13c0-3.3,2.7-6,6-6h10c3.3,0,6,2.7,6,6h4c0-5.5-4.5-10-10-10H19C13.5,3,9,7.5,9,13v11.2h4V13z" />
                                        <polygon points="4.6,22 11,30.4 17.4,22" />
                                    </g>
                                    <g fill="#1565C0">
                                        <path
                                            d="M35,35c0,3.3-2.7,6-6,6H19c-3.3,0-6-2.7-6-6H9c0,5.5,4.5,10,10,10h10c5.5,0,10-4.5,10-10V23h-4V35z" />
                                        <polygon points="30.6,26 37,17.6 43.4,26" />
                                    </g>
                                </svg>
                            </button>
                        @endif
                    </form>

                    <button type="button"
                        class="px-6 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition duration-150 ease-in-out shadow-md"
                        data-bs-toggle="modal" data-bs-target="#productoModal">
                        <i class="fas fa-plus mr-2"></i> Nuevo Producto
                    </button>
                    <!-- From Uiverse.io by KINGFRESS -->


                </div>
            </div>

            <div class="modal fade" id="productoModal" tabindex="-1" aria-labelledby="productoModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content rounded-lg shadow-xl">
                        <form id="productoForm" action="{{ route('productos.store') }}" method="POST">
                            @csrf
                            <div class="modal-header bg-indigo-600 px-6 py-4 rounded-t-lg">
                                <h2 class="modal-title text-2xl font-semibold text-white" id="productoModalLabel">
                                    Registrar Producto</h2>
                                <button type="button" class="btn-close text-white opacity-100" data-bs-dismiss="modal"
                                    aria-label="Cerrar"></button>
                            </div>
                            <div class="modal-body p-6">
                                <div class="mb-4">
                                    <label for="codigo_barras" class="block text-gray-700 text-sm font-bold mb-2">Código
                                        de barras</label>
                                    <input type="text" name="codigo_barras" value="{{ old('codigo_barras') }}"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-indigo-500 @error('codigo_barras') border-red-500 @enderror"
                                        required />
                                    @error('codigo_barras')
                                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="nombre"
                                        class="block text-gray-700 text-sm font-bold mb-2">Nombre</label>
                                    <input type="text" name="nombre" value="{{ old('nombre') }}"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-indigo-500 @error('nombre') border-red-500 @enderror"
                                        required />
                                    @error('nombre')
                                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="stock"
                                        class="block text-gray-700 text-sm font-bold mb-2">Stock</label>
                                    <input type="number" name="stock" value="{{ old('stock') }}"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-indigo-500 @error('stock') border-red-500 @enderror"
                                        required min="0" />
                                    <p class="text-red-500 text-xs italic mt-2 hidden" id="stock-error"></p>
                                    @error('stock')
                                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="precio_compra" class="block text-gray-700 text-sm font-bold mb-2">Precio
                                        de compra</label>
                                    <input type="number" name="precio_compra" value="{{ old('precio_compra') }}"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-indigo-500 @error('precio_compra') border-red-500 @enderror"
                                        required min="0" step="0.01" />
                                    <p class="text-red-500 text-xs italic mt-2 hidden" id="precio-compra-error"></p>
                                    @error('precio_compra')
                                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="precio_venta" class="block text-gray-700 text-sm font-bold mb-2">Precio
                                        de venta</label>
                                    <input type="number" name="precio_venta" value="{{ old('precio_venta') }}"
                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-indigo-500 @error('precio_venta') border-red-500 @enderror"
                                        required min="0" step="0.01" />
                                    <p class="text-red-500 text-xs italic mt-2 hidden" id="precio-venta-error"></p>
                                    @error('precio_venta')
                                        <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="modal-footer flex justify-end p-6 bg-gray-50 rounded-b-lg">
                                <button type="button"
                                    class="px-4 py-2 mr-2 bg-gray-300 text-gray-800 rounded-md hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition duration-150 ease-in-out"
                                    data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" id="guardarBtn"
                                    class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition duration-150 ease-in-out">Guardar</button>

                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="overflow-x-auto rounded-lg shadow-md border border-gray-200">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Código</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nombre</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Stock</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Precio de compra</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Precio de venta</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($productos as $producto)
                            <tr class="hover:bg-gray-50 transition duration-150 ease-in-out">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $producto->codigo_barras }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $producto->nombre }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $producto->stock }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    ${{ number_format($producto->precio_compra) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    ${{ number_format($producto->precio_venta) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm flex gap-2">
                                    <button title="Agregar Stock"
                                        class="px-4 py-2 text-white rounded-md hover:bg-blue-400 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-2 transition duration-150 ease-in-out"
                                        data-bs-toggle="modal" data-bs-target="#agregarStockModal{{ $producto->id }}">
                                        <?xml version="1.0" encoding="utf-8"?><svg
                                            xmlns="http://www.w3.org/2000/svg" fill="#000000" width="25px"
                                            height="25px" viewBox="0 0 24 24">
                                            <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z" />
                                        </svg>
                                    </button>
                                    <button title="Editar"
                                        class="px-4 py-2 text-white rounded-md hover:bg-yellow-400 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:ring-offset-2 transition duration-150 ease-in-out"
                                        data-bs-toggle="modal" data-bs-target="#editarModal{{ $producto->id }}">
                                        <?xml version="1.0" encoding="utf-8"?>
                                        <!-- License: PD. Made by Mary Akveo: https://maryakveo.com/ -->
                                        <svg fill="#000000" width="25px" height="25px" viewBox="0 0 24 24"
                                            id="edit" data-name="Line Color" xmlns="http://www.w3.org/2000/svg"
                                            class="icon line-color">
                                            <line id="secondary" x1="21" y1="21" x2="3"
                                                y2="21"
                                                style="fill: none; stroke: rgb(44, 169, 188); stroke-linecap: round; stroke-linejoin: round; stroke-width: 2;">
                                            </line>
                                            <path id="primary"
                                                d="M19.88,7,11,15.83,7,17l1.17-4,8.88-8.88A2.09,2.09,0,0,1,20,4,2.09,2.09,0,0,1,19.88,7Z"
                                                style="fill: none; stroke: rgb(0, 0, 0); stroke-linecap: round; stroke-linejoin: round; stroke-width: 2;">
                                            </path>
                                        </svg>
                                    </button>
                                    <form action="{{ route('productos.destroy', $producto) }}" method="POST"
                                        class="inline-block"
                                        onsubmit="return confirmDelete(event, '{{ $producto->nombre }}')">
                                        @csrf
                                        @method('DELETE')
                                        <button title="Eliminar" type="submit"
                                            class="px-4 py-2 text-white rounded-md hover:bg-red-400 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition duration-150 ease-in-out"><svg
                                                width="25px" height="25px" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M7 4a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v2h4a1 1 0 1 1 0 2h-1.069l-.867 12.142A2 2 0 0 1 17.069 22H6.93a2 2 0 0 1-1.995-1.858L4.07 8H3a1 1 0 0 1 0-2h4V4zm2 2h6V4H9v2zM6.074 8l.857 12H17.07l.857-12H6.074zM10 10a1 1 0 0 1 1 1v6a1 1 0 1 1-2 0v-6a1 1 0 0 1 1-1zm4 0a1 1 0 0 1 1 1v6a1 1 0 1 1-2 0v-6a1 1 0 0 1 1-1z"
                                                    fill="#0D0D0D" />
                                            </svg></button>

                                    </form>
                                </td>
                            </tr>

                            <div class="modal fade" id="editarModal{{ $producto->id }}" tabindex="-1"
                                aria-labelledby="editarModalLabel{{ $producto->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content rounded-lg shadow-xl">
                                        <form action="{{ route('productos.update', $producto->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-header bg-yellow-500 px-6 py-4 rounded-t-lg">
                                                <h5 class="modal-title text-2xl font-semibold text-white"
                                                    id="editarModalLabel{{ $producto->id }}">Editar Producto</h5>
                                                <button type="button" class="btn-close text-white opacity-100"
                                                    data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                            </div>
                                            <div class="modal-body p-6">
                                                <div class="mb-4">
                                                    <label for="edit_nombre_{{ $producto->id }}"
                                                        class="block text-gray-700 text-sm font-bold mb-2">Nombre</label>
                                                    <input type="text" name="nombre"
                                                        id="edit_nombre_{{ $producto->id }}"
                                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-indigo-500"
                                                        value="{{ $producto->nombre }}" required>
                                                </div>
                                                <div class="mb-4">
                                                    <label for="edit_codigo_barras_{{ $producto->id }}"
                                                        class="block text-gray-700 text-sm font-bold mb-2">Código de
                                                        barras</label>
                                                    <input type="text" name="codigo_barras"
                                                        id="edit_codigo_barras_{{ $producto->id }}"
                                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-indigo-500"
                                                        value="{{ $producto->codigo_barras }}" required>
                                                </div>
                                                <div class="mb-4">
                                                    <label for="edit_precio_compra_{{ $producto->id }}"
                                                        class="block text-gray-700 text-sm font-bold mb-2">Precio de
                                                        compra</label>
                                                    <input type="number" name="precio_compra"
                                                        id="edit_precio_compra_{{ $producto->id }}"
                                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-indigo-500"
                                                        step="0.01" min="0"
                                                        value="{{ $producto->precio_compra }}" required>
                                                </div>
                                                <div class="mb-4">
                                                    <label for="edit_precio_venta_{{ $producto->id }}"
                                                        class="block text-gray-700 text-sm font-bold mb-2">Precio de
                                                        venta</label>
                                                    <input type="number" name="precio_venta"
                                                        id="edit_precio_venta_{{ $producto->id }}"
                                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-indigo-500"
                                                        step="0.01" min="0"
                                                        value="{{ $producto->precio_venta }}" required>
                                                    <p class="text-red-500 text-xs italic mt-2 hidden"
                                                        id="edit-precio-venta-error-{{ $producto->id }}"></p>
                                                </div>
                                                <div class="mb-4">
                                                    <label for="edit_stock_{{ $producto->id }}"
                                                        class="block text-gray-700 text-sm font-bold mb-2">Stock</label>
                                                    <input type="number" name="stock"
                                                        id="edit_stock_{{ $producto->id }}"
                                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-indigo-500"
                                                        min="0" value="{{ $producto->stock }}" required>
                                                </div>
                                            </div>
                                            <div class="modal-footer flex justify-end p-6 bg-gray-50 rounded-b-lg">
                                                <button type="button"
                                                    class="px-4 py-2 mr-2 bg-gray-300 text-gray-800 rounded-md hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition duration-150 ease-in-out"
                                                    data-bs-dismiss="modal">Cancelar</button>
                                                <button type="submit"
                                                    class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition duration-150 ease-in-out">Guardar
                                                    cambios</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal para agregar stock -->
                            <div class="modal fade" id="agregarStockModal{{ $producto->id }}" tabindex="-1"
                                aria-labelledby="agregarStockLabel{{ $producto->id }}" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content rounded-lg shadow-xl">
                                        <form action="{{ route('productos.agregarStock', $producto->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <div class="modal-header bg-blue-500 px-6 py-4 rounded-t-lg">
                                                <h5 class="modal-title text-2xl font-semibold text-white"
                                                    id="agregarStockLabel{{ $producto->id }}">Agregar Stock</h5>
                                                <button type="button" class="btn-close text-white opacity-100"
                                                    data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                            </div>
                                            <div class="modal-body p-6">
                                                <div class="mb-4">
                                                    <label for="stock_agregar_{{ $producto->id }}"
                                                        class="block text-gray-700 text-sm font-bold mb-2">Cantidad a
                                                        agregar</label>
                                                    <input type="number" name="cantidad" min="1"
                                                        id="stock_agregar_{{ $producto->id }}"
                                                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-indigo-500"
                                                        required>
                                                </div>
                                            </div>
                                            <div class="modal-footer flex justify-end p-6 bg-gray-50 rounded-b-lg">
                                              
                                                <button type="submit"
                                                    class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Agregar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                    No hay productos registrados.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="mt-6">
                    {{ $productos->links() }}
                </div>
            </div>


        </div>

    </div>

    <script>
        // Global function for delete confirmation
        function confirmDelete(event, productName) {
            event.preventDefault(); // Prevent the form from submitting immediately
            Swal.fire({
                title: '¿Estás seguro?',
                text: `El producto "${productName}" será eliminado permanentemente. ¡No podrás revertir esta acción!`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#DC2626', // Tailwind red-600
                cancelButtonColor: '#4B5563', // Tailwind gray-600
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    event.target.submit(); // Submit the form if confirmed
                }
            });
            return false; // Prevent default form submission even if SweetAlert fails
        }

        document.addEventListener('DOMContentLoaded', function() {
            // New Product Modal Validation
            const newProductForm = document.getElementById('productoForm');
            if (newProductForm) {
                newProductForm.addEventListener('submit', function(event) {
                    let isValid = true;

                    // Clear previous errors
                    document.querySelectorAll('.is-invalid').forEach(el => el.classList.remove(
                        'is-invalid'));
                    document.querySelectorAll('.invalid-feedback').forEach(el => {
                        el.textContent = '';
                        el.classList.add('hidden');
                    });
                    document.querySelectorAll('.text-red-500.text-xs.italic.mt-2').forEach(el => {
                        if (el.id === '' || !el.id.startsWith(
                                'edit-')) { // Avoid clearing server-side errors on edit forms
                            el.textContent = '';
                            el.classList.add('hidden');
                        }
                    });

                    const stockInput = newProductForm.querySelector('input[name="stock"]');
                    const precioCompraInput = newProductForm.querySelector('input[name="precio_compra"]');
                    const precioVentaInput = newProductForm.querySelector('input[name="precio_venta"]');

                    const stockError = document.getElementById('stock-error');
                    const precioCompraError = document.getElementById('precio-compra-error');
                    const precioVentaError = document.getElementById('precio-venta-error');

                    // Validate stock (though HTML5 validation helps, backend can still send invalid data)
                    if (stockInput.value === '' || isNaN(stockInput.value) || parseFloat(stockInput.value) <
                        0) {
                        stockInput.classList.add('border-red-500');
                        stockError.textContent = 'El stock debe ser un número válido y no negativo.';
                        stockError.classList.remove('hidden');
                        isValid = false;
                    }

                    const precioCompra = parseFloat(precioCompraInput.value);
                    const precioVenta = parseFloat(precioVentaInput.value);

                    // Validate precio_compra
                    if (precioCompraInput.value === '' || isNaN(precioCompra) || precioCompra < 0) {
                        precioCompraInput.classList.add('border-red-500');
                        precioCompraError.textContent =
                            'El precio de compra debe ser un número válido y no negativo.';
                        precioCompraError.classList.remove('hidden');
                        isValid = false;
                    }

                    // Validate precio_venta
                    if (precioVentaInput.value === '' || isNaN(precioVenta) || precioVenta < 0) {
                        precioVentaInput.classList.add('border-red-500');
                        precioVentaError.textContent =
                            'El precio de venta debe ser un número válido y no negativo.';
                        precioVentaError.classList.remove('hidden');
                        isValid = false;
                    } else if (precioVenta <= precioCompra) {
                        precioVentaInput.classList.add('border-red-500');
                        precioVentaError.textContent =
                            'El precio de venta debe ser mayor al precio de compra.';
                        precioVentaError.classList.remove('hidden');
                        isValid = false;
                    }


                    if (!isValid) {
                        event.preventDefault(); // Stop form submission
                    }
                });

                // Real-time validation for new product modal
                newProductForm.querySelector('input[name="precio_venta"]').addEventListener('input', function() {
                    const precioCompra = parseFloat(newProductForm.querySelector(
                        'input[name="precio_compra"]').value);
                    const precioVenta = parseFloat(this.value);
                    const precioVentaError = document.getElementById('precio-venta-error');

                    if (isNaN(precioVenta) || precioVenta < 0) {
                        this.classList.add('border-red-500');
                        precioVentaError.textContent =
                            'El precio de venta debe ser un número válido y no negativo.';
                        precioVentaError.classList.remove('hidden');
                    } else if (precioVenta <= precioCompra) {
                        this.classList.add('border-red-500');
                        precioVentaError.textContent =
                            'El precio de venta debe ser mayor al precio de compra.';
                        precioVentaError.classList.remove('hidden');
                    } else {
                        this.classList.remove('border-red-500');
                        precioVentaError.textContent = '';
                        precioVentaError.classList.add('hidden');
                    }
                });
            }

            // Edit Product Modal Validation (loop through each product's modal)
            document.querySelectorAll('[id^="editarModal"]').forEach(modalElement => {
                modalElement.addEventListener('submit', function(event) {
                    const productId = this.id.replace('editarModal', '');
                    let isValid = true;

                    // Clear previous errors for this specific modal
                    this.querySelectorAll('.border-red-500').forEach(el => el.classList.remove(
                        'border-red-500'));
                    this.querySelectorAll('.text-red-500.text-xs.italic.mt-2').forEach(el => {
                        el.textContent = '';
                        el.classList.add('hidden');
                    });

                    const editPrecioCompraInput = this.querySelector(
                        `#edit_precio_compra_${productId}`);
                    const editPrecioVentaInput = this.querySelector(
                        `#edit_precio_venta_${productId}`);
                    const editPrecioVentaError = this.querySelector(
                        `#edit-precio-venta-error-${productId}`);

                    const editPrecioCompra = parseFloat(editPrecioCompraInput.value);
                    const editPrecioVenta = parseFloat(editPrecioVentaInput.value);

                    if (isNaN(editPrecioCompra) || editPrecioCompra < 0) {
                        editPrecioCompraInput.classList.add('border-red-500');
                        isValid = false;
                    }

                    if (isNaN(editPrecioVenta) || editPrecioVenta < 0) {
                        editPrecioVentaInput.classList.add('border-red-500');
                        editPrecioVentaError.textContent =
                            'El precio de venta debe ser un número válido y no negativo.';
                        editPrecioVentaError.classList.remove('hidden');
                        isValid = false;
                    } else if (editPrecioVenta <= editPrecioCompra) {
                        editPrecioVentaInput.classList.add('border-red-500');
                        editPrecioVentaError.textContent =
                            'El precio de venta debe ser mayor al precio de compra.';
                        editPrecioVentaError.classList.remove('hidden');
                        isValid = false;
                    }

                    if (!isValid) {
                        event.preventDefault(); // Stop form submission
                    }
                });

                // Real-time validation for edit product modal
                const editPrecioVentaInput = modalElement.querySelector('input[name="precio_venta"]');
                if (editPrecioVentaInput) {
                    editPrecioVentaInput.addEventListener('input', function() {
                        const productId = this.id.replace('edit_precio_venta_', '');
                        const editPrecioCompra = parseFloat(modalElement.querySelector(
                            `input[name="precio_compra"]`).value);
                        const editPrecioVenta = parseFloat(this.value);
                        const editPrecioVentaError = modalElement.querySelector(
                            `#edit-precio-venta-error-${productId}`);

                        if (isNaN(editPrecioVenta) || editPrecioVenta < 0) {
                            this.classList.add('border-red-500');
                            editPrecioVentaError.textContent =
                                'El precio de venta debe ser un número válido y no negativo.';
                            editPrecioVentaError.classList.remove('hidden');
                        } else if (editPrecioVenta <= editPrecioCompra) {
                            this.classList.add('border-red-500');
                            editPrecioVentaError.textContent =
                                'El precio de venta debe ser mayor al precio de compra.';
                            editPrecioVentaError.classList.remove('hidden');
                        } else {
                            this.classList.remove('border-red-500');
                            editPrecioVentaError.textContent = '';
                            editPrecioVentaError.classList.add('hidden');
                        }
                    });
                }
            });
        });
    </script>
</x-app-layout>
