<div id="sidebar" class="sidebar responsive ace-save-state">
    <script type="text/javascript">
        try {
            ace.settings.loadState('sidebar')
        } catch (e) {}
    </script>

    <div class="sidebar-shortcuts" id="sidebar-shortcuts">
        <div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
            <button class="btn btn-success">
                <i class="ace-icon fa fa-signal"></i>
            </button>

            <button class="btn btn-info">
                <i class="ace-icon fa fa-pencil"></i>
            </button>

            <button class="btn btn-warning">
                <i class="ace-icon fa fa-users"></i>
            </button>

            <button class="btn btn-danger">
                <i class="ace-icon fa fa-cogs"></i>
            </button>
        </div>

        <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
            <span class="btn btn-success"></span>

            <span class="btn btn-info"></span>

            <span class="btn btn-warning"></span>

            <span class="btn btn-danger"></span>
        </div>
    </div>
    <!-- /.sidebar-shortcuts -->

    <ul class="nav nav-list">
        <li class="<?= strpos($_SERVER['PATH_INFO'], 'dashboard') ? 'active' : '' ?>">
            <a href="<?= base_url('admin/dashboard') ?>">
                <i class="menu-icon fa fa-tachometer"></i>
                <span class="menu-text">Dashboard </span>
            </a>

            <b class="arrow"></b>
        </li>
        <li class="<?= strpos($_SERVER['PATH_INFO'], 'customers') ? 'active' : '' ?>">
            <a href="<?= base_url('admin/customers') ?>">
                <i class="menu-icon fa fa-list-alt"></i>
                <span class="menu-text"> Customers List </span>
            </a>

            <b class="arrow"></b>
        </li>
        <li class="<?= strpos($_SERVER['PATH_INFO'], 'category') || strpos($_SERVER['PATH_INFO'], 'tags') || strpos($_SERVER['PATH_INFO'], 'posts') ? 'open active' : '' ?>">
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-desktop"></i>
                <span class="menu-text">
                    Explore
                </span>
                <b class="arrow fa fa-angle-down"></b>
            </a>

            <b class="arrow"></b>

            <ul class="submenu">

                <li class="<?= strpos($_SERVER['PATH_INFO'], 'category') ? 'active' : '' ?>">
                    <a href="<?= base_url('admin/category/list') ?>">
                        <i class="menu-icon fa fa-caret-right"></i> Categories
                    </a>
                    <b class="arrow"></b>
                </li>

                <li class="<?= strpos($_SERVER['PATH_INFO'], 'tags') ? 'open active' : '' ?>">
                    <a href="<?= base_url('admin/tags/list') ?>">
                        <i class="menu-icon fa fa-caret-right"></i> Tags
                    </a>
                    <b class="arrow"></b>
                </li>

                <li class="<?= strpos($_SERVER['PATH_INFO'], 'posts') ? 'open active' : '' ?>">
                    <a href="<?= base_url('admin/posts/list') ?>">
                        <i class="menu-icon fa fa-caret-right"></i> Posts
                    </a>
                    <b class="arrow"></b>
                </li>

                <li class="hidden">
                    <a href="#" class="dropdown-toggle">
                        <i class="menu-icon fa fa-caret-right"></i> Explore
                        <b class="arrow fa fa-angle-down"></b>
                    </a>

                    <b class="arrow"></b>

                    <ul class="submenu">
                        <li class="">
                            <a href="<?= base_url('admin/top-talks') ?>">
                                <i class="menu-icon fa fa-caret-right"></i> Top Talks
                            </a>

                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="<?= base_url('admin/foods') ?>">
                                <i class="menu-icon fa fa-caret-right"></i> Foods
                            </a>

                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="<?= base_url('admin/education') ?>">
                                <i class="menu-icon fa fa-caret-right"></i> Education
                            </a>

                            <b class="arrow"></b>
                        </li>

                        <li class="">
                            <a href="<?= base_url('admin/special-talk') ?>">
                                <i class="menu-icon fa fa-caret-right"></i> Special Talk
                            </a>

                            <b class="arrow"></b>
                        </li>


                    </ul>
                </li>
            </ul>
        </li>

        <li class="<?= strpos($_SERVER['PATH_INFO'], 'business') || strpos($_SERVER['PATH_INFO'], 'cities') ? 'open active' : '' ?>">
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-list"></i>
                <span class="menu-text"> Business Listing </span>

                <b class="arrow fa fa-angle-down"></b>
            </a>

            <b class="arrow"></b>

            <ul class="submenu">
                <li class="<?= strpos($_SERVER['PATH_INFO'], 'business') && !strpos($_SERVER['PATH_INFO'], 'business/create') ? 'active' : '' ?>">

                    <a href="<?= base_url('admin/business') ?>">
                        <i class="menu-icon fa fa-caret-right"></i> Business Listing
                    </a>

                    <b class="arrow"></b>
                </li>
                <li  class="<?= strpos($_SERVER['PATH_INFO'], 'business/create') ? 'active' : '' ?>">
                    <a href="<?= base_url('admin/business/create') ?>">
                        <i class="menu-icon fa fa-caret-right"></i> Add new listing
                    </a>

                    <b class="arrow"></b>
                </li>

                <li class="">
                    <a href="<?= base_url('admin/add-categories') ?>">
                        <i class="menu-icon fa fa-caret-right"></i> Add Categories
                    </a>

                    <b class="arrow"></b>
                </li>
                <li class="<?= strpos($_SERVER['PATH_INFO'], 'cities') ? 'active' : '' ?>">
                    <a href="<?= base_url('admin/cities') ?>">
                        <i class="menu-icon fa fa-caret-right"></i> City
                    </a>

                    <b class="arrow"></b>
                </li>
            </ul>
        </li>

        <li class="">
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-pencil-square-o"></i>
                <span class="menu-text"> Events </span>

                <b class="arrow fa fa-angle-down"></b>
            </a>

            <b class="arrow"></b>

            <ul class="submenu">
                <li class="<?= strpos($_SERVER['PATH_INFO'], 'events') ? 'active' : '' ?>">
                    <a href="<?= base_url('admin/events/list') ?>">
                        <i class="menu-icon fa fa-caret-right"></i> Events List
                    </a>

                    <b class="arrow"></b>
                </li>

                <li class="<?= strpos($_SERVER['PATH_INFO'], 'events') ? 'active' : '' ?>">
                    <a href="<?= base_url('admin/events/create') ?>">
                        <i class="menu-icon fa fa-caret-right"></i> Add New Event
                    </a>

                    <b class="arrow"></b>
                </li>
                <li class="">
                    <a href="<?= base_url('admin/user-booked-event') ?>">
                        <i class="menu-icon fa fa-caret-right"></i> User booked event
                    </a>
                    <b class="arrow"></b>
                </li>


            </ul>
        </li>
        <li class="<?= strpos($_SERVER['PATH_INFO'], 'videos') ? 'open active' : '' ?>">
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-pencil-square-o"></i>
                <span class="menu-text"> Videos </span>

                <b class="arrow fa fa-angle-down"></b>
            </a>

            <b class="arrow"></b>

            <ul class="submenu">
                <li class="<?= strpos($_SERVER['PATH_INFO'], 'videos/list') || strpos($_SERVER['PATH_INFO'], 'videos/edit') ? 'active' : '' ?>">
                    <a href="<?= base_url('admin/videos/list') ?>">
                        <i class="menu-icon fa fa-caret-right"></i> Video Listing
                    </a>

                    <b class="arrow"></b>
                </li>

                <li class="<?= strpos($_SERVER['PATH_INFO'], 'videos/create') ? 'active' : '' ?>">
                    <a href="<?= base_url('admin/videos/create') ?>">
                        <i class="menu-icon fa fa-caret-right"></i> Add New video
                    </a>

                    <b class="arrow"></b>
                </li>


            </ul>
        </li>
        <li class="<?= strpos($_SERVER['PATH_INFO'], 'images') ? 'open active' : '' ?>">
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-pencil-square-o"></i>
                <span class="menu-text"> Image </span>

                <b class="arrow fa fa-angle-down"></b>
            </a>

            <b class="arrow"></b>

            <ul class="submenu">
                <li class="<?= strpos($_SERVER['PATH_INFO'], 'images/list') || strpos($_SERVER['PATH_INFO'], 'images/edit') ? 'active' : '' ?>">
                    <a href="<?= base_url('admin/images/list') ?>">
                        <i class="menu-icon fa fa-caret-right"></i> Image Listing
                    </a>

                    <b class="arrow"></b>
                </li>

                <li class="<?= strpos($_SERVER['PATH_INFO'], 'images/create') ? 'active' : '' ?>">
                    <a href="<?= base_url('admin/images/create') ?>">
                        <i class="menu-icon fa fa-caret-right"></i> Add New Image
                    </a>

                    <b class="arrow"></b>
                </li>


            </ul>
        </li>
        <li class="<?= strpos($_SERVER['PATH_INFO'], 'pool') ? 'open active' : '' ?>">
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-pencil-square-o"></i>
                <span class="menu-text"> Pools </span>

                <b class="arrow fa fa-angle-down"></b>
            </a>

            <b class="arrow"></b>

            <ul class="submenu">
                <li class="<?= strpos($_SERVER['PATH_INFO'], 'pool/list') ? 'active' : '' ?>">
                    <a href="<?= base_url('admin/pool/list') ?>">
                        <i class="menu-icon fa fa-caret-right"></i> List
                    </a>

                    <b class="arrow"></b>
                </li>

                <li class="<?= strpos($_SERVER['PATH_INFO'], 'pool/create') ? 'active' : '' ?>">
                    <a href="<?= base_url('admin/pool/create') ?>">
                        <i class="menu-icon fa fa-caret-right"></i> Add New Pool
                    </a>

                    <b class="arrow"></b>
                </li>


            </ul>
        </li>

        <li class="<?= strpos($_SERVER['PATH_INFO'], 'popup') ? 'active' : '' ?>">
            <a href="<?= base_url('admin/popup-images') ?>">
                <i class="menu-icon fa fa-list-alt"></i>
                <span class="menu-text"> Add landing popup </span>
            </a>

            <b class="arrow"></b>
        </li>
        <li class="<?= strpos($_SERVER['PATH_INFO'], 'pages') || strpos($_SERVER['PATH_INFO'], 'interacts') || strpos($_SERVER['PATH_INFO'], 'career') ? 'open active' : '' ?>">
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-pencil-square-o"></i>
                <span class="menu-text"> Information pages </span>
                <b class="arrow fa fa-angle-down"></b>
            </a>
            <b class="arrow"></b>

            <ul class="submenu">
                
                <li class="<?= strpos($_SERVER['PATH_INFO'], 'pages') ? 'active' : '' ?>">
                    <a href="<?= base_url('admin/pages') ?>">
                        <i class="menu-icon fa fa-caret-right"></i> Pages
                    </a>
                    <b class="arrow"></b>
                </li>

                <li class="<?= strpos($_SERVER['PATH_INFO'], 'interacts') ? 'active' : '' ?>">
                    <a href="<?= base_url('admin/interacts') ?>">
                        <i class="menu-icon fa fa-caret-right"></i> Interect Listing
                    </a>
                    <b class="arrow"></b>
                </li>

                <li class="<?= strpos($_SERVER['PATH_INFO'], 'career') ? 'active' : '' ?>">
                    <a href="<?= base_url('admin/career') ?>">
                        <i class="menu-icon fa fa-caret-right"></i> Career form list
                    </a>
                    <b class="arrow"></b>
                </li>



            </ul>
        </li>



    </ul>
    <!-- /.nav-list -->

    <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
        <i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state"
            data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
    </div>
</div>