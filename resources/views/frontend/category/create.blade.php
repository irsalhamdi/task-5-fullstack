@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        New Category
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ url('/user/category/store') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="exampleInputName1" class="form-label">Name</label>
                                <input type="name" name="name" placeholder="Input Name" class="form-control" id="exampleInputName1" aria-describedby="nameHelp" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputName1" class="form-label">User</label>
                                <div class="controls">
                                    <select name="user_id" required class="form-control">
                                        <option value="" selected="" disabled="">
                                            Select User
                                        </option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">
                                                {{ $user->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <a href="{{ url('/user/categories') }}" class="btn btn-secondary mt-3">Back</a>
                            <button type="submit" class="btn btn-success mt-3">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection