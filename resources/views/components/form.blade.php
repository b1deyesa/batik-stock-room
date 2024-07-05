<form
    class="form{{ $class }}"
    @if($id) id="{{ $id }}" @endif
    @if($wire) wire:submit="{{ $wire }}" @endif
    @if($action) action="{{ $action }}" @endif
    @if($method) method="{{ $method }}" @endif
    @if($enctype) enctype="{{ $enctype }}" @endif
    {{ $attributes }}
    >
    @csrf
    @if($method_type) @method($method_type) @endif
    {{ $slot }}
</form>