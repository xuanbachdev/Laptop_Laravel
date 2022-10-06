@extends('layouts.master')

@section('content')
    <div class="blog-item">
        <hr class="offset-top visible-lg visible-md">
        <hr class="offset-lg visible-xs">
        <hr class="offset-lg visible-xs">
        {{-- <img src="{{asset('storage/'.$post->cover_image)}}" alt="{{$post->title}}" class="hidden-xs" /> --}}
        <div class="white">
            <hr class="offset-md">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2 text-justify">
                        <h1 class="h2">{{$post->title}}</h1>
                        <hr class="offset-md">
                        <hr class="offset-md">
                        <p class="text-muted"><i> {{$post->created_at}}  <span class="pull-right"><i class="text-muted fa fa-eye"></i> {{$post->view}} </i></span></p>
                        <hr class="offset-lg">
                        <hr class="offset-lg">
                        {!! $post->content !!}
                    </div>
                </div>
            </div>
            <hr class="offset-lg">
            <hr class="offset-lg">
            <hr class="offset-lg">
        </div>
    </div>
@endsection
