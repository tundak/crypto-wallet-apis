@extends('admin.layouts.login')

@section('content')
<div class="login-box">
  <div class="login-logo">
    <a href=""><b>Radicalhash </b>Admin</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>
   @if(session()->has('message.danger'))
    <div class="alert alert-danger"> 
    {!! session('message.danger') !!}
    </div>
@endif

    <form class="form-horizontal" role="form" method="POST" action="{{ route('admin.login.submit') }}">
      {{ csrf_field() }}
      <div class="form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
        <input id="email" type="email" class="form-control" placeholder="email" name="email" value="{{ old('email') }}" required autofocus>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        @if ($errors->has('email'))
            <span class="has-error">
                <label>{{ $errors->first() }}</label>
            </span>
        @endif
      </div>
      <div class="form-group has-feedback {{ $errors->has('password') ? ' has-error' : '' }}">
        <input id="password" type="password" class="form-control" placeholder="password" name="password" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        @if ($errors->has('password'))
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

  </div>
  <!-- /.login-box-body -->
</div>
@endsection
