<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title', 'Karya Jaya Las - Solusi Las Profesional'); ?></title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        html, body { height: 100%; }
        body {
            background: #f0f2f5;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .main-content {
            padding: 30px 0 60px 0;
            min-height: calc(100vh - 70px);
        }
        @media (max-width: 768px) {
            .main-content {
                padding: 20px 0 40px 0;
            }
        }
        .alert-custom {
            border-radius: 12px;
            border-left: 4px solid #38a169;
            margin-bottom: 20px;
        }
        .alert-custom-danger {
            border-left-color: #e53e3e;
        }
    </style>
    <?php echo $__env->yieldContent('styles'); ?>
</head>
<body>
    <!-- ===== NAVBAR ===== -->
    <?php echo $__env->make('layouts.navigation', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    
    <!-- ===== MAIN CONTENT ===== -->
    <main class="main-content">
        <div class="container">
            <?php if(session('success')): ?>
                <div class="alert alert-success alert-dismissible fade show alert-custom">
                    <i class="fas fa-check-circle me-2"></i>
                    <?php echo e(session('success')); ?>

                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <?php if(session('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show alert-custom alert-custom-danger">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    <?php echo e(session('error')); ?>

                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <?php echo $__env->yieldContent('content'); ?>
        </div>
    </main>

    <!-- ===== SCRIPTS ===== -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <?php echo $__env->yieldContent('scripts'); ?>
</body>
</html><?php /**PATH C:\laragon\www\karya-jaya-las\resources\views/layouts/app.blade.php ENDPATH**/ ?>