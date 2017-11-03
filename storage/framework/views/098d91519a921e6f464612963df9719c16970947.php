<!-- resouce/views/layouts/alert -->

<div class="alert alert-<?php echo e(session('alert.type')); ?> <?php echo e((session('alert.type') == 'success') ? 'bg-green' : ''); ?> <?php echo e((session('alert.type') == 'error') ? 'bg-red' : ''); ?> alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <?php if(session('alert.title')): ?><strong class="alert-title"><?php echo e(session('alert.title')); ?></strong><br><?php endif; ?>
    <?php echo e(session('alert.message')); ?>

</div>