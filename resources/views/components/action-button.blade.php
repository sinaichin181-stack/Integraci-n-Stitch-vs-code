@props([
    'type' => 'submit',
    'variant' => 'primary',
])

@php
    $classes = $variant === 'primary'
        ? 'inline-flex min-h-12 w-full items-center justify-center gap-2 rounded-full bg-gradient-to-r from-violet-600 via-fuchsia-500 to-pink-400 px-5 py-3 text-sm font-bold text-white shadow-lg shadow-fuchsia-950/30 transition hover:brightness-110 focus:outline-none focus:ring-2 focus:ring-fuchsia-300 focus:ring-offset-2 focus:ring-offset-slate-950 disabled:cursor-not-allowed disabled:opacity-60'
        : 'inline-flex min-h-11 items-center justify-center gap-2 rounded-xl border border-white/10 bg-slate-800/80 px-4 py-2.5 text-xs font-semibold text-slate-100 transition hover:border-white/20 hover:bg-slate-700 focus:outline-none focus:ring-2 focus:ring-fuchsia-300';
@endphp

<button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</button>