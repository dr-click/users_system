@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                  Manage Groups
                  <a href="{{ route('groups.create')}}" class="btn btn-primary">New Group</a>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                              <td>ID</td>
                              <td>Name</td>
                              <td colspan = 1>Actions</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($groups as $group)
                            <tr>
                                <td>
                                  {{$group->id}}
                                </td>
                                <td>
                                  {{$group->name}}
                                </td>
                                <td>
                                    <form action="{{ route('groups.destroy', $group->id)}}" method="post">
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
