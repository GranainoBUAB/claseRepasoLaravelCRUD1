@extends('layouts.app')


@section('content')
    <div>
        <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">id</th>
                <th scope="col">Product</th>
                <th scope="col">Price</th>
                <th scope="col">Description</th>
                <th scope="col">Created</th>
                <th scope="col">Updated</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($products as $product)
                <tr>
                    <td>{{$product->id}}</td>
                    <td>{{$product->name}}</td>
                    <td>{{$product->price}}</td>
                    <td>{{$product->description}}</td>
                    <td>{{$product->created_at}}</td>
                    <td>{{$product->updated_at}}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
    </div>
@endsection
