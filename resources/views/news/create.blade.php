@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Create News Item') }}</div>

                <div class="card-body">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Error!</strong> You have following error(s) in your form<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('news.store') }}" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Title:</strong>
                                    <input type="text" name="title" class="form-control" placeholder="Title">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12  mt-4">
                                <div class="form-group">
                                    <strong>Content:</strong>
                                    <textarea class="form-control" style="height:150px" name="content" placeholder="Content"></textarea>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 text-center mt-4">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a class="btn btn-secondary" href="{{ route('news.index') }}"> Back</a>
                            </div>
                        </div>

                    </form>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
