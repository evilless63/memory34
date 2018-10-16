
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Изменить информацию о компании</div>

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

                    <form name="editInfo" method="POST"action="{{route('information.update')}}">
                        @csrf
                        <div class="form-group">
                            <label for="title">Адрес:</label>
                            <input type="text" class="form-control" id="adress" name="adress" aria-describedby="adress" value="{{ $info->adress }}">
                        </div>
                        <div class="form-group">
                            <label for="meta_desc">Телефон:</label>
                            <input type="text" class="form-control" id="phone" name="phone" aria-describedby="phone"  value="{{ $info->phone }}">
                        </div>
                        <div class="form-group">
                            <label for="meta_keys">Время работы:</label>
                            <input type="text" class="form-control" id="time" name="time" aria-describedby="time" value="{{ $info->time }}">
                        </div>
                        <div class="form-group">
                            <label for="meta_keys">Электронная почта:</label>
                            <input type="text" class="form-control" id="email" name="email" aria-describedby="email" value="{{ $info->email }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Обновить</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection