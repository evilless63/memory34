@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Все фотогаллереи | <a href="{{ route('album.create') }}">Создать фотогалерею</a></div>

                <div class="card-body">
                    <div class="row">
                    @foreach($albums as $album)
                        <div class="col-lg-4">
                            <div class="thumbnail" style="min-height: 514px;">
                                <img class="img-fluid" alt="{{$album->name}}" src="/albums/{{$album->cover_image}}">
                                <div class="caption">
                                <h3>{{$album->name}}</h3>
                                <p>{{$album->description}}</p>
                                <p>{{count($album->Photos)}} изображений.</p>
                                <p>Дата создания:  {{ date("d F Y",strtotime($album->created_at)) }} в {{date("g:ha",strtotime($album->created_at)) }}</p>
                                <p><a href="{{route('album.show', $album->id)}}" class="btn btn-big btn-default">Открыть фотогалерею</a></p>
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
