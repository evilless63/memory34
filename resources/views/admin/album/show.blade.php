@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Все фотогаллереи | <a href="{{ route('album.create') }}">Создать фотогалерею</a></div>

                <div class="container">
                    <div class="row">
                        <div class="col">
                            <img class="media-object pull-left" alt="{{$album->name}}" src="/albums/{{$album->cover_image}}" width="350px">
                        </div>
                        <div class="col">
                        <a href="{{route('image.create', $album->id)}}"><button type="button"class="btn btn-primary btn-large">Добавить изображение в фотогалерею</button></a>
                        <form action="{{route('album.destroy', $album->id)}}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-danger btn-small" onclick="return confirm('Вы уверены?')">Удалить фотогалерею</button>
                        </form>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <h2 class="media-heading" style="font-size: 26px">{{$album->name}}</h2>
                            
                            <h5>{{$album->description}}</h5>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        @foreach($album->Photos as $photo)
                        <div class="col-lg-3">
                            <div class="thumbnail" style="max-height: 350px, min-height: 350px">
                            <img class="img-fluid" alt="{{$album->name}}" src="/albums/{{$photo->image}}">
                            <div class="caption">
                                <p>{{$photo->description}}</p>
                                <p><p>Дата создания:  {{ date("d F Y",strtotime($photo->created_at)) }} в {{ date("g:ha",strtotime($photo->created_at)) }}</p></p>
                                <form action="{{route('image.destroy', $photo->id)}}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-small" onclick="return confirm('Вы уверены?')">Удалить изображение </button>
                                </form>
                                @if($otherAlbums->isNotEmpty())
                                <p>Переместить в другой Альбом :</p>
                                <form name="movephoto" method="POST"action="{{route('image.move')}}">
                                    @csrf
                                    <select name="new_album">
                                        @foreach($otherAlbums as $others)
                                        <option value="{{$others->id}}">{{$others->name}}</option>
                                        @endforeach
                                    </select>
                                    <input type="hidden" name="photo" value="{{$photo->id}}" />
                                    <button type="submit" class="btn btn-smallbtn-info" onclick="return confirm('Вы уверены?')">Переместить изображения</button>
                                </form>
                                @endif
                            </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection