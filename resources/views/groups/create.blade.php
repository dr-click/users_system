@extends('layouts.app')

@section('content')
<div class="row">
  <div class="col-sm-8 offset-sm-2">
      <h3 class="display-5">Create Group</h3>

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
      <form method="post" action="{{ route('groups.store') }}">
          @csrf
          <div class="form-group">

              <label for="first_name">Name:</label>
              <input type="text" class="form-control" name="name" value="{{ $group->name }}" />
          </div>

          <button type="submit" class="btn btn-primary">Create</button>
      </form>
  </div>
</div>
@endsection
