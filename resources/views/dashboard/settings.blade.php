@extends('layouts.default')
@section('content')
    <div class="main-container d-flex">
        @include('layouts/sidebar')
        <div class="content">
        </div>
    </div>
@endsection

<style>
    .content {
        background: #F8F1F1;
        font-family: 'Inter', sans-serif;
    }   
</style>
