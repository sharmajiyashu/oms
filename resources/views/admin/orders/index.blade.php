@extends('admin.layouts.app')

@section('content')
    <style>
        h3 {
            background: #b48b5b;
            color: white;
            padding: 0.1rem 1rem;
        }
    </style>

    <!-- BEGIN: Content-->
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
                                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a>
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
                                            <input type="date" class="form-control" name="date_from"
                                                value="{{ $date_time['date_from'] }}" />
                                        </div>
                                        <div class="col-md-2">
                                            <label for="">Date to</label>
                                            <input type="date" class="form-control" name="date_to"
                                                value="{{ $date_time['date_to'] }}" />
                                        </div>
                                        <div class="col-md-2">
                                            <label for=""> Agent</label>
                                            <select name="agent_id" id="" class="form-select">
                                                <option value="">(Select Agent)</option>
                                                @foreach ($agents as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ isset($date_time['agent_id']) && $date_time['agent_id'] == $item->id ? 'selected' : '' }}>
                                                        {{ $item->firstname }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-1">
                                            <button class="btn btn-success">Filter</button>
                                        </div>
                                        <div class="col-md-2"> <input type="text" class="form-control" id="myInput"
                                                onkeyup="myFunction()" placeholder="Search..."></div>

                                    </form>
                                        <div class="col-md-2">
                                            {{-- <a href="{{ route('admin.orders.export') }}"
                                                class=" btn btn-info btn-gradient round  ">Export</a> --}}

                                            <form action="{{ route('admin.orders.export') }}" method="">
                                                {{-- @csrf --}}
                                                <input type="hidden" name="agent_id"  value="{{ $date_time['agent_id'] }}">
                                                <input type="hidden" name="date_to"  value="{{ $date_time['date_to'] }}">
                                                <input type="hidden" name="date_from"  value="{{ $date_time['date_from'] }}">
                                                <button type="submit" class=" btn btn-info btn-gradient round  ">Export</button>
                                            </form>
                                        </div>
                                
                                    </div>
                                
                                
                                <div class="card-datatable">
                                    <table class="datatables-ajax table table-responsive">
                                        <thead>
                                            <tr>
                                                <th>Created Date</th>
                                                <th>Order ID</th>
                                                <th>Customer Name</th>
                                                <th>mobile</th>
                                                <th>Status / <br>tracking id</th>
                                                <th>Agent</th>
                                                <th>Amount</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="myTable">
                                            @php  $i=1; @endphp
                                            @foreach ($orders as $key => $val)
                                                <tr>
                                                    <td>{{ date('d-M-y H:i:s', strtotime($val->created_at)) }}</td>
                                                    <td>

                                                        <a href="#" data-bs-toggle="modal"
                                                            data-bs-target="#order_detail_{{ $val->id }}"><strong>{{ $val->order_id }}</strong></a>
                                                        <!-- Button trigger modal -->

                                                        <!-- Modal -->
                                                        <div class="modal fade text-start"
                                                            id="order_detail_{{ $val->id }}" tabindex="-1"
                                                            aria-labelledby="myModalLabel17" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title" id="myModalLabel17">
                                                                            {{ $val->order_id }}</h4>

                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body" style="    font-size: 14px;">
                                                                        <div class="row">
                                                                            <div class="col-md-12" style="font-size: 15px;">
                                                                                @if ($val->status == 'Reject')
                                                                                    <span
                                                                                        class="fw-bolder text-danger">Declined</span>
                                                                                    <a href="#"
                                                                                        data-bs-toggle="tooltip"
                                                                                        data-bs-placement="top"
                                                                                        title="{{ $val->reject_reason }}"><i
                                                                                            data-feather="eye"
                                                                                            class="me-50"></i></a>
                                                                                @elseif($val->status == 'Pending')
                                                                                    <span
                                                                                        class="fw-bolder text-warning">Pending</span>
                                                                                @elseif($val->status == 'Accept')
                                                                                    <strong
                                                                                        class="text-success">Approved:</strong>
                                                                                    <span
                                                                                        class="fw-bolder ">{{ $val->tracking_id }}</span>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <h3>Basic Details</h3>
                                                                            </div>


                                                                            <div class="col-md-6">
                                                                                Customer Type :
                                                                                <strong>{{ $val->customer_type }}</strong>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                Company :
                                                                                <strong>{{ $val->company }}</strong>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                Delivery Method :
                                                                                <strong>{{ $val->delivery_method }}</strong>
                                                                            </div>


                                                                        </div>

                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <h3>Payment Detail</h3>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                @if ($val->status != 'Accept')
                                                                                    Card Number :
                                                                                    <strong>{{ $val->card_number }}</strong><br>
                                                                                @else
                                                                                    Card Number :
                                                                                    <strong>************{{ $val->card_number[-4] }}{{ $val->card_number[-3] }}{{ $val->card_number[-2] }}{{ $val->card_number[-1] }}</strong>
                                                                                @endif
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                Exp :
                                                                                @if ($val->status != 'Accept')
                                                                                    <strong>{{ $val->card_exp }}</strong>
                                                                                @else
                                                                                    <strong>****</strong>
                                                                                @endif
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                Cvv :
                                                                                @if ($val->status != 'Accept')
                                                                                    <strong>{{ $val->card_cvv }}</strong>
                                                                                @else
                                                                                    <strong>***</strong>
                                                                                @endif
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                Comment :
                                                                                <strong>{{ $val->comment }}</strong>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                Total Amount :
                                                                                <strong>{{ $val->amount }}</strong>
                                                                            </div>

                                                                            
                                                                        </div>

                                                                        <div class="row">
                                                                            <div class="col-md-4">
                                                                                <h4>Product</h4>
                                                                                @php
                                                                                    $products = explode(",",$val->product);
                                                                                    foreach ($products as $key => $value) {
                                                                                        echo $value; echo "<br>";
                                                                                    }
                                                                                @endphp
                                                                            </div>
    
                                                                            <div class="col-md-4">
                                                                                <h4>Quanity</h4>
                                                                                @php
                                                                                    $products = explode(",",$val->quantity);
                                                                                    foreach ($products as $key => $value) {
                                                                                        echo $value; echo "<br>";
                                                                                    }
                                                                                @endphp
                                                                            </div>
    
                                                                            <div class="col-md-4">
                                                                                <h4>Amount</h4>
                                                                                @php
                                                                                    $products = explode(",",$val->amounts);
                                                                                    foreach ($products as $key => $value) {
                                                                                        echo $value; echo "<br>";
                                                                                    }
                                                                                @endphp
                                                                            </div>
                                                                        </div>

                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <h3>Customer Detail</h3>
                                                                            </div>
                                                                            <div class="col-md-12">
                                                                                Customer Name :
                                                                                <strong>{{ $val->customer_name }}</strong>
                                                                            </div>
                                                                            <div class="col-md-12">
                                                                                Address :
                                                                                <strong>{{ $val->sh_address }}</strong>
                                                                            </div>
                                                                            <div class="col-md-3">
                                                                                Country :
                                                                                <strong>{{ $val->sh_country }}</strong>
                                                                            </div>
                                                                            <div class="col-md-3">
                                                                                State :
                                                                                <strong>{{ $val->sh_state }}</strong>
                                                                            </div>
                                                                            <div class="col-md-3">
                                                                                City : <strong>{{ $val->sh_city }}</strong>
                                                                            </div>
                                                                            <div class="col-md-3">
                                                                                Zip Code :
                                                                                <strong>{{ $val->sh_zip_code }}</strong>
                                                                            </div>
                                                                        </div>

                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <h3>Billing Address</h3>
                                                                            </div>
                                                                            <div class="col-md-12">
                                                                                Address :
                                                                                <strong>{{ $val->bl_address }}</strong>
                                                                            </div>
                                                                            <div class="col-md-3">
                                                                                Country :
                                                                                <strong>{{ $val->bl_country }}</strong>
                                                                            </div>
                                                                            <div class="col-md-3">
                                                                                State :
                                                                                <strong>{{ $val->bl_state }}</strong>
                                                                            </div>
                                                                            <div class="col-md-3">
                                                                                City : <strong>{{ $val->bl_city }}</strong>
                                                                            </div>

                                                                            <div class="col-md-3">
                                                                                Zip Code :
                                                                                <strong>{{ $val->bl_zip_code }}</strong>
                                                                            </div>
                                                                        </div>

                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <h3>Contact Info</h3>
                                                                            </div>
                                                                            <div class="col-md-3">
                                                                                Mobile :
                                                                                <strong>{{ $val->mobile }}</strong>
                                                                            </div>
                                                                            <div class="col-md-4">
                                                                                CellPhone :
                                                                                <strong>{{ $val->cellphone }}</strong>
                                                                            </div>
                                                                            <div class="col-md-5">
                                                                                Email :
                                                                                <strong>{{ $val->email }}</strong>
                                                                            </div>
                                                                        </div>


                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>{{ $val->customer_name }}</td>
                                                    <td>{{ $val->mobile }}</td>
                                                    <td>

                                                        @if ($val->status == 'Pending')
                                                            <button type="button" class=" btn-relief-danger"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#Reject{{ $val->id }}"
                                                                style="border: coral;">
                                                                Decline
                                                            </button>
                                                            <div class="modal fade text-start modal-danger"
                                                                id="Reject{{ $val->id }}" tabindex="-1"
                                                                aria-labelledby="myModalLabel160" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered">

                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="myModalLabel160">
                                                                                {{ $val->order_id }}</h5>
                                                                            <button type="button" class="btn-close"
                                                                                data-bs-dismiss="modal"
                                                                                aria-label="Close"></button>
                                                                        </div>
                                                                        <form
                                                                            action="{{ route('admin.orders.changeStatus') }}"
                                                                            method="post">
                                                                            @csrf
                                                                            <div class="modal-body">
                                                                                <label for="">Reject Reason</label>
                                                                                <input type="hidden" name="id"
                                                                                    value="{{ $val->id }}">
                                                                                <input type="hidden" name="status"
                                                                                    value="Reject">
                                                                                <textarea class="form-control" name="reason" id="sh_address" rows="3" placeholder="Reject Reason"></textarea>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="submit"
                                                                                    class="btn btn-danger"
                                                                                    data-bs-dismiss="modal">Reject</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>

                                                                </div>
                                                            </div>

                                                            <div style="float:right">
                                                                <form action="{{ route('admin.orders.changeStatus') }}"
                                                                    method="post">
                                                                    @csrf
                                                                    <input type="hidden" name="id"
                                                                        value="{{ $val->id }}">
                                                                    <input type="hidden" name="status" value="Accept">
                                                                    <button class=" btn-relief-success"
                                                                        style="border: coral;">Approve</button>
                                                                </form>
                                                            </div>
                                                        @else
                                                            @if ($val->status == 'Reject')
                                                                <span class="fw-bolder text-danger">Declined</span>
                                                                <a href="#" data-bs-toggle="tooltip"
                                                                    data-bs-placement="top"
                                                                    title="{{ $val->reject_reason }}"><i
                                                                        data-feather="eye" class="me-50"></i></a>
                                                            @endif

                                                            @if ($val->status == 'Accept')
                                                                <strong class="text-success">Approved:</strong> <br>
                                                                <span>{{ $val->tracking_id }}</span><br>
                                                                <button type="button" class=" btn-relief-info"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#primary{{ $val->id }}"
                                                                    style="border: coral;">
                                                                    Update
                                                                </button>
                                                                <div class="modal fade text-start modal-dark"
                                                                    id="primary{{ $val->id }}" tabindex="-1"
                                                                    aria-labelledby="myModalLabel160" aria-hidden="true">
                                                                    <div class="modal-dialog modal-dialog-centered">

                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title"
                                                                                    id="myModalLabel160">
                                                                                    {{ $val->order_id }}</h5>
                                                                                <button type="button" class="btn-close"
                                                                                    data-bs-dismiss="modal"
                                                                                    aria-label="Close"></button>
                                                                            </div>
                                                                            <form
                                                                                action="{{ route('admin.orders.tracking_update') }}"
                                                                                method="post">
                                                                                @csrf
                                                                                <div class="modal-body">
                                                                                    <label for="">Tracking
                                                                                        Id</label>
                                                                                    <input type="hidden" name="id"
                                                                                        value="{{ $val->id }}">
                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        name="tracking_id" id=""
                                                                                        value="{{ $val->tracking_id }}"
                                                                                        placeholder="Tracking Id">
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="submit"
                                                                                        class="btn btn-dark"
                                                                                        data-bs-dismiss="modal">Update</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            @endif
                                                        @endif

                                                    </td>
                                                    <td><strong>{{ $val->name }}</strong></td>
                                                    <td class="fw-bolder text-dark">{{ $val->amount }}</td>

                                                    <td>
                                                        <div class="dropdown">
                                                            <button type="button"
                                                                class="btn btn-sm dropdown-toggle hide-arrow py-0"
                                                                data-bs-toggle="dropdown">
                                                                <i data-feather="more-vertical"></i>
                                                            </button>
                                                            <div class="dropdown-menu dropdown-menu-end">
                                                                <a class="dropdown-item"
                                                                    href="{{ route('admin.orders.edit', $val->id) }}">
                                                                    <i data-feather="edit-2" class="me-50"></i>
                                                                    <span>Edit</span>
                                                                </a>
                                                                <form
                                                                    action="{{ route('admin.orders.destroy', $val->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('delete')
                                                                    <button type="submit" class="dropdown-item"> <i
                                                                            data-feather="trash" class="me-50"></i>
                                                                        <span>Delete</span></button>
                                                                </form>
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

            </div>
        </div>
    </div>



    <script>
        function ChangeTranckingId(id, tracking_id) {
            $('#largeModal').modal('show');
        }
    </script>

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
