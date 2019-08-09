<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        @guest
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('admin/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p>{{ Auth::user()->name }}</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        @end

        <!-- search form (Optional) -->
        @env('BACKEND_SIDEBAR_SEARCH'))
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
	                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
        </form>
        @end
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            @foreach ($menus as $route => $menu)
                @can($menu['can'])
                    @if($menu['type'] == 'header')
                    <li class="header">{{ $menu['text'] }}</li>
                    @else
                    <li class="@isset($menu['items']) treeview @else item @endif">
                        @if($menu['type'] == 'item')
                        <a href="{{ url(config('backend.route') . $route) }}"><i class="{{ $menu['icon'] }}"></i> <span>{{ $menu['text'] }}</span></a>
                        @else
                        <a href="#">
                            <i class="{{ $menu['icon'] }}"></i> 
                            <span>{{ $menu['text'] }}</span>
                            <span class="pull-right">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        @endif

                        @isset($menu['items'])
                        <ul class="treeview-menu menu-open">
                            @foreach ($menu['items'] as $url => $item)
                                @can($menu['can'])
                                <li><a href="{{ url(config('backend.route') . $url) }}"><i class="{{ $item['icon'] }}"></i> <span>{{ $item['text'] }}</span></a></li>
                                @end
                            @endforeach
                        </ul>
                        @endif
                    </li>
                    @endif
                @end
            @endforeach
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>

@push('scripts')
    <script type="text/javascript">
    /**
     * Check for sidebar active menu item
     * @file partials/sidebar
     */
    $(function () {
        var path = location.href;
        if (path === cedu.backend) {
            // Check for dashboard page
            $('.sidebar li.item:first').addClass('active');
        } else {
            // Check for other route page
            $('.sidebar li a').each(function(index, element) {
                // Check for backend route
                if (element.href === cedu.backend) {
                    return;
                }

                // Check current path contains route
                if (path.indexOf(element.href) === 0) {
                    $(element).parent().addClass('active');
                    $(element).parents('li.treeview').addClass('active');
                    $(element).parents('ul.treeview-menu').addClass('menu-open');
                    // Cancel loop, active only one item
                    return false;
                }
            });
        }
    });
    </script>
@endpush