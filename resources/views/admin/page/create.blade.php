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
                <div class="card-header">Создать страницу</div>

                <div class="card-body">
                    <form action="{{ route('page.store') }}" method="POST">
                    @csrf
                        <div class="form-group">
                            <label for="title">Наименование страницы</label>
                            <input type="text" class="form-control" id="title" name="title" aria-describedby="title" placeholder="Наименование">
                        </div>
                        <div class="form-group">
                            <label for="meta_desc">Мета описание (отображается как описание в поиске Google, Yandex)  - не более 100 - 140 символов<</label>
                            <input type="text" class="form-control" id="meta_desc" name="meta_desc" aria-describedby="meta_desc" placeholder="Мета описание">
                        </div>
                        <div class="form-group">
                            <label for="meta_keys">Мета ключи (служит для определеняи страницы поисковиками Google, Yandex)  - не более 20 слов через запятую</label>
                            <input type="text" class="form-control" id="meta_keys" name="meta_keys" aria-describedby="meta_keys" placeholder="Мета описание">
                        </div>
                        <div class="form-group">
                            <label for="description">Текст страницы</label>
                            <textarea class="form-control" name="description" id="pageDescEditor" cols="30" rows="10"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Создать</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection