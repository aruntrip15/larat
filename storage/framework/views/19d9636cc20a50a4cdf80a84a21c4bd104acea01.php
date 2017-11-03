<section>
<!-- Left Sidebar -->
<aside id="leftsidebar" class="sidebar">
    <!-- User Info -->
    <div class="user-info clearfix">
        <!-- <?php if(Auth::user()->image): ?> -->
        <!-- <?php endif; ?> -->
        <div class="image">
            <img src="<?php echo e(asset('images/user2.jpg')); ?>" width="48" height="48" alt="User" />
        </div>
       
        <div class="info-container">
            <div class="name col-<?php echo e(globalSetting('adminTheme')); ?> font-bold" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo e(Auth::user()->name); ?></div>
            <div class="email col-<?php echo e(globalSetting('adminTheme')); ?>"><?php echo e(Auth::user()->email); ?></div>
            <div class="btn-group user-helper-dropdown">
                <i class="material-icons col-<?php echo e(globalSetting('adminTheme')); ?>" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                <ul class="dropdown-menu pull-right">
                    <li><a href="javascript:void(0);"><i class="material-icons">person</i>Profile</a></li>
                    <li role="seperator" class="divider"></li>
                    <li>
                        <a href="<?php echo e(route('logout')); ?>"
                            onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                            <i class="material-icons">exit_to_app</i>Sign Out
                        </a>
                        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                            <?php echo e(csrf_field()); ?>

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
            <li class="<?php echo e((Route::currentRouteName() == 'admin dashboard')? 'active' : ''); ?>">
                <a href="<?php echo e(route('admin dashboard')); ?>">
                    <i class="material-icons">dashboard</i>
                    <span>Dashboard</span>
                </a>
            </li>
            
            <li>
                <a href="javascript:void(0);" class="menu-toggle <?php echo e((Route::currentRouteName() == 'user list' ||  Route::currentRouteName() == 'user add' )? 'toggled' : ''); ?>">
                    <i class="material-icons">person</i>
                    <span>User</span>
                </a>
                <ul class="ml-menu">
                    <li class="<?php echo e((Route::currentRouteName()== 'user list')? 'active' : ''); ?>">
                        <a href="<?php echo e(route('user list')); ?>">
                            <span>List Users</span>
                        </a>
                    </li>
                    <li class="<?php echo e((Route::currentRouteName()== 'user add')? 'active' : ''); ?>">
                        <a href="<?php echo e(route('user add')); ?>">
                            <span>Add User</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:void(0);" class="menu-toggle <?php echo e((Route::currentRouteName() == 'role list' ||  Route::currentRouteName() == 'role add')? 'toggled' : ''); ?> ">
                    <i class="material-icons">group</i>
                    <span>Role</span>
                </a>
                <ul class="ml-menu">
                    <li class="<?php echo e((Route::currentRouteName()== 'role list')? 'active' : ''); ?>">
                        <a href="<?php echo e(route('role list')); ?>">
                            <span>List Roles</span>
                        </a>
                    </li>
                    <li class="<?php echo e((Route::currentRouteName()== 'role add')? 'active' : ''); ?>">
                        <a href="<?php echo e(route('role add')); ?>">
                            <span>Add Role</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:void(0);" class="menu-toggle <?php echo e((Route::currentRouteName() == 'permission list' ||  Route::currentRouteName() == 'permission add')? 'toggled' : ''); ?>">
                    <i class="material-icons">vpn_key</i>
                    <span>Permission</span>
                </a>
                <ul class="ml-menu">
                    <li class="<?php echo e((Route::currentRouteName()== 'permission list')? 'active' : ''); ?>">
                        <a href="<?php echo e(route('permission list')); ?>">
                            <span>List Permissions</span>
                        </a>
                    </li>
                    <li class="<?php echo e((Route::currentRouteName()== 'permission add')? 'active' : ''); ?>">
                        <a href="<?php echo e(route('permission add')); ?>">
                            <span>Add Permission</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript:void(0);" class="menu-toggle <?php echo e((Route::currentRouteName() == 'setting list' ||  Route::currentRouteName() == 'setting add')? 'toggled' : ''); ?>">
                    <i class="material-icons">settings</i>
                    <span>Settings</span>
                </a>
                <ul class="ml-menu">
                    <li class="<?php echo e((Route::currentRouteName()== 'setting list')? 'active' : ''); ?>">
                        <a href="<?php echo e(route('setting list')); ?>">
                            <span>List Settings</span>
                        </a>
                    </li>
                    <li class="<?php echo e((Route::currentRouteName()== 'setting add')? 'active' : ''); ?>">
                        <a href="<?php echo e(route('setting add')); ?>">
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