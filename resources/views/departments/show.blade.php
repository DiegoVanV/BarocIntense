<x-layouts.app :title="$department->name">
    <div class="py-6 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">

            <h1 class="text-2xl font-semibold mb-6" style="color: #212121">
                {{ $department->name }}
            </h1>

            @if($department->slug === 'products')
                @include('departments.sections.products')

            @elseif($department->slug === 'onderhoud')
                @include('departments.sections.onderhoud')

            @else
                <div class="bg-white rounded-lg shadow p-4">
                    <p class="text-gray-700">
                        Hier kan later specifieke informatie komen voor deze afdeling.
                    </p>
                </div>
            @endif

        </div>
    </div>
</x-layouts.app>
