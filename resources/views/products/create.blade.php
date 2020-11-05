@extends('layouts.app')

@section('title', 'Add Product')

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
                    <b class="h2 font-weight-bold">Tambah Produk</b>
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
            <form method="post" action="{{ route('products.store') }}" enctype="multipart/form-data">
                <div class="form-group">
                    @csrf
                    <label for="name">Product Name:</label>
                    <input type="text" class="form-control" name="name" />
                </div>
                <div class="form-group">
                    <label for="description">Description :</label>
                    <textarea rows="5" columns="5" class="form-control" name="description"></textarea>
                </div>
                <div class="form-group">
                    <label for="count">Total :</label>
                    <input type="text" class="form-control" name="count" />
                </div>
                <div class="form-group">
                    <label for="image">Image :</label>
                    <input type="file" name="image" id="image" class="form-control">
                </div>
                <div class="form-group">
                    <label for="price">Price (RM) :</label>
                    <input type="text" class="form-control" name="price" />
                </div>
                <button type="submit" class="btn btn-primary">Add Data</button>
            </form>
        </div>
    </div>
@endsection
