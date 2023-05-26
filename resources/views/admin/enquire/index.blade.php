


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
                            <h2 class="content-header-title float-start mb-0">Enquire</h2>
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
                                        @if (Auth::user()->type == 'admin')
                                            <div class="col-md-2">
                                                <label for=""> Agent</label>
                                                <select name="agent_id" id="" class="form-select">
                                                    <option value="">(Select Agent)</option>
                                                    @foreach ($agents as $item)
                                                        <option value="{{ $item->id }}" {{ (isset($date_time['agent_id']) && $date_time['agent_id'] == $item->id) ? 'selected' : '' }} >{{ $item->firstname }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        @endif
                                        <div class="col-md-2"> <input type="text" class="form-control" id="myInput" onkeyup="myFunction()" placeholder="Search..."></div>
                                        
                                        @if (Auth::user()->type == 'agent')
                                            <div class="col-md-2">
                                                <a href="{{url('agent/enquire/create')}}" class=" btn btn-info btn-gradient round  ">Add</a>
                                            </div>
                                        @endif
                                        
                                    </div>
                                </form>
                                <div class="card-datatable">
                                    <table class="datatables-ajax table table-responsive">
                                        <thead>
                                            <tr>
                                                <th>Sr.no</th>
                                                <th>Customer Name</th>
                                                <th>Mobile</th>
                                                <th>Email</th>
                                                <th>Status</th>
                                                @if (Auth::user()->type == 'admin')
                                                    <th>Agent</th>
                                                @endif
                                                <th>Created Date</th>
                                            </tr>
                                        </thead>
                                        <tbody id="myTable">
                                            @php  $i=1; @endphp
                                            @foreach($data as $key => $val)
                                            <tr>
                                                <th scope="row">{{ $i }}</th>
                                                @if (Auth::user()->type == 'admin')
                                                <td><a href="{{ route('admin.enquire.show',$val->id) }}"><strong>{{ $val->customer_name }}</strong></a></td>
                                                @else
                                                <td><a href="{{ route('agent.enquire.show',$val->id) }}"><strong>{{ $val->customer_name }}</strong></a></td>
                                                @endif
                                                
                                                <td>{{ $val->mobile }}</td>
                                                <td>{{ $val->email }}</td>
                                                <td>{{ $val->status }}</td>
                                                @if (Auth::user()->type == 'admin')
                                                    <td><strong>{{ $val->name }}</strong></td>
                                                @endif
                                                
                                                <td>{{ date('d-M-y H:i:s',strtotime($val->created_at)) }}</td>
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