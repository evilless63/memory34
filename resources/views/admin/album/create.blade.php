
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Создать фотогалерею</div>

                <div class="card-body">
                <div class="span4">

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif  

                    <form name="createnewalbum" method="POST"action="{{route('album.store')}}"enctype="multipart/form-data">
                    @csrf
                    <fieldset>
                        <div class="form-group">
                        <label for="name">Название</label>
                        <input name="name" type="text" class="form-control"placeholder="Наименование фотогалереи"value="{{Input::old('name')}}">
                        </div>
                        <div class="form-group">
                        <label for="description">Описание</label>
                        <textarea name="description" type="text"class="form-control" placeholder="Описание фотогалереи">{{Input::old('descrption')}}</textarea>
                        </div>
                        <div class="form-group">
                        <label for="cover_image">Выберите изображение альбомма</label>
                        {{Form::file('cover_image')}}
                        </div>
                        <button type="submit" class="btnbtn-default">Создать</button>
                    </fieldset>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection