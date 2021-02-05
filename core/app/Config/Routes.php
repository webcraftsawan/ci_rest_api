<?php namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

// Admin Routes Group
$routes->group('admin', function ($routes) {
    
    // Login Controller
    $routes->get('/', 'Login::index');
    $routes->post('login/post', 'Login::post');
    $routes->get('logout', 'Login::logout');
    $routes->get('forgot-password', 'Login::forgotPassword');
    $routes->post('forgot-password-request', 'Login::forgotPasswordRequest');
    $routes->get('reset/password/(:any)', 'Login::resetPassword/$1');
    $routes->post('reset-password/update/(:any)', 'Login::resetPasswordPost/$1');

    // Dashboard Controller
    $routes->get('dashboard', 'Dashboard::index');
    $routes->get('change-password', 'Dashboard::changePassword');
    $routes->post('update-password', 'Dashboard::updatePassword');

    // PopUp Controller
    $routes->get('popup-images', 'Popup::index');
    $routes->get('create-popup-image', 'Popup::create');
    $routes->post('store-popup-image', 'Popup::store');

    $routes->get('edit-popup-images/(:num)', 'Popup::edit/$1');
    $routes->post('update-popup-image/(:num)', 'Popup::update/$1');

    $routes->get('delete-popup-images/(:num)', 'Popup::delete/$1');

    // Pages Controller
    $routes->group('pages', function ($routes) {

        $routes->get('/', 'Pages::index');
        $routes->get('create', 'Pages::create');
        $routes->post('store', 'Pages::store');
        
        $routes->get('edit/(:num)', 'Pages::edit/$1');
        $routes->post('update/(:num)', 'Pages::update/$1');

        $routes->get('delete/(:num)', 'Pages::delete/$1');
    });

    // Category Controller
    $routes->group('pool', function ($routes) {

        $routes->get('list', 'Pool::index');
        $routes->get('create', 'Pool::create');
        $routes->post('store', 'Pool::store');

        $routes->get('edit/(:num)', 'Pool::edit/$1');
        $routes->post('update/(:num)', 'Pool::update/$1');

        $routes->get('delete/(:num)', 'Pool::delete/$1');
    });

    // Events Controller
    $routes->group('events', function ($routes) {

        $routes->get('list', 'Event::index');
        $routes->get('create', 'Event::create');
        $routes->post('store', 'Event::store');

        $routes->get('edit/(:num)', 'Event::edit/$1');
        $routes->post('update/(:num)', 'Event::update/$1');

        $routes->get('delete/(:num)', 'Event::delete/$1');
    });

    // Category Controller
    $routes->group('category', function ($routes) {

        $routes->get('list', 'Category::index');
        $routes->get('create', 'Category::create');
        $routes->post('store', 'Category::store');

        $routes->get('edit/(:num)', 'Category::edit/$1');
        $routes->post('update/(:num)', 'Category::update/$1');

        $routes->get('delete/(:num)', 'Category::delete/$1');
        
        $routes->get('subcategories/(:num)', 'Category::getSubcategories/$1');
    });


    // Post Controller
    $routes->group('posts', function ($routes) {
      
        $routes->get('list', 'Post::index');
        $routes->get('create', 'Post::create');
        $routes->post('store', 'Post::store');

        $routes->get('edit/(:num)', 'Post::edit/$1');
        $routes->post('update/(:num)', 'Post::update/$1');

        $routes->get('delete/(:num)', 'Post::delete/$1');
    });

    // Tags Controller
    $routes->group('tags', function ($routes) {

        $routes->get('list', 'Tags::index');
        $routes->get('create', 'Tags::create');
        $routes->post('store', 'Tags::store');

        $routes->get('edit/(:num)', 'Tags::edit/$1');
        $routes->post('update/(:num)', 'Tags::update/$1');

        $routes->get('delete/(:num)', 'Tags::delete/$1');
    });

    // Customer Controller
    $routes->group('customers', function ($routes) {

        $routes->get('/', 'Customers::index');
        $routes->get('create', 'Customers::create');
        $routes->post('store', 'Customers::store');

        $routes->get('view/(:num)', 'Customers::view/$1');

        $routes->get('edit/(:num)', 'Customers::edit/$1');
        $routes->post('update/(:num)', 'Customers::update/$1');

        $routes->get('delete/(:num)', 'Customers::delete/$1');
    });

    // Customer Controller
    $routes->group('interacts', function ($routes) {

        $routes->get('/', 'Interacts::index');
        $routes->get('create', 'Interacts::create');
        $routes->post('store', 'Interacts::store');

        $routes->get('view/(:num)', 'Interacts::view/$1');

        $routes->get('edit/(:num)', 'Interacts::edit/$1');
        $routes->post('update/(:num)', 'Interacts::update/$1');

        $routes->get('delete/(:num)', 'Interacts::delete/$1');
    });

    // Career Controller
    $routes->group('career', function ($routes) {

        $routes->get('/', 'Career::index');
        $routes->get('create', 'Career::create');
        $routes->post('store', 'Career::store');

        $routes->get('view/(:num)', 'Career::view/$1');

        $routes->get('edit/(:num)', 'Career::edit/$1');
        $routes->post('update/(:num)', 'Career::update/$1');

        $routes->get('delete/(:num)', 'Career::delete/$1');
    });

    // Bussiness Controller
    $routes->group('business', function ($routes) {

        $routes->get('/', 'Bussiness::index');
        $routes->get('create', 'Bussiness::create');
        $routes->post('store', 'Bussiness::store');

        $routes->get('view/(:num)', 'Bussiness::view/$1');

        $routes->get('edit/(:num)', 'Bussiness::edit/$1');
        $routes->post('update/(:num)', 'Bussiness::update/$1');

        $routes->get('delete/(:num)', 'Bussiness::delete/$1');
        //Status update
        $routes->get('updatestatus/(:num)/(:num)', 'Bussiness::updateStatus/$1/$2');
    });

    // Bussiness Controller
    $routes->group('cities', function ($routes) {

        $routes->get('/', 'City::index');
        $routes->get('create', 'City::create');
        $routes->post('store', 'City::store');

        $routes->get('view/(:num)', 'City::view/$1');

        $routes->get('edit/(:num)', 'City::edit/$1');
        $routes->post('update/(:num)', 'City::update/$1');

        $routes->get('delete/(:num)', 'City::delete/$1');
    });

    // Video Controller
    $routes->group('videos', function ($routes) {

        $routes->get('list', 'Video::index');
        $routes->get('create', 'Video::create');
        $routes->post('store', 'Video::store');

        $routes->get('edit/(:num)', 'Video::edit/$1');
        $routes->post('update/(:num)', 'Video::update/$1');

        $routes->get('delete/(:num)', 'Video::delete/$1');
    });


     // Image Controller
    $routes->group('images', function ($routes) {
        $routes->get('list', 'image::index');
        $routes->get('create', 'image::create');
        $routes->post('store', 'image::store');
        $routes->get('edit/(:num)', 'image::edit/$1');
        $routes->post('update/(:num)', 'image::update/$1');
        $routes->get('delete/(:num)', 'image::delete/$1');
    });
});

