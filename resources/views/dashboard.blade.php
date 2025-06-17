<x-app-layout>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <div class="container py-4">


        {{-- Tarjetas de resumen --}}
        <div class="row g-4 mb-4"> {{-- Changed g-3 to g-4 for slightly more gutter space --}}
            <div class="col-xl-3 col-md-6 mb-4"> {{-- Added col-xl-3 and mb-4 for better responsiveness and spacing --}}
                <div class="card bg-primary text-white shadow-sm border-0 dashboard-card"> {{-- Added shadow-sm and border-0, custom class dashboard-card --}}
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="card-title text-uppercase mb-2">Productos</h5> {{-- Added text-uppercase and mb-2 --}}
                                <p class="fs-3 fw-bold">{{ $totalProductos }}</p> {{-- Changed fs-4 to fs-3 and added fw-bold --}}
                            </div>
                            <i class="fas fa-box fa-3x opacity-50"></i> {{-- Example icon --}}
                        </div>
                        <div class="card-footer bg-transparent border-top-0 pt-2 text-end"> {{-- Added footer for consistency --}}
                            <a href="{{ route('productos.index') }}" class="text-white small text-decoration-none">Ver
                                más <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card bg-warning text-dark shadow-sm border-0 dashboard-card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="card-title text-uppercase mb-2">Stock bajo</h5>
                                <p class="fs-3 fw-bold">{{ $productosBajoStock->count() }}</p>
                            </div>
                            <i class="fas fa-exclamation-triangle fa-3x opacity-50"></i> {{-- Example icon --}}
                        </div>
                        <div class="card-footer bg-transparent border-top-0 pt-2 text-end">
                            <a href="{{ route('productos.index') }}" class="text-dark small text-decoration-none">Ver
                                más <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card bg-success text-white shadow-sm border-0 dashboard-card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="card-title text-uppercase mb-2">Ventas hoy</h5>
                                <p class="fs-3 fw-bold">${{ number_format($ventasHoy, 0, ',', '.') }}</p>
                            </div>
                            <i class="fas fa-dollar-sign fa-3x opacity-50"></i> {{-- Example icon --}}
                        </div>
                        <div class="card-footer bg-transparent border-top-0 pt-2 text-end">
                            <a href="{{ route('ventas.index') }}" class="text-white small text-decoration-none">Ver más
                                <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card bg-info text-white shadow-sm border-0 dashboard-card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="card-title text-uppercase mb-2">Ventas este mes</h5>
                                <p class="fs-3 fw-bold">${{ number_format($ventasMes, 0, ',', '.') }}</p>
                            </div>
                            <i class="fas fa-calendar-alt fa-3x opacity-50"></i> {{-- Example icon --}}
                        </div>
                        <div class="card-footer bg-transparent border-top-0 pt-2 text-end">
                            <a href="{{ route('ventas.index') }}" class="text-white small text-decoration-none">Ver más
                                <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <style>
            /* Add a subtle hover effect and slight elevation */
            .dashboard-card {
                transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
                border-radius: 0.75rem;
                /* Slightly more rounded corners */
                overflow: hidden;
                /* Ensures content respects border-radius */
            }

            .dashboard-card:hover {
                transform: translateY(-5px);
                /* Lifts the card slightly on hover */
                box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
                /* Stronger shadow on hover */
            }

            /* Adjust card body padding for a bit more space */
            .dashboard-card .card-body {
                padding: 1.5rem;
                /* More padding inside the card */
            }

            /* Style for the footer links */
            .dashboard-card .card-footer {
                padding-top: 0.75rem;
                padding-bottom: 0.75rem;
                border-top: 1px solid rgba(255, 255, 255, 0.2);
                /* Subtle border for footer */
                font-size: 0.875rem;
                /* Smaller font for footer text */
            }

            .dashboard-card .card-footer a {
                font-weight: 500;
                transition: color 0.2s ease;
            }

            .dashboard-card .card-footer a:hover {
                color: rgba(255, 255, 255, 0.8) !important;
                /* Lighter text on hover for dark cards */
            }

            /* Adjust specific text colors for better contrast on warning card */
            .card.bg-warning.text-dark .card-footer a {
                color: rgba(0, 0, 0, 0.6) !important;
            }

            .card.bg-warning.text-dark .card-footer a:hover {
                color: rgba(0, 0, 0, 0.8) !important;
            }

            /* Ensure icons are aligned and have some transparency */
            .dashboard-card i.fas {
                opacity: 0.4;
                /* Slightly transparent icons */
                margin-left: 1rem;
                transition: opacity 0.2s ease;
            }

            .dashboard-card:hover i.fas {
                opacity: 0.6;
                /* Icons become more visible on hover */
            }

            /* Improve font size for the numbers */
            .dashboard-card .fs-3 {
                font-size: calc(1.3rem + .6vw) !important;
                /* Responsive font size for large numbers */
            }

            /* Ensure card titles are clearly visible */
            .dashboard-card .card-title {
                letter-spacing: 0.05em;
                /* A bit of letter spacing */
                font-weight: 600;
                /* Bolder titles */
            }
        </style>


        <div class="row">
            {{-- Productos con stock bajo --}}
            <div class="col-md-6 mb-4">
                <div class="card  dashboard-card"> {{-- Added dashboard-card class --}}
                    <div class="card-header bg-blue-200 text-dark d-flex align-items-center"> {{-- Added d-flex and align-items-center --}}
                        <i class="fas fa-box fa-fw me-2"></i> {{-- Icon for products --}}
                        <h5 class="mb-0">Productos con poco stock</h5> {{-- Changed to h5 and added mb-0 --}}
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive table-scroll-limit"> {{-- Added table-responsive for small screens --}}
                            <table class="table table-sm table-striped table-hover m-0 "> {{-- Added table-striped and table-hover --}}
                                <thead>
                                    <tr>
                                        <th class="text-nowrap">Nombre</th> {{-- Added text-nowrap --}}
                                        <th class="text-nowrap text-end">Stock</th> {{-- Added text-nowrap and text-end --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($productosBajoStock as $producto)
                                        <tr>
                                            <td>{{ $producto->nombre }}</td>
                                            <td class="text-end">{{ $producto->stock }}</td> {{-- Aligned stock to end --}}
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="2" class="text-center text-muted py-3">
                                                <i class="fas fa-check-circle me-1"></i> Sin alertas de stock.
                                            </td> {{-- Added icon and more padding --}}
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer bg-light text-end border-top-0 pt-2 pb-2"> {{-- Added bg-light and pt-2 pb-2 for padding --}}
                        <a href="{{ route('productos.index') }}" class="text-warning small text-decoration-none">Ver
                            todos los productos <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>

            {{-- Últimas ventas --}}
            <div class="col-md-6 mb-4">
                <div class="card  dashboard-card"> {{-- Added dashboard-card class --}}
                    <div class="card-header bg-blue-200 text-black d-flex align-items-center"> {{-- Added d-flex and align-items-center --}}
                        <i class="fas fa-shopping-cart fa-fw me-2"></i> {{-- Icon for sales --}}
                        <h5 class="mb-0">Últimas ventas</h5> {{-- Changed to h5 and added mb-0 --}}
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive table-scroll-limit"> {{-- Added table-responsive for small screens --}}
                            <table class="table table-sm table-striped table-hover m-0"> {{-- Added table-striped and table-hover --}}
                                <thead>
                                    <tr>
                                        <th class="text-nowrap">Fecha</th> {{-- Added text-nowrap --}}
                                        <th class="text-nowrap text-end">Total</th> {{-- Added text-nowrap and text-end --}}
                                        <th class="text-nowrap text-end">Productos</th> {{-- Added text-nowrap and text-end --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($ultimasVentas as $venta)
                                        <tr>
                                            <td class="text-nowrap">{{ $venta->created_at->format('Y-m-d H:i') }}</td>
                                            {{-- Added text-nowrap --}}
                                            <td class="text-end">${{ number_format($venta->total, 0, ',', '.') }}</td>
                                            {{-- Aligned total to end --}}
                                            <td class="text-end">{{ $venta->detalles->sum('cantidad') }}</td>
                                            {{-- Aligned products to end --}}
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center text-muted py-3">
                                                <i class="fas fa-info-circle me-1"></i> No hay ventas recientes.
                                            </td> {{-- Added icon and more padding --}}
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer bg-light text-end border-top-0 pt-2 pb-2"> {{-- Added bg-light and pt-2 pb-2 for padding --}}
                        <a href="{{ route('ventas.index') }}" class="text-success small text-decoration-none">Ver
                            historial de ventas <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <div id="loadingOverlay"
            style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.3); z-index: 1000; justify-content: center; align-items: center;">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Cargando...</span>
            </div>
        </div>
        <div class="container text-center">
            <!-- Botones de filtro -->
            <div class="row">
                <!-- Gráfico de Ventas -->
                <div class="col bg-white graficas">
                    <div class="btn-group mt-2" role="group" aria-label="Filtros de tiempo">
                        <button type="button" class="btn btn-sm btn-outline-primary filter-btn"
                            data-filter="hoy">Hoy</button>
                        <button type="button" class="btn btn-sm btn-outline-primary filter-btn"
                            data-filter="7dias">7 Días</button>
                        <button type="button" class="btn btn-sm btn-outline-primary filter-btn"
                            data-filter="mes">Este Mes</button>
                    </div>
                    <canvas id="graficoVentas"></canvas>
                </div>

                <!-- Nuevo Gráfico de Ganancias -->
                <div class="col bg-white graficas ml-6">
                    <div class="btn-group mt-2" role="group" aria-label="Filtros de tiempo">
                        <button type="button" class="btn btn-sm btn-outline-primary filter-btn"
                            data-filter="hoy">Hoy</button>
                        <button type="button" class="btn btn-sm btn-outline-primary filter-btn"
                            data-filter="7dias">7 Días</button>
                        <button type="button" class="btn btn-sm btn-outline-primary filter-btn"
                            data-filter="mes">Este Mes</button>
                    </div>
                    <canvas id="graficoGanancias"></canvas>
                </div>
            </div>

            <script>
                // Variables globales para los gráficos
                let chartVentas, chartGanancias;

                // Inicializar los gráficos cuando el DOM esté listo
                document.addEventListener('DOMContentLoaded', function() {
                    initCharts();
                    setupFilterButtons();
                });

                // Función para inicializar los gráficos
                function initCharts() {
                    // Gráfico de Ventas
                    const ctxVentas = document.getElementById('graficoVentas').getContext('2d');
                    chartVentas = new Chart(ctxVentas, {
                        type: 'line',
                        data: {
                            labels: @json($labels),
                            datasets: [{
                                label: 'Ventas ($)',
                                data: @json($ventas),
                                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                                borderColor: 'rgb(54, 162, 235)',
                                borderWidth: 2,
                                fill: true,
                                tension: 0.3
                            }]
                        },
                        options: getChartOptions('Historial de Ventas')
                    });

                    // Gráfico de Ganancias
                    const ctxGanancias = document.getElementById('graficoGanancias').getContext('2d');
                    chartGanancias = new Chart(ctxGanancias, {
                        type: 'line',
                        data: {
                            labels: @json($labels),
                            datasets: [{
                                label: 'Ganancias ($)',
                                data: @json($ganancias),
                                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                borderColor: 'rgb(75, 192, 192)',
                                borderWidth: 2,
                                fill: true,
                                tension: 0.3
                            }]
                        },
                        options: getChartOptions('Historial de Ganancias')
                    });
                }

                // Función para opciones comunes del gráfico
                function getChartOptions(title) {
                    return {
                        responsive: true,
                        plugins: {
                            title: {
                                display: true,
                                text: title,
                                font: {
                                    size: 16
                                }
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        return '$' + context.raw.toLocaleString();
                                    }
                                }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    callback: function(value) {
                                        return '$' + value.toLocaleString();
                                    }
                                }
                            }
                        }
                    };
                }

                // Configurar los eventos de los botones
                function setupFilterButtons() {
                    const buttons = document.querySelectorAll('.filter-btn');

                    buttons.forEach(button => {
                        button.addEventListener('click', function() {
                            const filter = this.getAttribute('data-filter');
                            cambiarFiltro(filter);

                            // Actualizar estado activo de los botones (en ambos grupos)
                            document.querySelectorAll('.filter-btn').forEach(btn => {
                                btn.classList.remove('btn-primary');
                                btn.classList.add('btn-outline-primary');
                            });

                            // Activar solo los botones con el mismo filtro en ambos grupos
                            document.querySelectorAll(`.filter-btn[data-filter="${filter}"]`).forEach(btn => {
                                btn.classList.remove('btn-outline-primary');
                                btn.classList.add('btn-primary');
                            });
                        });
                    });
                }

                // Función para cambiar el filtro (actualiza ambas gráficas)
                function cambiarFiltro(filtro) {
                    // Mostrar carga
                    document.getElementById('loadingOverlay').style.display = 'flex';

                    // Hacer la petición AJAX
                    fetch(`/dashboard?filtro=${filtro}&ajax=1`, {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'Accept': 'application/json'
                            }
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Error en la respuesta del servidor');
                            }
                            return response.json();
                        })
                        .then(data => {
                            // Actualizar ambos gráficos
                            chartVentas.data.labels = data.labels;
                            chartVentas.data.datasets[0].data = data.ventas;
                            chartVentas.update();

                            chartGanancias.data.labels = data.labels;
                            chartGanancias.data.datasets[0].data = data.ganancias;
                            chartGanancias.update();

                            // Ocultar carga
                            document.getElementById('loadingOverlay').style.display = 'none';
                        })
                        .catch(error => {
                            console.error('Error al cambiar filtro:', error);
                            document.getElementById('loadingOverlay').style.display = 'none';
                            alert('Error al cargar los datos. Por favor intenta nuevamente.');
                        });
                }
            </script>
        </div>


        <style>
            .graficas {
                border-radius: 30px;
                border: 2px solid rgba(0, 0, 0, 0.125);
                box-shadow: 5px 5px 5px rgba(0, 0, 0, 0.15);
            }

            /* ... (your existing dashboard-card styles from the previous response) ... */

            /* Further refine table styles within dashboard cards */
            .table-scroll-limit {
                max-height: 250px;
                /* ajusta según tu preferencia */
                overflow-y: auto;
            }

            .dashboard-card .card-header {
                font-size: 1.1rem;
                /* Slightly larger font for header title */
                font-weight: 600;
                /* Bolder header title */
                padding: 0.75rem 1.25rem;
                /* Standard Bootstrap card-header padding */
                border-bottom: 1px solid rgba(0, 0, 0, 0.125);
                /* Default header border */
                border-top-left-radius: 0.75rem;
                /* Match card border-radius */
                border-top-right-radius: 0.75rem;
                /* Match card border-radius */
            }

            .dashboard-card .card-header h5 {
                font-size: 1.1rem;
                /* Ensure h5 inside header matches font-size */
                font-weight: inherit;
                /* Inherit font-weight from parent */
            }

            .dashboard-card .card-body .table {
                margin-bottom: 0;
                /* Remove default table margin */
                font-size: 0.9rem;
                /* Slightly smaller font for table content */
            }

            .dashboard-card .card-body .table th,
            .dashboard-card .card-body .table td {
                padding: 0.75rem;
                /* Consistent padding for table cells */
                vertical-align: middle;
                /* Vertically align content */
            }

            .dashboard-card .card-body .table thead th {
                border-bottom: 2px solid rgba(0, 0, 0, 0.125);
                /* Clearer header border */
                background-color: rgba(0, 0, 0, 0.03);
                /* Subtle background for table header */
            }

            /* Style for the "no data" message */
            .dashboard-card .card-body .table tbody td.text-center {
                font-style: italic;
                color: #6c757d;
                /* Muted text color */
            }

            /* Adjust specific header colors */
            .dashboard-card .card-header.bg-warning {
                border-bottom-color: rgba(0, 0, 0, 0.125);
                /* Ensure border matches card border */
            }

            .dashboard-card .card-header.bg-success {
                border-bottom-color: rgba(255, 255, 255, 0.2);
                /* Ensure border matches card border */
            }

            /* Footer styling for tables */
            .dashboard-card .card-footer {
                border-top: 1px solid rgba(0, 0, 0, 0.125);
                /* Consistent border for table footer */
                border-bottom-left-radius: 0.75rem;
                /* Match card border-radius */
                border-bottom-right-radius: 0.75rem;
                /* Match card border-radius */
                background-color: #f8f9fa;
                /* Light background for footer */
            }

            .dashboard-card .card-footer a {
                font-weight: 500;
                transition: color 0.2s ease;
            }

            /* Override footer link color for specific cards */
            .dashboard-card .card-footer .text-warning {
                color: #ffc107 !important;
                /* Ensure warning link color is correct */
            }

            .dashboard-card .card-footer .text-success {
                color: #28a745 !important;
                /* Ensure success link color is correct */
            }

            .dashboard-card .card-footer .text-warning:hover {
                color: #e0a800 !important;
            }

            .dashboard-card .card-footer .text-success:hover {
                color: #218838 !important;
            }

            /* Icon within card header */
            .dashboard-card .card-header .fas {
                font-size: 1.25rem;
                /* Slightly larger icon in header */
                opacity: 0.8;
                /* Subtle opacity */
            }

            /* Specific adjustments for dark mode if you're implementing it */
        </style>
</x-app-layout>
