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
                                                                <input type="text" name="title" class="form-control" value="<?= set_value('title' , $resp->title) ?>">
                                                                <p><small class="text-danger"><?= isset($errors['title']) ? $errors['title'] : '' ?></small></p>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Category</label>
                                                                <select class="form-control" name="category_id">
                                                                    <option value="">-- Select Category --</option>
                                                                    <?php foreach($all_cats as $category): ?>
                                                                        <option value="<?= $category->id ?>"  <?= ($resp->category_id == $category->id) ? 'selected' : '' ?>><?= $category->title ?></option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                                <p><small class="text-danger"><?= isset($errors['category_id']) ? $errors['category_id'] : '' ?></small></p>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label>Description</label>
                                                                <textarea name="description" class="form-control" rows="5"><?= set_value('description', $resp->description) ?></textarea>
                                                                <p><small class="text-danger"><?= isset($errors['description']) ? $errors['description'] : '' ?></small></p>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Image</label>
                                                                <input type="file" class="form-control" name="image" accept=".png,.jpg,.jpeg">
                                                                <p><small class="text-danger"><?= isset($errors['image']) ? $errors['image'] : '' ?></small></p>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Youtube Video URL</label>
                                                                <input type="text" class="form-control" name="video_url" value="<?= set_value('video_url' , $resp->video_url) ?>">
                                                                <p><small class="text-danger"><?= isset($errors['video_url']) ? $errors['video_url'] : '' ?></small></p>
                                                            </div>
                                                        </div>
                                                        <div class="clearfix"></div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Tags</label>
                                                                <select class="form-control select2-multiple" name="tags[]" multiple>
                                                                    <option value="">-- Select Tags --</option>
                                                                    <?php foreach($tags as $tag): ?>
                                                                        <option value="<?= $tag->id ?>" <?= in_array($tag->id, json_decode($resp->tags , true)) ? 'selected' : '' ?>><?= $tag->name ?></option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                                <p><small class="text-danger"><?= isset($errors['tags']) ? $errors['tags'] : '' ?></small></p>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Status</label>
                                                                <select name="status" class="form-control">
                                                                    <option value="">-- Select --</option>
                                                                    <option value="1" <?= ($resp->status == 1) ? 'selected' : '' ?>>Active</option>
                                                                    <option value="0" <?= ($resp->status == 0) ? 'selected' : '' ?>>Inactive</option>
                                                                </select>
                                                                <p><small class="text-danger"><?= isset($errors['status']) ? $errors['status'] : '' ?></small></p>
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
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <img src="<?= base_url('core/public/posts/'.$resp->image) ?>" width="350px" height="250px">
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <?= preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i","<iframe width=\"350\" height=\"250\" src=\"//www.youtube.com/embed/$1\" frameborder=\"0\" allowfullscreen></iframe>",$resp->video_url) ?>
                                                    </div>
                                                </div>
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