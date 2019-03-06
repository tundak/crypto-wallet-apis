@extends('admin.layouts.app')

@section('main-content')

  <div class="row">
    <div class="col-md-12">
      <!-- Horizontal Form -->
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Edit Profile</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        {!! Form::model($user, [ 'method' => 'put', 'route' => ['editProfileSubmit'], 'class'=>"form-horizontal",'id'=>'adminForm' ]) !!}
                        {{ csrf_field() }}
                        <div class="box-body">

                          
            <div class="form-group">
                {!! Form::label('first_name', 'First Name', ['class' => 'col-sm-2 control-label']) !!}
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
