<style>
    .main-menu .navbar-header .navbar-brand .brand-logo img {
    max-width: 100%;
}
.main-menu .navbar-header {
    height: 100%;
    width: 260px;
    height: 7.45rem;
    position: relative;
    padding: 0.35rem 1rem 0.3rem 1.64rem;
    transition: 300ms ease all, background 0s;
}
</style>

@if (Auth::user()->type == 'agent')
    <style>
        .semi-dark-layout .main-menu-content .navigation-main .nav-item .menu-content li:not(.active) a {
            background-color: rgb(14 66 134);
        }
        .semi-dark-layout .main-menu-content .navigation-main .nav-item .menu-content {
            background-color:rgb(14 66 134);
        }
    </style>
@endif
<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true"
    @if (Auth::user()->type == 'agent')
        style="background: rgb(14 66 134);"
    @endif
        >
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row" >
                <li class="nav-item me-auto"><a class="navbar-brand" href="{{url('/')}}">
                    
                <span class="brand-logo" style="">
                            <img src="{{asset('public/bidnanza_logo.png')}}" alt="" style="width: 175px;">
                    </span>
                         {{-- <h2 class="brand-text" style="color:#29a6ca">Admin</h2> --}}
                    </a></li>
                <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse"><i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i></a></li>
            </ul>
        </div>
        <div class="shadow-bottom"></div>
        <div class="main-menu-content">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation" 
                @if (Auth::user()->type == 'agent')
                    style="background: rgb(14 66 134);"
                @endif
            >

                <li class=" nav-item"><a class="d-flex align-items-center" href="{{url('admin')}}"><i data-feather="home"></i><span class="menu-title text-truncate" data-i18n="Dashboards">Dashboards</span><span class="badge badge-light-warning rounded-pill ms-auto me-1"></span></a>
                    
                </li>

                @if (Auth::user()->type == 'admin')
                    <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="shopping-bag"></i><span class="menu-title text-truncate" data-i18n="eCommerce">Agent</span></a>
                        <ul class="menu-content">
                            <li><a class="d-flex align-items-center" href="{{ route('admin.agent.index')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop"> List</span></a>
                            </li>
                            <li><a class="d-flex align-items-center" href="{{ route('admin.agent.create')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Details">Add</span></a>
                            </li>
                            <!-- <li><a class="d-flex align-items-center" href="app-ecommerce-wishlist.html"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Wish List">Category</span></a>
                            </li> -->
                        </ul>
                    </li>

                    <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="shopping-bag"></i><span class="menu-title text-truncate" data-i18n="eCommerce">Orders</span></a>
                        <ul class="menu-content">
                            <li><a class="d-flex align-items-center" href="{{ route('admin.orders.index')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop"> List</span></a>
                            </li>
                            <li><a class="d-flex align-items-center" href="{{ route('admin.orders.create')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Details">Add</span></a>
                            </li>
                        </ul>
                    </li>

                    <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="shopping-bag"></i><span class="menu-title text-truncate" data-i18n="eCommerce">Follow Up master</span></a>
                        <ul class="menu-content">
                            <li><a class="d-flex align-items-center" href="{{ route('admin.follow-up-master.index')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop"> List</span></a>
                            </li>
                            <li><a class="d-flex align-items-center" href="{{ route('admin.follow-up-master.create')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Details">Add</span></a>
                            </li>
                        </ul>
                    </li>


                @endif

                @if (Auth::user()->type == 'agent')

                    <li class=" nav-item"><a class="d-flex align-items-center" href="#"><i data-feather="shopping-bag"></i><span class="menu-title text-truncate" data-i18n="eCommerce">Orders</span></a>
                        <ul class="menu-content">
                            <li><a class="d-flex align-items-center" href="{{ route('agent.orders.index')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Shop"> List</span></a>
                            </li>
                            <li><a class="d-flex align-items-center" href="{{ route('agent.orders.create')}}"><i data-feather="circle"></i><span class="menu-item text-truncate" data-i18n="Details">Add</span></a>
                            </li>
                        </ul>
                    </li>
                    @php
                        $count = DB::table('follow_ups')->where('user_id',Auth::user()->id)->where('date',date('Y-m-d'))->where('status','unseen')->count();
                    @endphp

                    <li class=" nav-item"><a class="d-flex align-items-center" href="{{ route('agent.follow-up.index')}}"><i data-feather="home"></i><span class="menu-title text-truncate" data-i18n="Dashboards">Follow Up</span><span class="badge badge-light-warning rounded-pill ms-auto me-1">{{ $count }}</span></a>
                    
                    </li>
                    
                @endif


                


                

                

                

                

            </ul>
        </div>
    </div>