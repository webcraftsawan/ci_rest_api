<?php include('include/header.php');?>

<body class="no-skin">
<?php include('include/top-nav.php');?>

    <div class="main-container ace-save-state" id="main-container">
        <script type="text/javascript">
            try {
                ace.settings.loadState('main-container')
            } catch (e) {}
        </script>

<?php include('include/sidebar.php');?>

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
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="widget-box">
                                        <div class="widget-header widget-header-large">
                                            <h4 class="widget-title"><?= $title ?></h4>
                                        </div>
                                        <div class="widget-body">
                                            <div class="widget-main">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <a href="<?= base_url('admin/create-popup-image') ?>" target="_blank" class="pull-right btn btn-primary btn-sm"><i class="fa fa-plus"></i></a>
                                                    </div><hr>
                                                    <div class="col-sm-12">
                                                        <table class="table table-striped table-bordered">
                                                            <thead>
                                                                <tr>
                                                                    <th class="center">#</th>
                                                                    <th>Title</th>
                                                                    <th>Image</th>
                                                                    <th>Start Date</th>
                                                                    <th>End Date</th>
                                                                    <th>Status</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                                <?php if(!empty($popups)): foreach($popups as $key => $popup): ?>
                                                                    <tr>
                                                                        <th class="center">#<?= ++$key ?></th>
                                                                        <th><?= $popup->title ?></th>
                                                                        <th><img src="<?= base_url('core/public/uploads/'.$popup->image) ?>" width="150px"></th>
                                                                        <th><?= date('d M Y' , strtotime($popup->from)) ?></th>
                                                                        <th><?= date('d M Y' , strtotime($popup->to)) ?></th>
                                                                        <th><?= ($popup->is_active == 1) ? '<span class="text-success">Active</span>' : '<span class="text-danger">InActive</span>' ?></th>
                                                                        <th>
                                                                            <a href="<?= base_url('admin/edit-popup-images/'.$popup->id) ?>" target="_blank" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
                                                                            <a href="<?= base_url('admin/delete-popup-images/'.$popup->id) ?>" onclick="return confirm('Are you sure ?')" target="_blank" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
                                                                        </th>
                                                                    </tr>
                                                                <?php endforeach; else: ?>
                                                                    <tr><th colspan="6">No Data Found...</th></tr>
                                                                <?php endif; ?>
                                                            </tbody>
                                                        </table>
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
        <?php include('include/footer.php');?>