


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
                                <form action="" method="get">
                                    @csrf
                                    <div class="row border-bottom card-header">
                                        <div class="col-md-2">
                                            <label for="">Date From</label>
                                            <input type="date" class="form-control" name="date_from" value="{{ $date_time['date_from'] }}" />
                                        </div>
                                        <div class="col-md-2">
                                            <label for="">Date to</label>
                                            <input type="date" class="form-control" name="date_to" value="{{ $date_time['date_to'] }}" />
                                        </div>
                                        <div class="col-md-1">
                                            <button class="btn btn-success">Filter</button>
                                        </div>
                                        <div class="col-md-2"> <input type="text" class="form-control" id="myInput" onkeyup="myFunction()" placeholder="Search..."></div>
                                        <div class="col-md-2"><a href="{{ route('agent.orders.create') }}" class=" btn btn-info btn-gradient round  ">Add Order</a></div>
                                    </div>
                                </form>
                                
                                <div class="card-datatable">
                                    <table class="datatables-ajax table table-responsive" >
                                        <thead>
                                            <tr>
                                                <th>Created Date</th>
                                                <th>Order ID</th>
                                                <th>Status / <br>tracking id</th>
                                                <th>Customer Name</th>
                                                <th>mobile</th>
                                                <th>Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody id="myTable">
                                            @php  $i=1; @endphp
                                            @foreach($orders as $key => $val)
                                            <tr>
                                                <td>{{ date('d-M-y H:i:s',strtotime($val->created_at)) }}</td>
                                                <td><strong>{{ $val->order_id }}</strong></td>
                                                <td>
                                                    @if ($val->status == 'Reject')
                                                        <span class="fw-bolder text-danger">Reject</span>
                                                        <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $val->reject_reason }}"><i data-feather="eye" class="me-50"></i></a>
                                                    @elseif($val->status == 'Pending')
                                                        <span class="fw-bolder text-warning">Pending</span>
                                                    
                                                    @elseif($val->status == 'Accept')
                                                        <strong class="text-success">Tracking Id:</strong> <br>
                                                        <span >{{ $val->tracking_id }}</span>
                                                    @endif
                                                </td>
                                                <td>{{ $val->customer_name }}</td>
                                                <td>{{ $val->mobile }}</td>
                                                <td>{{ $val->amount }}</td>
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
    <script>
        function myFunction() {
            var input, filter, found, table, tr, td, i, j;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("myTable");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td");
                for (j = 0; j < td.length; j++) {
                    if (td[j].innerHTML.toUpperCase().indexOf(filter) > -1) {
                        found = true;
                    }
                }
                if (found) {
                    tr[i].style.display = "";
                    found = false;  
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    </script>


@endsection