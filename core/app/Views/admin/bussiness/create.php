<?= view('admin/include/header.php');?>

<body class="no-skin">
    <?= view('admin/include/top-nav.php');?>

    <div class="main-container ace-save-state" id="main-container">
        <script type="text/javascript">
            try {
                ace.settings.loadState('main-container')
            } catch (e) {}
        </script>
        <?= view('admin/include/sidebar.php');?>

        <div class="main-content">
            <div class="main-content-inner">
                <div class="breadcrumbs ace-save-state" id="breadcrumbs">
                    <ul class="breadcrumb">
                        <li>
                            <i class="ace-icon fa fa-home home-icon"></i>
                            <a href="#">Home</a>
                        </li>
                        <li class="">Business listing</li>
                        <li class="active">Add Business listing</li>
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
                            <form action="<?= $form_action ?>" method="POST" enctype="multipart/form-data">
                                <?= csrf_field() ?>
                                <div class="row">
                                    <div class="col-sm-8">
                                        <div class="widget-box">
                                            <div class="widget-header widget-header-large">
                                                <h4 class="widget-title">Add Business listing details</h4>
                                            </div>
                                            <div class="widget-body">
                                                <div class="widget-main">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label>Business/Shop/Company/Service name</label>
                                                                <input type="text" name="title" class="form-control" value="<?= set_value('title', isset($resp->title) ? $resp->title : '') ?>">
                                                                <p><small class="text-danger"><?= isset($errors['title']) ? $errors['title'] : '' ?></small></p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label>Description</label>
                                                                <textarea name="description" class="form-control"><?= set_value('description', isset($resp->description) ? $resp->description : '') ?></textarea>
                                                                <p><small class="text-danger"><?= isset($errors['description']) ? $errors['description'] : '' ?></small></p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Primary contact no.</label>
                                                                <input type="text" name="primary_contact" class="form-control" value="<?= set_value('primary_contact', isset($resp->primary_contact) ? $resp->primary_contact : '') ?>">
                                                                <p><small class="text-danger"><?= isset($errors['primary_contact']) ? $errors['primary_contact'] : '' ?></small></p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Secondary contact no.</label>
                                                                <input type="text" name="secondary_contact" class="form-control" value="<?= set_value('secondary_contact', isset($resp->secondary_contact) ? $resp->secondary_contact : '') ?>">
                                                                <p><small class="text-danger"><?= isset($errors['secondary_contact']) ? $errors['secondary_contact'] : '' ?></small></p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Opening time</label>
                                                                <input type="text" name="start_time" class="form-control timepicker" placeholder="Time" value="<?= set_value('start_time') ?>">
                                                            </div>
                                                            <div class="form-group">
                                                                <p><small class="text-danger"><?= isset($errors['start_time']) ? $errors['start_time'] : '' ?></small></p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Closing time</label>
                                                                <input type="text" name="end_time" class="form-control timepicker" placeholder="Time" value="<?= set_value('end_time') ?>">
                                                            </div>
                                                            <div class="form-group">
                                                                <p><small class="text-danger"><?= isset($errors['end_time']) ? $errors['end_time'] : '' ?></small></p>

                                                                <p><small class="text-danger"><?= isset($errors['time_error']) ? $errors['time_error'] : '' ?></small></p>

                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label>Address</label>
                                                                <textarea name="address" class="form-control"><?= set_value('address', isset($resp->address) ? $resp->address : '') ?></textarea>
                                                                <p><small class="text-danger"><?= isset($errors['address']) ? $errors['address'] : '' ?></small></p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Facebook</label>
                                                                <span class="input-icon w-100">
                                                                    <input type="text" name="facebook_profile" id="form-field-icon-1" class="w-100" value="<?= set_value('facebook', isset($resp->facebook) ? $resp->facebook : '') ?>">
                                                                    <i class="ace-icon fa fa-facebook-official blue"></i>
                                                                </span>
                                                                <p><small class="text-danger"><?= isset($errors['facebook']) ? $errors['facebook'] : '' ?></small></p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Twitter</label>
                                                                <span class="input-icon w-100">
                                                                    <input type="text" name="twitter_profile" id="form-field-icon-1" class="w-100" value="<?= set_value('twitter', isset($resp->twitter) ? $resp->twitter : '') ?>">
                                                                    <i class="ace-icon fa fa-twitter blue"></i>
                                                                </span>
                                                                <p><small class="text-danger"><?= isset($errors['twitter']) ? $errors['twitter'] : '' ?></small></p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Instagram</label>
                                                                <span class="input-icon w-100">
                                                                    <input type="text" name="instagram_profile" id="form-field-icon-1" class="w-100" value="<?= set_value('instagram', isset($resp->instagram) ? $resp->instagram : '') ?>">
                                                                    <i class="ace-icon fa fa-instagram blue"></i>
                                                                </span>
                                                                <p><small class="text-danger"><?= isset($errors['instagram']) ? $errors['instagram'] : '' ?></small></p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                        <div class="form-group">
                                                                <label>Youtube</label>
                                                                <span class="input-icon w-100">
                                                                    <input type="text" name="youtube_profile" id="form-field-icon-1" class="w-100 form-control" value="<?= set_value('youtube', isset($resp->youtube) ? $resp->youtube : '') ?>">
                                                                    <i class="ace-icon fa fa-youtube-play red"></i>
                                                                </span>
                                                                <p><small class="text-danger"><?= isset($errors['youtube']) ? $errors['youtube'] : '' ?></small></p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label>Select category</label>
                                                                <select class="form-control" name="category_id">
                                                                    <option value="">Select</option>
                                                                    <?php foreach ($categories as $category) : ?>
                                                                         <?php $selected = ($category->id == $resp->category_id ) ? 'selected' : ''; ?>
                                                                        <option value="<?= $category->id ?>" <?= $selected ?>><?= $category->title ?></option>
                                                                    <?php endforeach; ?>
                                                                </select>
                                                                <p><small class="text-danger"><?= isset($errors['category_id']) ? $errors['category_id'] : '' ?></small></p>
                                                            </div>
                                                        </div>
                                                       <!--  <div class="col-md-6">
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
                                                                <input type="text" name="tags" class="form-field-tags form-control" value="<?= set_value('tags', isset($resp->tags) ? $resp->tags : '') ?>" placeholder="Enter tags...">
                                                                <p><small class="text-danger"><?= isset($errors['tags']) ? $errors['tags'] : '' ?></small></p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label>Featured Tag</label>
                                                            <div class="form-group">
                                                                <input type="text" name="featured_tags" class="form-field-tags form-control" placeholder="Enter tags..." value="<?= set_value('featured_tags', isset($resp->featured_tags) ? $resp->featured_tags : '') ?>"/>
                                                                <p><small class="text-danger"><?= isset($errors['featured_tags']) ? $errors['featured_tags'] : '' ?></small></p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label>Location Tag</label>
                                                            <div class="form-group">
                                                                <input type="text" name="location_tags" class="form-field-tags form-control" placeholder="Enter tags..." value="<?= set_value('location_tags', isset($resp->location_tags) ? $resp->location_tags : '') ?>"/>
                                                                <p><small class="text-danger"><?= isset($errors['location_tags']) ? $errors['location_tags'] : '' ?></small></p>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <label>From date and time</label>
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    <input type="text" name="from_date_time" class="form-control date-timepicker" value="<?= set_value('from_date_time', isset($resp->from_date_time) ? timestamptodatepicker($resp->from_date_time) : '') ?>"/>
                                                                    <span class="input-group-addon">
                                                                        <i class="fa fa-clock-o bigger-110"></i>
                                                                    </span>
                                                                </div>
                                                                <p><small class="text-danger"><?= isset($errors['from_date_time']) ? $errors['from_date_time'] : '' ?></small></p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>To date and time</label>
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    <input type="text" name="to_date_time" class="form-control date-timepicker" value="<?= set_value('to_date_time', isset($resp->to_date_time) ? timestamptodatepicker($resp->to_date_time) : '') ?>"/>
                                                                    <span class="input-group-addon">
                                                                        <i class="fa fa-clock-o bigger-110"></i>
                                                                    </span>
                                                                </div>
                                                                <p><small class="text-danger"><?= isset($errors['to_date_time']) ? $errors['to_date_time'] : '' ?></small></p>

                                                                <p><small class="text-danger"><?= isset($errors['datetime_error']) ? $errors['datetime_error'] : '' ?></small></p>
                                                                
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
                                                <h5 class="widget-title">Upload Images</h5>
                                            </div>
                                            <div class="widget-body">
                                                <div class="widget-main">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label>Listing cover/banner </label>
                                                                <input type="file" name="cover_image" class="id-input-file" />
                                                            </div>
                                                              <?php if (isset($resp->cover_image)) : ?>
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <?= getCoverImage('bussiness/', $resp->cover_image) ?>
                                                                       
                                                                    </div>
                                                                </div>
                                                              <?php else : ?>
                                                              <?php endif; ?>
                                                        </div>
                                                    </div>

                                                    <div class="hr hr8 hr-dotted"></div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label>Album images </label>
                                                                <input type="file" name="album_images[]" multiple class="id-input-file" />
                                                            </div>
                                                            
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="hr hr8 hr-dotted"></div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <h5 class="widget-title">Album cover</h5>
                                                            <div class="form-group">
                                                                <input type="file" name="album_cover" class="id-input-file" />
                                                            </div>
                                                             <?php if (isset($resp->banner_image)) : ?>
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <?= getCoverImage('bussiness/', $resp->banner_image) ?>
                                                                       
                                                                    </div>
                                                                </div>
                                                             <?php else : ?>
                                                             <?php endif; ?>
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
                                </div>
                            </form>
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
        <?= view('admin/include/footer.php');?>
