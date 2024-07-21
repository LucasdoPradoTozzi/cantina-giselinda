<form {{ $attributes(["class" => "max-w-2xl mx-auto space-y-6", "method" => "GET"]) }}>
    @csrf
    @if (strtoupper($attributes->get('method', 'GET')) !== 'GET')
    @method($attributes->get('method'))
    @endif

    {{ $slot }}
</form>