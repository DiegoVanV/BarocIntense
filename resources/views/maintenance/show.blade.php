<x-layouts.app :title="$machine->naam">
    <div class="py-6 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <div class="flex justify-between items-start mb-4">
                <div>
                    <h1 class="text-2xl font-bold" style="color: #212121">{{ $machine->naam }}</h1>
                    <p class="text-sm text-gray-600">{{ $machine->type }} — {{ $machine->serienummer }}</p>
                </div>
                <div>
                    @if($machine->status === 'operationeel')
                        <span class="px-3 py-1 rounded-full" style="background:#27ae60; color:white;">Operationeel</span>
                    @elseif($machine->status === 'storing')
                        <span class="px-3 py-1 rounded-full" style="background:#e74c3c; color:white;">Storing</span>
                    @else
                        <span class="px-3 py-1 rounded-full" style="background:#f39c12; color:white;">Gepland onderhoud</span>
                    @endif
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-4 mb-4">
                <h2 class="text-lg font-semibold mb-2">Specificaties</h2>
                <pre class="text-sm text-gray-700">{{ $machine->specificaties }}</pre>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                <div class="bg-white rounded-lg shadow p-4">
                    <h3 class="font-semibold mb-2">Onderhoudsorders</h3>
                    @if($machine->onderhoudsorders->count())
                        <ul class="space-y-2">
                            @foreach($machine->onderhoudsorders as $order)
                                <li class="p-2 border rounded">
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <strong>{{ $order->titel }}</strong>
                                            <div class="text-sm text-gray-600">{{ $order->beschrijving }}</div>
                                            <div class="text-xs text-gray-500">Gepland op: {{ $order->gepland_op }}</div>
                                        </div>
                                        <div class="text-sm">
                                            @if($order->status === 'ingepland')
                                                <span class="px-2 py-1 rounded-full" style="background:#f39c12; color:white;">Ingepland</span>
                                            @elseif($order->status === 'bezig')
                                                <span class="px-2 py-1 rounded-full" style="background:#3498db; color:white;">Bezig</span>
                                            @else
                                                <span class="px-2 py-1 rounded-full" style="background:#2ecc71; color:white;">Afgerond</span>
                                            @endif
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-sm text-gray-600">Geen onderhoudsorders gevonden.</p>
                    @endif
                </div>

                <div class="bg-white rounded-lg shadow p-4">
                    <h3 class="font-semibold mb-2">Logboek</h3>
                    @if($machine->logs->count())
                        <ul class="space-y-2 text-sm text-gray-700">
                            @foreach($machine->logs as $log)
                                <li class="p-2 border rounded">
                                    <div class="text-sm"><strong>{{ $log->gebruiker }}</strong> — <span class="text-xs text-gray-500">{{ $log->toegevoegd_op }}</span></div>
                                    <div class="mt-1">{{ $log->omschrijving }}</div>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-sm text-gray-600">Geen logboekregels gevonden.</p>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-layouts.app>
