@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{$post->title}} par {{$post->user->name}}</div>
                    <div class="card-body">
                        {{$post->content}}
                    </div>
                    <div class="card-footer">
                        <a class="btn btn-primary" href="{{route('posts.index')}}">Voir tous les articles</a>
                        @if(auth()->check() && auth()->user()->id === $post->user_id)
                            <a class="btn btn-info" href="{{route('posts.edit', $post)}}">Modifier l'article</a>

                            <form action="{{route('posts.destroy', $post)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Supprimer l'article l'article</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection