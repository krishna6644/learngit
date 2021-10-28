<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="IE=edge" http-equiv="X-UA-Compatible">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="description">
    <meta content="" name="keywords">
    <meta content="Fives Market" name="author">
    <title>Admin | Dropzone</title>
    <script>
        base_url = "<?php echo base_url() ?>";
    </script>
    <link href="<?php echo base_url() ?>/assets/css/bootstrap.min.css" media="screen" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url() ?>/assets/css/font-awesome.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>/assets/js/dropzone.min.css">
    <link href="<?php echo base_url() ?>/assets/css/style.css" media="screen" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url() ?>/assets/css/datatables.min.css">
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css'>

</head>

<body>
    <!-- wrapper start -->
    <div class="wrapper">
        <div class="top-header">
            <div class="top-header__utility-icon">
                <div class="menu-icon" data-sidebar-toggle>
                    <i class="fal fa-bars"></i>
                </div>
            </div>
            <div class="top-header__logo">
                <a href="#">
                    <img src="<?php echo base_url() ?>/assets/images/logo.png" alt="Logo">
                </a>
            </div>
            <div class="top-header__utility">


                <div class="top-header__user">
                    <a class="user-item dropdown-item" href="javascript:;" data-dropdown-toggle>
                        <img class="user-img" src="<?php echo base_url() ?>/assets/images/user.png" alt="User image">
                        <span>My Account</span>
                        <i class="fal fa-chevron-down"></i>
                    </a>
                    <div class="dropdown-content dropdown-content--left" data-dropdown>
                        <ul>

                            <li><a href="#">Log out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="main">
            <div class="sidebar">
                <div class="sidebar__menu">
                    <ul class="menu">
                        <li>
                            <a href="<?php echo base_url('category/index') ?>" class="active"><i class="fal fa-th-large"></i> Category</a>
                        </li>

                    </ul>
                    <ul class="menu">
                        <li>
                            <a href="<?php echo base_url('product/index') ?>" class="active"><i class="fal fa-th-large"></i> Product</a>
                        </li>

                    </ul>
                    <ul class="menu">
                        <li>
                            <a href="<?php echo base_url('upload_files/list') ?>" class="active"><i class="fal fa-th-large"></i> Multi-Image</a>
                        </li>

                    </ul>
                    <ul class="menu">
                        <li>
                            <a href="<?php echo base_url('dropzone') ?>" class="active"><i class="fal fa-th-large"></i> Dropzone</a>
                        </li>

                    </ul>
                    <ul class="menu">
                        <li>
                            <a href="<?php echo base_url('payment-gateway') ?>" class="active"><i class="fal fa-th-large"></i> Payment-gateway</a>
                        </li>

                    </ul>
                </div>
            </div>