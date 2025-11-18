<x-layouts.app :title="__('Productbeheer')">
    <div class="py-6 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h1 class="text-3xl font-bold" style="color: #212121">{{ __('Productbeheer') }}</h1>
                </div>
                <a href="{{ route('product.management.create') }}" class="inline-flex items-center px-4 py-2 text-white rounded-lg transition" style="background-color: #ffd700; color: #212121; hover: background-color: #ffed4e;">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    {{ __('Product toevoegen') }}
                </a>
            </div>

            @if (session('success'))
                <div class="mb-6 p-4 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg">
                    <p class="text-green-800 dark:text-green-200">{{ session('success') }}</p>
                </div>
            @endif

            <!-- Filters -->
            <form method="GET" action="{{ route('product.management') }}" class="mb-6 bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- Category Filter -->
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

                    <!-- Filter Actions -->
                    <div class="flex items-end gap-2">
                        <button type="submit" class="w-full px-4 py-2 text-white rounded-lg transition font-medium" style="background-color: #ffd700; color: #212121;">
                            {{ __('Filteren') }}
                        </button>
                        @if (request()->filled('category') || request()->filled('stock_status'))
                            <a href="{{ route('product.management') }}" class="px-4 py-2 rounded-lg transition font-medium" style="border: 2px solid #ffd700; color: #212121; background-color: white;">
                                {{ __('Wissen') }}
                            </a>
                        @endif
                    </div>
                </div>
            </form>

            <!-- Products Table -->
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
                                    <td class="px-6 py-4 text-sm text-gray-900 dark:text-white font-semibold">€ {{ number_format($product->prijs, 2) }}</td>
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
                                        {{ $product->installatiekosten ? '€ ' . number_format($product->installatiekosten, 2) : '-' }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-center">
                                        <div class="flex justify-center gap-2">
                                            <a href="{{ route('product.edit', $product) }}" class="transition" style="color: #ffd700;">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                </svg>
                                            </a>
                                            <form action="{{ route('product.destroy', $product) }}" method="POST" class="inline" onsubmit="return confirm('{{ __('Weet je het zeker?') }}')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="transition" style="color: #e74c3c;">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
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
                    <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-white">{{ __('Geen producten') }}</h3>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ __('Begin door een nieuw product aan te maken.') }}</p>
                    <div class="mt-6">
                        <a href="{{ route('product.management.create') }}" class="inline-flex items-center px-4 py-2 text-white rounded-lg transition" style="background-color: #ffd700; color: #212121;">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            {{ __('Voeg je eerste product toe') }}
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-layouts.app>
