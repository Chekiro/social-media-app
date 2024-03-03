@extends('layout.app')
@section('title', 'Comments | Admin Dashboard')
@section('content')
    <div class="row">
        <div class="col-3">
            @include('admin.shared.left-sidebar')
        </div>
        <div class="col-9">
            @include('shared.success-message')
            <h1>Comments</h1>

            <table class="table table-striped mt-3">
                <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Idea</th>
                    <th>Content</th>
                    <th>Created At</th>
                    <th>#</th>
                </tr>
                </thead>
                <tbody>
                @foreach($comments as $comment)
                    <tr>
                        <td>{{$comment->id}}</td>
                        <td><a href="{{route('users.show',$comment->user)}}">{{$comment->user->name}}</a></td>
                        <td><a href="{{route('ideas.show',$comment->idea)}}">{{$comment->idea->id}}</a></td>
                        <td>{{$comment->content}}</td>
                        <td>{{$comment->created_at ->toDateString()}}</td>
                        <td>

                            <form method="POST" action="{{ route('admin.comments.destroy', $comment->id) }}">
                                @csrf
                                @method('delete')
                                <button type="submit" class="ms-1 btn  btn-sm"><i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </td>

                    </tr>
                @endforeach
                </tbody>
            </table>
            <div>
                {{$comments->links()}}
            </div>
        </div>


    </div>
@endsection