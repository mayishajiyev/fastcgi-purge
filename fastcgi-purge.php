<?php
/*
Plugin Name: DirectAdmin FastCGI Cache
Description: Adds an admin bar button to purge Nginx FastCGI cache instantly with notice feedback.
Version: 1.3.0
Author: Mayis Hajiyev
License: GPL2+
*/

if (!defined('ABSPATH')) exit;

class DA_FastCGI_Cache {

    public function __construct() {
        add_action('admin_bar_menu', [$this, 'add_admin_bar_button'], 100);
        add_action('wp_ajax_da_fastcgi_purge', [$this, 'handle_ajax']);
        add_action('save_post', [$this, 'auto_purge']);

        // IMPORTANT: load script in BOTH admin and frontend
        add_action('admin_footer', [$this, 'ajax_script']);
        add_action('wp_footer', [$this, 'ajax_script']);
    }

    /**
     * Add button to admin bar
     */
    public function add_admin_bar_button($wp_admin_bar) {

        if (!current_user_can('manage_options')) return;

        $wp_admin_bar->add_node([
            'id'    => 'da-fastcgi-clear',
            'title' => 'Clear FastCGI Cache',
            'href'  => '#',
        ]);
    }

    /**
     * Build purge URL
     */
    private function build_purge_url($path = '/*') {

        $home   = home_url();
        $parsed = wp_parse_url($home);

        if (!$parsed || empty($parsed['host'])) return false;

        $scheme = $parsed['scheme'] ?? 'https';
        $host   = $parsed['host'];

        if ($path[0] !== '/') {
            $path = '/' . $path;
        }

        return $scheme . '://' . $host . '/purge' . $path;
    }

    /**
     * Send purge request
     */
    private function purge($path = '/*') {

        $url = $this->build_purge_url($path);
        if (!$url) return false;

        $response = wp_remote_request($url, [
            'method'    => 'GET',
            'timeout'   => 5,
            'sslverify' => false,
        ]);

        if (is_wp_error($response)) return false;

        $code = wp_remote_retrieve_response_code($response);

        return ($code >= 200 && $code < 300);
    }

    /**
     * AJAX handler
     */
    public function handle_ajax() {

        check_ajax_referer('da_fastcgi_nonce');

        if (!current_user_can('manage_options')) {
            wp_send_json_error(['message' => 'Permission denied.']);
        }

        $purged = $this->purge('/*');

        if ($purged) {
            wp_send_json_success(['message' => 'FastCGI cache cleared successfully.']);
        } else {
            wp_send_json_error(['message' => 'Failed to clear FastCGI cache.']);
        }
    }

    /**
     * Auto purge on post update
     */
    public function auto_purge($post_id) {

        if (wp_is_post_revision($post_id)) return;
        if (get_post_status($post_id) !== 'publish') return;

        $this->purge('/*');
    }

    /**
     * Inject JS for frontend + admin
     */
    public function ajax_script() {

        if (!current_user_can('manage_options')) return;
        ?>

        <script>
        document.addEventListener("DOMContentLoaded", function() {

            const button = document.querySelector("#wp-admin-bar-da-fastcgi-clear a");
            if (!button) return;

            button.addEventListener("click", function(e) {
                e.preventDefault();

                button.innerHTML = 'Clearing... <span class="spinner is-active" style="float:none;margin-left:5px;"></span>';

                fetch("<?php echo admin_url('admin-ajax.php'); ?>", {
                    method: "POST",
                    headers: {"Content-Type": "application/x-www-form-urlencoded"},
                    body: "action=da_fastcgi_purge&_wpnonce=<?php echo wp_create_nonce('da_fastcgi_nonce'); ?>"
                })
                .then(res => res.json())
                .then(data => {

                    button.innerHTML = "Clear FastCGI Cache";

                    const notice = document.createElement("div");
                    notice.style.position = "fixed";
                    notice.style.top = "50px";
                    notice.style.right = "20px";
                    notice.style.zIndex = "99999";
                    notice.style.padding = "12px 20px";
                    notice.style.color = "#fff";
                    notice.style.borderRadius = "4px";
                    notice.style.fontSize = "14px";

                    if (data.success) {
                        notice.style.background = "#46b450";
                        notice.innerText = data.data.message;
                    } else {
                        notice.style.background = "#dc3232";
                        notice.innerText = data.data.message;
                    }

                    document.body.appendChild(notice);

                    setTimeout(() => {
                        notice.remove();
                    }, 4000);

                })
                .catch(() => {
                    button.innerHTML = "Clear FastCGI Cache";
                });

            });

        });
        </script>

        <?php
    }
}

new DA_FastCGI_Cache();