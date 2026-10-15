@extends('layouts.app')

@section('title', 'Bienvenido de vuelta')

@section('content')
    <div class="relative flex min-h-screen items-center justify-center overflow-hidden bg-[#090a12] px-4 py-8 text-white sm:py-12">
        <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(ellipse_at_15%_10%,_rgba(109,40,217,0.18),_transparent_40%),radial-gradient(ellipse_at_90%_85%,_rgba(219,39,119,0.12),_transparent_38%)]"></div>

        <main class="relative z-10 w-full max-w-md">
            <a href="{{ url('/') }}" class="mx-auto mb-7 flex w-fit items-center gap-2 text-xs font-black tracking-[0.16em] text-white" aria-label="Novelverse, inicio">
                <span class="flex size-9 items-center justify-center rounded-xl bg-gradient-to-br from-violet-500 to-pink-500 text-sm">N</span>
                NOVELVERSE
            </a>

            <section class="rounded-3xl border border-white/10 bg-[#11131e]/95 p-5 shadow-2xl shadow-black/40 backdrop-blur sm:p-8">
                <div class="mb-7 text-center">
                    <span class="mx-auto mb-4 flex size-12 items-center justify-center rounded-2xl border border-fuchsia-300/15 bg-fuchsia-400/10 text-xl text-fuchsia-200" aria-hidden="true">&#10022;</span>
                    <h1 class="text-2xl font-extrabold tracking-tight sm:text-3xl">Bienvenido de vuelta</h1>
                    <p class="mt-2 text-sm text-slate-400">Tus historias y tu fandom te estaban esperando.</p>
                </div>

                <form action="{{ route('login') }}" method="POST" class="space-y-5">
                    @csrf

                    @error('auth')
                        <p class="rounded-xl border border-rose-300/20 bg-rose-300/10 px-4 py-3 text-xs text-rose-200">{{ $message }}</p>
                    @enderror

                    <x-form-input
                        name="email"
                        label="Correo electrónico o ID de fan"
                        placeholder="fan@novelverse.com o @tuID"
                        autocomplete="username"
                        :value="old('email')"
                        required
                    />

                    <div>
                        <x-form-input
                            name="password"
                            label="Contraseña"
                            type="password"
                            placeholder="Introduce tu contraseña"
                            autocomplete="current-password"
                            required
                        />
                        <div class="mt-2 text-right">
                            <span class="text-[11px] text-slate-500">¿Olvidaste tu contraseña?</span>
                        </div>
                    </div>

                    <label class="flex cursor-pointer items-center gap-2.5 text-xs text-slate-400">
                        <input type="checkbox" name="remember" value="1" @checked(old('remember')) class="size-4 rounded border-slate-600 bg-slate-800 accent-fuchsia-500">
                        Mantener sesión iniciada
                    </label>

                    <x-action-button>
                        Iniciar Sesión <span aria-hidden="true">&rarr;</span>
                    </x-action-button>
                </form>

                <div class="my-6 flex items-center gap-3 text-[9px] font-semibold tracking-[0.18em] text-slate-500">
                    <span class="h-px flex-1 bg-white/10"></span>
                    O CONTINÚA CON
                    <span class="h-px flex-1 bg-white/10"></span>
                </div>

                <div class="grid grid-cols-2 gap-2.5">
                    <x-action-button type="button" variant="secondary" class="w-full"><span class="font-bold text-white">G</span> Google</x-action-button>
                    <x-action-button type="button" variant="secondary" class="w-full"><span aria-hidden="true">&#63743;</span> Apple</x-action-button>
                    <x-action-button type="button" variant="secondary" class="w-full"><span class="font-bold text-rose-300">微</span> Weibo</x-action-button>
                    <x-action-button type="button" variant="secondary" class="w-full"><span class="font-bold text-amber-300">K</span> Kakao</x-action-button>
                </div>

                <p class="mt-7 text-center text-xs text-slate-500">
                    ¿Nuevo en el fandom?
                    <a href="{{ url('/register') }}" class="font-semibold text-fuchsia-300 transition hover:text-pink-200">Crea tu FanID</a>
                </p>
            </section>

            <p class="mt-5 text-center text-[10px] text-slate-600">Al continuar, aceptas nuestras reglas de comunidad y política de privacidad.</p>
        </main>
    </div>
@endsection