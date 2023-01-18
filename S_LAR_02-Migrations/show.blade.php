@extends('layouts.admin')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Show Product</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-sm-6">
                    <h3 class="d-inline-block d-sm-none">{{ $product['name'] }}</h3>
                    <div class="col-12">
                        <img src="{{ asset('storage/' . $product['image']) }}" class="product-image" alt="Product Image">
                    </div>

                </div>
                <div class="col-12 col-sm-6">
                    <h3 class="my-3">{{ $product['name'] }}</h3>
                    <p>{{ $product['description'] }}</p>

                    <hr>
                    <h4>Available Colors: </h4>
                    <div class="text-xl btn-group btn-group-toggle text-center active">{{ $product['color']['name'] }}</div>

                    <hr>
                   <h4>Available Sizes: </h4>
                    <div class="text-xl btn-group btn-group-toggle text-center active">{{ $product['size']['name'] }}</div>

                    <hr>
                    <div class="bg-gray py-2 px-3 mt-4">
                        <h2 class="mb-0">
                            ${{ number_format($product->getPriceAfterDiscount(), 2) }}
                        </h2>
                        <h4 class="mt-0">
                            <del>${{ $product['price'] }}</del>
                            <div>Discount is {{ $product['discount'] * 100 }}%</div>
                        </h4>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
