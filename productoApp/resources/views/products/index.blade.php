@extends('plantilla1.index')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
@section('cuerpo')
    <div style="width: 80%;margin:0 auto;">
        <!-- nuevo 1 -->
    <div class="modal" id="modalDelete" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Confirm delete</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p>Confirm delete?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <form id="modalDeleteProductForm" action="" method="post">
                @method('delete')
                @csrf
                <input type="submit" class="btn btn-primary" value="Delete product"/>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- fin nuevo 1 -->
    <h1>{{ $appname }}</h1>
    @isset($message)
        <div class="alert alert-{{ $type }}" role="alert">
          {{ $message }}
        </div>
    @endisset
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
                <tr>
                    <td>
                        {{ $product['id'] }}
                    </td>
                    <td>
                        {{ $product['name'] }}
                    </td>
                    <td>
                        {{ $product['price'] }}
                    </td>
                    <td>
                        <a href="{{ url('producto/' . $product['id']) }}">Show</a>
                    </td>
                    <td>
                        <a href="{{ url('producto/' . $product['id'] . '/edit') }}">Edit</a>
                    </td>
                    <td>
                        <!-- nuevo 2 -->
                        <a href="javascript: void(0);" data-url="{{ url('producto/' . $product['id']) }}" data-bs-toggle="modal" data-bs-target="#modalDelete">Delete</a>
                        <!-- fin nuevo 2 -->
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ url('producto/create') }}" class="btn btn-primary btn-lg" type="button">Add new product</a>
    <a href="{{ url('producto/flush/all') }}" class="btn btn-danger btn-lg" type="button">Delete all</a>
    </div>
@endsection

@section('js')
<!-- nuevo 4 -->
<script src="{{ url('assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ url('assets/js/delete.js') }}"></script>
<!-- nuevo 4 -->
@endsection