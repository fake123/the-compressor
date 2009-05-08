<?php
require SYSPATH.'/helpers/Folder'.EXT;
/**
 * Bootstrap File
 */

/**
 * Getting all config files,
 * check application directory first then the system directory.
 */
$config_dir = 'config/';
$files = Folder::getFiles(SYSPATH.$config_dir);

foreach($files as $file):
    if(file_exists(APPPATH.$config_dir.$file)):
		include APPPATH.$config_dir.$file;
    ; else :
		include SYSPATH.$config_dir.$file;
    endif;
endforeach;

// Set default controller and action
define('DEFAULT_CONTROLLER', $route['_default']);
define('DEFAULT_ACTION', 'index');

// Load core files
require SYSPATH.'/core/Model'.EXT;
require SYSPATH.'/core/View'.EXT;
require SYSPATH.'/core/Controller'.EXT;
require SYSPATH.'/helpers/Inflector'.EXT;
require SYSPATH.'/core/Benchmark'.EXT;
require SYSPATH.'/core/Observer'.EXT;
require SYSPATH.'/core/Autoloader'.EXT;
require SYSPATH.'/core/Simplengine'.EXT;

Benchmark::start('total');

// Set view suffix
define('VIEW_SUFFIX', $config['view_suffix']);

// Set base url
define('BASE_URL',  $config['base_url']);

// Set debugger
define('DEBUG', $config['debug']);

/**
 * Get all routes and process them
 */
if(isset($route)):
    foreach($route as $key => $value):
		SE::addRoute($key, $value);
    endforeach;
endif;

// Dispatch Simplengine
SE::dispatch();
