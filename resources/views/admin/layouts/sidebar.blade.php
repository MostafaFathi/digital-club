<div class="sidebar sidebar-dark sidebar-main sidebar-fixed sidebar-expand-md">

    <!-- Sidebar mobile toggler -->
    <div class="sidebar-mobile-toggler text-center">
        <a href="#" class="sidebar-mobile-main-toggle">
            <i class="icon-arrow-left8"></i>
        </a>
        {{ config('app.name', 'Asir') }}
        <a href="#" class="sidebar-mobile-expand">
            <i class="icon-screen-full"></i>
            <i class="icon-screen-normal"></i>
        </a>
    </div>
    <!-- /sidebar mobile toggler -->


    <!-- Sidebar content -->
    <div class="sidebar-content">

        <!-- User menu -->
        <div class="sidebar-user">
            <div class="media-title font-weight-semibold text-center">
                <span style="color: #3ebdbe">Welcome </span>
                <label class="auth_user_name">{{auth()->user()->name}}</label>
                <img src="{{asset('portal/assets/images/hi.svg')}}">
            </div>
        </div>
        <!-- /user menu -->


        <!-- Main navigation -->
        <div class="card-sidebar-mobile">
            <ul class="nav nav-sidebar" data-nav-type="accordion">

                <!-- Main -->

                <li class="nav-item">
                    <router-link  class="nav-link " to="/admin/home">
                        <img src="{{asset('portal/assets/images/icon1.svg')}}">
                        <span>Home</span>
                    </router-link>
                </li>
                <li class="nav-item ">
                    <router-link  class="nav-link " to="/admin/events" >
                        <img src="{{asset('portal/assets/images/icon2.svg')}}">
                        <span>Events</span>
                    </router-link>
                </li>
                <li class="nav-item ">
                    <router-link  class="nav-link " to="/admin/members" >
                        <img src="{{asset('portal/assets/images/icon5.svg')}}">
                        <span>Members</span>
                    </router-link>
                </li>





            </ul>
        </div>
        <!-- /main navigation -->

    </div>
    <!-- /sidebar content -->

</div>
