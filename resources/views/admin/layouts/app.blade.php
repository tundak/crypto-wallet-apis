<!DOCTYPE html>

<html lang="{{ app()->getLocale() }}">



@section('htmlheader')

    @include('admin.layouts.elements.htmlHeader')

@show

<body class="skin-blue sidebar-mini">

@include('admin.layouts.elements.pageLoader')

<div id="app" v-cloak>

    <div class="wrapper">



    @include('admin.layouts.elements.mainHeader')



    @include('admin.layouts.elements.sidebar')



    <!-- Content Wrapper. Contains page content -->

    <div class="content-wrapper">

        @include('admin.layouts.elements.flash')

        

        <!-- Main content -->

        <section class="content" style="min-height: 765px">

            <!-- Your Page Content Here -->

            @yield('main-content')

        </section><!-- /.content -->

    </div><!-- /.content-wrapper -->



    @include('admin.layouts.elements.controlsidebar')



    @include('admin.layouts.elements.footer')



    </div><!-- ./wrapper -->

</div>

@section('scripts')

    @include('admin.layouts.elements.scripts')

@show

</body>

</html>

