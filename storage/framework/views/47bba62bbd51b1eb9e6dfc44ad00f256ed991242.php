﻿<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>404 | <?php echo e(config('app.name', 'Laravel')); ?></title>
    <!-- Favicon-->
    <link rel="icon" href="../../favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="<?php echo e(asset('plugins/bootstrap/css/bootstrap.css')); ?>" rel="stylesheet">

     <!-- Waves Effect Css -->
    <link href="<?php echo e(asset('plugins/node-waves/waves.css')); ?>" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="<?php echo e(asset('css/style.css')); ?>" rel="stylesheet">
</head>

<body class="four-zero-four">
    <div class="four-zero-four-container">
        <div class="error-code">404</div>
        <div class="error-message">This page doesn't exist</div>
        <div class="button-place">
            <a href="<?php echo e(route('welcome')); ?>" class="btn btn-default btn-lg waves-effect">GO TO HOMEPAGE</a>
        </div>
    </div>

    <!-- Jquery Core Js -->
    <script src="<?php echo e(asset('plugins/jquery/jquery.min.js')); ?>"></script>

     <!-- Bootstrap Core Js -->
     <script src="<?php echo e(asset('plugins/bootstrap/js/bootstrap.js')); ?>"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="<?php echo e(asset('plugins/node-waves/waves.js')); ?>"></script>

</body>

</html>