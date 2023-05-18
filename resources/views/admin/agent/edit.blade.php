


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
                            <h2 class="content-header-title float-start mb-0">Agent </h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{ route('admin.agent.index') }}">Agents</a>
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
                                <div class="card-header">
                                    <h4 class="card-title">make Add</h4>
                                </div>
                                <div class="card-body">
                                    <form class="form" action="{{ route('admin.agent.update',$agent->id) }}" method="POST">
                                    {{ csrf_field() }}
                                    @method('PATCH')
                                    
                                    <div class="row">

                                        <div class="col-md-6 col-12">
                                            <div class="mb-1">
                                                <label class="form-label" for="first-name-column">First Name</label>
                                                <input type="text" id="first-name-column" name="firstname" class="form-control" placeholder="First Name" value="{{ $agent->firstname }}" />
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="mb-1">
                                                <label class="form-label" for="first-name-column">Last Name</label>
                                                <input type="text" id="first-name-column" name="lastname" class="form-control" placeholder="Last Name" value="{{ $agent->lastname }}" />
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="mb-1">
                                                <label class="form-label" for="first-name-column">Mobile</label>
                                                <input type="number" id="first-name-column" name="mobile" class="form-control" placeholder="Mobile" value="{{ $agent->mobile }}" />
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="mb-1">
                                                <label class="form-label" for="first-name-column">Email</label>
                                                <input type="email" id="first-name-column" name="email" class="form-control" placeholder="Email" value="{{ $agent->email }}" />
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="mb-1">
                                                <label class="form-label"  for="last-name-column">Status</label>
                                                <select class="form-select" name="status" id="basicSelect">
                                                    <option value="Active">Active</option>
                                                    <option value="Inactive">InActive</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="mb-1">
                                                <div class="d-flex justify-content-between">
                                                    <label class="form-label" for="login-password">Password</label>
                                                </div>
                                                <div class="input-group input-group-merge form-password-toggle">
                                                    <input type="password" class="form-control form-control-merge" id="password" name="password" tabindex="2" placeholder="" aria-describedby="login-password" value="{{ old('password') }}" />
                                                    <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-md-12 col-12">
                                            <div class="mb-1">
                                                <label class="form-label" for="exampleFormControlTextarea1">Address</label>
                                                <textarea class="form-control" name="address" id="exampleFormControlTextarea1" rows="3" placeholder="Address">{{ $agent->address }}</textarea>
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