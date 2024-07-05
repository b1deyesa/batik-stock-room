<div class="multiple-file">
    <input type="file" wire:model="files" @if($value) x-ref="file" style="display: none" @endif multiple>
    @if ($value)
        <div class="list">
            @foreach ($value as $index => $item)    
                <div class="preview" wire:key="{{ $index }}">
                    <input type="text" id="file-preview-{{ $id }}-{{ $index }}" value="{{ $item['name'] .'.'. $item['extension'] }}" disabled>
                    <span class="tools" x-data="{ tool: $wire.entangle('showTool.{{ $index }}') }">
                        <button type="button" x-on:click="tool = true"><i class="fa-solid fa-ellipsis-vertical"></i></button>
                        <ul class="tool-list" x-show="tool" x-on:click.outside="tool = false" x-transition:enter.duration.400ms x-transition:leave.duration.300ms x-cloak>
                            <div x-data="{ rename: $wire.entangle('showRename.{{ $index }}') }">
                                <li x-on:click="rename = true; tool = false">Rename</li>
                                @teleport('body')
                                    <div class="modal" x-show="rename" x-trap="rename" wire:ignore x-transition.opacity x-cloak>
                                        <div class="container" x-show="rename" x-transition:enter.duration.600ms>
                                            <header>Rename File</header>
                                            <x-form wire="rename({{ $index }})">
                                                <x-input type="text" wire:model="new_name.{{ $index }}" />
                                                <x-button type="submit">Save</x-button>
                                            </x-form>
                                        </div>
                                    </div>
                                @endteleport
                            </div>
                            <li wire:click="download({{ $index }})">Download</li>
                            <li wire:click="delete({{ $index }})">Delete</li>
                        </ul>
                    </span>
                </div>
            @endforeach
            <button type="button" x-on:click="$refs.file.click();" class="add"><i class="fa-solid fa-plus"></i>Add New File</button>
        </div>
    @endif
    @error('files.*')
        <small class="error">{{ $message }}</small>
    @enderror
    <input type="hidden" name="{{ $name }}" id="{{ $id }}" value="{{ $value ? json_encode($value) : null }}">
</div>