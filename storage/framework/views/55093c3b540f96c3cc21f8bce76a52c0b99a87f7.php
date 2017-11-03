<?php $__env->startSection('content'); ?>
    <div class="block-header">
        <h2><?php echo app('translator')->getFromJson('title.setting'); ?> 
        <?php if(env('APP_ENV') != 'production'): ?> <a type="button"  href="<?php echo e(route('setting add')); ?>" class="m-l-15 btn bg-<?php echo e(globalSetting('adminTheme')); ?> waves-effect"><i class="material-icons">add</i></a> <?php endif; ?>
        </h2>
    </div>

    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="body form-card">
                <form method="GET" id="listSearchForm">
                        <input type="hidden" name="orderBy" id="orderBy" value="<?php echo e($searchFormData['orderBy']); ?>" />
                        <input type="hidden" name="orderName" id="orderName" value="<?php echo e($searchFormData['orderName']); ?>" />
                        <div class="row clearfix">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="form-line">
                                        <input class="form-control" placeholder="<?php echo app('translator')->getFromJson('label.settingName'); ?>" type="text" name="name" value="<?php echo e($searchFormData['name']); ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 button-demo">
                                <button type="submit" class="btn bg-<?php echo e(globalSetting('adminTheme')); ?> waves-effect"><?php echo app('translator')->getFromJson('label.search'); ?></button>
                                <a href="<?php echo e(route('setting list')); ?>" type="button" class="btn btn-default waves-effect"><?php echo app('translator')->getFromJson('label.reset'); ?></a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="body table-responsive">
                    <?php if($settings->count()): ?>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>
                                        <a class="listSortRecordLink" data-orderName="setting_key"  <?php if($searchFormData['orderName'] == 'setting_key'): ?> data-orderBy="<?php echo e($searchFormData['orderBy']); ?>" <?php else: ?> data-orderBy="asc" <?php endif; ?>>
                                            <?php echo app('translator')->getFromJson('label.key'); ?> 
                                            <?php if($searchFormData['orderName'] == 'setting_key'): ?>
                                                <?php if($searchFormData['orderBy'] == 'asc'): ?>
                                                    <span class="caret"></span>
                                                <?php else: ?>
                                                    <span class="caret rotate180"></span>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </a>
                                    </th>
                                    <th>
                                        <a class="listSortRecordLink" data-orderName="setting_value"  <?php if($searchFormData['orderName'] == 'setting_value'): ?> data-orderBy="<?php echo e($searchFormData['orderBy']); ?>" <?php else: ?> data-orderBy="asc" <?php endif; ?>>
                                            <?php echo app('translator')->getFromJson('label.value'); ?> 
                                            <?php if($searchFormData['orderName'] == 'setting_value'): ?>
                                                <?php if($searchFormData['orderBy'] == 'asc'): ?>
                                                    <span class="caret"></span>
                                                <?php else: ?>
                                                    <span class="caret rotate180"></span>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </a>
                                    </th>
                                    <th>
                                        <?php echo app('translator')->getFromJson('label.action'); ?> 
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $settings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $setting): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <th scope="row"><?php echo e($key+1); ?></th>
                                    <td><?php echo e(removeDblQuotes($setting->setting_key)); ?></td>
                                    <td><?php echo e(removeDblQuotes($setting->setting_value)); ?></td>
                                    <td>
                                        <a href="<?php echo e(route('setting add',['id' => $setting->id ])); ?>" type="button">
                                            <i class="material-icons">mode_edit</i>
                                        </a>
                                        <?php if(env('APP_ENV') != 'production'): ?>
                                        <a href="javascript:void(0)" data-href="<?php echo e(route('setting delete',['id' => $setting->id ])); ?>" data-message="<?php echo app('translator')->getFromJson('message.confirmDelete'); ?>" data-method="delete" type="button" class="deleteWithModal">
                                            <i class="material-icons col-red">delete_forever</i>
                                        </a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                        <div class="align-right">
                            <?php echo e($settings->appends(request()->query())->links()); ?>

                        </div>
                    <?php else: ?>
                        <?php echo app('translator')->getFromJson('message.noRecords'); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>