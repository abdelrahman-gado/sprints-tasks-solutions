@extends('layouts.admin')
@section('content')
    <div class="content mx-2">
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Products</h1>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-exclamation-triangle"></i> Success!</h5>
                    {{ $message }}
                </div>
            @endif

            @if ($message = Session::get('error'))
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-exclamation-triangle"></i> Error!</h5>
                    {{ $message }}
                </div>
            @endif



            <div class="conatiner-fluid mx-3">
                <div class="row d-flex justify-content-center mb-3">
                    <a href="{{ url('/admin/products/create') }}" class="btn btn-primary float-right">Create New
                        Product</a>
                </div>
                <div class="row">
                    <table class="table table-striped projects">
                        <thead>
                            <tr>

                                <th style="width: 10%">Image</th>
                                <th style="width: 5%">Name</th>
                                <th style="width: 5%">Category</th>
                                <th style="width: 5%">Price ($)</th>
                                <th style="width: 5%">Discount (%)</th>
                                <th style="width: 5%">Color</th>
                                <th style="width: 5%">Size</th>
                                <th style="width: 30%" colspan="3">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td><img src="{{ asset('storage/' . $product['image']) }}" alt="products" width="80px"
                                            height="80px"></td>
                                    <td>{{ $product['name'] }}</td>
                                    <td>{{ $product['category']['name'] }}</td>
                                    <td>${{ number_format($product->getPriceAfterDiscount(), 2) }}</td>
                                    <td>{{ $product['discount'] * 100 }}%</td>
                                    <td>{{ $product['size']['name'] }}</td>
                                    <td>{{ $product['color']['name'] }}</td>
                                    <td>
                                        <a class="btn btn-primary mx-2" href="{{ url('/admin/products/' . $product['id']) }}">
                                            <i class="fas fa-folder">
                                            </i>
                                            View
                                        </a>

                                        <a class="btn btn-info mx-2"
                                            href="{{ url('/admin/products/' . $product['id'] . '/edit') }}">
                                            <i class="fas fa-pencil-alt">
                                            </i>
                                            Edit
                                        </a>

                                        <form style="display: inline" class="mx-2"
                                            action="{{ url('/admin/products/' . $product['id']) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                onclick="return confirm('Delete this product, Are you sure?')"
                                                class="btn btn-danger">
                                                <i class="fas fa-trash">
                                                </i>
                                                Delete
                                            </button>
                                        </form>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {!! $products->links() !!}
                </div>
            </div>
        </div>
    @endsection
