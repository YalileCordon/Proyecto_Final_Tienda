@extends('layouts.app')

@section('template_title')
    Categories
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Categories') }}
                            </span>
                            @auth
                                @if (Auth::user()->is_admin)
                                    <div class="float-right">
                                        <a href="{{ route('categories.create') }}" class="btn btn-primary btn-sm float-right"
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

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $category)
                                        <tr>
                                            <td>{{ ++$i }}</td>

                                            <td>{{ $category->name }}</td>
                                            <td>{{ $category->description }}</td>

                                            <td>
                                                <form action="{{ route('categories.destroy', $category->id) }}"
                                                    method="POST">
                                                    <a class="btn btn-sm btn-primary "
                                                        href="{{ route('categories.show', $category->slug) }}"><i
                                                            class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>

                                                    @auth
                                                        @if (Auth::user()->is_admin)
                                                            <a class="btn btn-sm btn-success"
                                                                href="{{ route('categories.edit', $category->id) }}"><i
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
                {!! $categories->onEachSide(1)->links('pagination::bootstrap-4') !!}
            </div>
        </div>
    </div>
@endsection
