<?php

require '../vendor/autoload.php';

// define('DEBUG_TIME', microtime(true));

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

// if user put /?page=1
if (isset($_GET['page']) && $_GET['page'] === '1') {
    $uri = explode('?', $_SERVER['REQUEST_URI'])[0];
    $get = $_GET;
    // never modificate PHP gloabls variables
    unset($get['page']);
    $query = http_build_query($get);
    if (!empty($query)) {
    $uri = $uri . '?' . $query;
    }
    // redirection code
    http_response_code(301);
    header('Location: ' . $uri);
    exit();
}

use App\Router;

$router = new Router(dirname(__DIR__) . '/views');
$router
    //PROFIL 
    ->get('/profil', '/profil/profil', 'profil')                                        // profil page
    
    // HOME
    ->get('/', '/index', 'home')                                                             // home page
    
    // POSTS
    ->get('/posts', '/post/posts', 'posts')                                               // all posts
    ->get('/post/[*:slug]-[i:id]', '/post/show', 'post')                                // show an article

    // CATEGORIES
    ->get('/categories', '/categories/index', 'categories')                             // all categories
    ->get('/categories/[*:name]-[*:slug]-[i:id]', '/categories/show', 'categorie')               // see one categorie

    // ADMIN POSTS
    ->get('/admin/posts', '/admin/post/posts', 'admin_posts')                           // all post via admin page
    ->match('/admin/post/[i:id]', '/admin/post/edit', 'admin_post')                     // show an article via admin page
    ->match('/admin/post/new', '/admin/post/new', 'admin_post_new')                     // add post via admin page
    ->post('/admin/post/[i:id]/delete', '/admin/post/delete', 'admin_post_delete')      // delete post via admin page

    // ADMIN HOME
    ->get('/admin', '/admin/index', 'admin')

    // ADMIN CATEGORIES
    ->get('/admin/categories', '/admin/category/index', 'admin_categories')                         // all categories via admin page
    ->match('/admin/category/[i:id]', '/admin/category/edit', 'admin_category')                     // show a category via admin page
    ->match('/admin/category/new', '/admin/category/new', 'admin_category_new')                     // add category via admin page
    ->post('/admin/category/[i:id]/delete', '/admin/category/delete', 'admin_category_delete')      // delete category via admin page

    // LOGIN LOGOUT
    ->match('/login', '/auth/login', 'login')                                           // login page
    ->post('/logout', '/auth/logout' , 'logout')                                        // logout page
    ->run();
