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
<!-- Default box -->
<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">View Employee Details</h3>

   
  </div>
  <div class="box-body">
      <div class="row">
        <div class="col-md-12">
        <table class="table table-bordered">
          <tr>
            <td class="col-md-2">First Name</td>
            <td class="col-md-10">{{ $admin->first_name }}</td>
          </tr>
          <tr>
            <td class="col-md-2">Last Name</td>
            <td class="col-md-10">{{ $admin->last_name }}</td>
          </tr>
          <tr>
            <td class="col-md-2">Email</td>
            <td class="col-md-10">{{ $admin->email }}</td>
          </tr>

           <tr>
            <td class="col-md-2">Role</td>
            <td class="col-md-10"> @foreach($admin->roles as $role)
                {{ @$role->description }},
                @endforeach</td>
          </tr>

           <tr>
            <td class="col-md-2">Mobile Number</td>
            <td class="col-md-10">+{{ $admin->phone_code }}{{ $admin->mobile_number }}</td>
          </tr>
          
            <td class="col-md-2">Status</td>
            <td class="col-md-10">{!! $admin->status == 1 ? "<span class='label label-success'>Active</span>" : "<span class='label label-danger'>Inactive</span>" !!}</td>
          </tr>
          
        </table>
        </div>
      </div>
  </div>
  <!-- /.box-body -->
</div>
<!-- /.box -->
@endsection