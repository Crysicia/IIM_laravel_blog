@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Créer un article</div>
                    <div class="card-body">
                        <form action="{{route('posts.store')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="title">Titre</label>

                                <input name="title" type="title"
                                       class="form-control @error('title') is-invalid @enderror" id="title"
                                       placeholder="Entrer votre title"
                                       value="{{  old('title', "") }}">

                                @error('title')
                                <div class="invalid-feedback">
                                    Le titre est requis ou est trop long
                                </div>
                                @enderror


                            </div>

                            <div class="form-group">
                                <label for="content">Corps de l'article</label>
                                <textarea class="form-control @error('content') is-invalid @enderror" name="content"
                                          id="content" cols="30"
                                          rows="10">{{old('content')}}</textarea>
                                @error('content')
                                <div class="invalid-feedback">
                                    Le contenu de l'article ne peut pas être vide
                                </div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Créer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection