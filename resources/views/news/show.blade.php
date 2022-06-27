@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('View News Item') }}</div>

                    <div class="card-body">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Title:</strong>
                                {{ $news->title }}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 mt-4">
                            <div class="form-group">
                                <strong>Content:</strong>
                                {{ $news->content }}
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12 text-center mt-4">
                            <a class="btn btn-secondary" href="{{ route('news.index') }}"> Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
