


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
                            <h2 class="content-header-title float-start mb-0">Follow Up Master</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{url('admin/')}}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{ route('admin.follow-up-master.index') }}">follow-up-master</a>
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
                
                <section id="ajax-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header border-bottom">
                                    <h4 class="card-title">List</h4>
                
                
                                </div>
                                <div class="card-datatable">
                                    <table class="datatables-ajax table table-responsive">
                                        <thead>
                                            <tr>
                                                <th>Order ID</th>
                                                <th>Customer Name</th>
                                                <th>Mobile</th>
                                                <th>Email</th>
                                                <th>Type</th>
                                                
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php  $i=1; @endphp
                                            @foreach($data as $key => $val)
                                            <tr>
                                                {{-- <th scope="row">{{ $i }}</th> --}}
                                                <td><a href="{{ route('agent.follow-up.show-detail',$val->order_id) }}"><strong>{{ $val->order_id }}</strong></a></td>
                                                <td>{{ $val->customer_name }}</td>
                                                <td>{{ $val->mobile }}</td>
                                                <td>{{ $val->email }}</td>
                                                <td>{{ $val->type }}</td>
                                                
                                                <td>{{ $val->date }}</td>
                                                
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
    

@endsection