@props([
    'name',
    'label',
    'type' => 'text',
    'placeholder' => '',
    'autocomplete' => null,
    'hint' => null,
    'value' => null,
    'textarea' => false,
    'rows' => 4,
])

<div>
    <div class="mb-2 flex items-center justify-between gap-3">
        <label for="{{ $name }}" class="text-xs font-semibold text-slate-200">{{ $label }}</label>
        @if ($hint)
            <span class="text-[10px] font-medium text-emerald-300">{{ $hint }}</span>
        @endif
    </div>
    @if ($textarea)
        <textarea
            id="{{ $name }}"
            name="{{ $name }}"
            rows="{{ $rows }}"
            placeholder="{{ $placeholder }}"
            {{ $attributes->merge(['class' => 'w-full resize-y rounded-xl border border-white/5 bg-slate-800/80 px-4 py-3 text-sm text-white placeholder:text-slate-500 outline-none transition focus:border-fuchsia-400 focus:ring-2 focus:ring-fuchsia-400/20']) }}
        >{{ old($name, $value) }}</textarea>
    @else
        <input
            id="{{ $name }}"
            name="{{ $name }}"
            type="{{ $type }}"
            placeholder="{{ $placeholder }}"
            @if ($autocomplete) autocomplete="{{ $autocomplete }}" @endif
            @if (! in_array($type, ['password', 'file'], true)) value="{{ old($name, $value) }}" @endif
            {{ $attributes->merge(['class' => 'w-full rounded-xl border border-white/5 bg-slate-800/80 px-4 py-3 text-sm text-white placeholder:text-slate-500 outline-none transition focus:border-fuchsia-400 focus:ring-2 focus:ring-fuchsia-400/20']) }}
        >
    @endif
    @error($name)
        <p class="mt-1.5 text-xs text-rose-300">{{ $message }}</p>
    @enderror
</div>