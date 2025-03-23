@extends('layouts.errors')

@section('title', __('404 Not Found'))
@section('code', '404 Not Found')
@section('message', __('ページが見つかりません'))

@section('content')
<h1>
    <a href="{{ route('lendings.index') }}">TOPページ</a>
</h1>
@endsection