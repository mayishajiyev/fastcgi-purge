=== DirectAdmin FastCGI Cache Purge ===
Contributors: mayishajiyev
Tags: cache, fastcgi, nginx, directadmin, performance, purge
Requires at least: 5.0
Tested up to: 6.5
Requires PHP: 7.2
Stable tag: 1.3.0
License: GPL v2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

== Description ==

DirectAdmin FastCGI Cache Purge is a lightweight WordPress plugin specifically designed for DirectAdmin servers running Nginx with FastCGI caching.

Quickly purge your Nginx FastCGI cache directly from the WordPress admin bar with a single click. This plugin adds a convenient button that allows site administrators to instantly clear cached content with immediate visual feedback. Perfect for updating critical content without waiting for cache expiration.

= Features =

* ✓ One-click FastCGI cache purge from WordPress admin bar
* ✓ Automatic cache purging on post/page save
* ✓ Clean AJAX-based cache clearing with user feedback
* ✓ Lightweight and zero performance impact
* ✓ Fully compatible with DirectAdmin and Nginx servers
* ✓ Works on both admin area and frontend
* ✓ Restricted to administrators only (security)

== Installation ==

1. Download the plugin from GitHub or upload via WordPress plugin uploader
2. Extract the plugin files to `/wp-content/plugins/fastcgi-purge/`
3. Activate the plugin through the 'Plugins' menu in WordPress
4. Ensure your DirectAdmin server has Nginx with FastCGI cache configured
5. Click "Clear FastCGI Cache" button in the admin bar to start using

= Automatic Setup =

Simply activate the plugin - no additional configuration needed! The plugin automatically detects your Nginx FastCGI cache path through DirectAdmin.

== Frequently Asked Questions ==

= Do I need DirectAdmin? =
Yes, this plugin is specifically designed for DirectAdmin servers with Nginx FastCGI caching enabled.

= Is this plugin secure? =
Yes! Only users with "manage_options" capability (administrators) can purge the cache.

= Will this slow down my site? =
No! The plugin is extremely lightweight and uses efficient AJAX requests.

= Does it work without Nginx? =
This plugin is designed for Nginx FastCGI cache. It may not work with other caching solutions.

== Changelog ==

= 1.3.0 =
* Initial public release
* One-click FastCGI cache purge from admin bar
* Automatic cache purging on post/page save
* AJAX-based implementation with user feedback
* Security hardening and permissions check
* Optimized for DirectAdmin Nginx servers

== Credits ==

Developed by Mayis Hajiyev
GitHub: https://github.com/mayishajiyev/fastcgi-purge

== Support & Contributions ==

Found a bug or have a feature request? Please visit our GitHub repository:
https://github.com/mayishajiyev/fastcgi-purge

Contributions are welcome! Feel free to submit pull requests or open issues.

== License ==

This plugin is licensed under the GPL v2 or later. See the LICENSE file for full details.
