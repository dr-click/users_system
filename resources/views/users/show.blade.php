@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">User Details</div>
                <div class="card-body">
                    <strong>{{ $user->name }}</strong>
                    <ul>
                      <li>
                        <strong>Email: </strong>
                        {{ $user->email }}
                      </li>
                      <li>
                        <strong>Created At: </strong>
                        {{ $user->created_at }}
                      </li>
                    </ul>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
