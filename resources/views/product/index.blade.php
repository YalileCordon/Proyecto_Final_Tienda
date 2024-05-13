@extends('layouts.app')

@section('template_title')
    Products
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <form action="{{ route('products.showByCategory') }}" method="sGET">
                    <div class="form-row align-items-center">
                        <div class="col-auto">
                            <label for="category" class="sr-only">Search by category:</label>
                            <select name="category" id="category" class="form-control">
                                <option value="">All Categories</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}
                                        ({{ $productCounts[$category->id] ?? 0 }})
                                    </option>
                                    {{-- <option value="{{ $category->id }}">{{ $category->name }}</option> --}}
                                @endforeach
                            </select>
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <br>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Products') }}
                            </span>
                            @auth
                                @if (Auth::user()->is_admin)
                                    <div class="float-right">
                                        <a href="{{ route('products.create') }}" class="btn btn-primary btn-sm float-right"
                                            data-placement="left">
                                            {{ __('Create New') }}
                                        </a>
                                    </div>
                                @endif
                            @endauth
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success m-4">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body bg-white">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>

                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Price</th>
                                        <th>Picture</th>
                                        <th>Category Id</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                        <tr>
                                            <td>{{ ++$i }}</td>

                                            <td>{{ $product->name }}</td>
                                            <td>{{ $product->description }}</td>
                                            <td>{{ $product->price }}</td>
                                            <td>{{ $product->picture }}</td>
                                            <td>{{ $product->category_id }}</td>

                                            <td>
                                                <form action="{{ route('products.destroy', $product->id) }}"
                                                    method="POST">
                                                    <a class="btn btn-sm btn-primary"
                                                        href="{{ route('products.show', $product->slug) }}"><i
                                                            class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>

                                                    @auth
                                                        @if (Auth::user()->is_admin)
                                                            <a class="btn btn-sm btn-success"
                                                                href="{{ route('products.edit', $product->id) }}"><i
                                                                    class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm"
                                                                onclick="event.preventDefault(); confirm('Are you sure to delete?') ? this.closest('form').submit() : false;"><i
                                                                    class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button>
                                                        @endif
                                                    @endauth
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $products->onEachSide(1)->links('pagination::bootstrap-4') !!}
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <h2>Total de productos: {{ $totalProductCount }}</h2>
                    <!-- Rest of your products display code -->
                </div>
            </div>
        </div>
    </div>
@endsection
