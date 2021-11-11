@extends('plantilla1.index')

@section('cuerpo')
<div style="width: 80%;margin:0 auto;">
    <h1>{{ $appname }}</h1>

    @if (old('id') != '')
        <div class="alert alert-danger" role="alert">
          Error.
        </div>
    @endif
    
    <form action="{{ url('producto') }}">
        <label>
            ID<br>
            <input value="{{ $product['id'] }}" type="number" disabled />
        </label><br>
        <label>
            Name of product<br>
            <input value="{{ $product['name'] }}" type="text" disabled />
        </label><br>
        <label>
            Price<br>
            <input value="{{ $product['price'] }}" type="number" disabled />
        </label><br><br>
        <input type="submit" value="Back"/>
    </form>
</div>
@endsection