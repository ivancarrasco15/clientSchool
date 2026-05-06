@props(['active' => false, 'href' => '#'])

<a href="{{ $href }}"
   {{ $attributes->class([
       'rounded-xl px-4 py-2 text-sm font-medium transition',
       'bg-slate-900 text-white' => $active,
       'text-slate-700 hover:bg-slate-100' => ! $active,
   ]) }}>
    {{ $slot }}
</a>
