@extends('layouts.errors')

@section('title', __('500 Internal Server Error'))
@section('code', '500 Internal Server Error')
@section('message', __('サーバー内部でエラーが発生しました'))

@section('content')
<h1>
    <a href="{{ route('lendings.index') }}">TOPページ</a>
</h1>
@endsection
