@extends('layouts.app')

@section('title', 'Update Product')

@section('content')
    <style>
        .uper {
            margin-top: 40px;
        }

    </style>
    <div class="card uper">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <div>
                    <b class="h2 font-weight-bold">Kemaskini Maklumat Produk</b>
                </div>
                <div>
                    <a href="/products" class="btn btn-secondary"><i class="fas fa-home"></i></a>
                </div>
            </div>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div><br />
            @endif
            <form method="post" action="{{ route('products.update', $product->id) }}">
                <div class="form-group">
                    @csrf
                    @method('PATCH')
                    <label for="name">Product Name:</label>
                    <input type="text" class="form-control" name="name" value="{{ $product->name }}" />
                </div>
                <div class="form-group">
                    <label for="description">Description :</label>
                    <textarea rows="5" columns="5" class="form-control"
                        name="description">{{ $product->description }}</textarea>
                </div>
                <div class="form-group">
                    <label for="total">Total :</label>
                    <input type="text" class="form-control" name="total" value="{{ $product->count }}" />
                </div>
                <div class="form-group">
                    <label for="price">Price (RM) :</label>
                    <input type="text" class="form-control" name="price" value="{{ $product->price }}" />
                </div>
                <div class="form-group">
                    <label for="image">Image :</label>
                <input type="hidden" name="old_image" value="{{ $product->image }}">
                    <input type="file" class="form-control @error('image') is-invalid @enderror" name="image" />
                    @error('image')
                        <div class="text-danger">
                        <label>{{ $message }}</label>
                        </div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Update Data</button>
            </form>
        </div>
    </div>
@endsection
