<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="utf-8" />
    <title><?= $title ?></title>

    <meta name="description" content="overview &amp; stats" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

    <!-- bootstrap & fontawesome -->
    <link rel="stylesheet" <?= base_url() ?> href="<?= base_url('assets/css/bootstrap.min.css'); ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/font-awesome/4.5.0/css/font-awesome.min.css') ?>" />

    <!-- page specific plugin styles -->

    <!-- text fonts -->
    <link rel="stylesheet" href="<?= base_url('assets/css/fonts.googleapis.com.css') ?>" />

    <!-- ace styles -->
    <link rel="stylesheet" href="<?= base_url('assets/css/ace.min.css') ?>" class="ace-main-stylesheet" id="main-ace-style" />

    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap-datepicker3.min.css') ?>" />
        <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap-timepicker.min.css') ?>" />
        <link rel="stylesheet" href="<?= base_url('assets/css/daterangepicker.min.css') ?>" />
        <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap-datetimepicker.min.css') ?>" />

    <!--[if lte IE 9]>
			<link rel="stylesheet" href="<?= base_url('/') ?>/assets/css/ace-part2.min.css" class="ace-main-stylesheet" />
		<![endif]-->
    <link rel="stylesheet" href="<?= base_url('assets/css/ace-skins.min.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/css/ace-rtl.min.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/css/style-control.css') ?>" />

    <!--[if lte IE 9]>
		  <link rel="stylesheet" href="<?= base_url('/') ?>/assets/css/ace-ie.min.css" />
		<![endif]-->

    <!-- inline styles related to this page -->

    <!-- ace settings handler -->
    <script src="<?= base_url('assets/js/ace-extra.min.js') ?>"></script>

    <!-- include libraries(jQuery, bootstrap) -->
    <!-- <link href="//stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet"> -->
    <!-- <script src="//code.jquery.com/jquery-3.5.1.min.js"></script> -->
    <!-- <script src="//stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->



    <!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

    <!--[if lte IE 8]>
		<script src="<?= base_url('/') ?>/assets/js/html5shiv.min.js"></script>
		<script src="<?= base_url('/') ?>/assets/js/respond.min.js"></script>
		<![endif]-->
    
    <!-- Sweet Alert -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/10.13.0/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <!-- Sweet Alert -->
</head>