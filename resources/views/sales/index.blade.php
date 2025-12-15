@php
    $products = \App\Models\Product::query();
    $categories = \App\Models\Product::getCategories();
    $stockStatuses = [
        'in_stock' => __('Op voorraad'),
        'almost_empty' => __('Bijna op'),
        'empty' => __('Uitverkocht'),
    ];

    if (request()->filled('category')) {
        $products->where('categorie', request('category'));
    }

    if (request()->filled('stock_status')) {
        $status = request('stock_status');

        if ($status === 'in_stock') {
            $products->where('voorraad', '>', 5);
        } elseif ($status === 'almost_empty') {
            $products->whereBetween('voorraad', [1, 5]);
        } elseif ($status === 'empty') {
            $products->where('voorraad', 0);
        }
    }

    $products = $products->get();
@endphp

@if (session('success'))
    <div class="mb-6 p-4 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg">
        <p class="text-green-800 dark:text-green-200">{{ session('success') }}</p>
    </div>
@endif


<form method="GET" action="{{ route('departments.show', $department) }}" class="mb-6 bg-white dark:bg-gray-800 rounded-lg shadow p-6">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div>
            <label for="category" class="block text-sm font-medium text-gray-900 dark:text-white mb-2">{{ __('Categorie') }}</label>
            <select id="category" name="category" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <option value="">-- {{ __('Alle categorieën') }} --</option>
                @foreach ($categories as $cat)
                    <option value="{{ $cat }}" {{ request('category') === $cat ? 'selected' : '' }}>
                        {{ $cat }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="stock_status" class="block text-sm font-medium text-gray-900 dark:text-white mb-2">{{ __('Voorraadstatus') }}</label>
            <select id="stock_status" name="stock_status" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <option value="">-- {{ __('Alle statussen') }} --</option>
                @foreach ($stockStatuses as $key => $label)
                    <option value="{{ $key }}" {{ request('stock_status') === $key ? 'selected' : '' }}>
                        {{ $label }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="flex items-end gap-2">
            <button type="submit" class="w-full px-4 py-2 text-white rounded-lg transition font-medium" style="background-color: #ffd700; color: #212121;">
                {{ __('Filteren') }}
            </button>
            @if (request()->filled('category') || request()->filled('stock_status'))
                <a href="{{ route('departments.show', $department) }}" class="px-4 py-2 rounded-lg transition font-medium" style="border: 2px solid #ffd700; color: #212121; background-color: white;">
                    {{ __('Wissen') }}
                </a>
            @endif
        </div>
    </div>
</form>

@if ($products->count() > 0)
    <div class="overflow-x-auto bg-white dark:bg-gray-800 rounded-lg shadow">
        <table class="w-full">
            <thead class="bg-gray-100 dark:bg-gray-700">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900 dark:text-white">{{ __('Productnaam') }}</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900 dark:text-white">{{ __('Code') }}</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900 dark:text-white">{{ __('Categorie') }}</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900 dark:text-white">{{ __('Prijs') }}</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900 dark:text-white">{{ __('Voorraad') }}</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900 dark:text-white">{{ __('Installatiekosten') }}</th>
                    <th class="px-6 py-3 text-center text-sm font-semibold text-gray-900 dark:text-white">{{ __('Acties') }}</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                @foreach ($products as $product)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition">
                        <td class="px-6 py-4 text-sm text-gray-900 dark:text-white font-medium">{{ $product->naam }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">{{ $product->product_code }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">{{ $product->categorie }}</td>
                        <td class="px-6 py-4 text-sm text-gray-900 dark:text-white font-semibold">€ {{ number_format((float) ($product->prijs ?? 0), 2) }}</td>
                        <td class="px-6 py-4 text-sm">
                            <div class="flex items-center justify-between gap-3">
                                <span class="text-xl font-bold" style="color: #212121; min-width: 40px;">{{ $product->voorraad }}</span>
                                @if ($product->voorraad > 5)
                                    <span class="px-3 py-1 text-xs font-medium rounded-full text-white whitespace-nowrap">
                                    </span>
                                @elseif ($product->voorraad > 0)
                                    <span class="px-3 py-1 text-xs font-medium rounded-full text-white whitespace-nowrap" style="background-color: #f39c12;">
                                        {{ __('Bijna uitverkocht') }}
                                    </span>
                                @else
                                    <span class="px-3 py-1 text-xs font-medium rounded-full text-white whitespace-nowrap" style="background-color: #e74c3c;">
                                        {{ __('Uitverkocht') }}
                                    </span>
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">
                            {{ $product->installatiekosten !== null ? '€ ' . number_format((float) $product->installatiekosten, 2) : '-' }}
                        </td>
                        <td class="px-6 py-4 text-sm text-center">
                            <form action="{{ route('sales.add', $product) }}" method="POST" class="flex items-center justify-center gap-2">
                                @csrf

                                <input
                                    type="number"
                                    name="quantity"
                                    min="1"
                                    max="{{ $product->voorraad }}"
                                    value="1"
                                    class="w-20 px-2 py-1 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white"
                                >

                                <button
                                    type="submit"
                                    class="px-3 py-2 text-sm font-medium rounded-lg transition"
                                    style="background-color: #ffd700; color: #212121;">
                                    {{ __('Toevoegen') }}
                                </button>
                            </form>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@else
    <div class="text-center py-12 bg-white dark:bg-gray-800 rounded-lg">
        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
            </svg>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ __('er zijn geen producten beschikbaar.') }}</p>
    </div>
@endif
