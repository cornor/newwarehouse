<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">

                <img src="{{\Auth::user()->avatar}}" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p>{{\Auth::user()->name}}</p>
                <!-- Status -->

            </div>
        </div>



        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li  class="treeview {{ active_class(if_route_pattern(['permission.*','role.*','user.*'])) }}">
                <a href="#"><span>系统设置</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    {{--<li class="{{ active_class(if_route_pattern('permission.*')) }}"><a href="{{route('permission.index')}}">系统模块</a></li>--}}
                    {{--<li class="{{ active_class(if_route_pattern('role.*')) }}"><a href="{{route('role.index')}}">系统角色</a></li>--}}
                    <li class="{{ active_class(if_route_pattern('user.*')) }}"><a href="{{route('user.index')}}">用户管理</a></li>
                </ul>
            </li>
            <li  class="treeview {{ active_class(if_route_pattern(['category.*','materialin.*','materialout.*','storage.*'])) }}">
                <a href="#"><span>物料管理</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li class="{{ active_class(if_route_pattern('category.*')) }}"><a href="{{route('category.index')}}">类别管理</a></li>
                    <li class="{{ active_class(if_route_pattern('materialin.*')) }}"><a href="{{route('materialin.index')}}">物料入库</a></li>
                    <li class="{{ active_class(if_route_pattern('materialout.*')) }}"><a href="{{route('materialout.index')}}">物料出库</a></li>
                    <li class="{{ active_class(if_route_pattern('storage.*')) }}"><a href="{{route('storage.index')}}">库存列表</a></li>
                </ul>
            </li>
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>