


@extends('admin.layouts.app')

@section('content')


<div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">Order</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Orders</a>
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
                                    <a href="{{ route('agent.orders.create') }}" class=" btn btn-info btn-gradient round  ">Add Order</a>
                                </div>
                                <div class="card-datatable">
                                    <table class="datatables-ajax table table-responsive" >
                                        <thead>
                                            <tr>
                                                {{-- <th>Sr.no</th> --}}
                                                <th>Order ID</th>
                                                <th>Customer Name</th>
                                                <th>Amount</th>
                                                <th>Email</th>
                                                <th>mobile</th>
                                                {{-- <th>Status</th> --}}
                                                <th>Created Date</th>
                                                {{-- <th>Action</th> --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php  $i=1; @endphp
                                            @foreach($orders as $key => $val)
                                            <tr>
                                                {{-- <th scope="row">{{ $i }}</th> --}}
                                                <td><strong>{{ $val->order_id }}</strong></td>
                                                <td>{{ $val->customer_name }}</td>
                                                <td>{{ $val->amount }}</td>
                                                <td>{{ $val->email }}</td>
                                                <td>{{ $val->mobile }}</td>
                                                {{-- <td>{{ $val->status }}</td> --}}
                                                <td>{{ $val->created_at }}</td>
                                               
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



                

            </div>
        </div>
    </div>



@endsection