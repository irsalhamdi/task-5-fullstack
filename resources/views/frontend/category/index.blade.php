@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ url('/user/category/create') }}" class="btn btn-sm btn-secondary mt-3 justify-content-right">Add new category</a>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @php
                            $item = count($categories);
                        @endphp
                        @if ($item == 0)
                            <h3 class="text-secondary">Category not found !</h3>
                        @else
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">User</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $category)
                                        <tr>
                                            <td>{{ $category->name }}</td>
                                            <td>{{ $category->user->name }}</td>
                                            <td>
                                                <a href="{{ url('/user/category/edit', $category->id) }}" class="btn btn-dark btn-sm">Edit</a>
                                                <a href="{{ url('/user/category/delete', $category->id) }}" class="btn btn-danger btn-sm">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection