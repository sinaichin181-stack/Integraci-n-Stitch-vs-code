@extends('layouts.app')

@section('title', 'Crea tu FanID Oficial')

@section('content')
    <div class="min-h-screen bg-[#090a12] px-4 py-6 text-white sm:py-10">
        <main class="mx-auto max-w-md">
            <header class="mb-6 flex items-center justify-between">
                <a href="{{ url('/') }}" class="flex items-center gap-2 text-xs font-black tracking-[0.16em] text-white" aria-label="Novelverse, inicio">
                    <span class="flex size-8 items-center justify-center rounded-xl bg-gradient-to-br from-violet-500 to-pink-500 text-sm">N</span>
                    NOVELVERSE
                </a>
                <a href="{{ url('/') }}" class="text-xs font-semibold text-slate-400 transition hover:text-white">Saltar</a>
            </header>

            <div class="mb-5">
                <div class="mb-2 flex items-center justify-between text-[10px] font-semibold text-slate-400">
                    <span>Paso 1 de 2 <span class="px-1 text-slate-600">|</span> Credencial de entrada</span>
                    <span>90% completado</span>
                </div>
                <div class="h-1 overflow-hidden rounded-full bg-slate-800">
                    <div class="h-full w-[90%] rounded-full bg-gradient-to-r from-violet-500 to-pink-400"></div>
                </div>
            </div>

            <section class="rounded-3xl border border-white/10 bg-[#11131e] p-5 shadow-2xl shadow-black/30 sm:p-7">
                <h1 class="text-2xl font-extrabold tracking-tight sm:text-3xl">Crea tu <span class="bg-gradient-to-r from-violet-300 to-pink-300 bg-clip-text text-transparent">FanID Oficial</span></h1>
                <p class="mt-2 text-xs leading-relaxed text-slate-400">Únete a la mayor comunidad de adaptaciones de novelas, apoya a tus actores favoritos y colecciona beneficios exclusivos.</p>

                <div class="mt-4 flex flex-wrap gap-2" aria-label="Beneficios">
                    <span class="rounded-full border border-amber-300/20 bg-amber-300/10 px-3 py-1.5 text-[10px] font-semibold text-amber-200">5 votos diarios gratis</span>
                    <span class="rounded-full border border-rose-300/20 bg-rose-300/10 px-3 py-1.5 text-[10px] font-semibold text-rose-200">Preventa de boletos</span>
                    <span class="rounded-full border border-violet-300/20 bg-violet-300/10 px-3 py-1.5 text-[10px] font-semibold text-violet-200">Acceso fan</span>
                </div>

                <form class="mt-6 space-y-5" action="{{ route('register.store') }}" method="POST">
                    @csrf

                    <x-form-input
                        name="name"
                        label="Nombre de usuario / Fan nickname"
                        placeholder="LuminaShipper"
                        autocomplete="nickname"
                        required
                    />

                    <x-form-input
                        name="email"
                        label="Correo electrónico"
                        type="email"
                        placeholder="tu-correo@fandom.com"
                        autocomplete="email"
                        required
                    />

                    <div>
                        <x-form-input
                            name="password"
                            label="Contraseña"
                            type="password"
                            placeholder="Crea una contraseña segura"
                            autocomplete="new-password"
                            required
                        />
                        <div class="mt-2 flex items-center justify-between text-[10px]">
                            <span class="text-slate-500">Seguridad de contraseña</span>
                            <span class="font-semibold text-emerald-300">Fuerte y segura</span>
                        </div>
                        <div class="mt-1 flex gap-1" aria-hidden="true">
                            <span class="h-1 flex-1 rounded-full bg-fuchsia-500"></span>
                            <span class="h-1 flex-1 rounded-full bg-violet-500"></span>
                            <span class="h-1 flex-1 rounded-full bg-emerald-400"></span>
                            <span class="h-1 flex-1 rounded-full bg-slate-700"></span>
                        </div>
                    </div>

                    <fieldset>
                        <div class="mb-3 flex items-center justify-between gap-3">
                            <legend class="text-xs font-semibold text-slate-200">Actor favorito principal</legend>
                            <span class="text-[10px] text-slate-500">Elige tu bias</span>
                        </div>
                        <div class="grid grid-cols-4 gap-2">
                            <x-selection-card name="favorite_actor" value="mina-park" label="Mina Park" image="{{ asset('images/actor-mina-park.jpg') }}" :image-exists="file_exists(public_path('images/actor-mina-park.jpg'))" fallback="MP" selected />
                            <x-selection-card name="favorite_actor" value="dylan-wu" label="Dylan Wu" image="{{ asset('images/actor-dylan-wu.jpg') }}" :image-exists="file_exists(public_path('images/actor-dylan-wu.jpg'))" fallback="DW" />
                            <x-selection-card name="favorite_actor" value="sora-han" label="Sora Han" image="{{ asset('images/actor-sora-han.jpg') }}" :image-exists="file_exists(public_path('images/actor-sora-han.jpg'))" fallback="SH" />
                            <x-selection-card name="favorite_actor" value="ji-ho-kim" label="Ji-ho Kim" image="{{ asset('images/actor-ji-ho-kim.jpg') }}" :image-exists="file_exists(public_path('images/actor-ji-ho-kim.jpg'))" fallback="JK" />
                        </div>
                        @error('favorite_actor')
                            <p class="mt-2 text-xs text-rose-300">{{ $message }}</p>
                        @enderror
                    </fieldset>

                    <fieldset>
                        <legend class="mb-3 text-xs font-semibold text-slate-200">Género de novela predilecto</legend>
                        <div class="grid grid-cols-2 gap-2">
                            <x-selection-card name="favorite_genre" value="romance-fantasy" label="Romance Fantasía" icon="R" selected compact />
                            <x-selection-card name="favorite_genre" value="music-history" label="Música / Histórico" icon="M" compact />
                            <x-selection-card name="favorite_genre" value="contemporary-bl" label="BL Contemporáneo" icon="B" compact />
                            <x-selection-card name="favorite_genre" value="mystery-thriller" label="Misterio & Thriller" icon="T" compact />
                        </div>
                        @error('favorite_genre')
                            <p class="mt-2 text-xs text-rose-300">{{ $message }}</p>
                        @enderror
                    </fieldset>

                    <div class="space-y-3">
                        <label class="flex cursor-pointer items-start gap-2.5 text-[10px] leading-relaxed text-slate-400">
                            <input type="checkbox" name="terms" value="1" @checked(old('terms')) required class="mt-0.5 size-3.5 shrink-0 rounded border-slate-600 bg-slate-800 accent-fuchsia-500">
                            <span>Acepto las <a href="#" class="font-semibold text-fuchsia-300 underline decoration-fuchsia-300/40 underline-offset-2">Reglas de Convivencia del Fandom</a> y la <a href="#" class="font-semibold text-fuchsia-300 underline decoration-fuchsia-300/40 underline-offset-2">Política de Privacidad</a>.</span>
                        </label>
                        @error('terms')
                            <p class="text-xs text-rose-300">{{ $message }}</p>
                        @enderror
                        <label class="flex cursor-pointer items-start gap-2.5 text-[10px] leading-relaxed text-slate-400">
                            <input type="checkbox" name="updates" value="1" @checked(old('updates')) class="mt-0.5 size-3.5 shrink-0 rounded border-slate-600 bg-slate-800 accent-fuchsia-500">
                            <span>Quiero recibir noticias, alertas de casting y promociones exclusivas para fans.</span>
                        </label>
                    </div>

                    <x-action-button class="mt-1">
                        Crear mi FanID y entrar <span aria-hidden="true">&rarr;</span>
                    </x-action-button>
                </form>

                <div class="my-5 flex items-center gap-3 text-[9px] font-semibold tracking-[0.18em] text-slate-500">
                    <span class="h-px flex-1 bg-white/10"></span>
                    O REGÍSTRATE CON
                    <span class="h-px flex-1 bg-white/10"></span>
                </div>

                <div class="grid grid-cols-2 gap-2">
                    <x-action-button type="button" variant="secondary"><span class="font-bold">G</span> Google</x-action-button>
                    <x-action-button type="button" variant="secondary"><span aria-hidden="true">&#63743;</span> Apple</x-action-button>
                </div>

                <p class="mt-5 text-center text-xs text-slate-500">¿Ya eres miembro? <a href="{{ url('/login') }}" class="font-semibold text-fuchsia-300 hover:text-pink-200">Inicia sesión</a></p>
            </section>
        </main>
    </div>
@endsection