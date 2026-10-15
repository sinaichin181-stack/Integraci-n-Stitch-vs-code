@props([
    'name',
    'value',
    'label',
    'image' => null,
    'imageExists' => false,
    'fallback' => '',
    'icon' => null,
    'selected' => false,
    'compact' => false,
])

<label class="group block cursor-pointer">
    <input
        class="peer sr-only"
        type="radio"
        name="{{ $name }}"
        value="{{ $value }}"
        @checked(old($name, $selected ? $value : '') === $value)
    >
    @if ($compact)
        <span class="flex min-h-10 items-center gap-2 rounded-full border border-white/10 bg-slate-800/60 px-3 py-2 transition peer-checked:border-fuchsia-400 peer-checked:bg-fuchsia-500/10 peer-focus-visible:ring-2 peer-focus-visible:ring-fuchsia-300 group-hover:border-white/25">
            <span class="flex size-5 shrink-0 items-center justify-center rounded-full bg-white/5 text-[9px] font-bold text-violet-200" aria-hidden="true">{{ $icon }}</span>
            <span class="text-left text-[10px] font-semibold leading-tight text-slate-200">{{ $label }}</span>
        </span>
    @else
        <span class="flex h-full flex-col items-center gap-2 rounded-2xl border border-white/10 bg-slate-800/60 p-2 text-center transition peer-checked:border-fuchsia-400 peer-checked:bg-fuchsia-500/10 peer-focus-visible:ring-2 peer-focus-visible:ring-fuchsia-300 group-hover:border-white/25">
            @if ($image && $imageExists)
                <img src="{{ $image }}" alt="Retrato de {{ $label }}" class="aspect-square w-full rounded-xl object-cover">
            @elseif ($image)
                <span class="flex aspect-square w-full items-center justify-center rounded-xl bg-gradient-to-br from-violet-700 to-pink-500 text-2xl font-bold text-white" aria-hidden="true">{{ $fallback }}</span>
            @else
                <span class="flex aspect-square w-full items-center justify-center rounded-xl bg-gradient-to-br from-violet-700/70 to-pink-500/50 text-lg font-bold text-white" aria-hidden="true">{{ $icon }}</span>
            @endif
            <span class="text-[10px] font-semibold leading-tight text-slate-200">{{ $label }}</span>
        </span>
    @endif
</label>