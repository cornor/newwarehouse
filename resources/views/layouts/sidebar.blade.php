<!-- Left side column. contains the sidebar -->
<style>
    .sidebar-menu .menutitle {
        font-weight: bold;
        font-size: 16px;
    }
</style>
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
                <a href="#" class="menutitle"><span>系统设置</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    {{--<li class="{{ active_class(if_route_pattern('permission.*')) }}"><a href="{{route('permission.index')}}">系统模块</a></li>--}}
                    {{--<li class="{{ active_class(if_route_pattern('role.*')) }}"><a href="{{route('role.index')}}">系统角色</a></li>--}}
                    <li class="{{ active_class(if_route_pattern('user.index')) }}"><a href="{{route('user.index')}}">用户管理</a></li>
                    <li class="{{ active_class(if_route_pattern('user.create')) }}"><a href="{{route('user.create')}}">用户添加</a></li>
                </ul>
            </li>
            <li  class="treeview {{ active_class(if_route_pattern(['category.*'])) }}">
                <a href="#" class="menutitle"><span>分类管理</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li class="{{ active_class(if_route_pattern('category.index')) }}"><a href="{{route('category.index')}}">类别列表</a></li>
                    <li class="{{ active_class(if_route_pattern('category.create')) }}"><a href="{{route('category.create')}}">类别添加</a></li>
                </ul>
            </li>
            <li  class="treeview {{ active_class(if_route_pattern(['storage.*'])) }}">
                <a href="#" class="menutitle"><span>物资状态</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li class="{{ active_class(if_route_pattern('storage.*')) }}"><a href="{{route('storage.index')}}">库存列表</a></li>
                </ul>
            </li>
            <li  class="treeview {{ active_class(if_route_pattern(['materialin.*'])) }}">
                <a href="#" class="menutitle"><span>物资入库</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li class="{{ active_class(if_route_pattern('materialin.create')) }}"><a href="{{route('materialin.create')}}">物资入库</a></li>
                    <li class="{{ active_class(if_route_pattern('materialin.index')) }}"><a href="{{route('materialin.index')}}">入库记录</a></li>
                </ul>
            </li>
            <li  class="treeview {{ active_class(if_route_pattern(['materialout.*'])) }}">
                <a href="#" class="menutitle"><span>物资出库</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li class="{{ active_class(if_route_pattern(['materialout.create','materialout.storage'])) }}"><a href="{{route('materialout.storage')}}">物资出库</a></li>
                    <li class="{{ active_class(if_route_pattern('materialout.index')) }}"><a href="{{route('materialout.index')}}">出库记录</a></li>
                </ul>
            </li>
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>