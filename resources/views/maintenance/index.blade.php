<x-layouts.app :title="__('Onderhoud - Machines')">
    <div class="py-6 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <h1 class="text-2xl font-bold mb-6" style="color: #212121">Onderhoud - Machines</h1>
            <form method="GET" class="mb-4 flex flex-wrap gap-2 items-end">
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Zoek op naam, type, serienummer..." class="px-3 py-2 border rounded-lg" />
                <select name="status" class="px-3 py-2 border rounded-lg">
                    <option value="">Alle statussen</option>
                    <option value="operationeel" @selected(request('status')==='operationeel')>Operationeel</option>
                    <option value="storing" @selected(request('status')==='storing')>Storing</option>
                    <option value="gepland_onderhoud" @selected(request('status')==='gepland_onderhoud')>Gepland onderhoud</option>
                </select>
                <button type="submit" class="px-4 py-2 rounded-lg" style="background-color: #ffd700; color: #212121;">Filter</button>
            </form>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2">
                    <div class="overflow-x-auto bg-white rounded-lg shadow">
                        <table class="w-full">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 text-left">Naam</th>
                            <th class="px-4 py-2 text-left">Type</th>
                            <th class="px-4 py-2 text-left">Serienummer</th>
                            <th class="px-4 py-2 text-left">Status</th>
                            <th class="px-4 py-2 text-left">Actie</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($machines as $machine)
                            <tr class="border-b">
                                <td class="px-4 py-2">{{ $machine->naam }}</td>
                                <td class="px-4 py-2">{{ $machine->type }}</td>
                                <td class="px-4 py-2">{{ $machine->serienummer }}</td>
                                <td class="px-4 py-2">
                                    @if($machine->status === 'operationeel')
                                        <span class="px-2 py-1 rounded-full text-xs font-semibold" style="background:#27ae60; color:white;">Operationeel</span>
                                    @elseif($machine->status === 'storing')
                                        <span class="px-2 py-1 rounded-full text-xs font-semibold" style="background:#e74c3c; color:white;">Storing</span>
                                    @else
                                        <span class="px-2 py-1 rounded-full text-xs font-semibold" style="background:#f39c12; color:white;">Gepland onderhoud</span>
                                    @endif
                                </td>
                                <td class="px-4 py-2">
                                    <a href="{{ route('maintenance.show', $machine) }}" class="text-blue-600 hover:underline">Details</a>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="text-center py-4">Geen machines gevonden.</td></tr>
                        @endforelse
                    </tbody>
                </table>
                    </div>
                </div>

                <aside class="hidden lg:block">
                    <div class="bg-white rounded-lg shadow p-4 mb-4">
                        <h3 class="font-semibold mb-3">Aankomende onderhoud</h3>
                        @if(isset($upcoming) && $upcoming->count())
                            <ul class="space-y-2 text-sm">
                                @foreach($upcoming as $order)
                                    <li class="border rounded p-2">
                                        <div class="font-medium">{{ $order->titel }}</div>
                                        <div class="text-xs text-gray-500">{{ $order->gepland_op }} — {{ $order->machine?->naam ?? 'Onbekend' }}</div>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-sm text-gray-600">Geen gepland onderhoud in de nabije toekomst.</p>
                        @endif
                        <div class="mt-4">
                            <a href="{{ route('departments.show', ['department' => \App\Models\Department::where('slug','onderhoud')->first()]) }}" class="inline-block px-3 py-2 rounded" style="background:#ffd700;color:#212121;">Open Onderhoud</a>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </div>
</x-layouts.app>
