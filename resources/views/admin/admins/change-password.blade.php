@extends('admin.layouts.app')

@section('main-content')

  <div class="row">
    <div class="col-md-12">
      <!-- Horizontal Form -->
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Change Password</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form class="form-horizontal" role="form" method="POST" action="{{ route('changePasswordSubmit') }}">
                        {{ csrf_field() }}
                        <div class="box-body">

                             <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="old_password" class="col-md-2 control-label">Current Password</label>

                            <div class="col-sm-5">
                                <input id="old_password" type="password" class="form-control" name="old_password" required>

                                @if ($errors->has('curPassword'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('old_password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

               <div class="form-group{{ $errors->has('new_password') ? ' has-error' : '' }}">
                            <label for="new_password" class="col-md-2 control-label">New Password</label>

                            <div class="col-sm-5">
                                <input id="new_password" type="password" class="form-control" name="new_password" required>

                                @if ($errors->has('new_password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('new_password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                         <div class="form-group{{ $errors->has('confirm_password') ? ' has-error' : '' }}">
                            <label for="confirm_password" class="col-sm-2 control-label">Confirm Password</label>

                            <div class="col-sm-5">
                                <input id="confirm_password" type="password" class="form-control" name="confirm_password" required>
                                @if ($errors->has('confirm_password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('confirm_password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
<div class="form-group">
  <label for="password-confirm" class="col-sm-2 control-label"></label>
               <div class="col-sm-5">
            
            {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
            <a  href="{{ route('dashboard') }}" class="btn btn-default">Cancel</a>
          </div>
           </div>

                 </div>

                    </form>
      </div>
      <!-- /.box -->
    </div>
  </div>
@endsection
