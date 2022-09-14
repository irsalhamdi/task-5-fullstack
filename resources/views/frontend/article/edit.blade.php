@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Edit Article
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ url('/user/article/update', $article->id) }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="old_image" value="{{ $article->image }}">
                        <div class="mb-3">
                          <label for="exampleInputName1" class="form-label">Title</label>
                          <input type="name" name="title" value="{{ $article->title }}" placeholder="Input Title" class="form-control" id="exampleInputName1" aria-describedby="nameHelp" required>
                        </div>
                        <div class="mb-3">
                            <label for="floatingTextarea">Content</label>
                            <textarea class="form-control" name="content" placeholder="Leave a content here" id="floatingTextarea" required>
                                {{ $article->content }}
                            </textarea>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" name="image" class="form-control" id="image" aria-describedby="image" required>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Category</label>
                            <div class="controls">
                                <select name="category_id" required class="form-control">
                                    <option value="" selected="" disabled="">
                                        Select Category
                                    </option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ $category->id == $article->category_id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label">User</label>
                            <div class="controls">
                                <select name="user_id" required class="form-control">
                                    <option value="" selected="" disabled="">
                                        Select User
                                    </option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}" {{ $user->id == $article->user_id ? 'selected' : '' }}>
                                            {{ $user->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <a href="{{ url('/user/articles') }}" class="btn btn-secondary mt-3">Back</a>
                        <button type="submit" class="btn btn-success mt-3">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection