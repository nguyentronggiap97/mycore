<!-- Main Header -->
<header class="main-header">
	<!-- Logo -->
	<a href="{{ route('admin.index') }}" class="logo">
		<!-- mini logo for sidebar mini 50x50 pixels -->
		<span class="logo-mini"><b>{{ env('BACKEND_SITENAME_SHORT') }}</b></span>
		<!-- logo for regular state and mobile devices -->
		<span class="logo-lg"><b>{{ env('BACKEND_SITENAME_MAIN') }}</b>
		 {{ env('BACKEND_SITENAME_EXTRA') }}</span>
	</a>

	<!-- Header Navbar -->
	<nav class="navbar navbar-static-top" role="navigation">
		<!-- Sidebar toggle button-->
		<a href="#" class="sidebar-toggle b-l" data-toggle="offcanvas" role="button">
			<span class="sr-only">Toggle navigation</span>
		</a>
        <ul class="nav navbar-nav hidden-xs">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-plus"></i>
                    <span>Create</span>
                </a>
                <ul class="dropdown-menu">
                    <li><a href=""><i class="fa fa-book"></i> Books</a></li>
                    <li class="divider"></li>
                    <li><a href="{{ route('users.create') }}#node-add-modal"><i class="fa fa-user-plus"></i> Users</a></li>
                </ul>
            </li>
            <li data-toggle="modal" data-target="#admin-modules">
                <a href="#"><i class="fa fa-th-large"></i></a>
            </li>
            <li>
                <form class="navbar-form navbar-left" role="search">
                    <div class="form-group">
                        <input type="text" class="form-control" id="navbar-search-input" placeholder="Search">
                    </div>
                </form>
            </li>
        </ul>
		@include('backend::partials.navbar')
	</nav>
</header>

@push('scripts')
<script data-exec-on-popstate>
    $('#admin-modules a').click(function() {
        $('.modal').modal('hide');
    });
</script>
@endpush

@push('assets')
<div class="modal fade" id="admin-modules">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Dashboard</h4>
            </div>
            <div class="modal-body">
                <a class="btn btn-app" href="{{ route('users.index') }}">
                    <i class="fa fa-users"></i> Users
                </a>
            </div>
        </div>
    </div>
</div>
@endpush