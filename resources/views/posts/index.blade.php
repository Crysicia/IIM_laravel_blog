@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Tous les articles
                    </div>
                    <div class="card-body">
                        @forelse($posts as $post)
                            <p><a href="{{route('posts.show', ["post" => $post])}}">{{$post->title}}</a></p>
                        @empty
                            <p>Il n'y a pas encore d'articles sur le blog</p>
                        @endforelse
                    </div>
                    @auth
                        <div class="card-footer">
                            <a href="{{route('posts.create')}}" class="btn btn-primary">Créer un article</a>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </div>
@endsection