<?php

// @codingStandardsIgnoreFile

if (getenv('DEBUG')) {
    ini_set('display_errors', true);
    ini_set('display_startup_errors', true);
    error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
}

$databases = [];
$databases['default']['default'] = [
  'database' => getenv('MYSQL_DATABASE'),
  'username' => getenv('MYSQL_USERNAME'),
  'password' => getenv('MYSQL_PASSWORD'),
  'prefix' => '',
  'host' => getenv('MYSQL_HOST'),
  'port' => getenv('MYSQL_PORT'),
  'namespace' => 'Drupal\\Core\\Database\\Driver\\mysql',
  'driver' => 'mysql'
];

/**
 * Reverse proxy tingelings.
 */
# $_SERVER['HTTPS'] = 'on';
# $settings['https'] = 'on';
# $settings['reverse_proxy'] = TRUE;
# $settings['reverse_proxy_addresses'] = [explode(', ', $_SERVER['HTTP_X_FORWARDED_FOR'])[1], $_SERVER['REMOTE_ADDR']];

/**
 * Location of the site configuration files.
 *
 * The $config_directories array specifies the location of file system
 * directories used for configuration data. On install, the "sync" directory is
 * created. This is used for configuration imports. The "active" directory is
 * not created by default since the default storage for active configuration is
 * the database rather than the file system. (This can be changed. See "Active
 * configuration settings" below).
 *
 * The default location for the "sync" directory is inside a randomly-named
 * directory in the public files path. The setting below allows you to override
 * the "sync" location.
 *
 * If you use files for the "active" configuration, you can tell the
 * Configuration system where this directory is located by adding an entry with
 * array key CONFIG_ACTIVE_DIRECTORY.
 *
 * Example:
 * @code
 *   $config_directories = array(
 *     CONFIG_SYNC_DIRECTORY => '/directory/outside/webroot',
 *   );
 * @endcode
 */
$config_directories = array();
$config_directories[CONFIG_SYNC_DIRECTORY] = 'sites/default/sync';

/**
 * Settings:
 *
 * $settings contains environment-specific configuration, such as the files
 * directory and reverse proxy address, and temporary configuration, such as
 * security overrides.
 *
 * @see \Drupal\Core\Site\Settings::get()
 */

/**
 * The active installation profile.
 *
 * Changing this after installation is not recommended as it changes which
 * directories are scanned during extension discovery. If this is set prior to
 * installation this value will be rewritten according to the profile selected
 * by the user.
 *
 * @see install_select_profile()
 *
 * @deprecated in Drupal 8.3.0 and will be removed before Drupal 9.0.0. The
 *   install profile is written to the core.extension configuration. If a
 *   service requires the install profile use the 'install_profile' container
 *   parameter. Functional code can use \Drupal::installProfile().
 */
# $settings['install_profile'] = '';

/**
 * Salt for one-time login links, cancel links, form tokens, etc.
 *
 * This variable will be set to a random value by the installer. All one-time
 * login links will be invalidated if the value is changed. Note that if your
 * site is deployed on a cluster of web servers, you must ensure that this
 * variable has the same value on each server.
 *
 * For enhanced security, you may set this variable to the contents of a file
 * outside your document root; you should also ensure that this file is not
 * stored with backups of your database.
 *
 * Example:
 * @code
 *   $settings['hash_salt'] = file_get_contents('/home/example/salt.txt');
 * @endcode
 */

$settings['hash_salt'] = file_get_contents('/opt/src/.salt');

/**
 * Deployment identifier.
 *
 * Drupal's dependency injection container will be automatically invalidated and
 * rebuilt when the Drupal core version changes. When updating contributed or
 * custom code that changes the container, changing this identifier will also
 * allow the container to be invalidated as soon as code is deployed.
 */
# $settings['deployment_identifier'] = \Drupal::VERSION;

/**
 * Access control for update.php script.
 *
 * If you are updating your Drupal installation using the update.php script but
 * are not logged in using either an account with the "Administer software
 * updates" permission or the site maintenance account (the account that was
 * created during installation), you will need to modify the access check
 * statement below. Change the FALSE to a TRUE to disable the access check.
 * After finishing the upgrade, be sure to open this file again and change the
 * TRUE back to a FALSE!
 */
$settings['update_free_access'] = FALSE;

/**
 * Specify every reverse proxy IP address in your environment.
 * This setting is required if $settings['reverse_proxy'] is TRUE.
 */
# $settings['reverse_proxy_addresses'] = array('a.b.c.d', ...);

/**
 * Set this value if your proxy server sends the client IP in a header
 * other than X-Forwarded-For.
 */
# $settings['reverse_proxy_header'] = 'X_CLUSTER_CLIENT_IP';

/**
 * Set this value if your proxy server sends the client protocol in a header
 * other than X-Forwarded-Proto.
 */
