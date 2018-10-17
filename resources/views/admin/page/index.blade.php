@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Все страницы | <a href="{{ route('page.create') }}">Создать страницу</a></div>

                <div class="card-body">
                    <div class="menu classic">
                        <ul id="nav" class="menu">
                        @foreach($pages as $page)
                            <li>
                                <a href="{{ route('page.edit', $page->id) }}">{{ $page->title }}</a>
                                <form style="display: inline;" action="{{ route('page.destroy', $page->id) }}" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" rel="tooltip" type="submit" class="btn btn-link">
                                        Удалить
                                    </button>
                                </form>
                                @if($page->is_main == 1)
                                    <span><strong>Используется как Главная</strong></span>
                                @endif
                            </li>
                        @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
