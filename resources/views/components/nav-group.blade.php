@props([
    'isResourceGroup',
    'activeRule',
    'parentActiveRule',
    'label',
    'icon',
    'items',
    'url',
])

@php
$subNavLabel = 'subNavOpen' . Str::studly($label);
@endphp
<li x-data="{ {{ $subNavLabel }} : {{ (request()->is($activeRule)) ? 'true' : 'false' }} }">
    <div class="inline-flex w-full {{ (request()->is($activeRule)) ? 'bg-gray-700' : '' }}">
    <a
        @if($isResourceGroup)
        href="{{ $url }}"
        @else
        @click="{{ $subNavLabel }} = !{{ $subNavLabel }}"
        @endif
        {{ $attributes->merge(['class' => 'px-4 py-3 flex flex-grow items-center space-x-3 rtl:space-x-reverse rounded transition-color duration-200 hover:text-white ' . (request()->is($activeRule) ? 'text-white bg-gray-700' : 'text-current')]) }}
    >
        <x-dynamic-component :component="$icon" class="flex-shrink-0 w-5 h-5" />

        <span class="flex-grow text-sm font-medium leading-tight">{{ __($label) }}</span>
    </a>
    <button @click="{{ $subNavLabel }} = !{{ $subNavLabel }}" class="px-3">
        <x-heroicon-o-chevron-down class="w-4" x-show="true === {{ $subNavLabel }}" />
        <x-heroicon-o-chevron-right class="w-4" x-show="false === {{ $subNavLabel }}" />
    </button>

    </div>
    <ol :class="{ 'block' : {{ $subNavLabel }} , 'hidden' : !{{ $subNavLabel }}}"  @click.away="{{ $subNavLabel }} = false">
        @foreach($items as $item)
            <li class="border-l-2 {{ (request()->is($item->activeRule)) ? 'border-gray-700' : 'border-gray-300' }}">
                <x-filament::nav-link
                    :active-rule="$item->activeRule"
                    :icon="$item->icon"
                    :label="$item->label"
                    :url="$item->url"
                />
            </li>
        @endforeach
    </ol>
</li>
