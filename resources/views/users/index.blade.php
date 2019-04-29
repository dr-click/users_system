@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Manage Users</div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                              <td>ID</td>
                              <td>Name</td>
                              <td>Email</td>
                              <td colspan = 2>Actions</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>{{$user->id}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>
                                    <a href="{{ route('users.edit',$user->id)}}" class="btn btn-primary">Edit</a>
                                </td>
                                <td>
                                    <form action="{{ route('users.destroy', $user->id)}}" method="post">
                                      @csrf
                                      @method('DELETE')
                                      <button class="btn btn-danger" type="submit">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
