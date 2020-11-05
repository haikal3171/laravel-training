@extends('layouts.app')

@section('title','Home')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>

<div class="row">
  <div class="col-md-12">
    <div class="text-right pb-2">
      <a href="{{ route('products.create')}}" class="btn btn-sm btn-success">
        <i class="fas fa-plus-square"></i> Tambah Produk
      </a>
    </div>
  </div>
</div>
  
<div class="uper">
  <table class="table table-striped">
    <thead>
        <tr>
          <td>ID</td>
          <td>Image</td>
          <td>Name</td>
          <td>Description</td>
          <td>Total</td>
          <td>Price (RM)</td>
          <td colspan="2">Action</td>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $product)
        <tr>
            <td>{{$product->id}}</td>
            <td>
              @if($product->image)
                <img src="images/{{$product->image}}" alt="Photo1" width=50>
              @else
                <img src="noImageLogo.png" alt="Photo2" width=50>
              @endif
            </td>
            <td>{{$product->name}}</td>
            <td>{{$product->description}}</td>
            <td>{{$product->count}}</td>
            <td>{{$product->price}}</td>
            <td><a href="{{ route('products.edit', $product->id)}}" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i> Kemaskini</a></td>
            <td>
                <form action="{{ route('products.destroy', $product->id)}}" method="post">
                  @csrf
                  @method('DELETE')
                  {{-- {{ method_field('delete') }} --}}
                  <button class="btn btn-sm btn-danger" type="submit"><i class="fas fa-trash-alt"></i> Padam</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
  </table>
<div>
@endsection