# $settings['reverse_proxy_proto_header'] = 'X_FORWARDED_PROTO';

/**
 * Set this value if your proxy server sends the client protocol in a header
 * other than X-Forwarded-Host.
 */
# $settings['reverse_proxy_host_header'] = 'X_FORWARDED_HOST';

/**
 * Set this value if your proxy server sends the client protocol in a header
 * other than X-Forwarded-Port.
 */
# $settings['reverse_proxy_port_header'] = 'X_FORWARDED_PORT';

/**
 * Set this value if your proxy server sends the client protocol in a header
 * other than Forwarded.
 */
# $settings['reverse_proxy_forwarded_header'] = 'FORWARDED';

/**
 * Page caching:
 *
 * By default, Drupal sends a "Vary: Cookie" HTTP header for anonymous page
 * views. This tells a HTTP proxy that it may return a page from its local
 * cache without contacting the web server, if the user sends the same Cookie
 * header as the user who originally requested the cached page. Without "Vary:
 * Cookie", authenticated users would also be served the anonymous page from
 * the cache. If the site has mostly anonymous users except a few known
 * editors/administrators, the Vary header can be omitted. This allows for
 * better caching in HTTP proxies (including reverse proxies), i.e. even if
 * clients send different cookies, they still get content served from the cache.
 * However, authenticated users should access the site directly (i.e. not use an
 * HTTP proxy, and bypass the reverse proxy if one is used) in order to avoid
 * getting cached pages from the proxy.
 */
# $settings['omit_vary_cookie'] = TRUE;


/**
 * Cache TTL for client error (4xx) responses.
 *
 * Items cached per-URL tend to result in a large number of cache items, and
 * this can be problematic on 404 pages which by their nature are unbounded. A
 * fixed TTL can be set for these items, defaulting to one hour, so that cache
 * backends which do not support LRU can purge older entries. To disable caching
 * of client error responses set the value to 0. Currently applies only to
 * page_cache module.
 */
# $settings['cache_ttl_4xx'] = 3600;

/**
 * Expiration of cached forms.
 *
 * Drupal's Form API stores details of forms in a cache and these entries are
 * kept for at least 6 hours by default. Expired entries are cleared by cron.
 *
 * @see \Drupal\Core\Form\FormCache::setCache()
 */
# $settings['form_cache_expiration'] = 21600;

/**
 * Class Loader.
 *
 * If the APC extension is detected, the Symfony APC class loader is used for
 * performance reasons. Detection can be prevented by setting
 * class_loader_auto_detect to false, as in the example below.
 */
# $settings['class_loader_auto_detect'] = FALSE;

/*
 * If the APC extension is not detected, either because APC is missing or
 * because auto-detection has been disabled, auto-loading falls back to
 * Composer's ClassLoader, which is good for development as it does not break
 * when code is moved in the file system. You can also decorate the base class
 * loader with another cached solution than the Symfony APC class loader, as
 * all production sites should have a cached class loader of some sort enabled.
 *
 * To do so, you may decorate and replace the local $class_loader variable. For
 * example, to use Symfony's APC class loader without automatic detection,
 * uncomment the code below.
 */
/*
if ($settings['hash_salt']) {
  $prefix = 'drupal.' . hash('sha256', 'drupal.' . $settings['hash_salt']);
  $apc_loader = new \Symfony\Component\ClassLoader\ApcClassLoader($prefix, $class_loader);
  unset($prefix);
  $class_loader->unregister();
  $apc_loader->register();
  $class_loader = $apc_loader;
}
*/

/**
 * Authorized file system operations:
 *
 * The Update Manager module included with Drupal provides a mechanism for
 * site administrators to securely install missing updates for the site
 * directly through the web user interface. On securely-configured servers,
 * the Update manager will require the administrator to provide SSH or FTP
 * credentials before allowing the installation to proceed; this allows the
 * site to update the new files as the user who owns all the Drupal files,
 * instead of as the user the webserver is running as. On servers where the
 * webserver user is itself the owner of the Drupal files, the administrator
 * will not be prompted for SSH or FTP credentials (note that these server
 * setups are common on shared hosting, but are inherently insecure).
 *
 * Some sites might wish to disable the above functionality, and only update
 * the code directly via SSH or FTP themselves. This setting completely
 * disables all functionality related to these authorized file operations.
 *
 * @see https://www.drupal.org/node/244924
 *
 * Remove the leading hash signs to disable.
 */
# $settings['allow_authorize_operations'] = FALSE;

/**
 * Default mode for directories and files written by Drupal.
 *
 * Value should be in PHP Octal Notation, with leading zero.
 */
# $settings['file_chmod_directory'] = 0775;
# $settings['file_chmod_file'] = 0664;

