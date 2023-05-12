


@extends('admin.layouts.app')

@section('content')

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
                                    <a href="{{ route('admin.orders.create') }}" class=" btn btn-info btn-gradient round  ">Add Order</a>
                                </div>
                                <div class="card-datatable">
                                    <table class="datatables-ajax table table-responsive" >
                                        <thead>
                                            <tr>
                                                {{-- <th>Sr.no</th> --}}
                                                <th>Order ID</th>
                                                <th>Customer Name</th>
                                                <th>Amount</th>
                                                {{-- <th>Email</th> --}}
                                                <th>mobile</th>
                                                <th>Created Date</th>
                                                <th>Status / <br>tracking id</th>
                                                {{-- <th></th> --}}
                                                <th>Action</th>
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
                                                {{-- <td>{{ $val->email }}</td> --}}
                                                
                                                <td>{{ $val->mobile }}</td>
                                                
                                                <td>{{ $val->created_at }}</td>
                                                <td>
                                                
                                                    @if ($val->status == 'Pending')
                                                        <button type="button" class=" btn-relief-danger" data-bs-toggle="modal" data-bs-target="#Reject{{ $val->id }}" style="border: coral;">
                                                            Reject
                                                        </button>
                                                        <div class="modal fade text-start modal-danger" id="Reject{{$val->id}}" tabindex="-1" aria-labelledby="myModalLabel160" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered">
                                                                
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="myModalLabel160">{{ $val->order_id }}</h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <form action="{{ route('admin.orders.changeStatus') }}" method="post">
                                                                            @csrf
                                                                            <div class="modal-body">
                                                                                <label for="">Reject Reason</label>
                                                                                <input type="hidden" name="id" value="{{ $val->id }}">
                                                                                <input type="hidden" name="status" value="Reject">
                                                                                <textarea class="form-control" name="reason" id="sh_address" rows="3" placeholder="Reject Reason"></textarea>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="submit" class="btn btn-danger" data-bs-dismiss="modal">Reject</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                
                                                            </div>
                                                        </div>

                                                        <div style="float:right">
                                                            <form action="{{ route('admin.orders.changeStatus') }}" method="post">
                                                                @csrf
                                                                <input type="hidden" name="id" value="{{ $val->id }}">
                                                                <input type="hidden" name="status" value="Accept">
                                                                <button class=" btn-relief-success" style="border: coral;">Accept</button>
                                                            </form>
                                                        </div>
                                                        
                                                        
                                                    @else 
                                                        
                                                        
                                                        @if ($val->status == 'Reject')
                                                            <strong>{{ $val->status }}</strong>
                                                            <br>
                                                            {{ $val->reject_reason }}

                                                        @endif

                                                        @if ($val->status == 'Accept')
                                                        Trcking Id :<br><strong>{{ $val->tracking_id }}</strong> <br>
                                                        <button type="button" class=" btn-relief-info" data-bs-toggle="modal" data-bs-target="#primary{{ $val->id }}" style="border: coral;">
                                                            Update
                                                        </button>
                                                        <div class="modal fade text-start modal-dark" id="primary{{$val->id}}" tabindex="-1" aria-labelledby="myModalLabel160" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered">
                                                                
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title" id="myModalLabel160">{{ $val->order_id }}</h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <form action="{{ route('admin.orders.tracking_update') }}" method="post">
                                                                            @csrf
                                                                            <div class="modal-body">
                                                                                <label for="">Tracking Id</label>
                                                                                <input type="hidden" name="id" value="{{ $val->id }}">
                                                                                <input type="text" class="form-control" name="tracking_id" id="" value="{{ $val->tracking_id }}" placeholder="Tracking Id">
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="submit" class="btn btn-dark" data-bs-dismiss="modal">Update</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                
                                                            </div>
                                                        </div>

                                                        @endif
                                                    @endif
                                                
                                                </td>
                                                {{-- <td><strong>{{ $val->tracking_id }}</strong> <br>

                                                    

                                                    <button type="button" class=" btn-relief-info" data-bs-toggle="modal" data-bs-target="#primary{{ $val->id }}" style="border: coral;">
                                                        Update
                                                    </button>
                                                    <div class="modal fade text-start modal-dark" id="primary{{$val->id}}" tabindex="-1" aria-labelledby="myModalLabel160" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="myModalLabel160">{{ $val->order_id }}</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <form action="{{ route('admin.orders.tracking_update') }}" method="post">
                                                                        @csrf
                                                                        <div class="modal-body">
                                                                            <label for="">Tracking Id</label>
                                                                            <input type="hidden" name="id" value="{{ $val->id }}">
                                                                            <input type="text" class="form-control" name="tracking_id" id="" value="{{ $val->tracking_id }}" placeholder="Tracking Id">
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="submit" class="btn btn-dark" data-bs-dismiss="modal">Update</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            
                                                        </div>
                                                    </div>

                                                </td> --}}
                                                <td>
                                                    <div class="dropdown">
                                                        <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                                                            <i data-feather="more-vertical"></i>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <a class="dropdown-item" href="{{route('admin.orders.edit',$val->id)}}">
                                                                <i data-feather="edit-2" class="me-50"></i>
                                                                <span>Edit</span>
                                                            </a>
                                                            <form action="{{route('admin.orders.destroy',$val->id)}}" method="POST">
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

            </div>
        </div>
    </div>



    <script>
        function ChangeTranckingId(id,tracking_id){
            $('#largeModal').modal('show');
        }
    </script>
    

@endsection