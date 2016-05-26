<?php defined('SYSPATH') or die('No direct script access.');

// -- Environment setup --------------------------------------------------------

// Load the core Kohana class
require SYSPATH.'classes/Kohana/Core'.EXT;

if (is_file(APPPATH.'classes/Kohana'.EXT))
{
	// Application extends the core
	require APPPATH.'classes/Kohana'.EXT;
}
else
{
	// Load empty core extension
	require SYSPATH.'classes/Kohana'.EXT;
}

/**
 * Set the default time zone.
 *
 * @link http://kohanaframework.org/guide/using.configuration
 * @link http://www.php.net/manual/timezones
 */
date_default_timezone_set('Europe/Kiev');

/**
 * Set the default locale.
 *
 * @link http://kohanaframework.org/guide/using.configuration
 * @link http://www.php.net/manual/function.setlocale
 */
setlocale(LC_ALL, 'ru_RU.utf-8');

/**
 * Enable the Kohana auto-loader.
 *
 * @link http://kohanaframework.org/guide/using.autoloading
 * @link http://www.php.net/manual/function.spl-autoload-register
 */
spl_autoload_register(array('Kohana', 'auto_load'));

/**
 * Optionally, you can enable a compatibility auto-loader for use with
 * older modules that have not been updated for PSR-0.
 *
 * It is recommended to not enable this unless absolutely necessary.
 */
//spl_autoload_register(array('Kohana', 'auto_load_lowercase'));

/**
 * Enable the Kohana auto-loader for unserialization.
 *
 * @link http://www.php.net/manual/function.spl-autoload-call
 * @link http://www.php.net/manual/var.configuration#unserialize-callback-func
 */
ini_set('unserialize_callback_func', 'spl_autoload_call');

/**
 * Set the mb_substitute_character to "none"
 *
 * @link http://www.php.net/manual/function.mb-substitute-character.php
 */
mb_substitute_character('none');

// -- Configuration and initialization -----------------------------------------

/**
 * Set the default language
 */
I18n::lang('ru-ru');

if (isset($_SERVER['SERVER_PROTOCOL']))
{
	// Replace the default protocol.
	HTTP::$protocol = $_SERVER['SERVER_PROTOCOL'];
}

/**
 * Set Kohana::$environment if a 'KOHANA_ENV' environment variable has been supplied.
 *
 * Note: If you supply an invalid environment name, a PHP warning will be thrown
 * saying "Couldn't find constant Kohana::<INVALID_ENV_NAME>"
 */
Kohana::$environment = Kohana::DEVELOPMENT; // Мы перевели Кохану в режим разработки.
if (isset($_SERVER['KOHANA_ENV']))
{
	Kohana::$environment = constant('Kohana::'.strtoupper($_SERVER['KOHANA_ENV']));
}

/**
 * Initialize Kohana, setting the default options.
 *
 * The following options are available:
 *
 * - string   base_url    path, and optionally domain, of your application   NULL
 * - string   index_file  name of your index file, usually "index.php"       index.php
 * - string   charset     internal character set used for input and output   utf-8
 * - string   cache_dir   set the internal cache directory                   APPPATH/cache
 * - integer  cache_life  lifetime, in seconds, of items cached              60
 * - boolean  errors      enable or disable error handling                   TRUE
 * - boolean  profile     enable or disable internal profiling               TRUE
 * - boolean  caching     enable or disable internal caching                 FALSE
 * - boolean  expose      set the X-Powered-By header                        FALSE
 */
Kohana::init(array(
	'base_url'   => '/',
        'index_file' => false,
));

/**
 * Attach the file write to logging. Multiple writers are supported.
 */
Kohana::$log->attach(new Log_File(APPPATH.'logs'));

/**
 * Attach a file reader to config. Multiple readers are supported.
 */
Kohana::$config->attach(new Config_File);

/**
 * Enable modules. Modules are referenced by a relative or absolute path.
 */
Kohana::modules(array(
	   'auth'       => MODPATH.'auth',       // Basic authentication
           'email' => MODPATH.'email',
	// 'cache'      => MODPATH.'cache',      // Caching with multiple backends
	// 'codebench'  => MODPATH.'codebench',  // Benchmarking tool
	   'database'   => MODPATH.'database',   // Database access
           'image'      => MODPATH.'image',      // Image manipulation
	// 'minion'     => MODPATH.'minion',     // CLI Tasks
	   'orm'        => MODPATH.'orm',        // Object Relationship Mapping
	// 'unittest'   => MODPATH.'unittest',   // Unit testing
	   'userguide'  => MODPATH.'userguide',  // User guide and API documentation
	));

