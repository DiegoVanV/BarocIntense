<x-layouts.app :title="__('Edit Product')">
    <div class="py-6 px-4 sm:px-6 lg:px-8">
        <div class="max-w-2xl mx-auto">

            <div class="mb-6">
                <h1 class="text-3xl font-bold" style="color: #212121">{{ __('Edit Product') }}</h1>
                <p class="mt-2" style="color: #666666">{{ __('Update the product details below.') }}</p>
            </div>


            <form action="{{ route('product.update', $product) }}" method="POST" class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                @csrf
                @method('PUT')


                <div class="mb-6">
                    <label for="naam" class="block text-sm font-medium text-gray-900 dark:text-white mb-2">{{ __('Product Name') }} <span class="text-red-500">*</span></label>
                    <input type="text" id="naam" name="naam" value="{{ old('naam', $product->naam) }}" required class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('naam')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>


                <div class="mb-6">
                    <label for="categorie" class="block text-sm font-medium text-gray-900 dark:text-white mb-2">{{ __('Category') }} <span class="text-red-500">*</span></label>
                    <select id="categorie" name="categorie" required class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">-- {{ __('Select a category') }} --</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat }}" {{ old('categorie', $product->categorie) === $cat ? 'selected' : '' }}>
                                {{ $cat }}
                            </option>
                        @endforeach
                    </select>
                    @error('categorie')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>


                <div class="mb-6">
                    <label for="product_code" class="block text-sm font-medium text-gray-900 dark:text-white mb-2">{{ __('Product Code') }} <span class="text-red-500">*</span></label>
                    <input type="text" id="product_code" name="product_code" value="{{ old('product_code', $product->product_code) }}" required class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('product_code')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>


                <div class="mb-6">
                    <label for="prijs" class="block text-sm font-medium text-gray-900 dark:text-white mb-2">{{ __('Price') }} <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <span class="absolute left-4 top-2 text-gray-500 dark:text-gray-400">€</span>
                        <input type="number" id="prijs" name="prijs" value="{{ old('prijs', $product->prijs) }}" step="0.01" min="0" required class="w-full pl-8 pr-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                    @error('prijs')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>


                <div class="mb-6">
                    <label for="voorraad" class="block text-sm font-medium text-gray-900 dark:text-white mb-2">{{ __('Stock') }} <span class="text-red-500">*</span></label>
                    <input type="number" id="voorraad" name="voorraad" value="{{ old('voorraad', $product->voorraad) }}" min="0" required class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('voorraad')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>


                <div class="mb-6">
                    <label for="installatiekosten" class="block text-sm font-medium text-gray-900 dark:text-white mb-2">{{ __('Installation Costs') }} <span class="text-gray-500 text-xs">({{ __('optional') }})</span></label>
                    <div class="relative">
                        <span class="absolute left-4 top-2 text-gray-500 dark:text-gray-400">€</span>
                        <input type="number" id="installatiekosten" name="installatiekosten" value="{{ old('installatiekosten', $product->installatiekosten) }}" step="0.01" min="0" class="w-full pl-8 pr-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                    @error('installatiekosten')
                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>


                <div class="flex justify-between">
                    <a href="{{ route('product.management') }}" class="px-6 py-2 rounded-lg transition" style="border: 2px solid #ffd700; color: #212121; background-color: white;">
                        {{ __('Cancel') }}
                    </a>
                    <button type="submit" class="px-6 py-2 text-white rounded-lg transition" style="background-color: #ffd700; color: #212121;">
                        {{ __('Update Product') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>
