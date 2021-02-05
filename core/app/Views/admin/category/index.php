<?php echo view('admin/include/header'); // include('../include/header.php');?>

<body class="no-skin">
<?php echo view('admin/include/top-nav'); // include('../include/top-nav.php');?>
    <div class="main-container ace-save-state" id="main-container">
        <script type="text/javascript">
            try {
                ace.settings.loadState('main-container')
            } catch (e) {}
        </script>

    <?php echo view('admin/include/sidebar'); // include('../include/sidebar.php');?>

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
                                                        <a href="<?= base_url('admin/category/create') ?>" target="_blank" class="pull-right btn btn-primary btn-sm"><i class="fa fa-plus"></i></a>
                                                    </div><hr>
                                                    <div class="col-sm-12">
                                                        <table class="table table-striped table-bordered">
                                                            <thead>
                                                                <tr>
                                                                    <th class="center">#</th>
                                                                    <th>Name</th>
                                                                    <th>Status</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                                <?php if(!empty($categories)): foreach($categories as $key => $category): ?>
                                                                    <tr>
                                                                        <th class="center">#<?= ++$key ?></th>
                                                                        <td><?php if($category->parent_id > 0): ?>
                                                                             <?= parentCategoryName($category->parent_id) ?> > 
                                                                            <?php endif; ?>
                                                                            <?= $category->title ?>
                                                                        </td>
                                                                        <td><?= ($category->status == 1) ? '<span class="text-success">Active</span>' : '<span class="text-danger">InActive</span>' ?></td>
                                                                        <td>

                                                                            <a href="<?= base_url('admin/category/edit/'.$category->id) ?>" target="_blank" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
                                                                            
                                                                            <a href="<?= base_url('admin/category/delete/'.$category->id) ?>" onclick="return confirm('Are you sure ?')" target="_blank" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
                                                                        
                                                                        </td>
                                                                    </tr>
                                                                <?php endforeach; else: ?>
                                                                    <tr><td colspan="7">No Data Found...</td></tr>
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
    <?php echo view('admin/include/footer'); // include('../include/footer.php');?>