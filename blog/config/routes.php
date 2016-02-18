<?php
use Cake\Core\Plugin;
use Cake\Routing\Router;

/**
 * The default class to use for all routes
 *
 * The following route classes are supplied with CakePHP and are appropriate
 * to set as the default:
 *
 * - Route
 * - InflectedRoute
 * - DashedRoute
 *
 * If no call is made to `Router::defaultRouteClass`, the class used is
 * `Route` (`Cake\Routing\Route\Route`)
 *
 * Note that `Route` does not do any inflections on URLs which will result in
 * inconsistently cased URLs when used with `:plugin`, `:controller` and
 * `:action` markers.
 *
 */
Router::defaultRouteClass('Route');

Router::scope('/', function ($routes) {
  
  $routes->connect('/', ['controller' => 'Users', 'action' => 'login']);
  
  $routes->connect('/register', ['controller' => 'Users', 'action' => 'register']);
  $routes->connect('/login', ['controller' => 'Users', 'action' => 'login']);
  $routes->connect('/logout', ['controller' => 'Users', 'action' => 'logout']);
  $routes->connect('/forgot-password', ['controller' => 'Users', 'action' => 'forgot_password_step_1']);
  $routes->connect('/reset-password/*', ['controller' => 'Users', 'action' => 'forgot_password_step_2']);

  $routes->connect('/pages/*', ['controller' => 'Pages', 'action' => 'display']);
  /*
  $routes->connect('/articles/:id/:slug', 
    ['controller' => 'Articles', 'action' => 'view'],
    ['pass' => ['id', 'slug']]
  );*/
  $routes->fallbacks('InflectedRoute');
});


//Prefix
Router::prefix('admin', function ($routes) {
  $routes->fallbacks('InflectedRoute');
});


/**
 * Load all plugin routes.  See the Plugin documentation on
 * how to customize the loading of plugin routes.
 */
Plugin::routes();
