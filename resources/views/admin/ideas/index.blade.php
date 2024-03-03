@extends('layout.app')
@section('title', 'Ideas | Admin Dashboard')
@section('content')
    <div class="row">
        <div class="col-3">
            @include('admin.shared.left-sidebar')
        </div>
        <div class="col-9">
            @include('shared.success-message')
            <h1>Ideas</h1>

            <table class="table table-striped mt-3">
                <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>User</th>
                    <th>Content</th>
                    <th>Created At</th>
                    <th>#</th>
                </tr>
                </thead>
                <tbody>
                @foreach($ideas as $idea)
                    <tr>
                        <td>{{$idea->id}}</td>
                        <td>{{$idea->user->name}}</td>
                        <td>{{$idea->content}}</td>
                        <td>{{$idea->created_at ->toDateString()}}</td>
                        <td>

                            <div>
                                <a class="ms-1 btn btn-sm " href="{{route('ideas.show',$idea->id)}}"><i
                                            class="fa-solid fa-eye mx-1"></i></a>
                            </div>

                            <div>
                                <a class="ms-1 btn btn-sm " href="{{route('ideas.edit',$idea->id)}}"><i
                                            class="fa-solid fa-user-pen"></i></a>
                            </div>

                            <form method="POST" action="{{ route('admin.ideas.destroy', $idea->id) }}">
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
                {{$ideas->links()}}
            </div>
        </div>


    </div>
@endsection