<?php $__env->startSection('content'); ?>
    <div class="block-header">
        <h2><?php if(isset($role->id)): ?> <?php echo app('translator')->getFromJson('title.updateRole'); ?> <?php else: ?> <?php echo app('translator')->getFromJson('title.createRole'); ?> <?php endif; ?></h2>
    </div>

    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="body">
                    <form method="post" action="<?php echo e(route('role store')); ?>" class="form_validation" novalidate>
                        <?php echo csrf_field(); ?>

                        <!-- If Edit mode -->
                        <?php if(isset($role->id)): ?>
                            <input type="hidden" name="id" value="<?php echo e($role->id); ?>" />
                        <?php endif; ?>
                        <label for="name"><?php echo app('translator')->getFromJson('label.roleName'); ?></label>
                        <div class="form-group">
                            <div class="form-line <?php echo e($errors->has('name') ? 'error focused' : ''); ?>">
                                <input id="name" name="name" class="form-control" placeholder="<?php echo app('translator')->getFromJson('label.roleName'); ?>" type="text" minlength="4" required value="<?php echo e(isset($role->name) ? $role->name : (old('name')?old('name'):'')); ?>">
                            </div>
                            <div class="help-info">Min. 4 characters</div>
                            <?php if($errors->has('name')): ?>
                                <label id="name-error" class="error" for="name"><?php echo e($errors->first('name')); ?></label>
                            <?php endif; ?>
                        </div>
                        <?php if(isset($permissions)): ?>
                        <div class="form-group">
                            <label for="name"><?php echo app('translator')->getFromJson('label.assignPermission'); ?></label>
                            <select name="permissions[]" class="form-control show-tick" multiple data-live-search="true">
                                <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <?php echo e($selected = ""); ?>

                                <?php if(isset($selectedPermissions)): ?>
                                    <?php if(in_array($val->name, $selectedPermissions)): ?>
                                        <?php echo e($selected = 'selected="selected"'); ?>

                                    <?php endif; ?>
                                <?php endif; ?>

                                <option value="<?php echo e($val->name); ?>" <?php echo e($selected); ?>><?php echo e($val->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <?php endif; ?>
                        <button type="submit" class="btn bg-<?php echo e(globalSetting('adminTheme')); ?> waves-effect"><?php if(isset($role->id)): ?> <?php echo app('translator')->getFromJson('label.update'); ?>  <?php else: ?> <?php echo app('translator')->getFromJson('label.create'); ?> <?php endif; ?></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>