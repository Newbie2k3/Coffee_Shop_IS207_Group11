@props(['menuOpen', 'icon', 'size'])

<div x-data="{ {{ $menuOpen }}: false }">
    <div class="icon" @click="{{ $menuOpen }} = !{{ $menuOpen }}">
        {!! $icon !!}
    </div>
    <div class="sd-modal {{ $size }}-modal" x-show="{{ $menuOpen }}"
        x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95" @click.away="{{ $menuOpen }} = false">
        {{ $slot }}
    </div>
</div>
