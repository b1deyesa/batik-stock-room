@if ($type == 'link')
    <a 
        class="button{{ $class }}"
        @if($href) href="{{ $href }}" @endif
        @if($target) target="{{ $target }}" @endif
        @if($disabled) onclick="return false;" id="disabled" @endif
        {{ $attributes }}
        >{{ $slot }}</a>
@elseif ($type == 'file')
    <a 
        class="file{{ $class }}"
        @if($href) href="{{ $href }}" @endif
        {{ $attributes }}
        ><i class="fa-solid fa-file-arrow-up"></i>{{ $slot }}</a>
@else
    <button
        class="button{{ $class }}"
        type="{{ $type }}"
        @if($id) id="{{ $id }}" @endif
        @if($wire) wire:click="{{ $wire }}" @endif
        {{ $attributes }}
        >{{ $slot }}</button>
@endif