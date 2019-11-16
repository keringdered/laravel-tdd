@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create A New Thread</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form action="/threads" method="POST">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label>Title:</label>
                                <input class="form-control" name="title" type="text" placeholder="title">
                            </div>
                            <div class="form-group">
                                <label>Body:</label>
                                <textarea class="form-control" name="body" placeholder="Type to Compose" rows="8"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Post</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
