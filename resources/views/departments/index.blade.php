<x-layouts.app :title="__('Departments')">
    <div class="py-6 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <h1 class="text-2xl font-semibold" style="color: #212121">{{ __('Departments') }}</h1>

            <div class="mt-4 bg-white rounded-lg shadow p-4">
                <ul class="divide-y">
                    @foreach($departments as $d)
                        <li class="py-3 flex justify-between items-center">
                            <div>
                                <a href="{{ route('departments.show', $d) }}" class="font-medium text-gray-800">{{ $d->name }}</a>
                                <div class="text-sm text-gray-500">{{ $d->products()->count() }} {{ __('products') }}</div>
                            </div>
                            <a href="{{ route('departments.show', $d) }}" class="px-3 py-1 rounded text-white" style="background-color: #ffd700; color: #212121;">{{ __('Open') }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</x-layouts.app>
