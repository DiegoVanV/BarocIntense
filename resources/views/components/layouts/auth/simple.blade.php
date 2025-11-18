<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    @include('partials.head')
</head>

<body class="min-h-screen bg-neutral-100 antialiased dark:bg-linear-to-b dark:from-neutral-950 dark:to-neutral-900">

    <div class="flex min-h-screen flex-col items-center justify-center p-6 md:p-10">
        <div class="flex w-full max-w-md flex-col gap-6">

            <a href="{{ route('home') }}" class="flex flex-col items-center gap-2 font-medium" wire:navigate>
                <span class="flex items-center justify-center">
                    <img
                        src="{{ asset('BarocIntenseLogo/Logo2_groot.png') }}"
                        alt="Logo"
                        class="w-50 h-auto"
                    >
                </span>
                <span class="sr-only">{{ config('app.name', 'Laravel') }}</span>
            </a>

            <div class="flex flex-col gap-6">
                <div
                    class="rounded-xl border bg-white dark:bg-stone-950 dark:border-stone-800 text-stone-800 shadow-sm"
                    style="border-color: #ffd700; box-shadow: 0 4px 10px rgba(0,0,0,0.08);"
                >
                    <div class="px-10 py-8">
                        {{ $slot }}
                    </div>
                </div>
            </div>

        </div>
    </div>

    @fluxScripts
</body>
</html>

