<div class="editor" wire:ignore>
    <textarea name="{{ $name }}" id="texteditor-{{ $id }}" wire:model.live="texteditor">{{ old($name, $value) }}</textarea>
</div>

@pushOnce('scripts')
    <script>
        const watchdog = new CKSource.EditorWatchdog();
        window.watchdog = watchdog;
        watchdog.setDestructor( editor => {
            return editor.destroy();
        } );
        watchdog.on( 'error', handleSampleError );
        function handleSampleError( error ) {
            const issueUrl = 'https://github.com/ckeditor/ckeditor5/issues';
            const message = [
                'Oops, something went wrong!',
                `Please, report the following error on ${ issueUrl } with the build id "87shcralxaff-bjg4rrl292r" and the error stack trace:`
            ].join( '\n' );
        }
    </script>
@endPushOnce
@push('scripts')
    <script>
        watchdog.setCreator(( element, config ) => {
            return CKSource.Editor
                .create( element, config )
                .then(editor => {
                    editor.model.document.on('change:data', () => {
                        @this.set("texteditor", editor.getData());
                    })
                })
            });
    </script>
    <script>
        watchdog
            .create( document.querySelector( '#texteditor-' + "<?php echo $id ?>" ), {
                removePlugins: ['Title', 'MediaEmbedToolbar'],
                placeholder: '',
                toolbar: {
                    items: [ 
                        'undo', 
                        'redo', 
                        'heading', 
                        'fontFamily',
                        '|', 
                        'bold', 
                        'italic', 
                        'underline', 
                        'alignment', 
                        '|', 
                        'imageInsert',
                        'mediaEmbed',
                        'insertTable',
                        'link', 
                        'code', 
                        '|',
                        'highlight',
                        'fontBackgroundColor', 
                        'fontColor',
                        'fontSize',
                        '|', 
                        'horizontalLine', 
                        'bulletedList', 
                        'numberedList', 
                        'blockQuote'
                    ],
                    shouldNotGroupWhenFull: false
                },
                simpleUpload: {
                    uploadUrl: "{{ route('upload.image.ckeditor', ['_token' => csrf_token()]) }}",
                    withCredentials: true,
                    headers: {
                        'X-CSRF-TOKEN': 'CSRF-Token',
                        Authorization: 'Bearer <JSON Web Token>'
                    }
                }
            })
            .catch( handleSampleError );
    </script>
@endpush