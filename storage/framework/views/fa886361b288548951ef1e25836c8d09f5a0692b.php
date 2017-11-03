<?php $__env->startSection('content'); ?>
    <div class="block-header">
        <h2><?php echo app('translator')->getFromJson('title.dashboard'); ?></h2>
    </div>

    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <a class="info-box-4" href="<?php echo e(route('user list')); ?>">
                <div class="icon">
                    <i class="material-icons col-<?php echo e(globalSetting('adminTheme')); ?>">person</i>
                </div>
                <div class="content">
                    <div class="text col-<?php echo e(globalSetting('adminTheme')); ?>"><?php echo app('translator')->getFromJson('title.userManagement'); ?></div>
                    <div class="number col-<?php echo e(globalSetting('adminTheme')); ?>">123</div>
                </div>
            </a> 
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <a class="info-box-4" href="<?php echo e(route('role list')); ?>">
                <div class="icon">
                    <i class="material-icons col-<?php echo e(globalSetting('adminTheme')); ?>">group</i>
                </div>
                <div class="content">
                    <div class="text col-<?php echo e(globalSetting('adminTheme')); ?>"><?php echo app('translator')->getFromJson('title.roleManagement'); ?></div>
                    <div class="number col-<?php echo e(globalSetting('adminTheme')); ?>">123</div>
                </div>
            </a> 
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <a class="info-box-4" href="<?php echo e(route('permission list')); ?>">
                <div class="icon">
                    <i class="material-icons col-<?php echo e(globalSetting('adminTheme')); ?>">vpn_key</i>
                </div>
                <div class="content">
                    <div class="text col-<?php echo e(globalSetting('adminTheme')); ?>"><?php echo app('translator')->getFromJson('title.permissionManagement'); ?></div>
                    <div class="number col-<?php echo e(globalSetting('adminTheme')); ?>">123</div>
                </div>
            </a> 
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <a class="info-box-4" href="<?php echo e(route('setting list')); ?>">
                <div class="icon">
                    <i class="material-icons col-<?php echo e(globalSetting('adminTheme')); ?>">settings</i>
                </div>
                <div class="content">
                    <div class="text col-<?php echo e(globalSetting('adminTheme')); ?>"><?php echo app('translator')->getFromJson('title.globalSettingManagement'); ?></div>
                    <div class="number col-<?php echo e(globalSetting('adminTheme')); ?>">123</div>
                </div>
            </a> 
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>