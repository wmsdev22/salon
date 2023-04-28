@extends('layouts.app')
@push('css_lib')
    <link rel="stylesheet" href="{{asset('vendor/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/summernote/summernote-bs4.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/dropzone/min/dropzone.min.css')}}">
@endpush
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-bold">{{trans('lang.membership_plural') }}<small class="mx-3">|</small><small>{{trans('lang.membership_desc')}}</small></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb bg-white float-sm-right rounded-pill px-4 py-2 d-none d-md-flex">
                        <li class="breadcrumb-item"><a href="{{url('/dashboard')}}"><i class="fas fa-tachometer-alt"></i> {{trans('lang.dashboard')}}</a></li>
                        <li class="breadcrumb-item">
                            <a href="{!! route('memberships.index') !!}">{{trans('lang.membership_plural')}}</a>
                        </li>
                        <li class="breadcrumb-item active">{{trans('lang.membership_edit')}}</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="content">
        <div class="clearfix"></div>
        @include('flash::message')
        @include('adminlte-templates::common.errors')
        <div class="clearfix"></div>
        <div class="card shadow-sm">
            <div class="card-header">
                <ul class="nav nav-tabs d-flex flex-row align-items-start card-header-tabs">
                    @can('memberships.index')
                        <li class="nav-item">
                            <a class="nav-link" href="{!! route('memberships.index') !!}"><i class="fa fa-list mr-2"></i>{{trans('lang.membership_table')}}</a>
                        </li>
                    @endcan
                    @can('memberships.create')
                        <li class="nav-item">
                            <a class="nav-link" href="{!! route('memberships.create') !!}"><i class="fa fa-plus mr-2"></i>{{trans('lang.membership_create')}}</a>
                        </li>
                    @endcan
                    <li class="nav-item">
                        <a class="nav-link active" href="{!! url()->current() !!}"><i class="fas fa-edit mr-2"></i>{{trans('lang.membership_edit')}}</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                {!! Form::model($membership, ['route' => ['memberships.update', $membership->id], 'method' => 'patch']) !!}
                <div class="row">
                    @include('memberships.fields')
                </div>
                {!! Form::close() !!}
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    @include('layouts.media_modal')
@endsection
@push('scripts_lib')
    <script src="{{asset('vendor/select2/js/select2.full.min.js')}}"></script>
    <script src="{{asset('vendor/summernote/summernote.min.js')}}"></script>
    <script src="{{asset('vendor/dropzone/min/dropzone.min.js')}}"></script>
    <script type="text/javascript">
        Dropzone.autoDiscover = false;
        var dropzoneFields = [];
    </script>
      <script type="text/javascript">
            var var16110650672130312723ble = '';
                        var dz_var16110650672130312723ble = $(".dropzone.image").dropzone({
                url: "http://127.0.0.1:8000/uploads/store",
                addRemoveLinks: true,
                maxFiles: 1,
                init: function () {
                                    },
                accept: function (file, done) {
                    dzAccept(file, done, this.element, "https://nailstale.in/images/icons");
                },
                sending: function (file, xhr, formData) {
                    dzSending(this, file, formData, 'Rg56AV3Rk3DPXI4ali96MEUnLw9r3GQ452plYAw8');
                },
                maxfilesexceeded: function (file) {
                    dz_var16110650672130312723ble[0].mockFile = '';
                    dzMaxfile(this, file);
                },
                complete: function (file) {
                    dzComplete(this, file, var16110650672130312723ble, dz_var16110650672130312723ble[0].mockFile);
                    dz_var16110650672130312723ble[0].mockFile = file;
                },
                removedfile: function (file) {
                    dzRemoveFile(
                        file, var16110650672130312723ble, 'http://127.0.0.1:8000/membership/remove-media',
                        'image', '0', 'http://127.0.0.1:8000/uplaods/clear', 'Rg56AV3Rk3DPXI4ali96MEUnLw9r3GQ452plYAw8'
                    );
                }
            });
            dz_var16110650672130312723ble[0].mockFile = var16110650672130312723ble;
            dropzoneFields['image'] = dz_var16110650672130312723ble;
        </script>
@endpush
