<div x-data="{ modal: false }">
    @if ($trigger)
        <span class="trigger" x-on:click="modal = true">
            {{ $trigger }}
        </span>
    @else
        <x-button x-on:click="modal = true">{{ $label }}</x-button>
    @endif
    @teleport('body')
        <div class="modal{{ $class }}" x-show="modal" x-trap="modal" x-transition.opacity x-cloak>
            <div class="container" x-show="modal" @if($close) x-on:click.outside="modal = false" @endif x-transition:enter.duration.600ms>
                @if($close)<span class="close" x-on:click="modal = false"><i class="fa-solid fa-xmark"></i></span>@endif
                {{ $slot }}
            </div>
        </div>
    @endteleport
</div>