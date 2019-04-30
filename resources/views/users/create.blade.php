@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-sm-8 offset-sm-2">
      <h3 class="display-5">Create User</h3>

      @if ($errors->any())
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
      <br />
      @endif
      <form method="post" action="{{ route('users.store') }}">
          @csrf
          <div class="form-group">
            <label for="first_name">Group:</label>
            <select class="chosen-select" name="group_id" id="user_group_id">
              @foreach($groups as $group)
                  <option value="{{$group->id}}"
                    @if ($user->group_id && $group->id == old('group_id', $user->group_id))
                      selected="selected"
                    @endif
                  >{{$group->name}}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
              <label for="first_name">Name:</label>
              <input type="text" class="form-control" name="name" value="{{ $user->name }}" />
          </div>
          <div class="form-group">
              <label for="email">Email:</label>
              <input type="email" class="form-control" name="email" value="{{ $user->email }}" />
          </div>
          <div class="form-group">
              <label for="city">Password:</label>
              <input type="password" class="form-control" name="password" value="" />
          </div>
          <button type="submit" class="btn btn-primary">Create</button>
      </form>
  </div>
</div>
@endsection
