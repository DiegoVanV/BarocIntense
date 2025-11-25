<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-white dark:bg-zinc-800">
                <flux:sidebar sticky stashable class="border-e" style="border-color: #ffd700; background-color: #ffffff;">
            <flux:sidebar.toggle class="lg:hidden" icon="x-mark" style="color: #212121;" />

            <a href="{{ route('dashboard') }}" class="me-5 flex items-center space-x-2 rtl:space-x-reverse" wire:navigate style="color: #212121;">
                <x-app-logo />
            </a>

            @php
                $user = auth()->user();
            @endphp

            <flux:navlist variant="outline">
                <flux:navlist.group :heading="__('')" class="grid">
                    <flux:navlist.item icon="home" :href="route('dashboard')" :current="request()->routeIs('dashboard')" wire:navigate :class="request()->routeIs('dashboard') ? 'border-l-4' : ''" style="color: #212121; transition: all 0.2s;" :style="request()->routeIs('dashboard') ? 'border-color: #ffd700 !important' : ''">{{ __('Dashboard') }}</flux:navlist.item>
                </flux:navlist.group>
            </flux:navlist>

            @if($user && $user->isManager())
                <flux:navlist class="mt-4" variant="outline">
                    <flux:navlist.group :heading="__('Departments')" class="grid">
                        @foreach(\App\Models\Department::all() as $d)
                            <flux:navlist.item :href="route('departments.show', $d)" :current="request()->routeIs('departments.show') && request()->route('department') && request()->route('department')->id == $d->id" wire:navigate :class="request()->routeIs('departments.show') && request()->route('department') && request()->route('department')->id == $d->id ? 'border-l-4' : ''" style="color: #212121;" :style="request()->routeIs('departments.show') && request()->route('department') && request()->route('department')->id == $d->id ? 'border-color: #ffd700 !important' : ''">{{ $d->name }}</flux:navlist.item>
                        @endforeach
                    </flux:navlist.group>
                </flux:navlist>
            @elseif($user && $user->department)
                <flux:navlist class="mt-4" variant="outline">
                    <flux:navlist.group :heading="__('Department')" class="grid">
                        <flux:navlist.item :href="route('departments.show', $user->department)" :current="request()->routeIs('departments.show') && request()->route('department') && request()->route('department')->id == $user->department->id" wire:navigate :class="request()->routeIs('departments.show') && request()->route('department') && request()->route('department')->id == $user->department->id ? 'border-l-4' : ''" style="color: #212121;" :style="request()->routeIs('departments.show') && request()->route('department') && request()->route('department')->id == $user->department->id ? 'border-color: #ffd700 !important' : ''">{{ $user->department->name }}</flux:navlist.item>
                    </flux:navlist.group>
                </flux:navlist>
            @endif



            <flux:spacer />



            <!-- Desktop User Menu -->
            <flux:dropdown class="hidden lg:block" position="bottom" align="start">
                <flux:profile
                    :name="auth()->user()->name"
                    :initials="auth()->user()->initials()"
                    icon:trailing="chevrons-up-down"
                    data-test="sidebar-menu-button"
                />

                <flux:menu class="w-[220px]">
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                    <span
                                        class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white"
                                    >
                                        {{ auth()->user()->initials() }}
                                    </span>
                                </span>

                                <div class="grid flex-1 text-start text-sm leading-tight">
                                    <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                    <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <flux:menu.radio.group>
                        <flux:menu.item :href="route('profile.edit')" icon="cog" wire:navigate>{{ __('Settings') }}</flux:menu.item>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full" data-test="logout-button">
                            {{ __('Log Out') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:sidebar>

        <!-- Mobile User Menu -->
        <flux:header class="lg:hidden">
            <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

            <flux:spacer />

            <flux:dropdown position="top" align="end">
                <flux:profile
                    :initials="auth()->user()->initials()"
                    icon-trailing="chevron-down"
                />

                <flux:menu>
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                                <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                    <span
                                        class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white"
                                    >
                                        {{ auth()->user()->initials() }}
                                    </span>
                                </span>

                                <div class="grid flex-1 text-start text-sm leading-tight">
                                    <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                    <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <flux:menu.radio.group>
                        <flux:menu.item :href="route('profile.edit')" icon="cog" wire:navigate>{{ __('Settings') }}</flux:menu.item>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full" data-test="logout-button">
                            {{ __('Log Out') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:header>

        {{ $slot }}

        @fluxScripts
    </body>
</html>
