<div class="navbar navbar-expand-md navbar-dark fixed-top">
	<div class="navbar-brand  text-center">
		<a href="/" class="d-inline-block">
            <img src="{{asset('portal/assets/images/logo-dig.png')}}" alt="">
		</a>
	</div>

	<div class="d-md-none">
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">
			<i class="icon-tree5"></i>
		</button>
		<button class="navbar-toggler sidebar-mobile-main-toggle" type="button">
			<i class="icon-paragraph-justify3"></i>
		</button>
	</div>

	<div class="collapse navbar-collapse" id="navbar-mobile">
		<ul class="navbar-nav d-none">
			<li class="nav-item">
				<a href="#" class="navbar-nav-link sidebar-control sidebar-main-toggle d-none d-md-block">
					<i class="icon-paragraph-justify3"></i>
				</a>
			</li>
		</ul>

		<ul class="navbar-nav ml-auto">




			<li class="nav-item dropdown dropdown-user">
				<a href="javascript:void(0)" class="navbar-nav-link d-flex align-items-center dropdown-toggle" data-toggle="dropdown">
					<span class="auth_user_name">{{auth()->user()->name}}</span>
					<!-- <img src="{{asset('portal/assets/images/img-users.svg')}}"> -->
				</a>

				<div class="dropdown-menu dropdown-menu-right">
                    <router-link   class="dropdown-item" to="/admin/profile">
                        <i class="icon-user-plus"></i> My profile
                    </router-link>
                     <div class="dropdown-divider"></div>
					<a href="{{ route('log_out') }}" class="dropdown-item"><i class="icon-switch2"></i> Logout</a>
				</div>
			</li>





		</ul>
	</div>
</div>
