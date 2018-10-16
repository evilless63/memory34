@extends('layouts.app')

@section('meta_desc', $page->meta_desc)
@section('meta_keys', $page->meta_keys)

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ $page->title }}</div>

                <div class="card-body">
                    <div class="container">
                        <div class="row">
                            <div class="col">
                            {!! $page->description !!}
                            </div>
                        </div>
                        @if($page->albums->isNotEmpty())
                        <div class="row">
                            <div class="col">
                                <h4>Альбомы:</h4>
                            </div>
                        </div>
                        <div class="row">
                            @foreach($page->albums()->get() as $album)
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
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection