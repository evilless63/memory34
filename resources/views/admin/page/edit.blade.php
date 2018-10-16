@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif  

            <div class="card">
                <div class="card-header">Редактировать страницу</div>

                <div class="card-body">
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <form action="{{ route('page.update', $page->id) }}" method="POST">
                                @method('PATCH')
                                @csrf
                                    <div class="form-group">
                                        <label for="title">Наименование страницы</label>
                                        <input type="text" class="form-control" id="title" name="title" aria-describedby="title" placeholder="Наименование" value="{{ $page->title }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="meta_desc">Мета описание (отображается как описание в поиске Google, Yandex) - не более 100 - 140 символов</label>
                                        <input type="text" class="form-control" id="meta_desc" name="meta_desc" aria-describedby="meta_desc"  value="{{ $page->meta_desc }}" placeholder="Мета описание">
                                    </div>
                                    <div class="form-group">
                                        <label for="meta_keys">Мета ключи (служит для определеняи страницы поисковиками Google, Yandex) - не более 20 слов через запятую</label>
                                        <input type="text" class="form-control" id="meta_keys" name="meta_keys" aria-describedby="meta_keys" value="{{ $page->meta_keys }}" placeholder="Мета описание">
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Текст страницы</label>
                                        <textarea class="form-control" name="description" id="pageDescEditor" cols="30" rows="10">
                                        {!! $page->description !!}
                                        </textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="meta_keys">Добавить альбомы на страницу</label>
                                        <select name="albums[]" class="form-control" multiple searchable="Search here..">
                                            <option value="" disabled selected>Выберите альбомы</option>
                                            @foreach($albums as $album)
                                            <option value="{{ $album->id }}">{{ $album->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Обновить</button>
                                </form>
                            </div>
                        </div>

                        @if($page->albums()->get()->isNotEmpty())
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
                                        <form action="{{route('page.albumdetach')}}" method="POST">
                                            @csrf
                                            <input type="hidden" id="pageId" name="pageId"  value="{{ $page->id }}" >
                                            <input type="hidden" id="albumId" name="albumId"  value="{{ $album->id }}" >
                                            <button type="submit" class="btn btn-danger btn-small" onclick="return confirm('Вы уверены?')">Убрать альбом со страницы </button>
                                        </form>
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