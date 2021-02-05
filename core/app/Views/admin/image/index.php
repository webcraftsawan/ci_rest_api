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
                        <li class="">Image album</li>
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
                                                        <a href="<?= base_url('admin/images/create') ?>" target="_blank" class="pull-right btn btn-primary btn-sm"><i class="fa fa-plus"></i></a>
                                                    </div><hr>
                                                    <div class="col-sm-12">
                                                        <table class="table table-striped table-bordered">
                                                            <thead>
                                                                <tr>
                                                                    <th class="center">#</th>
                                                                    <th>Album title </th>
                                                                    <th>Cover Image</th>
                                                                    <th>Category</th>
                                                                   <!--  <th>subcategory</th> -->
                                                                    <th>Views</th>
                                                                    <th>Shares</th>
                                                                    <th>From Date and Time </th>
                                                                    <th>To Date and Time</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                                <?php
                                                                if (!empty($lists)) :
                                                                    foreach ($lists as $key => $pool) : ?>
                                                                    <tr>
                                                                        <td class="center">#<?= ++$key ?></td>
                                                                        <td><?= $pool->title ?></td>
                                                                        <td>
                                                                            <?php if ($pool->cover_image) : ?>
                                                                                <?= getThumbImage('images/cover_image', $pool->cover_image) ?>
                                                                            <?php endif; ?>
                                                                        </td>
                                                                        <td>
                                                                        <?php
                                                                        if (!empty($pool->category_id)) {
                                                                            foreach ($categories as $category) {
                                                                                if ($pool->category_id == $category->id) {
                                                                                    echo $category->title;
                                                                                }
                                                                            }
                                                                        }
                                                                        ?>
                                                                        </td>
                                                                       <!--  <td> -->
                                                                        <?php
                                                                       /* if (!empty($pool->subcategory_id)) {
                                                                            foreach ($categories as $category) {
                                                                                if ($pool->subcategory_id == $category->id) {
                                                                                    echo $category->title;
                                                                                }
                                                                            }
                                                                        }*/
                                                                        ?>
                                                                        <!-- </td> -->
                                                                        <td><?= getPostViews($pool->id, 'image') ?></td>
                                                                        <td><?= getPostShare($pool->id, 'image') ?></td>
                                                                        <td><?= timestamptodate($pool->from_date_time) ?></td>
                                                                        <td><?= timestamptodate($pool->to_date_time) ?></td>
                                                                        <td>
                                                                            <a href="<?= base_url('admin/images/edit/'.$pool->id) ?>" target="_blank" class="btn btn-info btn-xs"><i class="ace-icon fa fa-pencil bigger-120"></i></a>
                                                                            <a href="<?= base_url('admin/images/delete/'.$pool->id) ?>" onclick="return confirm('Are you sure ?')" target="_blank" class="btn btn-danger btn-xs"><i class="ace-icon fa fa-trash-o bigger-120"></i></a>
                                                                        </td>
                                                                    </tr>
                                                                    <?php endforeach;
                                                                else : ?>
                                                                    <tr><th colspan="7">No Data Found...</th></tr>
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