/**
 * Create cookie salt
 */
Cookie::$salt = '747977757078727';

/**
 * Set the routes. Each route must have a minimum of a name, a URI and a set of
 * defaults for the URI.
 */
//Route::set('winners', 'winners')
//        ->defaults(array(
//            'controller' => 'static',
//            'action' => 'winners',
//        ));
//
//Route::set('about', 'about')
//        ->defaults(array(
//            'controller' => 'static',
//            'action' => 'about',
//        ));
//
//Route::set('vote', 'vote')
//        ->defaults(array(
//            'controller' => 'static',
//            'action' => 'vote',
//        ));



// Admin side of site - Add Gift
Route::set('add_gift', 'admin/gifts/add')
            ->defaults(array(
            'directory'  => 'admin',
            'controller' => 'main',
            'action'     => 'add_gift',
    ));

// Admin side of site - Edit Gift
Route::set('edit_gift', 'admin/gifts/<id>')
            ->defaults(array(
            'directory'  => 'admin',
            'controller' => 'main',
            'action'     => 'edit_gift',
    ));

// Admin side of site - Add users
Route::set('add_users', 'admin/users/add')
            ->defaults(array(
            'directory'  => 'admin',
            'controller' => 'users',
            'action'     => 'add_users',
    ));

// Admin side of site - Change user pass
Route::set('change_user_pass', 'admin/users/<id>/change_pass')
            ->defaults(array(
            'directory'  => 'admin',
            'controller' => 'users',
            'action'     => 'change_user_pass',
    ));

// Admin side of site - Add photos
Route::set('add_photo', 'admin/users/<id>/add')
            ->defaults(array(
            'directory'  => 'admin',
            'controller' => 'users',
            'action'     => 'add_photo',
    ));

// Admin side of site - Edit photos
Route::set('edit_photo', 'admin/users/<id>/<photo_id>')
            ->defaults(array(
            'directory'  => 'admin',
            'controller' => 'users',
            'action'     => 'edit_photo',
    ));

// Admin side of site - Edit users
Route::set('edit_users', 'admin/users/<id>')
            ->defaults(array(
            'directory'  => 'admin',
            'controller' => 'users',
            'action'     => 'edit_users',
    ));

// Admin side of site - index users
Route::set('admin_users', 'admin/users')
            ->defaults(array(
            'directory'  => 'admin',
            'controller' => 'users',
            'action'     => 'index',
    ));

// Admin side of site: ADD options
Route::set('admin_options_add', 'admin/options/add')
            ->defaults(array(
            'directory'  => 'admin',
            'controller' => 'options',
            'action'     => 'add_options',
    ));

// Admin side of site: EDIT options
Route::set('admin_options_edit', 'admin/options/<id>')
            ->defaults(array(
            'directory'  => 'admin',
            'controller' => 'options',
            'action'     => 'edit_options',
    ));

// Admin side of site - INDEX options
Route::set('admin_options', 'admin/options')
            ->defaults(array(
            'directory'  => 'admin',
            'controller' => 'options',
            'action'     => 'index',
    ));

// Admin side of site
Route::set('admin', 'admin(/<action>(/<id>))')
            ->defaults(array(
            'directory'  => 'admin',
            'controller' => 'main',
            'action'     => 'index',
    ));

// Comments for Articles
Route::set('comments', 'comments/<id>', array('id' => '.+'))
	->defaults(array(
		'controller' => 'comments',
		'action'     => 'index',		
	));

// Route for Articles, maybe we need it
Route::set('articles', '<articles>/<id>-<artname>', array('id' => '[0-9]+'), array('artname' => '.+'))
	->defaults(array(
		'controller' => 'articles',
		'action'     => 'article',		
	));

// Route for Winners page and Winner pages
Route::set('winners', 'winners(/<id>)', array('id' => '.+'))
        ->defaults(array(
            'controller' => 'winners',
            'action'     => 'index',		
    ));

// Route for Winners page and Winner pages
Route::set('registration', 'registration(/<id>)', array('id' => '.+'))
        ->defaults(array(
            'controller' => 'registration',
            'action'     => 'index',		
    ));

Route::set('get_end_month_winner', 'vote/cron/get_end_month_winner')
        ->defaults(array(
            'controller' => 'winners',
            'action' => 'get_end_month_winner',
        ));
        
// All static pages on site
Route::set('static', '<action>(/<id>)', 
            array('action' => 'about|vote|addcode|tmppage')
          )
          ->defaults(array(
            'controller' => 'static',
    ));

Route::set('default', '(<controller>(/<action>(/<id>)))')
	->defaults(array(
		'controller' => 'static',
		'action'     => 'index',
	));
