<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['default_controller'] = 'landing';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

/**
 * Route customer
 */
// auth
$route['login'] = 'customer/auth';
$route['register'] = 'customer/auth/register';
$route['logout'] = 'customer/auth/logout';
// home
$route['home'] = 'customer/home';
// product
$route['product'] = 'customer/product';
$route['product/(:any)'] = 'customer/product/detail/$1';
// cart
$route['detail-cart'] = 'customer/cart';
$route['happy-pets/(:num)'] = 'customer/cart/addtocart/$1';
$route['delete-cart/(:num)'] = 'customer/cart/removecartitem/$1';
$route['clear-cart'] = 'customer/cart/emptycart';
// proses order
$route['process-order'] = 'customer/cart/processorder';
$route['checkout-success'] = 'customer/cart/checkoutsuccess';
// view order
$route['order-profile'] = 'customer/cart/showmyorder';
$route['order-profile/detail/(:num)'] = 'customer/cart/showdetailorder/$1';
// category
$route['category'] = 'customer/category';
$route['category/(:num)'] = 'customer/category/productcategory/$1';
// about us
$route['aboutus'] = 'main/aboutus';
// groomings
$route['grooming'] = 'customer/grooming';
$route['grooming/register'] = 'customer/grooming/groomingregistration';
$route['grooming/detail/(:num)'] = 'customer/grooming/detailgrooming/$1';
$route['grooming/delete/(:num)'] = 'customer/grooming/deletegroomingdata/$1';
// profiles
$route['customer/profile'] = 'customer/profile';
$route['customer/profile/update-profile'] = 'customer/profile/editprofile';
$route['customer/profile/change-password'] = 'customer/profile/changepassword';


// auth blocked
$route['access-denied'] = 'customer/auth/blocked';

/**
 * Route admin
 */
// auth
$route['admin'] = 'admin/auth';
$route['admin/logout'] = 'admin/auth/logout';
// dashboard
$route['dashboard'] = 'admin/dashboard';
// customer
$route['manage-customer'] = 'admin/customer';
$route['manage-customer/add'] = 'admin/customer/create';
$route['manage-customer/ubah/(:num)'] = 'admin/customer/edit/$1';
$route['manage-customer/delete/(:num)'] = 'admin/customer/delete/$1';
$route['manage-customer/detail/(:num)'] = 'admin/customer/detail/$1';
// admins
$route['manage-admin'] = 'admin/admin';
$route['manage-admin/add'] = 'admin/admin/create';
$route['manage-admin/ubah/(:num)'] = 'admin/admin/edit/$1';
$route['manage-admin/delete/(:num)'] = 'admin/admin/delete/$1';
// category
$route['manage-category'] = 'admin/category';
$route['manage-category/ajaxlist'] = 'admin/category/ajaxlist';
$route['manage-category/ajaxedit/(:num)'] = 'admin/category/ajaxedit/$1';
$route['manage-category/ajaxadd'] = 'admin/category/ajaxadd';
$route['manage-category/ajaxupdate'] = 'admin/category/ajaxupdate';
$route['manage-category/ajaxdelete/(:num)'] = 'admin/category/ajaxdelete/$1';
// products
$route['manage-product'] = 'admin/product';
$route['manage-product/add'] = 'admin/product/create';
$route['manage-product/ubah/(:num)'] = 'admin/product/edit/$1';
$route['manage-product/delete/(:num)'] = 'admin/product/delete/$1';
$route['manage-product/detail/(:num)'] = 'admin/product/detail/$1';
// Package grooming
$route['paket-grooming'] = 'admin/package';
$route['paket-grooming/ajaxlist'] = 'admin/package/ajaxlist';
$route['paket-grooming/ajaxedit/(:num)'] = 'admin/package/ajaxedit/$1';
$route['paket-grooming/ajaxadd'] = 'admin/package/ajaxadd';
$route['paket-grooming/ajaxupdate'] = 'admin/package/ajaxupdate';
$route['paket-grooming/ajaxdelete/(:num)'] = 'admin/package/ajaxdelete/$1';
//grooming customer
$route['manage-grooming'] = 'admin/grooming';
$route['manage-grooming/ubah-status/(:num)'] = 'admin/grooming/changestatus/$1';
$route['manage-grooming/detail/(:num)'] = 'admin/grooming/detail/$1';
$route['manage-grooming/delete/(:num)'] = 'admin/grooming/delete/$1';
// Order customer
$route['manage-order'] = 'admin/order';
$route['manage-order/ubah-status/(:num)'] = 'admin/order/changeorderstatus/$1';
$route['manage-order/delete/(:num)'] = 'admin/order/deleteorder/$1';
$route['manage-order/detail/(:num)'] = 'admin/order/detailorder/$1';
// Profile
$route['admin/profile'] = 'admin/profile';
$route['admin/profile/update-profile'] = 'admin/profile/editprofile';
$route['admin/profile/change-password'] = 'admin/profile/changepassword';
// Report
$route['report'] = 'admin/report';
$route['report/filter'] = 'admin/report/filterreports';

//clear
$route['clear'] = 'session/clear_flashdata';
