@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{$post->title}} par {{$post->user->name}} | {{$post->likes->count()}} likes
                        @if(auth()->check() && auth()->user()->likes()->where("likeable_type", "App\Post")->where('likeable_id', $post->id)->get()->isEmpty())
                            <form action="{{route('posts.likes.store', ["post" => $post])}}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-primary">Liker</button>
                            </form>
                        @elseif(auth()->check())
                            <form action="{{route('posts.likes.destroy', ["post" => $post, "like" => $post->likes()->where('user_id', auth()->user()->id)->first()->id])}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-warning">Disliker</button>
                            </form>
                        @endif
                    </div>
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
                                <button type="submit" class="btn btn-danger">Supprimer l'article</button>
                            </form>
                        @endif
                    </div>
                </div>
                <h3>Commentaires :</h3>
                @forelse($post->comments as $comment)
                    <div class="card">
                        <div class="card-body">
                            <blockquote class="blockquote mb-0">
                                <p>{{ $comment->content }}</p>
                                <footer class="blockquote-footer">{{ $comment->user->name }} | {{ $comment->likes()->count() }} likes</footer>
                            </blockquote>
                            @if(auth()->check() && auth()->user()->likes()->where("likeable_type", "App\Comment")->where('likeable_id', $comment->id)->get()->isEmpty())
                                <form action="{{route('comments.likes.store', ["comment" => $comment])}}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">Liker</button>
                                </form>
                            @elseif(auth()->check())
                                <form action="{{route('comments.likes.destroy', ["comment" => $comment, "like" => $comment->likes()->where('user_id', auth()->user()->id)->first()->id])}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-warning">Disliker</button>
                                </form>
                            @endif
                            @if(auth()->check() && auth()->user()->id === $comment->user_id)
                                <form action="{{route('posts.comments.destroy', ['post' => $post, 'comment' => $comment])}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Supprimer</button>
                                </form>
                            @endif
                        </div>
                    </div>
                @empty
                    <p>Il n'y a pas encore de commentaire sur cet article</p>
                @endforelse
                @if(auth()->check())
                    <form action="{{route('posts.comments.store', ["post" => $post])}}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="content">Ecrire un commentaire</label>
                            <textarea class="form-control @error('content') is-invalid @enderror" name="content"
                                      id="content" cols="30"
                                      rows="3">{{old('content')}}</textarea>
                            @error('content')
                            <div class="invalid-feedback">
                                Le commentaire ne peut pas être vide.
                            </div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Créer</button>
                    </form>
                @endif
            </div>
        </div>
    </div>
@endsection