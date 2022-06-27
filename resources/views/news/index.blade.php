@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('News Management') }}</div>

                    <div class="card-body">
                        <div class="row justify-content-center">
                            @auth<a class="btn btn-success col-md-2" href="{{ route('news.create') }}"> Create News Item</a>@endauth
                        </div>

                        @if ($message = Session::get('success'))
                            <div class="alert alert-success mt-4 text-center">
                                {{ $message }}
                            </div>
                        @endif

                        <table class="table">
                            <tr>
                                <th>Id</th>
                                <th>Title</th>
                                <th>Content</th>
                                <th width="280px">Action</th>
                            </tr>
                            @foreach ($news as $newsItem)
                                <tr>
                                    <td>{{ $newsItem->id }}</td>
                                    <td>{{ $newsItem->title }}</td>
                                    <td>{{ $newsItem->content }}</td>
                                    <td>

                                        @auth
                                            <form action="{{ route('news.destroy', $newsItem->id) }}" method="POST">

                                                <a class="btn btn-info"
                                                    href="{{ route('news.show', $newsItem->id) }}">Show</a>

                                                <a class="btn btn-primary"
                                                    href="{{ route('news.edit', $newsItem->id) }}">Edit</a>

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        @else
                                            <a class="btn btn-info" href="{{ route('news.show', $newsItem->id) }}">Show</a>
                                        @endauth


                                    </td>
                                </tr>
                            @endforeach
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