/**
 * Public file base URL:
 *
 * An alternative base URL to be used for serving public files. This must
 * include any leading directory path.
 *
 * A different value from the domain used by Drupal to be used for accessing
 * public files. This can be used for a simple CDN integration, or to improve
 * security by serving user-uploaded files from a different domain or subdomain
 * pointing to the same server. Do not include a trailing slash.
 */
# $settings['file_public_base_url'] = 'http://downloads.example.com/files';

/**
 * Public file path:
 *
 * A local file system path where public files will be stored. This directory
 * must exist and be writable by Drupal. This directory must be relative to
 * the Drupal installation directory and be accessible over the web.
 */
# $settings['file_public_path'] = 'sites/default/files';

/**
 * Private file path:
 *
 * A local file system path where private files will be stored. This directory
 * must be absolute, outside of the Drupal installation directory and not
 * accessible over the web.
 *
 * Note: Caches need to be cleared when this value is changed to make the
 * private:// stream wrapper available to the system.
 *
 * See https://www.drupal.org/documentation/modules/file for more information
 * about securing private files.
 */
# $settings['file_private_path'] = '';

/**
 * Session write interval:
 *
 * Set the minimum interval between each session write to database.
 * For performance reasons it defaults to 180.
 */
# $settings['session_write_interval'] = 180;

/**
 * String overrides:
 *
 * To override specific strings on your site with or without enabling the Locale
 * module, add an entry to this list. This functionality allows you to change
 * a small number of your site's default English language interface strings.
 *
 * Remove the leading hash signs to enable.
 *
 * The "en" part of the variable name, is dynamic and can be any langcode of
 * any added language. (eg locale_custom_strings_de for german).
 */
# $settings['locale_custom_strings_en'][''] = array(
#   'forum'      => 'Discussion board',
#   '@count min' => '@count minutes',
# );

/**
 * A custom theme for the offline page:
 *
 * This applies when the site is explicitly set to maintenance mode through the
 * administration page or when the database is inactive due to an error.
 * The template file should also be copied into the theme. It is located inside
 * 'core/modules/system/templates/maintenance-page.html.twig'.
 *
 * Note: This setting does not apply to installation and update pages.
 */
# $settings['maintenance_theme'] = 'bartik';

/**
 * PHP settings:
 *
 * To see what PHP settings are possible, including whether they can be set at
 * runtime (by using ini_set()), read the PHP documentation:
 * http://php.net/manual/ini.list.php
 * See \Drupal\Core\DrupalKernel::bootEnvironment() for required runtime
 * settings and the .htaccess file for non-runtime settings.
 * Settings defined there should not be duplicated here so as to avoid conflict
 * issues.
 */

/**
 * If you encounter a situation where users post a large amount of text, and
 * the result is stripped out upon viewing but can still be edited, Drupal's
 * output filter may not have sufficient memory to process it.  If you
 * experience this issue, you may wish to uncomment the following two lines
 * and increase the limits of these variables.  For more information, see
 * http://php.net/manual/pcre.configuration.php.
 */
# ini_set('pcre.backtrack_limit', 200000);
# ini_set('pcre.recursion_limit', 200000);

/**
 * Active configuration settings.
 *
 * By default, the active configuration is stored in the database in the
 * {config} table. To use a different storage mechanism for the active
 * configuration, do the following prior to installing:
 * - Create an "active" directory and declare its path in $config_directories
 *   as explained under the 'Location of the site configuration files' section
 *   above in this file. To enhance security, you can declare a path that is
 *   outside your document root.
 * - Override the 'bootstrap_config_storage' setting here. It must be set to a
 *   callable that returns an object that implements
 *   \Drupal\Core\Config\StorageInterface.
 * - Override the service definition 'config.storage.active'. Put this
 *   override in a services.yml file in the same directory as settings.php
 *   (definitions in this file will override service definition defaults).
 */
# $settings['bootstrap_config_storage'] = array('Drupal\Core\Config\BootstrapConfigStorageFactory', 'getFileStorage');

/**
 * Configuration overrides.
 *
 * To globally override specific configuration values for this site,
 * set them here. You usually don't need to use this feature. This is
 * useful in a configuration file for a vhost or directory, rather than
 * the default settings.php.
 *
 * Note that any values you provide in these variable overrides will not be
 * viewable from the Drupal administration interface. The administration
 * interface displays the values stored in configuration so that you can stage
 * changes to other environments that don't have the overrides.
 *
 * There are particular configuration values that are risky to override. For
 * example, overriding the list of installed modules in 'core.extension' is not
 * supported as module install or uninstall has not occurred. Other examples
 * include field storage configuration, because it has effects on database
 * structure, and 'core.menu.static_menu_link_overrides' since this is cached in
 * a way that is not config override aware. Also, note that changing
 * configuration values in settings.php will not fire any of the configuration
 * change events.
 */
