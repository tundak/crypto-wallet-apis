@extends('admin.layouts.app')

@section('main-content')
  <div class="row">
      <div class="col-lg-12">
          <div class="row table-header-row">
              <div class="panel-heading datatable-heading">
                 <a href="{{route('admins.index')}}" class = 'btn btn-primary' > <i class="fa fa-list"></i> All Employee </a>
                 <a href="{{route('admins.create')}}" class = 'btn btn-success' > <i class="fa fa-plus"></i> Add New Employee </a>
              </div>    
          </div>    
      </div>
  </div>
  <br/>
  <div class="row">
    <div class="col-md-12">
      <!-- Horizontal Form -->
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Update Employee</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        {!! Form::model($admin, [ 'method' => 'put', 'route' => ['admins.update',$admin->id], 'class'=>"form-horizontal",'files' => true,'id'=>'adminForm' ]) !!}
        
          <div class="box-body">
            <div class="form-group">
                {!! Form::label('first_name', 'Frist Name', ['class' => 'col-sm-2 control-label']) !!}
              <div class="col-sm-5">
                {!! Form::text('first_name', null, ['class' => 'form-control']) !!}
                @if ($errors->has('first_name'))
                    <span class="has-error">
                        <label class="control-label">* {{ $errors->first('first_name') }}</label>
                    </span>
                @endif
              </div>
            </div>
        
          <div class="form-group">
                {!! Form::label('last_name', 'Last Name', ['class' => 'col-sm-2 control-label']) !!}
              <div class="col-sm-5">
                {!! Form::text('last_name', null, ['class' => 'form-control']) !!}
                @if ($errors->has('last_name'))
                    <span class="has-error">
                        <label class="control-label">* {{ $errors->first('last_name') }}</label>
                    </span>
                @endif
              </div>
            </div>


            <div class="form-group">
                {!! Form::label('email', 'Email', ['class' => 'col-sm-2 control-label']) !!}
              <div class="col-sm-5">
                {!! Form::text('email', null, ['class' => 'form-control','readonly']) !!}
                @if ($errors->has('email'))
                    <span class="has-error">
                        <label class="control-label">* {{ $errors->first('email') }}</label>
                    </span>
                @endif
              </div>
            </div>

            <div class="form-group">
                {!! Form::label('mobile_number', 'Mobile Number', ['class' => 'col-sm-2 control-label']) !!}
                 <div class="col-md-2">
                                {!! Form::select('phone_code', $country_phone_code , 91,[ 'class'=>'form-control select2','id'=>'phone_code'])!!}
                                @if ($errors->has('phone_code'))
                                <span class="has-error">
                                    <label class="control-label">*{{ $errors->first('phone_code') }}</label>
                                </span>
                                @endif
                            </div>
                            <div class="col-md-3">
                                {!! Form::text('mobile_number', null, ['placeholder'=>'Mobile Number','class' => 'form-control','id'=>'mobile_number']) !!}
                                @if ($errors->has('mobile_number'))
                                <span class="has-error">
                                    <label class="control-label">* {{ $errors->first('mobile_number') }}</label>
                                </span>
                                @endif
                            </div>
                            </div>

            <div class="form-group">
                {!! Form::label('role_id', 'Employee Role:', ['class' => 'col-sm-2 control-label']) !!}
              <div class="col-sm-5">
                {!! Form::select('role_id[]', $roles , $role_id,['required' => 'required','class'=>'form-control select2', 'multiple'=>'multiple'])!!}
                @if ($errors->has('name'))
                    <span class="has-error">
                        <label class="control-label">{{ $errors->first('name') }}</label>
                    </span>
                @endif
              </div>
            </div>

          
              <div class="form-group">
                            <label for="password" class="col-md-2 control-label">New Password</label>

                            <div class="col-sm-5">
                                <input id="password" type="password" class="form-control" name="password" >

                                @if ($errors->has('password'))
                                    <span class="has-error">
                                       <label class="control-label">{{ $errors->first('password') }}</label>
                                    </span>
                                @endif
                            </div>
                        </div>

                         <div class="form-group">
                            <label for="confirm_password" class="col-sm-2 control-label">Confirm Password</label>

                            <div class="col-sm-5">
                                <input id="confirm_password" type="password" class="form-control" name="confirm_password">
                                @if ($errors->has('confirm_password'))
                                     <span class="has-error">
                                         <label class="control-label">{{ $errors->first('confirm_password') }}</label>
                                    </span>
                                @endif
                            </div>
                        </div>
         
          <div class="form-group">
              {!! Form::label('status', 'Status', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-6">
              {{ Form::checkbox('status', 1, null, ['class' => 'minimal']) }}
            </div>
          </div>
         <div class="form-group">
  <label for="password-confirm" class="col-sm-2 control-label"></label>
               <div class="col-sm-5">
            
            {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
            <a  onclick="window.history.go(-1); return false;" href="#" class="btn btn-default">Cancel</a>
          </div>
           </div>
           </div>
          <!-- /.box-footer -->
        {!! Form::close() !!}
      </div>
      <!-- /.box -->
    </div>
  </div>
@endsection

@push('header-styles')
<link rel="stylesheet" href="{{ asset('public/AssetsAdmin/bower_components/select2/dist/css/select2.min.css') }}">
@endpush

@push('footer-scripts')
    <script src="{{ asset('public/AssetsAdmin/bower_components/select2/dist/js/select2.full.min.js' )}}"></script>

@endpush

@push('footer-jquery')
   <script>
    $(function () {
      $('.select2').select2()
    })
</script>
@endpush

