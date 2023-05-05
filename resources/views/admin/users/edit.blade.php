


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
                            <h2 class="content-header-title float-start mb-0">Users</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">user</a>
                                    </li>
                                    <li class="breadcrumb-item active"><a href="#">Update</a>
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
                                    <h4 class="card-title">Update</h4>
                                </div>
                                <div class="card-body">
                                    <form class="form" action="{{ route('admin.users.update',$user->id) }}" method="POST">
                                    {{ csrf_field() }}
                                    @method('PATCH')
                                    
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <div class="mb-1">
                                                <label class="form-label" for="first-name-column">Name</label>
                                                <input type="text" id="first-name-column" name="name" class="form-control" placeholder="User Name" value="{{ $user->name }}" />
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="mb-1">
                                                <label class="form-label"  for="last-name-column">Type</label>
                                                <select class="form-select" name="type" id="basicSelect">
                                                    <option value="customer"  {{ (isset($user->type) && $user->type == 'customer') ? 'selected' : '' }} >Customer</option>
                                                    <option value="dealer"  {{ (isset($user->type) && $user->type == 'dealer') ? 'selected' : '' }} >Dealer</option>
                                                    <option value="admin" {{ (isset($user->type) && $user->type == 'admin') ? 'selected' : '' }} >Admin</option>
                                                    <!-- <option>Thor Ragnarok</option> -->
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="mb-1">
                                                <label class="form-label"  for="last-name-column">Status</label>
                                                <select class="form-select" name="status" id="basicSelect">
                                                    <option value="Active"  {{ (isset($user->status) && $user->status == 'Active') ? 'selected' : '' }} >Active</option>
                                                    <option value="Inactive"  {{ (isset($user->status) && $user->status == 'Inactive') ? 'selected' : '' }} >Inactive</option>
                                                </select>
                                            </div>
                                        </div>


                                        <div class="col-md-6 col-12">
                                            <div class="mb-1">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Email</label>
                                                    <input type="email" id="first-name-column" name="email" class="form-control" placeholder="User Email" value="{{ $user->email }}" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12 col-12">
                                            <div class="mb-1">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Password</label>
                                                    <input type="password" id="first-name-column" name="password" class="form-control" placeholder="User Password" value="{{ old('password') }}" />
                                                </div>
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