@extends('layout.app')
@section('title', 'Users | Admin Dashboard')
@section('content')
    <div class="row">
        <div class="col-3">
            @include('admin.shared.left-sidebar')
        </div>
        <div class="col-9">
            @include('shared.success-message')
            <h1>Users</h1>

            <table class="table table-striped mt-3">
                <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Joined At</th>
                    <th>#</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->created_at ->toDateString()}}</td>
                        <td>

                            <div>
                                <a class="ms-1 btn btn-sm " href="{{route('users.show',$user->id)}}"><i
                                            class="fa-solid fa-eye mx-1"></i></a>
                            </div>

                            <div>
                                <a class="ms-1 btn btn-sm " href="{{route('users.edit',$user->id)}}"><i
                                            class="fa-solid fa-user-pen"></i></a>
                            </div>

                            <form method="POST" action="{{ route('users.destroy', $user->id) }}">
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
                {{$users->links()}}
            </div>
        </div>


    </div>
@endsection