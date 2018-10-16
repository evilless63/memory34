
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Изменить информацию о пользователе</div>

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

                    <form name="editUser" method="POST"action="{{route('user.changepass')}}">
                        @csrf
                        <div class="form-group">
                            <label for="title">Текущий пароль:</label>
                            <input type="password" class="form-control" id="curPassword" name="curPassword" aria-describedby="curPassword" value="">
                        </div>
                        <div class="form-group">
                            <label for="meta_desc">Новый пароль:</label>
                            <input type="password" class="form-control" id="newPassword" name="newPassword" aria-describedby="newPassword"  value="">
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