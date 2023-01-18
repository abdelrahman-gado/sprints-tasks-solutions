@php

function getIsChecked($val, $arrName) {
    if (!request()->has($arrName)) {
        return '';
    }

    $arr = request()->get($arrName);
    return in_array($val, $arr) ? ' checked' : '';
}
 
@endphp

@extends('layouts.main')
@section('content')
    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="#">Home</a>
                    <a class="breadcrumb-item text-dark" href="#">Shop</a>
                    <span class="breadcrumb-item active">Shop List</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Shop Start -->
    <form action="{{ url('/shop') }}">
        <div class="container-fluid">
            <div class="row px-xl-5">
                <!-- Shop Sidebar Start -->
                <div class="col-lg-3 col-md-4">
                    <!-- Price Start -->
                    <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter
                            by
                            price</span></h5>
                    <div class="bg-light p-4 mb-30">
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" checked id="price-all" name="price[]"
                                value="-1" {{ getIsChecked('-1', 'price') }}>
                            <label class="custom-control-label" for="price-all">All Price</label>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="price-1" name="price[]"
                                value="0" {{ getIsChecked('0', 'price') }}>
                            <label class="custom-control-label" for="price-1">$0 - $100</label>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="price-2" name="price[]"
                                value="100" {{ getIsChecked('100', 'price') }}>
                            <label class="custom-control-label" for="price-2">$100 - $200</label>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="price-3" name="price[]"
                                value="200" {{ getIsChecked('200', 'price') }}>
                            <label class="custom-control-label" for="price-3">$200 - $300</label>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="price-4" name="price[]"
                                value="300" {{ getIsChecked('300', 'price') }}>
                            <label class="custom-control-label" for="price-4">$300 - $400</label>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
                            <input type="checkbox" class="custom-control-input" id="price-5" name="price[]"
                                value="400" {{ getIsChecked('400', 'price') }}>
                            <label class="custom-control-label" for="price-5">$400 - $500</label>
                        </div>
                    </div>
                    <!-- Price End -->

                    <!-- Color Start -->
                    <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter
                            by
                            color</span></h5>
                    <div class="bg-light p-4 mb-30">
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" checked id="color-all" name="color[]"
                                value="-1" {{ getIsChecked('-1', 'color') }}>
                            <label class="custom-control-label" for="color-all">All Color</label>
                        </div>
                        @foreach ($colors as $color)
                            <div
                                class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                                <input type="checkbox" class="custom-control-input" id="color-{{ $color['id'] }}"
                                    name="color[]" value="{{ $color['id'] }}" {{ getIsChecked($color['id'], 'color') }}>
                                <label class="custom-control-label"
                                    for="color-{{ $color['id'] }}">{{ $color['name'] }}</label>
                            </div>
                        @endforeach
                    </div>
                    <!-- Color End -->

                    <!-- Size Start -->
                    <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Filter
                            by
                            size</span></h5>
                    <div class="bg-light p-4 mb-30">
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" checked id="size-all" name="size[]"
                                value="-1" {{ getIsChecked('-1', 'size') }}>
                            <label class="custom-control-label" for="size-all">All Size</label>
                        </div>
                        @foreach ($sizes as $size)
                            <div
                                class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                                <input type="checkbox" class="custom-control-input" id="size-{{ $size['id'] }}"
                                    name="size[]" value="{{ $size['id'] }}" {{ getIsChecked($size['id'], 'size') }}>
                                <label class="custom-control-label"
                                    for="size-{{ $size['id'] }}">{{ $size['name'] }}</label>
                            </div>
                        @endforeach
                    </div>
                    <!-- Size End -->
                    <button class="btn btn-primary btn-block" type="submit">Filter</button>
                </div>
                <!-- Shop Sidebar End -->


                <!-- Shop Product Start -->
                <div class="col-lg-9 col-md-8">
                    <div class="row pb-3">
                        <div class="col-12 pb-1">
                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <div>
                                    <button class="btn btn-sm btn-light"><i class="fa fa-th-large"></i></button>
                                    <button class="btn btn-sm btn-light ml-2"><i class="fa fa-bars"></i></button>
                                </div>
                                <div class="ml-2">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-light dropdown-toggle"
                                            data-toggle="dropdown">Sorting</button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="#">Latest</a>
                                            <a class="dropdown-item" href="#">Popularity</a>
                                            <a class="dropdown-item" href="#">Best Rating</a>
                                        </div>
                                    </div>
                                    <div class="btn-group ml-2">
                                        <button type="button" class="btn btn-sm btn-light dropdown-toggle"
                                            data-toggle="dropdown">Showing</button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="#">10</a>
                                            <a class="dropdown-item" href="#">20</a>
                                            <a class="dropdown-item" href="#">30</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @foreach ($products as $product)
                            <div class="col-lg-4 col-md-6 col-sm-6 pb-1">
                                <div class="product-item bg-light mb-4">
                                    <div class="product-img position-relative overflow-hidden">
                                        <img class="img-fluid w-100" src="{{ asset('storage/' . $product['image']) }}"
                                            alt="">
                                        <div class="product-action">
                                            <a class="btn btn-outline-dark btn-square" onclick="addProductToCart({{ $product['id'] }})"><i
                                                    class="fa fa-shopping-cart"></i></a>
                                            <a class="btn btn-outline-dark btn-square" onclick="addProductToLikedList({{ $product['id'] }})"><i
                                                    class="far fa-heart"></i></a>
                                            
                                        </div>
                                    </div>
                                    <div class="text-center py-4">
                                        <a class="h6 text-decoration-none text-truncate"
                                            href="{{ url('/detail?id=' . $product['id']) }}">{{ $product['name'] }}</a>
                                        <div class="d-flex align-items-center justify-content-center mt-2">
                                            <h5>${{ $product->getPriceAfterDiscount() }}</h5>
                                            <h6 class="text-muted ml-2"><del>${{ $product['price'] }}</del></h6>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-center mb-1">
                                            <small class="fa fa-star text-primary mr-1"></small>
                                            <small class="fa fa-star text-primary mr-1"></small>
                                            <small class="fa fa-star text-primary mr-1"></small>
                                            <small class="fa fa-star text-primary mr-1"></small>
                                            <small class="fa fa-star-half-alt text-primary mr-1"></small>
                                            <small>({{ $product['rating_count'] }})</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="col-12">
                            {!! $products->appends(request()->except('page'))->links() !!}
                        </div>
                    </div>
                </div>
                <!-- Shop Product End -->
            </div>
        </div>
    </form>
    <!-- Shop End -->
@endsection

@section('scripts')
<script>
    function addProductToCart(id) {
        $.ajax({
            url: "{{ url('/add-product-to-cart') }}",
            data: { id: id },
            success: (data) => {
                location.href = data.url;
            }
        });
    }

    function addProductToLikedList(id) {
        $.ajax({
            url: "{{ url('/add-product-to-likedlist') }}",
            data: { id: id },
            success: (data) => {
                location.href = data.url;
            }
        });
    }
</script>
@endsection