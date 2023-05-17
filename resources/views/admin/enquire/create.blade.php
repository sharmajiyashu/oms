


@extends('admin.layouts.app')

@section('content')
<style>
    h4{
        background: #488eca;
    color: white;
    padding: 1%;
    },
    
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
                            <h2 class="content-header-title float-start mb-0">Enquire</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ url('admin')}}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{ route('agent.enquire.index') }}">Enquire</a>
                                    </li>
                                    <li class="breadcrumb-item active"><a href="#">Add</a>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">

            @if ($errors->any())
                @foreach ($errors->all() as $error)
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <div class="alert-body">
                                            {{$error}}
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endforeach
            @endif

                <!-- Basic multiple Column Form section start -->
                <section id="multiple-column-form">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                
                                <div class="card-body">
                                    <form class="form" action="{{ route('agent.enquire.store') }}" method="POST">
                                    {{ csrf_field() }}
                                    
                                        

                                        <div class="row">

                                            <h4>Basic Details</h4>
                                            <div class="col-md-12 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Customer Name</label>
                                                    <input type="text" id="first-name-column" name="customer_name" class="form-control" placeholder="Customer Name" value="{{ old('customer_name') }}" />
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Email</label>
                                                    <input type="email" id="first-name-column" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}" />
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Mobile</label>
                                                    <input type="number" id="first-name-column" name="mobile" class="form-control" placeholder="Mobile" value="{{ old('mobile') }}" />
                                                </div>
                                            </div>

                                            <div class="col-md-12 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="exampleFormControlTextarea1">Comment</label>
                                                    <textarea class="form-control" name="comment" id="exampleFormControlTextarea1" rows="2" placeholder="Comment">{{ old('comment') }}</textarea>
                                                </div>
                                            </div>

                                            <h3 style="background: #48ca88;
                                            color: white;
                                            padding: 1%;">Follow Up Details</h3>

                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Next Follow-up Date </label>
                                                    <input type="date" id="first-name-column" name="follow_date" class="form-control" placeholder="" value="{{ old('follow_date') }}" />
                                                </div>
                                            </div>
                                            

                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label"  for="last-name-column">Status</label>
                                                    <select class="form-select" name="status" id="basicSelect">
                                                        <option value="Active">Active</option>
                                                        <option value="Inactive">Inactive</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-12 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="exampleFormControlTextarea1">Customer Note</label>
                                                    <textarea class="form-control" name="follow_comment" id="exampleFormControlTextarea1" rows="2" placeholder="Customer Note">{{ old('follow_comment') }}</textarea>
                                                </div>
                                            </div>
                                            
                                            
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary me-1">Submit</button>
                                                <button type="reset" class="btn btn-outline-secondary">Reset</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Basic Floating Label Form section end -->

            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection