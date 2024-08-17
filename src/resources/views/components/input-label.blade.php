@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm font-bold text-black']) }}>
    {{ $value ?? $slot }}
</label>
