<?php if($paginator->hasPages()): ?>
    <nav>
        <ul class="pagination">

            
            <?php if($paginator->onFirstPage()): ?>
                <li class="disabled">
                    <a href="javascript:void(0);">
                        <i class="material-icons">chevron_left</i>
                    </a>
                </li>
            <?php else: ?>
                <li>
                    <a href="<?php echo e($paginator->previousPageUrl()); ?>" rel="prev">
                        <i class="material-icons">chevron_left</i>
                    </a>
                </li>
            <?php endif; ?>


            
            <?php $__currentLoopData = $elements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                
                <?php if(is_string($element)): ?>
                    <li class="disabled"><a href="javascript:void(0);"><?php echo e($element); ?></a></li>
                <?php endif; ?>

                
                <?php if(is_array($element)): ?>
                    <?php $__currentLoopData = $element; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($page == $paginator->currentPage()): ?>
                            <li class="active"><a href="javascript:void(0);" class="bg-<?php echo e(config('settings.adminTheme')); ?>"><?php echo e($page); ?></a></li>
                        <?php else: ?>
                            <li><a href="<?php echo e($url); ?>" class="waves-effect"><?php echo e($page); ?></a></li>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            
            
            <?php if($paginator->hasMorePages()): ?>
                <li>
                    <a href="<?php echo e($paginator->nextPageUrl()); ?>" rel="next" class="waves-effect">
                        <i class="material-icons">chevron_right</i>
                    </a>
                </li>
            <?php else: ?>
                <li class="disabled">
                    <a href="javascript:void(0);" class="waves-effect">
                        <i class="material-icons">chevron_right</i>
                    </a>
                </li>
            <?php endif; ?>
            
        </ul>
    </nav>
<?php endif; ?>
