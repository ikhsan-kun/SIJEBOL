<?php if($paginator->hasPages()): ?>
    <nav role="navigation" aria-label="Pagination Navigation" class="jbl-pagination-container">
        
        <?php if($paginator->onFirstPage()): ?>
            <span class="jbl-page-item disabled" aria-disabled="true" aria-label="<?php echo app('translator')->get('pagination.previous'); ?>">
                <span class="jbl-page-link" aria-hidden="true">&lsaquo;</span>
            </span>
        <?php else: ?>
            <a href="<?php echo e($paginator->previousPageUrl()); ?>" rel="prev" class="jbl-page-item" aria-label="<?php echo app('translator')->get('pagination.previous'); ?>">
                <span class="jbl-page-link">&lsaquo;</span>
            </a>
        <?php endif; ?>

        
        <?php $__currentLoopData = $elements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            
            <?php if(is_string($element)): ?>
                <span class="jbl-page-item disabled" aria-disabled="true">
                    <span class="jbl-page-link"><?php echo e($element); ?></span>
                </span>
            <?php endif; ?>

            
            <?php if(is_array($element)): ?>
                <?php $__currentLoopData = $element; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($page == $paginator->currentPage()): ?>
                        <span class="jbl-page-item active" aria-current="page">
                            <span class="jbl-page-link"><?php echo e($page); ?></span>
                        </span>
                    <?php else: ?>
                        <a href="<?php echo e($url); ?>" class="jbl-page-item">
                            <span class="jbl-page-link"><?php echo e($page); ?></span>
                        </a>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        
        <?php if($paginator->hasMorePages()): ?>
            <a href="<?php echo e($paginator->nextPageUrl()); ?>" rel="next" class="jbl-page-item" aria-label="<?php echo app('translator')->get('pagination.next'); ?>">
                <span class="jbl-page-link">&rsaquo;</span>
            </a>
        <?php else: ?>
            <span class="jbl-page-item disabled" aria-disabled="true" aria-label="<?php echo app('translator')->get('pagination.next'); ?>">
                <span class="jbl-page-link" aria-hidden="true">&rsaquo;</span>
            </span>
        <?php endif; ?>
    </nav>
<?php endif; ?>
<?php /**PATH D:\laragon\www\jeboll\resources\views/vendor/pagination/tailwind.blade.php ENDPATH**/ ?>