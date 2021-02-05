<?php echo view('admin/include/header'); ?>

<body class="no-skin">
<?php echo view('admin/include/top-nav');?>

    <div class="main-container ace-save-state" id="main-container">
        <script type="text/javascript">
            try {
                ace.settings.loadState('main-container')
            } catch (e) {}
        </script>

<?php echo view('admin/include/sidebar');?>

        <div class="main-content">
            <div class="main-content-inner">
                <div class="breadcrumbs ace-save-state" id="breadcrumbs">
                    <ul class="breadcrumb">
                        <li>
                            <i class="ace-icon fa fa-home home-icon"></i>
                            <a href="#">Home</a>
                        </li>
                        <li class="active"><?= $title ?></li>
                    </ul>
                    <!-- /.breadcrumb -->

                    <div class="nav-search" id="nav-search">
                        <form class="form-search">
                            <span class="input-icon">
                                <input type="text" placeholder="Search ..." class="nav-search-input"
                                    id="nav-search-input" autocomplete="off" />
                                <i class="ace-icon fa fa-search nav-search-icon"></i>
                            </span>
                        </form>
                    </div>
                    <!-- /.nav-search -->
                </div>

                <div class="page-content">
                  
                    
                    <!-- /.page-header -->

                    <div class="row">
                        <div class="col-xs-12">
                            <!-- PAGE CONTENT BEGINS -->
                            <!-- <div class="alert alert-block alert-success">
                                <button type="button" class="close" data-dismiss="alert">
                                    <i class="ace-icon fa fa-times"></i>
                                </button>

                                <i class="ace-icon fa fa-check green"></i> Welcome to
                                <strong class="green">
                                    Ace
                                    <small>(v1.4)</small>
                                </strong>, лёгкий, многофункциональный и простой в использовании шаблон для админки на bootstrap 3.3.6. Загрузить исходники с <a href="https://github.com/bopoda/ace">github</a> (with minified
                                ace js/css files).
                            </div> -->
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="widget-box">
                                        <div class="widget-header widget-header-large">
                                            <h4 class="widget-title"><?= $title ?></h4>
                                        </div>
                                        <div class="widget-body">
                                            <div class="widget-main">
                                                <form action="<?= $form_action ?>" method="post" enctype="multipart/form-data">
                                                    <?= csrf_field() ?>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Title</label>
                                                                <input type="text" name="title" class="form-control" value="<?= set_value('title', isset($resp->title) ? $resp->title : '') ?>">
                                                                <p><small class="text-danger"><?= isset($errors['title']) ? $errors['title'] : '' ?></small></p>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label>Content</label>
                                                                <textarea name="description" class="form-control" rows="5"><?= set_value('description' , isset($resp->description) ? $resp->description : '') ?></textarea>
                                                                <p><small class="text-danger"><?= isset($errors['description']) ? $errors['description'] : '' ?></small></p>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-12">
                                                            <div class="row">

                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label>Status</label>
                                                                        <select name="status" class="form-control">
                                                                            <option value="">-- Select --</option>
                                                                            <option value="1" <?= set_value('status' , isset($resp->status) ? $resp->status : '') == 1 ? 'selected' : '' ?>>Active</option>
                                                                            <option value="0" <?= set_value('status' , isset($resp->status) ? $resp->status : '') == 0 ? 'selected' : '' ?>>Inactive</option>
                                                                        </select>
                                                                        <p><small class="text-danger"><?= isset($errors['status']) ? $errors['status'] : '' ?></small></p>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>From</label>
                                                                <input type="text" class="form-control datetimepicker" name="from" value="<?= set_value('from' , isset($resp->start_date) ? $resp->start_date : '') ?>">
                                                                <p><small class="text-danger"><?= isset($errors['from']) ? $errors['from'] : '' ?></small></p>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>To</label>
                                                                <input type="text" class="form-control datetimepicker" name="to" value="<?= set_value('to',isset($resp->end_date) ? $resp->end_date : '') ?>">
                                                                <p><small class="text-danger"><?= isset($errors['to']) ? $errors['to'] : '' ?></small></p>
                                                                <p><small class="text-danger"><?= isset($errors['resp_date']) ? $errors['resp_date'] : '' ?></small></p>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                                <div class="hr hr8 hr-dotted"></div>
                                                                <button type="submit" class="btn btn-success btn-lg pull-right">Save</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>



                            <!-- /.row -->

                            <!-- PAGE CONTENT ENDS -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.page-content -->
            </div>
        </div>
        <!-- /.main-content -->
        <?php echo view('admin/include/footer');?>