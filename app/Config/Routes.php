<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultController('HomeController');
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

$routes->group('/',['namespace' => 'App\Controllers\Settings'],function($routes){
    //Ruta para establecer el idioma
    $routes->get('locale/(:segment)', 'LocaleController::set/$1', ['as' => 'locale']);
    //Rutas mantenimiento
    $routes->get('maintenance/', 'MaintenanceController::index', ['as' => 'maintenance']);
});
/**
 *Rutas Render Files
 **/
$routes->group('/files',['namespace' => 'App\Controllers\Files'],function($routes){
	$routes->match(['get','post'],'image-profile/(:segment)', 'RenderImageController::profile/$1', ['as' => 'image_profile']);
});

/**Grupo de Rutas Administrador 
 * usamos un filtro para validar si el usuario inicio sesión
 * también le pasamos parámetros para ver que roles pueden ingresar
*/

$routes->group('admin',['filter'=>'role:admin'],function($routes){
    /**
     * Rutas Admin.
     **/
    $routes->group('/', [
        'filter'    => 'permission:admin-website',
        'namespace' => 'App\Controllers\Admin',
    ], function ($routes) {
        $routes->get('/',  'DashboardController::index', ['as' => 'dashboard']);
    });
    /**
     * Rutas Profile.
     **/
    $routes->group('article', [
        'filter'    => 'permission:admin-website',
        'namespace' => 'App\Controllers\Admin',
    ], function ($routes) {
        $routes->get('/',  'ArticleController::index', ['as' => 'profile']);
    });
    /**
     * Ruta para establecer enlace simbolico
     */
    $routes->group('symlink', [
        'filter'    => 'permission:admin-website',
        'namespace' => 'App\Controllers\Admin',
    ], function ($routes) {
        $routes->get('', 'DashboardController::set', ['as' => 'symlink']);
    });
     /**
     * Ruta para cambiar el estado del
     * website
     */
    $routes->group('maintenance', [
        'filter'    => 'permission:admin-website',
        'namespace' => 'App\Controllers\Settings',
    ], function ($routes) {
        $routes->get('change', 'MaintenanceController::maintenance_update', ['as' => 'maintenance_change']);
    });
});

/*
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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')){
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
