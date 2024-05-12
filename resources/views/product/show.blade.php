@extends('layouts.app')

@section('template_title')
    {{ $product->name ?? __('Show') . " " . __('Product') }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
----------------------------------------------
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h3>{{ $product->name }}</h3>
                    </div>
                    <div class="card-body">
                        <p>{{ $product->description }}</p>
                        <p>Categoría: {{ $product->category->name }}</p>
                        <!-- Add more product details here -->
                    </div>
                </div>
            </div>
        </div>
    </div>
-----------------------------------------------
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Product</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary btn-sm" href="{{ route('products.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body bg-white">
                        
                                <div class="form-group mb-2 mb20">
                                    <strong>Name:</strong>
                                    {{ $product->name }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Description:</strong>
                                    {{ $product->description }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Price:</strong>
                                    {{ $product->price }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Picture:</strong>
                                    {{ $product->picture }}
                                </div>
                                <div class="form-group mb-2 mb20">
                                    <strong>Category Id:</strong>
                                    {{ $product->category_id }}
                                </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
