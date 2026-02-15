=== DirectAdmin FastCGI Cache Purge ===

Contributors: mayishajiyev
Plugin Name: DirectAdmin FastCGI Cache
Description: Adds an admin bar button to purge Nginx FastCGI cache instantly with notice feedback.
Version: 1.3.0
Author: Mayis Hajiyev
Author URI: https://github.com/mayishajiyev
License: GPL2+
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: da-fastcgi-cache
Domain Path: /languages

== Description ==

DirectAdmin FastCGI Cache Purge is a lightweight WordPress plugin designed for DirectAdmin servers running Nginx with FastCGI caching.

This plugin adds a convenient admin bar button that allows site administrators to instantly purge the Nginx FastCGI cache with visual feedback. Perfect for quickly clearing cached content after updates.

== Key Features ==

* One-click FastCGI cache purge from WordPress admin bar
* Automatic cache purging on post save
* Clean AJAX-based cache clearing with user feedback
* Lightweight and efficient
* Compatible with DirectAdmin and Nginx servers
* Works on admin area and frontend

== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/fastcgi-purge/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Configure your Nginx FastCGI cache path in DirectAdmin
4. Click the "Clear FastCGI Cache" button in the admin bar to purge cache instantly

== Requirements ==

* WordPress 5.0 or higher
* PHP 7.2 or higher
* DirectAdmin Server with Nginx
* FastCGI cache configured in Nginx

== Usage ==

Once activated, you'll see a "Clear FastCGI Cache" button in the WordPress admin bar. Click it anytime to purge your Nginx FastCGI cache.

The plugin automatically purges cache when:
* A post is saved or updated
* Any content is published

== Security ==

Only users with "manage_options" capability (administrators) can purge the cache.

== Changelog ==

= 1.3.0 =
* Initial release
* One-click cache purge functionality
* Auto-purge on post save

== Support ==

For issues, feature requests, or questions, please visit:
https://github.com/mayishajiyev/fastcgi-purge

== License ==

This plugin is licensed under the GPL2+ license. See LICENSE file for details.
