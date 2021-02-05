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
                        <li class="">Image album</li>
                        <li class="active">Add Image album</li>
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
                                <form action="<?= $form_action ?>" method="post" enctype="multipart/form-data">
                                    <?= csrf_field() ?>
                                    <div class="col-sm-8">
                                        <div class="widget-box">
                                            <div class="widget-header widget-header-large">
                                                <h4 class="widget-title"><?= $title ?></h4>
                                            </div>
                                            <div class="widget-body">
                                                <div class="widget-main">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label>Image album title</label>
                                                                <input type="text" name="title" class="form-control" value="<?= set_value('title', isset($resp->title) ? $resp->title : '') ?>">
                                                                <p><small class="text-danger"><?= isset($errors['title']) ? $errors['title'] : '' ?></small></p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label>Image album Description</label>
                                                                <textarea name="description" class="form-control"><?= set_value('description', isset($resp->description) ? $resp->description : '') ?></textarea>
                                                                <p><small class="text-danger"><?= isset($errors['description']) ? $errors['description'] : '' ?></small></p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                           <div class="form-group">
                                                                <label>Select category</label>
                                                                <select class="form-control" name="category_id">
                                                                    <option value="">Select</option>
                                                                    <?php foreach ($categories as $category) : ?>
                                                                        <?php $selected = ($category->id == $resp->category_id ) ? 'selected' : ''; ?>
                                                                        <option value="<?= $category->id ?>" <?= $selected?>><?= $category->title ?></option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                                <p><small class="text-danger"><?= isset($errors['category_id']) ? $errors['category_id'] : '' ?></small></p>
                                                            </div>
                                                        </div>
                                            
                                                     <!--    <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Select subcategory</label>
                                                                <select class="form-control" name="subcategory_id">
                                                                    <option value="">Select</option>
                                                                </select>
                                                                <p><small class="text-danger"><?= isset($errors['subcategory_id']) ? $errors['subcategory_id'] : '' ?></small></p>
                                                            </div>
                                                        </div> -->
                                                       
                                                        <div class="col-md-12">
                                                            <label>Tag</label>
                                                            <div class="form-group">
                                                                <input type="text" name="tags" class="form-field-tags" value="<?= set_value('title', isset($resp->tags) ? $resp->tags : '') ?>" placeholder="Enter tags ..." />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label>Featured Tag</label>
                                                            <div class="form-group">
                                                                <input type="text" name="featured_tags" class="form-field-tags"  value="<?= set_value('title', isset($resp->featured_tags) ? $resp->featured_tags : '') ?>" placeholder="Enter tags ..." />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>From date and time</label>
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    <input type="text" class="form-control datetimepicker" name="from_date_time" value="<?= set_value('from_date_time', isset($resp->from_date_time) ? timestamptodatepicker($resp->from_date_time) : '') ?>" placeholder="Enter From Date">
                                                                        <span class="input-group-addon">
                                                                            <i class="fa fa-clock-o bigger-110"></i>
                                                                        </span>
                                                                    <p><small class="text-danger"><?= isset($errors['from_date_time']) ? $errors['from_date_time'] : '' ?></small></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>To date and time</label>
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    <input type="text" class="form-control datetimepicker" name="to_date_time" value="<?= set_value('to_date_time', isset($resp->to_date_time) ? timestamptodatepicker($resp->to_date_time) : '') ?>" placeholder="Enter To Date">
                                                                    <span class="input-group-addon">
                                                                        <i class="fa fa-clock-o bigger-110"></i>
                                                                    </span>
                                                                    <p><small class="text-danger"><?= isset($errors['to_date_time']) ? $errors['to_date_time'] : '' ?></small></p>
                                                                    <p><small class="text-danger"><?= isset($errors['resp_date']) ? $errors['resp_date'] : ''
                                                                    ?></small></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4 mb-15">
                                        <div class="widget-box tabbable">
                                            <div class="widget-header widget-header-large">
                                                <h5 class="widget-title">Upload Image album</h5>
                                            </div>
                                            <div class="widget-body">
                                                <div class="widget-main">
                                                      <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label>Browse Image album</label>
                                                                <input name="image" type="file"
                                                                class="id-input-file" />
                                                            </div>
                                                            <?php if (isset($resp->image)) : ?>
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <?= getCoverImage('images/', $resp->image) ?>
                                                                       
                                                                    </div>
                                                                </div>
                                                            <?php else : ?>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>

                                                  
                                                   <div class="hr hr8 hr-dotted"></div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="widget-header widget-header-large">
                                                                <h5 class="widget-title">Upload album cover image</h5>
                                                            </div>
                                                            <div class="widget-body">
                                                                <div class="widget-main">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <input type="file" class="id-input-file"  name="cover_image"/>
                                                                            </div>
                                                                        </div>
                                                                        <?php if (isset($resp->cover_image)) : ?>
                                                                            <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                    <?= getCoverImage('images/cover_image', $resp->cover_image) ?>
                                                                                    <input type="hidden" name="old_cover_image" value="<?= $resp->cover_image ?>">
                                                                                    <input type="hidden" name="old_image" value="<?= $resp->image ?>">
                                                                                </div>
                                                                            </div>
                                                                        <?php else : ?>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                     <div class="hr hr8 hr-dotted"></div>
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <button type="submit" class="btn btn-success btn-lg pull-right">Submit</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </form>
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
       
