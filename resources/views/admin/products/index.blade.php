


@extends('admin.layouts.app')

@section('content')

<!-- @section('vendor-style')
  {{-- vendor css files --}} -->

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('public/admin/app-assets/vendors/css/vendors.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/admin/app-assets/vendors/css/tables/datatable/dataTables.bootstrap5.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/admin/app-assets/vendors/css/tables/datatable/responsive.bootstrap5.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('public/admin/app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css')}}">
    <!-- END: Vendor CSS-->

<!-- @endsection -->


 <!-- BEGIN: Content-->
<!-- BEGIN: Content-->
<div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">Product</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{url('admin/')}}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">Products</a>
                                    </li>
                                    <li class="breadcrumb-item active">List
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Ajax Sourced Server-side -->
                <section id="ajax-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header border-bottom">
                                    <h4 class="card-title">List</h4>
                                    <a href="{{url('admin/products/create')}}" class=" btn btn-info btn-gradient round  ">Add</a>
                                </div>
                                <div class="card-datatable">
                                    <table class="datatables-ajax table table-responsive">
                                        <thead>
                                            <tr>
                                                <th>Sr.no</th>
                                                <th>title</th>
                                                <th>status</th>
                                                <th>Created Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php  $i=1; @endphp
                                            @foreach($products as $key => $val)
                                            <tr>
                                                <th scope="row">{{ $i }}</th>
                                                <td>{{ $val->title }}</td>
                                                <td>{{ $val->status }}</td>
                                                <td>{{ $val->created_at }}</td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                                                            <i data-feather="more-vertical"></i>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <a class="dropdown-item" href="{{route('admin.products.edit',$val->id)}}">
                                                                <i data-feather="edit-2" class="me-50"></i>
                                                                <span>Edit</span>
                                                            </a>
                                                            <form action="{{route('admin.products.destroy',$val->id)}}" method="POST">
                                                                @csrf
                                                                @method('delete')
                                                                <button type="submit" class="dropdown-item"> <i data-feather="trash" class="me-50"></i>
                                                                <span>Delete</span></button>
                                                            </form>
                                                            <!-- <a class="dropdown-item" href="">
                                                                <i data-feather="trash" class="me-50"></i>
                                                                <span>Delete</span>
                                                            </a> -->
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            @php $i++; @endphp
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!--/ Ajax Sourced Server-side -->

                

            </div>
        </div>
    </div>
    <!-- END: Content-->
    <!-- END: Content-->


    <!-- BEGIN: Page Vendor JS-->


    <!-- <script src="{{ asset('public/admin/app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('public/admin/app-assets/vendors/js/tables/datatable/dataTables.bootstrap5.min.js')}}"></script>
    <script src="{{ asset('public/admin/app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js')}}"></script>
    <script src="{{ asset('public/admin/app-assets/vendors/js/tables/datatable/responsive.bootstrap5.js')}}"></script>
    <script src="{{ asset('public/admin/app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js')}}"></script> -->


    <script src="{{ asset('public/admin/app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('public/admin/app-assets/vendors/js/tables/datatable/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('public/admin/app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('public/admin/app-assets/vendors/js/tables/datatable/responsive.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('public/admin/app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js') }}"></script>
    <script src="{{ asset('public/admin/app-assets/vendors/js/tables/datatable/datatables.buttons.min.js') }}"></script>
    <script src="{{ asset('public/admin/app-assets/vendors/js/tables/datatable/jszip.min.js') }}"></script>
    <script src="{{ asset('public/admin/app-assets/vendors/js/tables/datatable/pdfUser.min.js') }}"></script>
    <script src="{{ asset('public/admin/app-assets/vendors/js/tables/datatable/vfs_fonts.js') }}"></script>
    <script src="{{ asset('public/admin/app-assets/vendors/js/tables/datatable/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('public/admin/app-assets/vendors/js/tables/datatable/buttons.print.min.js') }}"></script>
    <script src="{{ asset('public/admin/app-assets/vendors/js/tables/datatable/dataTables.rowGroup.min.js') }}"></script>


    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Page JS-->
    <script src="{{ asset('public/js/table-datatables-advanced.js')}}"></script>
    <!-- END: Page JS-->

@endsection