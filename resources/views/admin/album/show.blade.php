@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Все фотогаллереи | <a href="{{ route('album.create') }}">Создать фотогалерею</a></div>

                <div class="starter-template">
                    <div class="media">
                    <img class="media-object pull-left" alt="{{$album->name}}" src="/albums/{{$album->cover_image}}" width="350px">
                    <div class="media-body">
                        <h2 class="media-heading" style="font-size: 26px">Название фотогалереи:</h2>
                        <p>{{$album->name}}</p>
                    <div class="media">
                    <h2 class="media-heading" style="font-size: 26px">Описание фотогалереи :</h2>
                    <p>{{$album->description}}<p>
                    <a href="{{route('image.create', $album->id)}}"><button type="button"class="btn btn-primary btn-large">Добавить изображение в фотогалерею</button></a>
                    <a href="{{route('album.delete', $album->id)}}" onclick="return confirm('Вы уверены?')"><button type="button"class="btn btn-danger btn-large">Удалить фотогалерею</button></a>
                    </div>
                </div>

                <div class="row">
                    @foreach($album->Photos as $photo)
                    <div class="col-lg-3">
                        <div class="thumbnail" style="max-height: 350px, min-height: 350px">
                        <img alt="{{$album->name}}" src="/albums/{{$photo->image}}">
                        <div class="caption">
                            <p>{{$photo->description}}</p>
                            <p><p>Дата создания:  {{ date("d F Y",strtotime($photo->created_at)) }} в {{ date("g:ha",strtotime($photo->created_at)) }}</p></p>
                            <a href="{{route('image.delete', $photo->id)}}" onclick="return confirm('Вы уверены?')"><button type="button" class="btn btn-danger btn-small">Удалить изображение</button></a>
                        </div>
                        </div>
                    </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>
</div>
@endsection