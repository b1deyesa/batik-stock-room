<table class="table">
    @isset($head)
        <thead>
            {{ $head }}
        </thead>
    @endisset
    <tbody>
        {{ $body }}
    </tbody>
</table>