<x-app-layout>

    <div class="container">
        <h2 class="mb-4">Logs Personalizados</h2>

        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Fecha</th>
                    <th>Nivel</th>
                    <th>Mensaje</th>
                    <th>Contexto</th>
                </tr>
            </thead>
            <tbody>
                @forelse($logs as $index => $log)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td><code>{{ $log['fecha'] }}</code></td>
                        <td>
                            <span
                                class="badge 
                            @if ($log['nivel'] === 'INFO') bg-info text-dark
                            @elseif($log['nivel'] === 'ERROR') bg-danger
                            @elseif($log['nivel'] === 'WARNING') bg-warning text-dark
                            @else bg-secondary @endif">
                                {{ $log['nivel'] }}
                            </span>
                        </td>
                        <td><strong>{{ $log['mensaje'] }}</strong></td>
                        <td>
                            @if (is_array($log['contexto']))
                                @foreach ($log['contexto'] as $k => $v)
                                    <span class="badge bg-light text-dark border me-1 mb-1">
                                        <strong>{{ ucfirst($k) }}:</strong> {{ $v }}
                                    </span>
                                @endforeach
                            @else
                                <em>Sin datos</em>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">No hay logs registrados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</x-app-layout>
