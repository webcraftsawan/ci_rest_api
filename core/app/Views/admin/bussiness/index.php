<?php echo view('admin/include/header'); ?>
<body class="no-skin">
    <?php echo view('admin/include/top-nav'); ?>
    <div class="main-container ace-save-state" id="main-container">
        <script type="text/javascript">
            try {
                ace.settings.loadState('main-container')
            } catch (e) {}
        </script>

        <?php echo view('admin/include/sidebar'); ?>

        <div class="main-content">
            <div class="main-content-inner">
               <div class="breadcrumbs ace-save-state" id="breadcrumbs">
                    <ul class="breadcrumb">
                        <li>
                            <i class="ace-icon fa fa-home home-icon"></i>
                            <a href="#">Home</a>
                        </li>
                        <li class="">Business Listing</li>
                        <li class="active">View Business Listing</li>
                        
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
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="widget-box">
                                        <div class="widget-header widget-header-large">
                                            <h4 class="widget-title"><?= $title ?></h4>
                                        </div>
                                        <div class="widget-body">
                                            <div class="widget-main">
                                                <div class="row">
                                                    <div class="col-sm-12 table-responsive">
                                                        <table id="simple-table" class="table  table-bordered table-hover">
                                                            <thead>
                                                                <tr>
                                                                    <th class="center">
                                                                        <label class="pos-rel">
                                                                            <input type="checkbox" class="ace" />
                                                                            <span class="lbl"></span>
                                                                        </label>
                                                                    </th>
                                                                    <th class="detail-col">View</th>
                                                                    <th>Name</th>
                                                                    <th>Category</th>
                                                                    <th >Primary contact no.</th>
                                                                    <th>From date and time</th>
                                                                    <th>To date and time</th>
                                                                    <th>Status</th>
                                                                    <th >Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php if (!empty($bussiness)) :
                                                                    foreach ($bussiness as $key => $business) : ?>
                                                                <tr>
                                                                    <td class="center">
                                                                        <label class="pos-rel">
                                                                            <input type="checkbox" class="ace" />
                                                                            <span class="lbl"></span>
                                                                        </label>
                                                                    </td>
                                                                    <td class="center">
                                                                        <div class="action-buttons">
                                                                            <a href="#" class="green bigger-140 show-details-btn" title="Show Details">
                                                                                <i class="ace-icon fa fa-angle-double-down"></i>
                                                                                <span class="sr-only">Details</span>
                                                                            </a>
                                                                        </div>
                                                                    </td>
                                                                    <td><?= $business->title ?></td>
                                                                    <td>
                                                                        <?php
                                                                        if (!empty($business->category_id)) {
                                                                            foreach ($categories as $category) {
                                                                                if ($business->category_id == $category->id) {
                                                                                    echo $category->title;
                                                                                }
                                                                            }
                                                                        }
                                                                        ?>
                                                                    </td>
                                                                    <td ><?= $business->primary_contact ?></td>
                                                                    <td><?= timestamptodate($business->from_date_time) ?></td>
                                                                    <td><?= timestamptodate($business->to_date_time) ?></td>
                                                                    <td >
                                                                        <?php
                                                                       
                                                                        if ($business->status == 1) {
                                                                            $class = "label-success";
                                                                            $labelText = "Publish";
                                                                        } else {
                                                                            $class = "label-warning";
                                                                            $labelText = "Expiring";
                                                                        }
                                                                        ?>
                                                                        <span class="label label-sm <?= $class;?>" id="label-status-<?=$business->id?>"><?=$labelText; ?></span>
                                                                    </td>
                                                                    <td>
                                                                        <div class="hidden-sm hidden-xs btn-group">
                                                                            <button class="btn btn-xs btn-success" data-rel="tooltip" title="" data-placement="top" data-original-title="View">
                                                                            <i
                                                                            class="ace-icon fa fa-eye bigger-120"></i>
                                                                            </button>
                                                                            
                                                                            <a href="<?= base_url('admin/business/edit/'.$business->id) ?>" class="btn btn-xs btn-info" data-rel="tooltip" title="Edit" data-placement="top" data-original-title="Edit">
                                                                               <i class="ace-icon fa fa-pencil bigger-120"></i>
                                                                            </a>

                                                                            <button class="btn btn-xs btn-warning business_publish" id="business-publish-<?=$business->id ?>" data-rel="tooltip" title="" data-placement="top" data-original-title="Unpublish" data-id="<?php echo $business->id; ?>" data-status="<?php echo $business->status; ?>">
                                                                            <i
                                                                            class="ace-icon fa fa-ban bigger-120"></i>
                                                                            </button>

                                                                            <a href="<?= base_url('admin/business/delete/'.$business->id) ?>" onclick="return confirm('Are you sure ?')" class="btn btn-xs btn-danger" data-rel="tooltip" title="Delete" data-placement="top" data-original-title="Delete">
                                                                               <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                                                            </a>

                                                                           
                                                                        </div>
                                                                        <div class="hidden-md hidden-lg">
                                                                            <div class="inline pos-rel">
                                                                                <button class="btn btn-minier btn-primary dropdown-toggle" data-toggle="dropdown" data-position="auto">
                                                                                <i class="ace-icon fa fa-cog icon-only bigger-110"></i>
                                                                                </button>
                                                                                <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                                                                    <li>
                                                                                        <a href="#" class="tooltip-info" data-rel="tooltip" title="View">
                                                                                            <span class="blue">
                                                                                                <i class="ace-icon fa fa-search-plus bigger-120"></i>
                                                                                            </span>
                                                                                        </a>
                                                                                    </li>
                                                                                    <li>
                                                                                        <a href="<?= base_url('admin/business/edit/'.$business->id) ?>" class="tooltip-success" data-rel="tooltip" title="Edit" data-placement="top" data-original-title="Edit">
                                                                                             <span class="green">
                                                                                                <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                                                                                            </span>
                                                                                        </a>
                                                                                      <!--   <a href="#" class="tooltip-success" data-rel="tooltip" title="Edit">
                                                                                            <span class="green">
                                                                                                <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                                                                                            </span>
                                                                                        </a> -->
                                                                                    </li>

                                                                                    <li>
                                                                                        <a href="<?= base_url('admin/business/delete/'.$business->id) ?>" onclick="return confirm('Are you sure ?')" class="tooltip-error" data-rel="tooltip" title="" data-placement="top" data-original-title="Delete">
                                                                                            <span class="red">
                                                                                                <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                                                                            </span>
                                                                                        </a>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr class="detail-row">
                                                                    <td colspan="9">
                                                                        <div class="table-detail">
                                                                            <div class="row">
                                                                                <div class="col-xs-12 col-sm-3">
                                                                                    <div class="text-center">
                                                                                       <?php if ($business->cover_image) : ?>
                                                                                            <?= getThumbImage('bussiness', $business->cover_image) ?>
                                                                                       <?php endif; ?>
                                                                                        <br />
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-xs-12 col-sm-9">
                                                                                    <div class="space visible-xs"></div>
                                                                                    <div class="profile-user-info profile-user-info-striped">
                                                                                        <div class="profile-info-row">
                                                                                            <div class="profile-info-name"> Secondary contact no. </div>
                                                                                            <div class="profile-info-value">
                                                                                                <span><?= $business->secondary_contact ?></span>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="profile-info-row">
                                                                                            <div class="profile-info-name"> Location </div>
                                                                                            <div class="profile-info-value">
                                                                                                <i class="fa fa-map-marker light-orange bigger-110"></i>
                                                                                                <span><?= $business->address ?></span>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="profile-info-row">
                                                                                            <div class="profile-info-name"> Facebook </div>
                                                                                            <div class="profile-info-value">
                                                                                                <span><?= $business->facebook ?></span>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="profile-info-row">
                                                                                            <div class="profile-info-name"> Twitter </div>
                                                                                            <div class="profile-info-value">
                                                                                                <span><?= $business->twitter ?></span>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="profile-info-row">
                                                                                            <div class="profile-info-name"> Instagram </div>
                                                                                            <div class="profile-info-value">
                                                                                                <span><?= $business->instagram ?></span>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="profile-info-row">
                                                                                            <div class="profile-info-name"> Youtube </div>
                                                                                            <div class="profile-info-value">
                                                                                                <span><?= $business->youtube ?></span>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                    <?php endforeach;
                                                                else : ?>
                                                                    <tr><td colspan="7">No Data Found...</td></tr>
                                                                <?php endif; ?>
                                                            </tbody>
                                                        </table>
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
    <?php echo view('admin/include/footer'); // include('../include/footer.php');?>
    <script type="text/javascript">
        $(function() {
            $(document).on('click', ".business_publish" , function(){
                var id = $(this).data('id');
                var status = $(this).data('status');
                Swal.fire({
                  title: 'Are you sure?',
                  text: "You want to change Status!",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Yes!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "GET",
                            url: "<?= base_url('admin/business/updatestatus') ?>/"+id+"/"+status,
                            dataType: "json",
                            success: function (response) {
                                if(response.status == true){
                                    let timerInterval
                                    Swal.fire({
                                      title: 'Please Wait!',
                                      //html: 'I will close in  milliseconds.',
                                      timer: 2000,
                                      timerProgressBar: true,
                                      didOpen: () => {
                                        Swal.showLoading()
                                      },
                                      willClose: () => {
                                        clearInterval(timerInterval)
                                      }
                                    }).then((result) => {
                                      /* Read more about handling dismissals below */
                                      /*Swal.fire(
                                          'Status Changed!',
                                          'Status has been Changed Successfully.',
                                          'success'
                                      )*/
                                        Swal.fire({
                                          position: 'center',
                                          icon: 'success',
                                          title: 'Status has been Changed Successfully.',
                                          showConfirmButton: false,
                                          timer: 1000
                                        })
                                      if (result.dismiss === Swal.DismissReason.timer) {
                                            if(response.bussiness_status == 1){
                                                $("#business-publish-"+id).data('status',response.bussiness_status);
                                                $('#label-status-'+id).removeClass('label-warning').addClass('label-success').html('Publish');
                                            }else {
                                                $("#business-publish-"+id).data('status',response.bussiness_status);
                                                $('#label-status-'+id).removeClass('label-success').addClass('label-warning').html('Expiring');
                                            }
                                        }
                                    })
                                }
                            }
                        });
                    }
                })
            });
        });
    </script>
