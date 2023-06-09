
@extends('admin.layouts.app')

@section('content')
<style>
    .active_date{
        color: red;
    }
</style>
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h2 class="content-header-title float-start mb-0">Follow Up</h2>
                        <div class="breadcrumb-wrapper">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url('admin/')}}">Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.follow-up-master.index') }}">Follow-Up</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.follow-up-master.index') }}">Detail</a>
                                </li>
                                <li class="breadcrumb-item active">{{ $orders->order_id }}
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="content-body">
            
            <div class="card">
                <div class="card-header ">
                    <h2>{{ $orders->order_id }}</h2>
                </div>
                <div class="card-body">
                    <div class="row card">
                        <div class="col-md-6">
                            <strong>Customer name </strong> : {{ $orders->customer_name }}
                        </div>
                        <div class="col-md-6">
                            <strong>Email </strong> : {{ $orders->email }}
                        </div>
                        <div class="col-md-6">
                            <strong>Mobile </strong> : {{ $orders->mobile }}
                        </div>
                        <div class="col-md-6">
                            <strong>Current Status </strong> : {{ $orders->follow_up_type }}
                        </div>
                    </div>
                    
                    <div style="border: solid 2px #d6cece;">
                        @foreach ($data as $item)
                            <div class=" border-top" style="padding: 11px;">
                                
                                <div class="row">
                                    
                                    <div class="col-md-1 @php if($item->date == date('Y-m-d')){ echo 'active_date'; } @endphp" > <span><strong>{{ date('d-m-y',strtotime($item->date)) }}</strong></span></div>
                                    <div class="col-md-11"> <span>{{ $item->note }}</span></div>
                                </div>
                                
                                
                            </div>
                            
                        @endforeach
                    </div>

                    <div style="text-align: end;">
                        <button type="button" class="btn btn-relief-dark" data-bs-toggle="modal" data-bs-target="#primary" style="border: coral;">
                            Update Follow Up
                        </button>
                        <div class="modal fade text-start modal-dark" id="primary" tabindex="-1" aria-labelledby="myModalLabel160" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="myModalLabel160">{{ $orders->order_id }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        @if (Auth::user()->type == 'admin')
                                            <form action="{{ route('admin.follow-up.add-more') }}" method="post">
                                        @else
                                            <form action="{{ route('agent.follow-up.add-more') }}" method="post">
                                        @endif
                                        
                                            @csrf
                                            <input type="hidden" name="order_id" value="{{ $orders->id }}">
                                            <div class="modal-body">
                                                
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-1">
                                                            <label class="form-label" for="first-name-column"> Date </label>
                                                            <input type="date" id="first-name-column" name="date" class="form-control" placeholder="" value="{{ old('next_follow_date') }}" />
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="mb-1">
                                                            <label class="form-label"  for="last-name-column">Status</label>
                                                            <select class="form-select" name="status" id="basicSelect">
                                                                <option value="New"  {{ (isset($orders->follow_up_type) && $orders->follow_up_type == 'New') ? 'selected' : '' }}>New</option>
                                                                @foreach ($follow_master as $values)
                                                                    <option value="{{ $values->title }}" {{ (isset($orders->follow_up_type) && $orders->follow_up_type == $values->title) ? 'selected' : '' }}>{{ $values->title }}</option>
                                                                @endforeach
                                                                
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="mb-1">
                                                            <label class="form-label" for="first-name-column">Customer Notes</label>
                                                            <textarea class="form-control" name="comment" id="exampleFormControlTextarea1" rows="2" placeholder="Comment">{{ old('comment') }}</textarea>
                                                        </div>
                                                    </div>

                                                </div>
                                                

                                                
                                                
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-dark" data-bs-dismiss="modal">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                
                            </div>
                        </div>
                    </div>
                    
                </div>
                
            </div>

            

        </div>
    </div>
</div>

@endsection