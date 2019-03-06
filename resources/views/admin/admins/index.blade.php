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
    <div class="col-xs-12">
      <div class="box">
        {!! Form::open(['route' => ['admins.index'], 'method' => 'get']) !!}	
        <div class="box-header">
          <h3 class="box-title">{{ $admin_title or 'Section Title' }}</h3>
          <div class="box-tools">
            <div class="input-group input-group-sm" style="width: 150px;">
              {!! Form::text('keyword', null, array('placeholder' => 'Search keyword','class' => 'form-control pull-right','id'=>'search_text')) !!}
              <div class="input-group-btn">
                {{ Form::button('<i class="fa fa-search"></i>', ['class' => 'btn btn-danger btn-xs', 'role' => 'button', 'type' => 'submit' ]) }}
			        </div>
            </div>
          </div>
        </div>
        {!! Form::close() !!}
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
          @if($data->count() > 0)

          <table class="table table-hover">
            <tr>
              <th class="col-md-1">Id</th>
              <th class="col-md-2">Frist Name</th>
              <th class="col-md-2">Last Name</th>
               <th class="col-md-2">Email</th>
               <th class="col-md-2">Role</th>
              <th class="col-md-1">Status</th>
              <th class="col-md-2">Action</th>
            </tr>
            @foreach ($data as $row)
              <tr>
                <td>{{ $row->id }}</td>
                <td>{{ $row->first_name }}</td>
                <td>{{ $row->last_name }}</td>
                <td>{{ $row->email }}</td>
                <td>
                @foreach($row->roles as $role)
                {{ @$role->description }},
                @endforeach
                </td>
                <td>{!! $row->status == 1 ? "<span class='label label-success'>Approved</span>" : "<span class='label label-warning'>Un Approved</span>" !!}</td>
                <td>
                  <div class='btn-group'>
                      <a href="{!! route('admins.show', [$row->id]) !!}" class='btn btn-default btn-xs'><i class="fa fa-eye "></i> View</a>
                      <a href="{!! route('admins.edit', [$row->id]) !!}" class='btn btn-default btn-xs'><i class="fa fa-pencil-square-o"></i> Edit</a>
                
                  </div>
                </td>
              </tr>
            @endforeach
            
          </table>
          @else

            <table class="table table-hover">
              <tr><td>No Record Found! </td></tr>
            </table>

          @endif                                                                                                                                           
        </div>
        {{-- Pagination --}}
        <div class="box-footer clearfix">
          {!! $data->render() !!}
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </div>
  </div>
@endsection
