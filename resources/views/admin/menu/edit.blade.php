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
                <div class="card-header">Редактировать пункт меню {{ $menu->title }}</div>

                <div class="card-body">
                    <form action="{{ route('menu.update', $menu->id) }}" method="POST">
                    @method('PATCH')
                    @csrf
                        <div class="form-group">
                            <label for="title">Наименование пункта меню</label>
                            <input type="text" class="form-control" id="title" name="title" aria-describedby="title" placeholder="Наименование" value="{{ $menu->title }}">
                        </div>
                        <div class="form-group">

                            @if($parent_menu_actual === Null)
                                <label for="parent_id">Родительский пункт меню</label>
                            @else
                                <label for="parent_id">Текущий родительский пункт меню - <strong>{{ $parent_menu_actual->title }}</strong>, новый пункт меню:</label>
                            @endif
                            
                            <select class="form-control" id="parent_id" name="parent_id" value="1">

                                @if($parent_menu_actual === Null)
                                    <option value="">Нет родительского пункта</option>
                                    @foreach($parent_menus as $parent_menu)
                                        <option value="{{ $parent_menu->id }}">{{ $parent_menu->title }}</option>
                                    @endforeach
                                @else
                                    <option value="{{ $parent_menu_actual->id }}">{{ $parent_menu_actual->title }}</option>
                                    @foreach($parent_menus as $parent_menu)
                                        @if ($parent_menu->id <> $parent_menu_actual->id)
                                        <option value="{{ $parent_menu->id }}">{{ $parent_menu->title }}</option>
                                        @endif
                                    @endforeach
                                @endif
                                
                            </select>
                        </div>

                        <div class="form-check">
                            <input type="hidden" name="is_active" value="0">
                            <input type="checkbox" class="form-check-input" id="is_active" name="is_active" {{ $menu->is_active == 1 ? 'checked' : ''}} value="1">
                            <label class="form-check-label" for="is_active">Пункт активен (Если пункт не активен, то изменяет данный реквизит для всех вложенных пунктов меню)</label>
                        </div>
                        <div class="form-check">
                            <input type="hidden" name="is_footer" value="0">
                            <input type="checkbox" class="form-check-input" id="is_footer" name="is_footer" {{ $menu->is_footer == 1 ? 'checked' : ''}} value="1">
                            <label class="form-check-label" for="is_footer">Размещать в подвале (Если пункт не активен, то изменяет данный реквизит для всех вложенных пунктов меню)</label>
                        </div>

                        <div class="form-group">
                            <label for="order">Индекс меню - положение относительно других пунктов</label>
                            <input type="number" class="form-control" id="order" name="order" aria-describedby="order" placeholder="Индекс меню" value="{{ $menu->order }}">
                        </div>

                        <button type="submit" class="btn btn-primary">Обновить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection