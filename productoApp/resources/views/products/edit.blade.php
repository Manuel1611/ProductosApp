@extends('plantilla1.index')

@section('cuerpo')
<div style="width: 80%;margin:0 auto;">
    <h1>{{ $appname }}</h1>

    @if (old('id') != '')
        <div class="alert alert-danger" role="alert">
          Error.
        </div>
    @endif
    
    <form action="{{ url('producto/' . $product['id']) }}" method="post">
        @csrf
        @method('put')
        <input value="{{ old('id', $product['id']) }}" type="hidden" name="id" />
        <label>
            Name of product<br>
            <input value="{{ old('name', $product['name']) }}" type="text" name="name" placeholder="Name of product" min-length="5" max-length="30" autocomplete="off" required />
        </label><br>
        <label>
            Price<br>
            <input value="{{ old('price', $product['price']) }}" type="number" name="price" placeholder="Price" min="1" step="0.01" autocomplete="off" required />
        </label><br><br>
        <input type="submit" value="Edit"/>
    </form><br>
    <form action="{{ url('producto') }}">
        <input type="submit" value="Back"/>
    </form>
</div>
@endsection