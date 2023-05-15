


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
                            <h2 class="content-header-title float-start mb-0">Order</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="{{ route('admin.orders.index') }}">Orders</a>
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
                                {{-- <div class="card-header">
                                    <h4 class="card-title"> Add</h4>
                                </div> --}}
                                <div class="card-body">
                                    <form class="form" action="{{ route('admin.orders.store') }}" method="POST">
                                    {{ csrf_field() }}
                                    
                                        <div class="row">
                                            <h4>Basic Details</h4>

                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Customer Name</label>
                                                    <input type="text" id="first-name-column" name="customer_name" class="form-control" placeholder="Customer Name" value="{{ old('customer_name') }}" />
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label"  for="last-name-column">Company</label>
                                                    <select class="form-select" name="company" id="basicSelect">
                                                        @foreach (config('constant.company') as $item)
                                                            <option value="{{ $item }}">{{ $item }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div id="append_product" class="col-md-12">

                                                <div class="row">   
                                                    <div class="col-md-6 col-12">
                                                        <div class="mb-1">
                                                            <label class="form-label"  for="last-name-column">Product</label>
                                                            <select class="form-select" name="product[]" id="basicSelect">
                                                                @foreach (config('constant.products') as $item)
                                                                    <option value="{{ $item }}">{{ $item }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
        
                                                    <div class="col-md-6 col-12">
                                                        <div class="mb-1">
                                                            <label class="form-label" for="first-name-column">Quantity</label>
                                                            <input type="number" id="first-name-column" name="quantity[]" class="form-control" placeholder="Customer Name" value="{{ old('customer_name') }}" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div>
                                                <div class="mb-1">
                                                    <a href="#" class="" onclick="Append_product()">Add More Product</a>
                                                </div>    
                                            </div>


                                            <script>
                                                function Append_product(){
                                                    var div = document.getElementById('append_product');
                                                    div.innerHTML += `<div class="row">   
                                                        <div class="col-md-6 col-12">
                                                            <div class="mb-1">
                                                                <label class="form-label"  for="last-name-column">Product</label>
                                                                <select class="form-select" name="product[]" id="basicSelect">
                                                                    @foreach (config('constant.products') as $item)
                                                                        <option value="{{ $item }}">{{ $item }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
            
                                                        <div class="col-md-6 col-12">
                                                            <div class="mb-1">
                                                                <label class="form-label" for="first-name-column">Quantity</label>
                                                                <input type="number" id="first-name-column" name="quantity[]" class="form-control" placeholder="Customer Name" value="{{ old('customer_name') }}" />
                                                            </div>
                                                        </div>
                                                    </div>`;
                                                }
                                            </script>
                                            
                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="exampleFormControlTextarea1">Amount</label>
                                                    <input type="number" id="first-name-column" name="amount" class="form-control" placeholder="Amount" value="{{ old('amount') }}" />
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label"  for="last-name-column">   Delivery Method</label>
                                                    <select class="form-select" name="delivery_method" id="basicSelect">
                                                        <option value="Express">Express</option>
                                                        <option value="Normal">Normal</option>
                                                    </select>
                                                </div>
                                            </div>


                                            <h4 class="card-title">Shipping Details </h4>
                                            

                                            <div class="col-md-12 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="exampleFormControlTextarea1">Address</label>
                                                    <textarea class="form-control" name="sh_address" id="sh_address" rows="3" placeholder="Address">{{ old('sh_address') }}</textarea>
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label"  for="last-name-column">City</label>
                                                    <select class="form-select" id="sh_city" name="sh_city" >
                                                        @foreach ($cities as $item)
                                                            <option value="{{ $item->name }}">{{ $item->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label"  for="last-name-column">State</label>
                                                    <select class="form-select" id="sh_state" name="sh_state" >
                                                        @foreach ($states as $item)
                                                            <option value="{{ $item->name }}">{{ $item->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-4 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Zip Code</label>
                                                    <input type="text" id="sh_zip_code" name="sh_zip_code" class="form-control" placeholder="Zip Code" value="{{ old('sh_zip_code') }}" />
                                                </div>
                                            </div>

                                            
                                            <h4 class="card-title">Billing Address &nbsp;&nbsp; <input type="checkbox" id="same_as" name="vehicle1" value="Bike" onclick="same_As()" > <span style="font-size: 13px;">same as shipping </span></h4>

                                            <script>
                                                var same_as = 0;
                                                function same_As(){

                                                    if(same_as == 0){
                                                        same_as = 1;
                                                        let sh_city = document.getElementById('sh_city').value;
                                                        document.getElementById('bl_city').value = sh_city;

                                                        let sh_state = document.getElementById('sh_state').value;
                                                        document.getElementById('bl_state').value = sh_state;

                                                        let sh_zip_code = document.getElementById('sh_zip_code').value;
                                                        document.getElementById('bl_zip_code').value = sh_zip_code;

                                                        let sh_address = document.getElementById('sh_address').value;
                                                        document.getElementById('bl_address').value = sh_address;



                                                    }else{
                                                        same_as = 0;
                                                        document.getElementById('bl_city').value = '';
                                                        document.getElementById('bl_state').value = '';
                                                        document.getElementById('bl_zip_code').value = '';
                                                        document.getElementById('bl_address').value = '';
                                                    }   

                                                }
                                            </script>
                                            

                                            <div class="col-md-12 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="exampleFormControlTextarea1">Address</label>
                                                    <textarea class="form-control" name="bl_address" id="bl_address" rows="3" placeholder="Address">{{ old('bl_address') }}</textarea>
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label"  for="last-name-column">City</label>
                                                    <select class="form-select" id="bl_city" name="bl_city" >
                                                        @foreach ($cities as $item)
                                                            <option value="{{ $item->name }}">{{ $item->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label"  for="last-name-column">State</label>
                                                    <select class="form-select" name="bl_state" id="bl_state">
                                                        @foreach ($states as $item)
                                                            <option value="{{ $item->name }}">{{ $item->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-4 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Zip Code</label>
                                                    <input type="text" id="bl_zip_code" name="bl_zip_code" class="form-control" placeholder="Zip Code" value="{{ old('bl_zip_code') }}" />
                                                </div>
                                            </div>

                                            <h4 class="card-title">   Contact info </h4>
                                            

                                            <div class="col-md-4 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Mobile</label>
                                                    <input type="text" id="first-name-column" name="mobile" class="form-control" placeholder="Mobile" value="{{ old('mobile') }}" />
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-4 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Cellphone</label>
                                                    <input type="text" id="first-name-column" name="cellphone" class="form-control" placeholder="Cellphone" value="{{ old('cellphone') }}" />
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Email address</label>
                                                    <input type="text" id="first-name-column" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}" />
                                                </div>
                                            </div>

                                            <h4> Payment Detail</h4>
                                            

                                            <div class="col-md-12 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Card Number</label>
                                                    <input type="text" id="first-name-column" name="card_number" class="form-control" placeholder="Card Number" value="{{ old('card_number') }}" />
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Exp</label>
                                                    <input type="date" id="first-name-column" name="card_exp" class="form-control" placeholder="Card Exp" value="{{ old('card_exp') }}" />
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="first-name-column">Cvv</label>
                                                    <input type="number" id="first-name-column" name="card_cvv" class="form-control" placeholder="CVV" value="{{ old('card_cvv') }}" />
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
                                                <input type="date" id="first-name-column" name="next_follow_date" class="form-control" placeholder="" value="{{ old('next_follow_date') }}" />
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-12">
                                            <div class="mb-1">
                                                <label class="form-label" for="first-name-column">Customer Notes</label>
                                                <input type="text" id="first-name-column" name="next_follow_comment" class="form-control" placeholder="Customer Note" value="{{ old('next_follow_comment') }}" />
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