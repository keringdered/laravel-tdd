@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <a href="#">{{$thread->creator->name }}</a> Posted : {{$thread->title}}
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        {{$thread->body}}
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8 ">
                @foreach($thread->replies as $reply)
                    <div class="card" style="margin-bottom: 5px; margin-top: 5px;">
                        <div class="card-header" style="background-color: #fff;">
                            <strong>
                                <a href="#">{{$reply->owner->name}}</a>
                                said {{$reply->created_at->diffForHumans()}} ...
                            </strong>
                        </div>

                        <div class="card-body">
                            {{$reply->body}}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @if(auth()->check())
            <div class="row justify-content-center">
                <div class="col-md-8 ">
                    <form action="{{$thread->path()."/replies"}}" method="POST">
                        {{csrf_field()}}
                        <div class="form-group">
                            <textarea placeholder="Have something to say?" class="form-control" name="body" rows="5"></textarea>
                        </div>
                        <div class="form-group">
                            <input class="btn btn-primary" value="Post" type="Submit">
                        </div>
                    </form>
                </div>
            </div>
        @else
            <div class="row justify-content-center">
                <div class="col-md-8 ">
                    <a href="{{route('login')}}"> Sign in to Comment</a>
                </div>
            </div>
        @endif
    </div>
@endsection
