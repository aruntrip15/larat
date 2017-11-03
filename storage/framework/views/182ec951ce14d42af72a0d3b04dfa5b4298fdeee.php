<?php $__env->startSection('content'); ?>
    <div class="block-header">
        <h2><?php echo app('translator')->getFromJson('title.user'); ?> <a type="button" href="<?php echo e(route('user add')); ?>" class="m-l-15 btn bg-<?php echo e(globalSetting('adminTheme')); ?> waves-effect"><i class="material-icons">add</i></a></h2>
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
                                        <input class="form-control" placeholder="<?php echo app('translator')->getFromJson('label.nameOrEmail'); ?>" type="text" name="nameOrEmail" value="<?php echo e($searchFormData['nameOrEmail']); ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <select class="form-control show-tick" name="role">
                                    <option value=""><?php echo app('translator')->getFromJson('label.allRoles'); ?></option>
                                    <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($searchFormData['role'] != '' && $searchFormData['role'] == $role->id): ?>
                                            <option value="<?php echo e($role->id); ?>" selected="selected"><?php echo e($role->name); ?></option>
                                        <?php else: ?>
                                            <option value="<?php echo e($role->id); ?>"><?php echo e($role->name); ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="col-md-4 button-demo">
                                <button type="submit" class="btn bg-<?php echo e(globalSetting('adminTheme')); ?> waves-effect"><?php echo app('translator')->getFromJson('label.search'); ?></button>
                                <a href="<?php echo e(route('user list')); ?>" type="button" class="btn btn-default waves-effect"><?php echo app('translator')->getFromJson('label.reset'); ?></a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="body table-responsive">
                    <?php if($users->count()): ?>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>
                                        <a class="listSortRecordLink" data-orderName="users.name"  <?php if($searchFormData['orderName'] == 'users.name'): ?> data-orderBy="<?php echo e($searchFormData['orderBy']); ?>" <?php else: ?> data-orderBy="asc" <?php endif; ?>>
                                            <?php echo app('translator')->getFromJson('label.name'); ?>
                                            <?php if($searchFormData['orderName'] == 'users.name'): ?>
                                                <?php if($searchFormData['orderBy'] == 'asc'): ?>
                                                    <span class="caret"></span>
                                                <?php else: ?>
                                                    <span class="caret rotate180"></span>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </a>
                                    </th>
                                    <th>
                                        <a class="listSortRecordLink" data-orderName="users.email" <?php if($searchFormData['orderName'] == 'users.email'): ?> data-orderBy="<?php echo e($searchFormData['orderBy']); ?>" <?php else: ?> data-orderBy="asc" <?php endif; ?>>
                                            <?php echo app('translator')->getFromJson('label.email'); ?> 
                                            <?php if($searchFormData['orderName'] == 'users.email'): ?>
                                                <?php if($searchFormData['orderBy'] == 'asc'): ?>
                                                    <span class="caret"></span>
                                                <?php else: ?>
                                                    <span class="caret rotate180"></span>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </a>
                                    </th>
                                    <th>
                                        <a class="listSortRecordLink" data-orderName="roles.name" <?php if($searchFormData['orderName'] == 'roles.name'): ?> data-orderBy="<?php echo e($searchFormData['orderBy']); ?>" <?php else: ?> data-orderBy="asc" <?php endif; ?>>
                                            <?php echo app('translator')->getFromJson('label.role'); ?>
                                            <?php if($searchFormData['orderName'] == 'roles.name'): ?>
                                                <?php if($searchFormData['orderBy'] == 'asc'): ?>
                                                    <span class="caret"></span>
                                                <?php else: ?>
                                                    <span class="caret rotate180"></span>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </a>
                                    </th>
                                    <th>
                                        <a class="listSortRecordLink" data-orderName="users.created_at" <?php if($searchFormData['orderName'] == 'users.created_at'): ?> data-orderBy="<?php echo e($searchFormData['orderBy']); ?>" <?php else: ?> data-orderBy="asc" <?php endif; ?>>
                                            <?php echo app('translator')->getFromJson('label.created'); ?> 
                                            <?php if($searchFormData['orderName'] == 'users.created_at'): ?>
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
                                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <th scope="row"><?php echo e($key+1); ?></th>
                                    <td><?php echo e($user->name); ?></td>
                                    <td><?php echo e($user->email); ?></td>
                                    <td><?php echo e($user->role_name); ?></td>
                                    <td><?php echo e($user->created_at); ?></td>
                                    <td>
                                        <a href="<?php echo e(route('user add',['id' => $user->id ])); ?>">
                                            <i class="material-icons">mode_edit</i>
                                        </a>
                                        <a href="javascript:void(0)" data-href="<?php echo e(route('user delete',['id' => $user->id ])); ?>" data-message="<?php echo app('translator')->getFromJson('message.confirmDelete'); ?>" data-method="delete" type="button" class="deleteWithModal">
                                            <i class="material-icons col-red">delete_forever</i>
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                        <div class="align-right">
                            <?php echo e($users->appends(request()->query())->links()); ?>

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