// REST API JWT ROUTES
    $routes->group('api/user', function ($routes) {

        $routes->post('register', 'api/Auth::register');
        $routes->post('login', 'api/Auth::login');
        $routes->post('forgot/password', 'api/Auth::forgot_password');
        $routes->get('reset/password/(:any)', 'api/Auth::reset_password/$1');
        $routes->post('password/store', 'api/Auth::reset_password_store');

        $routes->get('details', 'api/Profile::access');

        $routes->post('interact/form', 'api/Profile::interact');
        $routes->post('career/form', 'api/Profile::career');

        //Customer List
        $routes->post('customersList', 'api/Profile::customersList');

        //Customer delete
        $routes->post('customerDelete', 'api/Profile::customerDelete');
    });

    // Master
    $routes->group('api/master', function ($routes) {
        //Add Category
        $routes->post('categoryAdd', 'api/Master::categoryAdd');
        //Category List
        $routes->post('categoryList', 'api/Master::categoryList');
        // Category Delete
        $routes->post('categoryDelete', 'api/Master::categoryDelete');
        // Category Update
        $routes->post('categoryUpdate', 'api/Master::categoryUpdate');

        //Add Tags
        $routes->post('addTags', 'api/Master::addTags');
        //Tags List
        $routes->post('tagsList', 'api/Master::tagsList');
        // Tags Update
        $routes->post('updateTags', 'api/Master::updateTags');
        // Tags Delete
        $routes->post('tagsDelete', 'api/Master::tagsDelete');

        //Landing Pages List
        $routes->post('landingPageList', 'api/Master::landingPageList');
        //Add Landing Pages
        $routes->post('addLandingPage', 'api/Master::addLandingPage');
        //Update Landing Pages
        $routes->post('landingPageUpdate', 'api/Master::landingPageUpdate');

        //Interacts Listing
        $routes->post('interactsList', 'api/Master::interactsList');
        //Contact Form Listing
        $routes->post('careerformList', 'api/Master::careerformList');
    });

     // Post
    $routes->group('api/post', function ($routes) {
        //Post List
        $routes->post('postList', 'api/Post::postList');
        //Add Post
        $routes->post('addPost', 'api/Post::addPost');
        // Post Update
        $routes->post('postUpdate', 'api/Post::postUpdate');
        //Post Delete
        $routes->post('postDelete', 'api/Post::postDelete');
    });

/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
    if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
        require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
    }
