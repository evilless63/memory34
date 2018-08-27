@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Все меню | <a href="{{ route('menu.create') }}">Создать пункт меню</a></div>

                <div class="card-body">
                    <div class="menu classic">
                        <ul id="nav" class="menu">
                        @include('admin.includes.menuItems', ['items'=>$menus->roots()])
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
