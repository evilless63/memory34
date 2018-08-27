@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

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
                <div class="card-header">Создать пункт меню</div>

                <div class="card-body">
                    <form action="{{ route('menu.store') }}" method="POST">
                    @csrf
                        <div class="form-group">
                            <label for="title">Наименование пункта меню</label>
                            <input type="text" class="form-control" id="title" name="title" aria-describedby="title" placeholder="Наименование">
                        </div>
                        <div class="form-group">
                            <label for="parent_id">Родительский пункт меню</label>
                            <select class="form-control" id="parent_id" name="parent_id" value="1">
                                <option value="">Нет родительского пункта</option>
                                @foreach($parent_menus as $menu)
                                    <option value="{{ $menu->id }}">{{ $menu->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="parent_id">Ссылка на страницу</label>
                            <select class="form-control" id="path" name="path" value="1">
                                <option value="">Не ссылается на страницу</option>
                                @foreach($pages as $page)
                                    <option value="{{ route('page.show', $page->id) }}">{{ $page->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1">
                            <label class="form-check-label" for="is_active">Пункт активен</label>
                        </div>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="is_footer" name="is_footer" value="1">
                            <label class="form-check-label" for="is_footer">Размещать в подвале</label>
                        </div>

                        <div class="form-group">
                            <label for="order">Индекс меню - положение относительно других пунктов</label>
                            <input type="number" class="form-control" id="order" name="order" aria-describedby="order" placeholder="Индекс меню">
                        </div>

                        <button type="submit" class="btn btn-primary">Создать</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection