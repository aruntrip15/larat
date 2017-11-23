<section>
<!-- Left Sidebar -->
<aside id="leftsidebar" class="sidebar">
    <!-- User Info -->
    <div class="user-info clearfix">
        <!-- @if (Auth::user()->image) -->
        <!-- @endif -->
        <div class="image">
            <img src="{{ asset('storage/avatars/' . Auth::user()->avatar) }}" width="48" height="48" alt="User" />
        </div>
       
        <div class="info-container">
            <div class="name col-{{globalSetting('adminTheme')}} font-bold" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }}</div>
            <div class="email col-{{globalSetting('adminTheme')}}">{{ Auth::user()->email }}</div>
            <div class="btn-group user-helper-dropdown">
                <i class="material-icons col-{{globalSetting('adminTheme')}}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                <ul class="dropdown-menu pull-right">
                    <li><a href="{{ route('user add',['id' => Auth::user()->id ]) }}"><i class="material-icons">person</i>Profile</a></li>
                    <li><a href="{{ route('user password',['id' => Auth::user()->id ]) }}"><i class="material-icons">vpn_key</i>Change Password</a></li>
                    <li role="seperator" class="divider"></li>
                    <li>
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                            <i class="material-icons">exit_to_app</i>Sign Out
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- #User Info -->
    <!-- Menu -->
    <div class="menu">
        <ul class="list">
            <li class="header">MAIN NAVIGATION</li>
            <li class="{{(Route::currentRouteName() == 'admin dashboard')? 'active' : ''}}">
                <a href="{{ route('admin dashboard') }}">
                    <i class="material-icons">dashboard</i>
                    <span>Dashboard</span>
                </a>
            </li>
            
            <li>
                <a href="javascript:void(0);" class="menu-toggle {{(Route::currentRouteName() == 'user list' ||  Route::currentRouteName() == 'user add' || Route::currentRouteName() == 'user password' || Route::currentRouteName() == 'user send email')? 'toggled' : '' }}">
                    <i class="material-icons">person</i>
                    <span>User</span>
                </a>
                <ul class="ml-menu">
                    <li class="{{(Route::currentRouteName()== 'user list' || Route::currentRouteName() == 'user send email')? 'active' : ''}}">
                        <a href="{{ route('user list') }}">
                            <span>List Users</span>
                        </a>
                    </li>
                    <li class="{{(Route::currentRouteName() == 'user add' || Route::currentRouteName() == 'user password')? 'active' : ''}}">
                        <a href="{{ route('user add') }}">
                            <span>Add User</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:void(0);" class="menu-toggle {{(Route::currentRouteName() == 'role list' ||  Route::currentRouteName() == 'role add')? 'toggled' : '' }} ">
                    <i class="material-icons">group</i>
                    <span>Role</span>
                </a>
                <ul class="ml-menu">
                    <li class="{{(Route::currentRouteName()== 'role list')? 'active' : ''}}">
                        <a href="{{ route('role list') }}">
                            <span>List Roles</span>
                        </a>
                    </li>
                    <li class="{{(Route::currentRouteName()== 'role add')? 'active' : ''}}">
                        <a href="{{ route('role add') }}">
                            <span>Add Role</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:void(0);" class="menu-toggle {{(Route::currentRouteName() == 'permission list' ||  Route::currentRouteName() == 'permission add')? 'toggled' : '' }}">
                    <i class="material-icons">vpn_key</i>
                    <span>Permission</span>
                </a>
                <ul class="ml-menu">
                    <li class="{{(Route::currentRouteName()== 'permission list')? 'active' : ''}}">
                        <a href="{{ route('permission list') }}">
                            <span>List Permissions</span>
                        </a>
                    </li>
                    <li class="{{(Route::currentRouteName()== 'permission add')? 'active' : ''}}">
                        <a href="{{ route('permission add') }}">
                            <span>Add Permission</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:void(0);" class="menu-toggle {{(Route::currentRouteName() == 'setting list' ||  Route::currentRouteName() == 'setting add')? 'toggled' : '' }}">
                    <i class="material-icons">settings</i>
                    <span>Settings</span>
                </a>
                <ul class="ml-menu">
                    <li class="{{(Route::currentRouteName()== 'setting list')? 'active' : ''}}">
                        <a href="{{ route('setting list') }}">
                            <span>List Settings</span>
                        </a>
                    </li>
                    <li class="{{(Route::currentRouteName()== 'setting add')? 'active' : ''}}">
                        <a href="{{ route('setting add') }}">
                            <span>Add Setting</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
    <!-- #Menu -->
    <!-- Footer -->
    <!-- <div class="legal">
        <div class="copyright">
            &copy; 2016 - 2017 <a href="javascript:void(0);">AdminBSB - Material Design</a>.
        </div>
        <div class="version">
            <b>Version: </b> 1.0.5
        </div>
    </div> -->
    <!-- #Footer -->
</aside>
<!-- #END# Left Sidebar -->
</section>