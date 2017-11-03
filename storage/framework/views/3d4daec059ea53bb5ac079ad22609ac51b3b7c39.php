<?php $__env->startSection('content'); ?>
    <div class="block-header">
        <h2><?php if(isset($permission->id)): ?> <?php echo app('translator')->getFromJson('title.updatePermission'); ?> <?php else: ?> <?php echo app('translator')->getFromJson('title.createPermission'); ?> <?php endif; ?></h2>
    </div>

    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="body">
                    <form method="post" action="<?php echo e(route('permission store')); ?>" class="form_validation" novalidate>
                        <?php echo csrf_field(); ?>

                        <!-- If Edit mode -->
                        <?php if(isset($permission->id)): ?>
                            <input type="hidden" name="id" value="<?php echo e($permission->id); ?>" />
                        <?php endif; ?>
                        <label for="name"><?php echo app('translator')->getFromJson('label.permissionName'); ?></label>
                        <div class="form-group">
                            <div class="form-line <?php echo e($errors->has('name') ? 'error focused' : ''); ?>">
                                <input id="name" name="name" class="form-control" placeholder="<?php echo app('translator')->getFromJson('label.permissionName'); ?>" type="text" minlength="4" required value="<?php echo e(isset($permission->name) ? $permission->name : (old('name')?old('name'):'')); ?>">
                            </div>
                            <div class="help-info">Min. 4 characters</div>
                            <?php if($errors->has('name')): ?>
                                <label id="name-error" class="error" for="name"><?php echo e($errors->first('name')); ?></label>
                            <?php endif; ?>
                        </div>
                        <button type="submit" class="btn bg-<?php echo e(globalSetting('adminTheme')); ?> waves-effect"><?php if(isset($permission->id)): ?> <?php echo app('translator')->getFromJson('label.update'); ?>  <?php else: ?> <?php echo app('translator')->getFromJson('label.create'); ?> <?php endif; ?></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>