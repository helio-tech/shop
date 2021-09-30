@extends('admin.layout')

@section('content')
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin.products.update', ['product' => $product]) }}" method="post" enctype="multipart/form-data">
                                @csrf @method('PATCH')
                                <div class="form-group">
                                    <label for="name">Product name: </label>
                                    <input type="text" name="name" id="name" value="{{ $product->name }}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="description">Product description: </label>
                                    <textarea type="text" name="description" id="description" class="form-control">{{ $product->description }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="price">Product name: </label>
                                    <input type="number" min="0" name="price" id="price" value="{{ $product->currentPrice->price }}" class="form-control">
                                </div>
                                <button type="submit" class="btn btn-primary float-right">Tạo</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection
