@extends('layouts.app')

@section('meta_desc', $page->meta_desc)
@section('meta_keys', $page->meta_keys)

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $page->title }}</div>

                <div class="card-body">
                {!! $page->description !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection