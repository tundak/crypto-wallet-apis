<?php
use \App\Http\Controllers\Controller;
?>
@extends('admin.layouts.app')

@section('main-content')


<div class="row">
   <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-aqua">
         <div class="inner">
            <h3>{{$order_count}}</h3>
            <p>Orders</p>
         </div>
         <div class="icon">
            <i class="ion ion-bag"></i>
         </div>
         <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
   </div>


 
   

  

   </div>

   
  



@endsection

@push('header-scripts')

@endpush

@push('header-styles')

@endpush

@push('footer-scripts')

@endpush

@push('footer-jquery')

@endpush