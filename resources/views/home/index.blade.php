@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    Welcome
                    @if (Auth::user())
                      <strong>{{ $user->name }}</strong>
                      <ul>
                        <li>
                          <a href="{{ route('home') }}">{{ __('Home') }}</a>
                        </li>
                        <li>
                          <a href="{{ route('users.index') }}">{{ __('Users') }}</a>
                        </li>
                        <li>
                          <a href="{{ route('groups.index') }}">{{ __('Groups') }}</a>
                        </li>
                      </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
