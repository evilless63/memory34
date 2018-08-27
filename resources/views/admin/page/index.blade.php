@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Все страницы | <a href="{{ route('page.create') }}">Создать страницу</a></div>

                <div class="card-body">
                    <div class="menu classic">
                        <ul id="nav" class="menu">
                        @foreach($pages as $page)
                            <li>
                                <a href="{{ route('page.edit', $page->id) }}">{{ $page->title }}</a>
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
