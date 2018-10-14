
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Добавить изображения</div>

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

                    <form name="addimagetoalbum" method="POST"action="{{route('image.store')}}"enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="album_id"value="{{$album->id}}" />
                        <fieldset>
                            <legend>Добавить изображение в {{$album->name}}</legend>
                            <div class="form-group">
                            <label for="description">Описание изображения</label>
                            <textarea name="description" type="text"class="form-control" placeholder="Imagedescription"></textarea>
                            </div>
                            <div class="form-group">
                            <label for="image">Выбрать изображение</label>
                            {{Form::file('image')}}
                            </div>
                            <button type="submit" class="btnbtn-default">Добавить изображение!</button>
                        </fieldset>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection