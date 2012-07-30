<?php
/**
 * CakePHP Debug Level:
 * 	0: No error messages, errors, or warnings shown. Flash messages redirect.
 * 	1: Errors and warnings shown, model caches refreshed, flash messages halted.
 * 	2: As in 1, but also with full debug messages and SQL output.
 */
	Configure::write('debug', 1);
/**
 * CakePHP Log Level:
 *  Boolean: Set true/false to activate/deactivate logging
 *  Integer: Use built-in PHP constants to set the error level (see error_reporting)
 *    Configure::write('log', E_ERROR | E_WARNING);
 *    Configure::write('log', E_ALL ^ E_NOTICE);
 */
	Configure::write('log', true);
	Configure::write('App.encoding', 'UTF-8');

#To use CakePHP pretty URLs, remove .htaccess ad uncomment the App.baseUrl below:
	#Configure::write('App.baseUrl', env('SCRIPT_NAME'));

	Configure::write('Routing.prefixes', array('admin'));

# Turn off all caching application-wide.
	Configure::write('Cache.disable', false);

/**
 * If set to true, for view caching you must still use the controller
 * var $cacheAction inside your controllers to define caching settings.
 * You can either set it controller-wide by setting var $cacheAction = true,
 * or in each action using $this->cacheAction = true.
 */
	Configure::write('Cache.check', true);

/**
 * Defines the default error type when using the log() function. Used for
 * differentiating error logging and debugging. Currently PHP supports LOG_DEBUG.
 */
	define('LOG_ERROR', 2);

/**
 * The preferred session handling method. Valid values:
 *
 * 'php'	 		Uses settings defined in your php.ini.
 * 'cake'		Saves session files in CakePHP's /tmp directory.
 * 'database'	Uses CakePHP's database sessions.
 *
 * To define a custom session handler, save it at /app/config/<name>.php.
 * Set the value of 'Session.save' to <name> to utilize it in CakePHP.
 *
 * To use database sessions, run the app/config/schema/sessions.php schema using
 * the cake shell command: cake schema run create Sessions
 *
 */
	Configure::write('Session.save', 'php');

#The name of CakePHP's session cookie.
	Configure::write('Session.cookie', 'PULSEM');

	Configure::write('Session.timeout', '120');
	Configure::write('Session.start', true);
	Configure::write('Session.checkAgent', true);

/**
 * The level of CakePHP security.
 * 'high'	Session timeout in 'Session.timeout' x 10
 * 'medium'	Session timeout in 'Session.timeout' x 5040
 * 'low'	Session timeout in 'Session.timeout' x 2628000
 */
	Configure::write('Security.level', 'low');

	Configure::write('Security.salt', '909dc4e70766cb57de08f94f7c8d264dad4a7e7d');
	Configure::write('Security.cipherSeed', '73821247805089838592382279556');

/**
 * Apply timestamps with the last modified time to static assets (js, css, images).
 * Will append a querystring parameter containing the time the file was modified. This is
 * useful for invalidating browser caches.
 *
 * Set to `true` to apply timestamps, when debug = 0, or set to 'force' to always enable
 * timestamping.
 */
	//Configure::write('Asset.timestamp', true);
/**
 * Compress CSS output by removing comments, whitespace, repeating tags, etc.
 * This requires a/var/cache directory to be writable by the web server for caching.
 * and /vendors/csspp/csspp.php
 *
 * To use, prefix the CSS link URL with '/ccss/' instead of '/css/' or use HtmlHelper::css().
 */
	//Configure::write('Asset.filter.css', 'css.php');

/**
 * Plug in your own custom JavaScript compressor by dropping a script in your webroot to handle the
 * output, and setting the config below to the name of the script.
 *
 * To use, prefix your JavaScript link URLs with '/cjs/' instead of '/js/' or use JavaScriptHelper::link().
 */
	//Configure::write('Asset.filter.js', 'custom_javascript_output_filter.php');

/**
 * The classname and database used in CakePHP's
 * access control lists.
 */
	Configure::write('Acl.classname', 'DbAcl');
	Configure::write('Acl.database', 'default');

/**
 * If you are on PHP 5.3 uncomment this line and correct your server timezone
 * to fix the date & time related errors.
 */
	date_default_timezone_set('America/Mexico_City');

/**
 * Cache Engine Configuration
 * Default settings provided below
 *
 * File storage engine.
 *
 * 	 Cache::config('default', array(
 *		'engine' => 'File', //[required]
 *		'duration'=> 3600, //[optional]
 *		'probability'=> 100, //[optional]
 * 		'path' => CACHE, //[optional] use system tmp directory - remember to use absolute path
 * 		'prefix' => 'cake_', //[optional]  prefix every cache file with this string
 * 		'lock' => false, //[optional]  use file locking
 * 		'serialize' => true, [optional]
 *	));
 */
 
Cache::config('default', array(
	'engine' => 'File',
	'duration'=> '+20 days',
	'probability'=> 100
));
Configure::load('site');