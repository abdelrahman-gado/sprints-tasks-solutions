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
                            <h1 class="m-0">Create New Product</h1>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <form class="card-body" action="{{ url('/admin/products') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="name">Product Name</label>
                    <input type="text" class="form-control" id="name" name="name"
                        placeholder="Enter Product Name" value="{{ old('name') }}">
                </div>
                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="form-group">
                    <label for="image">Product Image</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="image" name="image">
                            <label class="custom-file-label" for="image">Choose image</label>
                        </div>
                    </div>
                </div>
                @error('image')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="form-group">
                    <label>Description</label>
                    <textarea class="form-control" name="description" rows="3" placeholder="Enter Product Description">{{ old('description') }}</textarea>
                </div>
                @error('description')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="form-group">
                    <label>Price</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">$</span>
                        </div>
                        <input type="number" min="1" step="0.01" class="form-control" name="price" value="{{ old('price') }}">
                        <div class="input-group-append">
                            <span class="input-group-text">.00</span>
                        </div>
                    </div>
                </div>
                @error('price')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="form-group my-3">
                    <label>Discount</label>
                    <div class="input-group">
                        <input type="number" min="0.1" max="100" step="0.1" class="form-control" name="discount" value=""{{ old('discount') }}>
                        <div class="input-group-append">
                            <span class="input-group-text">.00</span>
                        </div>
                    </div>
                </div>
                @error('discount')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="form-group">
                    <label>Select Category</label>
                    <select class="form-control" name="category_id">
                        @foreach ($categories as $category)
                            <option value="{{ $category['id'] }}"
                                {{ $category['id'] == old('category_id') ? 'selected' : '' }}>{{ $category['name'] }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Select Size</label>
                    <select class="form-control" name="size_id">
                        @foreach ($sizes as $size)
                            <option value="{{ $size['id'] }}" {{ $size['id'] == old('size_id') ? 'selected' : '' }}>
                                {{ $size['name'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Select Color</label>
                    <select class="form-control" name="color_id">
                        @foreach ($colors as $color)
                            <option value="{{ $color['id'] }}" {{ $color['id'] == old('color_id') ? 'selected' : '' }}>
                                {{ $color['name'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="is_recent" value="1"
                            {{ old('is_recent') == '1' ? 'checked' : '' }}>
                        <label class="form-check-label">Recent</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="is_featured" value="1"
                            {{ old('is_featured') == '1' ? 'checked' : '' }}>
                        <label class="form-check-label">Featured</label>
                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-center flex-column">
                    <button type="submit" class="btn btn-primary btn-block">Create New Product</button>
                    <a href="{{ url('/admin/products') }}" class="btn btn-default btn-block">Cancel</a>
                </div>
            </form>
        </div>
    @endsection
