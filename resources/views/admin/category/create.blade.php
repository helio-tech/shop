@extends('admin.layout')

@section('content')
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin.categories.store') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="name">Name: </label>
                                    <input type="text" name="name" id="name" placeholder="" class="form-control">
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
