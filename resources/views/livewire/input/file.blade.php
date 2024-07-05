<div class="file">
    @if (!$value)
        <input type="file" wire:model="file" id="file-{{ $id }}">
        @error('file')
            <small class="error">{{ $message }}</small>
        @enderror
    @else
        <div class="preview">
            <input type="text" id="file-preview-{{ $id }}" value="{{ $value['name'] .'.'. $value['extension'] }}" disabled>
            <span class="tools" x-data="{ tool: $wire.entangle('showTool') }">
                <button type="button" x-on:click="tool = true"><i class="fa-solid fa-ellipsis-vertical"></i></button>
                <ul class="tool-list" x-show="tool" x-on:click.outside="tool = false" x-transition:enter.duration.400ms x-transition:leave.duration.300ms x-cloak>
                    <div x-data="{ rename: $wire.entangle('showRename') }">
                        <li x-on:click="rename = true; tool = false">Rename</li>
                        @teleport('body')
                            <div class="modal" x-show="rename" x-trap="rename" x-transition.opacity x-cloak>
                                <div class="container" x-show="rename" x-transition:enter.duration.600ms>
                                    <header>Rename File</header>
                                    <x-form wire="rename">
                                        <x-input type="text" wire="new_name" />
                                        <x-button type="submit">Save</x-button>
                                    </x-form>
                                </div>
                            </div>
                        @endteleport
                    </div>
                    <li wire:click="download">Download</li>
                    <li wire:click="delete">Delete</li>
                </ul>
            </span>
        </div>
    @endif
    <input type="hidden" name="{{ $name }}" id="{{ $id }}" value="{{ $value ? json_encode($value) : null }}">
</div>