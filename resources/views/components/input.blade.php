<div class="input">
    
    {{-- Label --}}
    @if($label)<span class="label">{{ $label }}@if($required)<span class="required">*</span>@endif</span>
    @endif
    
    {{-- Inputs --}}
    @switch($type)
        @case('textarea')
            <textarea
                @if($id) id="{{ $id }}" @endif
                @if($name) name="{{ $name }}" @endif
                @if($wire) wire:model="{{ $wire }}" @endif
                @if($rows) rows="{{ $rows }}" @endif
                @if($placeholder) placeholder="{{ $placeholder }}" @endif
                @disabled($disabled)
                {{ $attributes }}
                >{{ old($name, $value) }}</textarea>
            @break
        @case('select')
            <div class="select @error($name) danger @enderror">
                <select
                    @if($id) id="{{ $id }}" @endif
                    @if($name) name="{{ $name }}" @endif
                    @if($wire) wire:model="{{ $wire }}" @endif
                    @if($live) wire:model.live="{{ $live }}" @endif
                    @disabled($disabled)
                    onchange="this.dataset.empty = this.value == ''"
                    {{ $attributes }}
                    >
                    @if($placeholder)<option value="" selected>{{ $placeholder }}</option>@endif
                    @foreach ($options as $index => $option)
                        <option value="{{ $index }}" @selected((string)old($name, $value) == $index)>{{ $option }}</option>
                    @endforeach
                </select>
            </div>
            @break
        @case('radio')
            <div class="radio" @if($rows) style="flex-direction: row; gap: 1em;" @endif>
                @foreach ($options as $index => $option)
                    <label>
                        <input 
                            type="radio"
                            @if($id) id="{{ $id }}-{{ $index }}" @endif
                            @if($name) name="{{ $name }}" @endif
                            @if($wire) wire:model="{{ $wire }}" @endif
                            @checked((string)old($name, $value) == $index)
                            value="{{ $index }}"
                            >{{ $option }}</label>
                @endforeach
            </div>
            @break
        @case('checkbox')
            <div class="checkbox">
                @foreach ($options as $index => $option)
                    <label>
                        <input 
                            type="checkbox"
                            @if ($loop->count == 1)
                                @if($id) id="{{ $id }}" @endif
                                @if($name) name="{{ $name }}" @endif
                                @if($wire) wire:model="{{ $wire }}" @endif
                                @if($live) wire:model.live="{{ $live }}" @endif
                            @else
                                @if($id) id="{{ $id }}-{{ $index }}" @endif
                                @if($name) name="{{ $name }}[{{ $index }}]" @endif
                                @if($wire) wire:model="{{ $wire }}.{{ $index }}" @endif
                                @if($live) wire:model.live="{{ $live }}.{{ $index }}" @endif
                            @endif
                            @checked(old($name, $value) && in_array($index, old($name, json_decode($value, true))))
                            value="{{ $index }}"
                            >{{ $option }}</label>
                @endforeach
            </div>
            @break
        @case('file')
            @livewire('input.file', compact('id', 'name', 'value'))
            @break
        @case('multiple-file')
            @livewire('input.multiple-file', compact('id', 'name', 'value'))
            @break
        @case('editor')
            @livewire('input.editor', compact('id', 'name', 'value'))    
            @break
        @default
            <input
                type="{{ $type }}"
                @if($id) id="{{ $id }}" @endif
                @if($name) name="{{ $name }}" @endif
                @if($wire) wire:model="{{ $wire }}" @endif
                @if($placeholder) placeholder="{{ $placeholder }}" @endif
                @if($autofocus) autofocus @endif
                @disabled($disabled)
                @error($name) class="danger" @enderror
                value="{{ old($name, $value) }}"
                autocomplete="off"
                {{ $attributes }}
                >
    @endswitch
    
    {{-- Error --}}
    @error($name)
        <small class="error">{{ $message }}</small>
    @enderror
    
</div>