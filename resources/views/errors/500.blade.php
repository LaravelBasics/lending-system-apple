@extends('layouts.errors')

@section('title', __('500 Internal Server Error'))
@section('code', '500 Internal Server Error')
@section('message', __('サーバー内部でエラーが発生しました'))

@section('content')
<h1>
    <a href="{{ route('home') }}">TOPページ</a>
</h1>
<!-- 画面中央に表示する画像 -->
<img src="{{ asset("images/image500.png") }}" alt="画像500"
    class="position-fixed top-50 start-50 translate-middle"
    style="width: 150px; height: auto;">
@endsection
