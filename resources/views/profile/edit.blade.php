@extends('layouts.app')

@section('title', 'Edición de Perfil')

@section('content')
    <div class="min-h-screen bg-[#090a12] px-4 py-6 text-white sm:py-10">
        <main class="mx-auto max-w-3xl">
            <header class="mb-6 flex items-center justify-between">
                <a href="{{ url('/') }}" class="text-xs font-semibold text-slate-400 transition hover:text-white">&larr; Volver</a>
                <span class="rounded-full border border-violet-300/20 bg-violet-300/10 px-3 py-1.5 text-[10px] font-semibold text-violet-200">FanID · Perfil</span>
            </header>

            <section class="rounded-3xl border border-white/10 bg-[#11131e] shadow-2xl shadow-black/30">
                <div class="relative h-36 overflow-hidden rounded-t-3xl bg-gradient-to-r from-indigo-950 via-violet-950 to-rose-950 sm:h-48">
                    @if (file_exists(public_path('images/profile-cover.jpg')))
                        <img src="{{ asset('images/profile-cover.jpg') }}" alt="" class="size-full object-cover">
                    @else
                        <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top_right,_var(--tw-gradient-stops))] from-cyan-900/50 via-violet-950 to-slate-950"></div>
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-[#11131e] via-slate-950/10 to-black/20"></div>
                    <span class="absolute right-4 top-4 rounded-full border border-white/15 bg-black/30 px-3 py-1 text-[10px] font-semibold text-white/80">Editar perfil</span>
                </div>

                <div class="px-5 pb-6 sm:px-8 sm:pb-8">
                    <div class="relative z-10 -mt-12 mb-6 flex flex-wrap items-end justify-between gap-4">
                        <div class="flex items-end gap-4">
                            <div class="flex size-24 items-center justify-center overflow-hidden rounded-full border-4 border-[#11131e] bg-gradient-to-br from-fuchsia-500 to-violet-700 text-2xl font-extrabold text-white shadow-lg shadow-black/30">
                                @if (auth()->user()?->avatar_path)
                                    <img src="{{ asset('storage/' . auth()->user()->avatar_path) }}" alt="Avatar de {{ auth()->user()->name }}" class="size-full object-cover">
                                @elseif (file_exists(public_path('images/profile-avatar.jpg')))
                                    <img src="{{ asset('images/profile-avatar.jpg') }}" alt="Avatar de {{ auth()->user()?->name ?? 'usuario' }}" class="size-full object-cover">
                                @else
                                    <span aria-hidden="true">FU</span>
                                @endif
                            </div>
                            <div class="pb-1">
                                <h1 class="text-xl font-extrabold tracking-tight sm:text-2xl">Edición de Perfil</h1>
                                <p class="mt-1 text-xs text-slate-400">Actualiza tu identidad dentro del fandom.</p>
                            </div>
                        </div>
                        <label class="inline-flex cursor-pointer items-center rounded-full border border-white/10 bg-slate-800/80 px-4 py-2 text-xs font-semibold text-slate-100 transition hover:border-fuchsia-300/50 hover:bg-slate-700">
                            <input type="file" name="avatar" accept="image/*" form="profile-edit-form" class="sr-only">
                            Cambiar avatar
                        </label>
                    </div>

                    <form id="profile-edit-form" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PUT')

                        @if (session('status'))
                            <p class="rounded-xl border border-amber-300/20 bg-amber-300/10 px-4 py-3 text-xs text-amber-100">{{ session('status') }}</p>
                        @endif

                        <div class="grid gap-5 sm:grid-cols-2">
                            <x-form-input
                                name="name"
                                label="Nombre"
                                placeholder="Tu nombre"
                                autocomplete="name"
                                :value="auth()->user()?->name"
                            />
                            <x-form-input
                                name="handle"
                                label="Handle"
                                placeholder="@TuHandle"
                                hint="Tu identidad pública"
                                :value="auth()->user()?->handle"
                            />
                            <div class="sm:col-span-2">
                                <x-form-input
                                    name="bio"
                                    label="Biografía"
                                    placeholder="Cuéntale a la comunidad qué historias te apasionan..."
                                    :value="auth()->user()?->bio"
                                    textarea
                                    rows="4"
                                />
                            </div>
                            <x-form-input
                                name="city"
                                label="Ciudad"
                                placeholder="Tu ciudad"
                                autocomplete="address-level2"
                                :value="auth()->user()?->city"
                            />
                        </div>

                        @error('avatar')
                            <p class="text-xs text-rose-300">{{ $message }}</p>
                        @enderror

                        <div class="flex flex-col-reverse gap-3 border-t border-white/10 pt-5 sm:flex-row sm:justify-end">
                            <a href="{{ url('/') }}" class="inline-flex min-h-11 items-center justify-center rounded-xl border border-white/10 px-5 text-xs font-semibold text-slate-300 transition hover:bg-white/5">Cancelar</a>
                            <x-action-button class="sm:w-auto">Guardar cambios</x-action-button>
                        </div>
                    </form>
                </div>
            </section>
        </main>
    </div>
@endsection