


@extends('admin.layouts.app')

@section('content')

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
                            <h2 class="content-header-title float-start mb-0">Enquire -Follow up</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{url('agent/')}}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{ route('agent.enquire.index') }}">Enquire</a>
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
                                <form action="" method="get">
                                    @csrf
                                    <div class="row border-bottom card-header">
                                        <div class="col-md-6"><h4 class="card-title">List</h4></div>
                                        <div class="col-md-2">
                                            <input type="date" class="form-control" name="date" value="{{ $date_time['date'] }}" />
                                        </div>
                                        <div class="col-md-2">
                                            <select name="status" id="" class="form-control">
                                                <option value="">All</option>
                                                @foreach ($follow_up_master as $item)
                                                    <option value="{{ $item->title }}" {{ (isset($date_time['status']) && $date_time['status'] == $item->title) ? 'selected' : '' }}>{{ $item->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <button class="btn btn-success">Search</button>
                                        </div>
                                    </div>
                                </form>
                                <div class="card-datatable">
                                    <table class="datatables-ajax table table-responsive">
                                        <thead>
                                            <tr>
                                                {{-- <th>Sr.no</th> --}}
                                                <th>Customer Name</th>
                                                <th>Mobile</th>
                                                <th>Email</th>
                                                <th>Status</th>
                                                <th>Created Date</th>
                                                {{-- <th>Action</th> --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php  $i=1; @endphp
                                            @foreach($data as $key => $val)
                                            <tr>
                                                {{-- <th scope="row">{{ $i }}</th> --}}
                                                <td><a href="{{ route('agent.enquire.show',$val->id) }}"><strong>{{ $val->customer_name }}</strong></a></td>
                                                <td>{{ $val->mobile }}</td>
                                                <td>{{ $val->email }}</td>
                                                <td>{{ $val->status }}</td>
                                                <td>{{ $val->created_at }}</td>
                                                {{-- <td>
                                                    <div class="dropdown">
                                                        <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                                                            <i data-feather="more-vertical"></i>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <a class="dropdown-item" href="{{route('admin.follow-up-master.edit',$val->id)}}">
                                                                <i data-feather="edit-2" class="me-50"></i>
                                                                <span>Edit</span>
                                                            </a>
                                                            <form action="{{route('admin.follow-up-master.destroy',$val->id)}}" method="POST">
                                                                @csrf
                                                                @method('delete')
                                                                <button type="submit" class="dropdown-item"> <i data-feather="trash" class="me-50"></i>
                                                                <span>Delete</span></button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </td> --}}
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