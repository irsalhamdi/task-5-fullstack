@extends('layouts.app')

@section('content')
  <div class="container">
      <div class="row justify-content-center">
        @php
          $item = count($posts)
        @endphp
        @if ($item == 0)
          <h4 class="text-mute">Post not found !</h4>
        @else
          @foreach ($posts as $post)
            <div class="col-md-4 mb-3">
              <div class="card">
                <img src="https://source.unsplash.com/500x400?{{ $post->category->name }}" class="card-img-top" alt="{{ $post->category->name }}">
                <div class="card-body">
                  <h5 class="card-title">{{ $post->title }}</h5>
                  <p>{{ $post->content }}</p>
                  <p>
                    <small class="text-muted">
                      By. {{ $post->user->name }},
                      {{ $post->created_at->diffForHumans() }},
                      {{ $post->category->name }}
                    </small>
                  </p>
                </div>
              </div>
            </div>
          @endforeach
        @endif
      </div>
  </div>
@endsection
