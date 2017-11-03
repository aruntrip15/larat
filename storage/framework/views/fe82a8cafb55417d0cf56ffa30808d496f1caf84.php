<?php $__env->startSection('content'); ?>
    <div class="block-header">
        <h2><?php if(isset($user->id)): ?> <?php echo app('translator')->getFromJson('title.updateUser'); ?> <?php else: ?> <?php echo app('translator')->getFromJson('title.createUser'); ?> <?php endif; ?></h2>
    </div>

    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="body">
                    <form method="post" action="<?php echo e(route('user store')); ?>" class="form_validation" novalidate>
                        <?php echo csrf_field(); ?>

                        <!-- If Edit mode -->
                        <?php if(isset($user->id)): ?>
                            <input type="hidden" name="id" value="<?php echo e($user->id); ?>" />
                        <?php endif; ?>
                        <label for="name"><?php echo app('translator')->getFromJson('label.userName'); ?></label>
                        <div class="form-group">
                            <div class="form-line <?php echo e($errors->has('name') ? 'error focused' : ''); ?>">
                                <input id="name" name="name" class="form-control" placeholder="<?php echo app('translator')->getFromJson('label.userName'); ?>" type="text" minlength="4" required value="<?php echo e(isset($user->name) ? $user->name : (old('name')?old('name'):'')); ?>">
                            </div>
                            <div class="help-info">Min. 4 characters</div>
                            <?php if($errors->has('name')): ?>
                                <label id="name-error" class="error" for="name"><?php echo e($errors->first('name')); ?></label>
                            <?php endif; ?>
                        </div>
                        <label for="name"><?php echo app('translator')->getFromJson('label.userEmail'); ?></label>
                        <div class="form-group">
                            <div class="form-line <?php echo e($errors->has('email') ? 'error focused' : ''); ?>">
                                <input id="email" name="email" class="form-control" placeholder="<?php echo app('translator')->getFromJson('label.userEmail'); ?>" type="email" required value="<?php echo e(isset($user->email) ? $user->email : (old('email')?old('email'):'')); ?>">
                            </div>
                            <div class="help-info">Email address</div>
                            <?php if($errors->has('email')): ?>
                                <label id="email-error" class="error" for="email"><?php echo e($errors->first('email')); ?></label>
                            <?php endif; ?>
                        </div>
                        <label for="name"><?php echo app('translator')->getFromJson('label.userPwd'); ?></label>
                        <div class="form-group">
                            <div class="form-line <?php echo e($errors->has('password') ? 'error focused' : ''); ?>">
                                <input id="password" name="password" class="form-control" minlength="6" placeholder="<?php echo app('translator')->getFromJson('label.userPwd'); ?>" type="password"  value="" <?php echo e((!isset($user->id))? 'required' : ''); ?> >
                            </div>
                            <div class="help-info">Min.6 characters</div>
                            <?php if($errors->has('password')): ?>
                                <label id="password-error" class="error" for="password"><?php echo e($errors->first('password')); ?></label>
                            <?php endif; ?>
                        </div>
                        <label for="name"><?php echo app('translator')->getFromJson('label.userConfirmPwd'); ?></label>
                        <div class="form-group">
                            <div class="form-line <?php echo e($errors->has('confirmPassword') ? 'error focused' : ''); ?>">
                                <input id="password_confirmation" name="password_confirmation" equalTo="#password" class="form-control" minlength="6" placeholder="<?php echo app('translator')->getFromJson('label.userConfirmPwd'); ?>" type="password"  value="" <?php echo e((!isset($user->id))? 'required' : ''); ?>>
                            </div>
                            <div class="help-info">Min. 6 characters, Equal to Password</div>
                            <?php if($errors->has('confirmPassword')): ?>
                                <label id="password_confirmation-error" class="error" for="password_confirmation"><?php echo e($errors->first('password_confirmation')); ?></label>
                            <?php endif; ?>
                        </div>
                        <?php if(isset($roles)): ?>
                        <div class="form-group">
                            <label for="name"><?php echo app('translator')->getFromJson('label.assignRole'); ?></label>
                            <select name="role" class="form-control show-tick" data-live-search="true">
                                <option value=""><?php echo app('translator')->getFromJson('label.noneSelected'); ?></option>
                                <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <?php echo e($selected = ""); ?>

                                <?php if(isset($selectedRoles)): ?>
                                    <?php if(in_array($val->name, $selectedRoles)): ?>
                                        <?php echo e($selected = 'selected="selected"'); ?>

                                    <?php endif; ?>
                                <?php endif; ?>

                                <option value="<?php echo e($val->name); ?>" <?php echo e($selected); ?>><?php echo e($val->name); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <?php endif; ?>
                        <button type="submit" class="btn bg-<?php echo e(globalSetting('adminTheme')); ?> waves-effect"><?php if(isset($user->id)): ?> <?php echo app('translator')->getFromJson('label.update'); ?>  <?php else: ?> <?php echo app('translator')->getFromJson('label.create'); ?> <?php endif; ?></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>