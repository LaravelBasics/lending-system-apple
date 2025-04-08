@extends('layouts.errors')

@section('title', __('404 Not Found'))
@section('code', '404 Not Found')
@section('message', __('ページが見つかりません'))

@section('content')
<h1>
    <a href="{{ route('home') }}">TOPページ</a>
</h1>
<!-- 画面中央に表示する画像 -->
<img src="{{ asset("images/image404.png") }}" alt="画像404"
    class="position-fixed top-50 start-50 translate-middle"
    style="width: 150px; height: auto;">
@endsection