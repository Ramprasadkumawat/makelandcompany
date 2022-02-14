<?php if(auth()->guard()->check()): ?>
    
<?php endif; ?>
    
<?php if(auth()->guard()->guest()): ?>
    
<?php endif; ?>
<?php echo $__env->make('layouts.navbars.navs.guest', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('layouts.navbars.navs.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\wamp64\www\makel-and-company\resources\views/layouts/navbars/navbar.blade.php ENDPATH**/ ?>