# $config['system.file']['path']['temporary'] = '/tmp';
# $config['system.site']['name'] = 'My Drupal site';
# $config['system.theme']['default'] = 'stark';
# $config['user.settings']['anonymous'] = 'Visitor';

/**
 * Fast 404 pages:
 *
 * Drupal can generate fully themed 404 pages. However, some of these responses
 * are for images or other resource files that are not displayed to the user.
 * This can waste bandwidth, and also generate server load.
 *
 * The options below return a simple, fast 404 page for URLs matching a
 * specific pattern:
 * - $config['system.performance']['fast_404']['exclude_paths']: A regular
 *   expression to match paths to exclude, such as images generated by image
 *   styles, or dynamically-resized images. The default pattern provided below
 *   also excludes the private file system. If you need to add more paths, you
 *   can add '|path' to the expression.
 * - $config['system.performance']['fast_404']['paths']: A regular expression to
 *   match paths that should return a simple 404 page, rather than the fully
 *   themed 404 page. If you don't have any aliases ending in htm or html you
 *   can add '|s?html?' to the expression.
 * - $config['system.performance']['fast_404']['html']: The html to return for
 *   simple 404 pages.
 *
 * Remove the leading hash signs if you would like to alter this functionality.
 */
# $config['system.performance']['fast_404']['exclude_paths'] = '/\/(?:styles)|(?:system\/files)\//';
# $config['system.performance']['fast_404']['paths'] = '/\.(?:txt|png|gif|jpe?g|css|js|ico|swf|flv|cgi|bat|pl|dll|exe|asp)$/i';
# $config['system.performance']['fast_404']['html'] = '<!DOCTYPE html><html><head><title>404 Not Found</title></head><body><h1>Not Found</h1><p>The requested URL "@path" was not found on this server.</p></body></html>';

/**
 * Load services definition file.
 */
$settings['container_yamls'][] = $app_root . '/' . $site_path . '/services.yml';

/**
 * Override the default service container class.
 *
 * This is useful for example to trace the service container for performance
 * tracking purposes, for testing a service container with an error condition or
 * to test a service container that throws an exception.
 */
# $settings['container_base_class'] = '\Drupal\Core\DependencyInjection\Container';

/**
 * Override the default yaml parser class.
 *
 * Provide a fully qualified class name here if you would like to provide an
 * alternate implementation YAML parser. The class must implement the
 * \Drupal\Component\Serialization\SerializationInterface interface.
 */
# $settings['yaml_parser_class'] = NULL;

/**
 * Trusted host configuration.
 *
 * Drupal core can use the Symfony trusted host mechanism to prevent HTTP Host
 * header spoofing.
 *
 * To enable the trusted host mechanism, you enable your allowable hosts
 * in $settings['trusted_host_patterns']. This should be an array of regular
 * expression patterns, without delimiters, representing the hosts you would
 * like to allow.
 *
 * For example:
 * @code
 * $settings['trusted_host_patterns'] = array(
 *   '^www\.example\.com$',
 * );
 * @endcode
 * will allow the site to only run from www.example.com.
 *
 * If you are running multisite, or if you are running your site from
 * different domain names (eg, you don't redirect http://www.example.com to
 * http://example.com), you should specify all of the host patterns that are
 * allowed by your site.
 *
 * For example:
 * @code
 * $settings['trusted_host_patterns'] = array(
 *   '^example\.com$',
 *   '^.+\.example\.com$',
 *   '^example\.org$',
 *   '^.+\.example\.org$',
 * );
 * @endcode
 * will allow the site to run off of all variants of example.com and
 * example.org, with all subdomains included.
 */

// $settings['trusted_host_patterns'] = array();

/**
 * The default list of directories that will be ignored by Drupal's file API.
 *
 * By default ignore node_modules and bower_components folders to avoid issues
 * with common frontend tools and recursive scanning of directories looking for
 * extensions.
 *
 * @see file_scan_directory()
 * @see \Drupal\Core\Extension\ExtensionDiscovery::scanDirectory()
 */
$settings['file_scan_ignore_directories'] = [
  'node_modules',
  'bower_components',
];

/**
 * The default number of entities to update in a batch process.
 *
 * This is used by update and post-update functions that need to go through and
 * change all the entities on a site, so it is useful to increase this number
 * if your hosting configuration (i.e. RAM allocation, CPU speed) allows for a
 * larger number of entities to be processed in a single batch run.
 */
$settings['entity_update_batch_size'] = 50;

/**
 * Load local development override configuration, if available.
 *
 * Use settings.local.php to override variables on secondary (staging,
 * development, etc) installations of this site. Typically used to disable
 * caching, JavaScript/CSS compression, re-routing of outgoing emails, and
 * other things that should not happen on development and testing sites.
 *
 * Keep this code block at the end of this file to take full effect.
 */
