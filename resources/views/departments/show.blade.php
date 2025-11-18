<x-layouts.app :title="$department->name">
    <div class="py-6 px-4 sm:px-6 lg:px-8">
        <div class="max-w-5xl mx-auto">

            <h1 class="text-2xl font-semibold" style="color: #212121">
                {{ $department->name }}
            </h1>

            <p class="text-sm text-gray-600 mb-4">
                Dit is de pagina voor de afdeling <strong>{{ $department->name }}</strong>.
            </p>

            <div class="bg-white rounded-lg shadow p-4">
                <p class="text-gray-700">
                    Hier kan later specifieke informatie komen voor deze afdeling.
                </p>
            </div>

        </div>
    </div>
</x-layouts.app>
