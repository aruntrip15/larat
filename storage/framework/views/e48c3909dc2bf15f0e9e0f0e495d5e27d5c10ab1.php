<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Laravel')); ?></title>

    <!-- Laravel Style -->
    <!-- <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet"> -->

    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="<?php echo e(asset('plugins/bootstrap/css/bootstrap.css')); ?>" rel="stylesheet">

     <!-- Bootstrap Select Css -->
    <link href="<?php echo e(asset('plugins/bootstrap-select/css/bootstrap-select.css')); ?>" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="<?php echo e(asset('plugins/node-waves/waves.css')); ?>" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="<?php echo e(asset('plugins/animate-css/animate.css')); ?>" rel="stylesheet" />

    <!-- Morris Chart Css-->
    <link href="<?php echo e(asset('plugins/morrisjs/morris.css')); ?>" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="<?php echo e(asset('css/style.css')); ?>" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="<?php echo e(asset('css/themes/all-themes.css')); ?>" rel="stylesheet">

    <!-- Developer added css -->
    <link href="<?php echo e(asset('css/developer.css')); ?>" rel="stylesheet">
    
</head>
<body class="theme-<?php echo e(globalSetting('adminTheme')); ?>">
    
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-<?php echo e(globalSetting('adminTheme')); ?>">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->

    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->

    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="<?php echo e(route('admin dashboard')); ?>">LARAVEL ADMIN</a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <!-- #END# Call Search -->
                    <li class="pull-right"><a  href="<?php echo e(route('logout')); ?>"
                            onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();" class="js-right-sidebar" data-close="true"><i class="material-icons">exit_to_app</i></a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- #Top Bar -->

    <!-- Left and Right Side Bar -->
    <?php echo $__env->make('layouts.adminsidebars', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>    
    <!-- #Left and Right Side Bar -->


    <!-- Content View -->
    <section class="content">
        <div class="container-fluid">
        <?php if(session('alert.type')): ?>
            <?php $__env->startComponent('layouts.alert'); ?>
            <?php echo $__env->renderComponent(); ?>
        <?php endif; ?>

        <?php echo $__env->yieldContent('content'); ?>
        </div>
    </div>
    <!-- #Content View -->

    <!--Default Deleate Confirmation -->
    <?php $__env->startComponent('layouts.deletemodal'); ?>
    <?php echo $__env->renderComponent(); ?>
    <!-- Default Deleate Confirmation-->

    <!-- Scripts -->
    <!-- Jquery Core Js -->
    <script src="<?php echo e(asset('plugins/jquery/jquery.min.js')); ?>"></script>

    <!-- Bootstrap Core Js -->
    <script src="<?php echo e(asset('plugins/bootstrap/js/bootstrap.js')); ?>"></script>

     <!-- Select Plugin Js -->
     <script src="<?php echo e(asset('plugins/bootstrap-select/js/bootstrap-select.js')); ?>"></script>

    <!-- Select Plugin Js -->
    <script src="<?php echo e(asset('plugins/bootstrap-select/js/bootstrap-select.js')); ?>"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="<?php echo e(asset('plugins/jquery-slimscroll/jquery.slimscroll.js')); ?>"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="<?php echo e(asset('plugins/node-waves/waves.js')); ?>"></script>

    <!-- Jquery CountTo Plugin Js -->
    <script src="<?php echo e(asset('plugins/jquery-countto/jquery.countTo.js')); ?>"></script>

    <!-- Morris Plugin Js -->
    <script src="<?php echo e(asset('plugins/raphael/raphael.min.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/morrisjs/morris.js')); ?>"></script>

    <!-- ChartJs -->
    <script src="<?php echo e(asset('plugins/chartjs/Chart.bundle.js')); ?>"></script>

    <!-- Flot Charts Plugin Js -->
    <script src="<?php echo e(asset('plugins/flot-charts/jquery.flot.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/flot-charts/jquery.flot.resize.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/flot-charts/jquery.flot.pie.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/flot-charts/jquery.flot.categories.js')); ?>"></script>
    <script src="<?php echo e(asset('plugins/flot-charts/jquery.flot.time.js')); ?>"></script>

    <!-- Sparkline Chart Plugin Js -->
    <script src="<?php echo e(asset('plugins/jquery-sparkline/jquery.sparkline.js')); ?>"></script>

    <!-- Custom Js -->
    <script src="<?php echo e(asset('js/admin.js')); ?>"></script>
    <!-- <script src="<?php echo e(asset('js/pages/index.js')); ?>"></script> -->

    <!-- Demo Js -->
    <script src="<?php echo e(asset('js/demo.js')); ?>"></script>

    <script src="<?php echo e(asset('plugins/jquery-validation/jquery.validate.js')); ?>"></script>

    <script src="<?php echo e(asset('js/common.admin.js')); ?>"></script>

</body>
</html>