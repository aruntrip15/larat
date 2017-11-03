<?php $__env->startSection('content'); ?>
    <div class="block-header">
        <h2><?php if(isset($setting->id)): ?> <?php echo app('translator')->getFromJson('title.updateSetting'); ?> <?php else: ?> <?php echo app('translator')->getFromJson('title.createSetting'); ?> <?php endif; ?></h2>
    </div>

    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="body">
                    <form method="post" action="<?php echo e(route('setting store')); ?>" class="form_validation" novalidate>
                        <?php echo csrf_field(); ?>

                        <!-- If Edit mode -->
                        <?php if(isset($setting->id)): ?>
                            <input type="hidden" name="id" value="<?php echo e($setting->id); ?>" />
                        <?php endif; ?>
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="name"><?php echo app('translator')->getFromJson('label.settingName'); ?></label>
                                <div class="form-group">
                                    <div class="form-line <?php echo e($errors->has('name') ? 'error focused' : ''); ?>"> 
                                        <input id="name" name="name" class="form-control" placeholder="<?php echo app('translator')->getFromJson('label.settingName'); ?>" type="text" minlength="3" required value="<?php echo e(isset($setting->setting_key) ? removeDblQuotes($setting->setting_key) : (old('name')?old('name'):'')); ?>" <?php echo e((env('APP_ENV') == 'production')?'readonly':''); ?>>
                                    </div>
                                    <div class="help-info">Min. 3 characters</div>
                                    <?php if($errors->has('name')): ?>
                                        <label id="name-error" class="error" for="name"><?php echo e($errors->first('name')); ?></label>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label for="value"><?php echo app('translator')->getFromJson('label.settingValue'); ?></label>
                                <div class="form-group">
                                    <div class="form-line <?php echo e($errors->has('value') ? 'error focused' : ''); ?>">
                                        <input id="value" name="value" class="form-control" placeholder="<?php echo app('translator')->getFromJson('label.settingValue'); ?>" type="text" required value="<?php echo e(isset($setting->setting_value) ? removeDblQuotes($setting->setting_value) : (old('value')?old('value'):'')); ?>">
                                    </div>
                                    <div class="help-info"><?php if(env('APP_ENV') != 'production'): ?> Please add same setting to config/customSettings.php as fallback setting,  <?php endif; ?> Min. 3 characters</div>
                                    <?php if($errors->has('value')): ?>
                                        <label id="value-error" class="error" for="value"><?php echo e($errors->first('value')); ?></label>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="row"  <?php echo e((env('APP_ENV') == 'production')? 'style=display:none':''); ?>>
                            <div class="col-sm-12">
                                <div class="form-group">
                                <label for="name"><?php echo app('translator')->getFromJson('label.settingFor'); ?></label>
                                <select name="settingFor" class="form-control show-tick">
                                    <?php if(isset($setting->id)): ?>
                                    <option value="prod" <?php echo e(($setting->setting_type == 'prod')?'selected="selected"':''); ?> >Production</option>
                                    <option value="dev" <?php echo e(($setting->setting_type == 'dev')?'selected="selected"':''); ?>>Development</option>
                                    <?php else: ?>
                                        <option value="prod">Production</option>
                                        <option value="dev">Development</option>
                                    <?php endif; ?>
                                    
                                </select>
                            </div>
                            </div>
                        </div>
                        <button type="submit" class="btn bg-<?php echo e(globalSetting('adminTheme')); ?> waves-effect"><?php if(isset($setting->id)): ?> <?php echo app('translator')->getFromJson('label.update'); ?>  <?php else: ?> <?php echo app('translator')->getFromJson('label.create'); ?> <?php endif; ?></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>