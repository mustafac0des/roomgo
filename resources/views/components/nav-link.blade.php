@props(['active' => false])

@php
$classes = ($active ?? false)
            ? 'flex items-center gap-3 px-4 py-3 rounded-xl bg-[#9A616D] text-white shadow-md transition'
            : 'flex items-center gap-3 px-4 py-3 rounded-xl text-gray-600 hover:bg-gray-50 hover:text-[#9A616D] transition border border-transparent';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    <span class="font-medium">{{ $slot }}</span>
</a>
