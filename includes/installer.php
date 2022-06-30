<?php
namespace Wecoder\Academy;

/**
 * Installer class
 */

class Installer
{
    /**
     * Run the installer
     *
     * @return void
     */
    public function run()
    {
        $this->add_version();
        $this->create_table();
    }
    /**
     * Add version function
     */

    public function add_version()
    {
        // installed time
        $installed = get_option('wc_academy_installed');
        if (!$installed) {
            update_option('wc_academy_installed', time());
        }

        // update version
        update_option('wc_academy_version', WC_ACADEMY_VERSION);
    }

    /**
     * Create necessary table
     */

    public function create_table()
    {
        global $wpdb;
        $charset_collate = $wpdb->get_charset_collate();
        $schema = "CREATE TABLE IF NOT EXISTS `{$wpdb->prefix}ac_addresses` (
            `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
            `name` varchar(100) NOT NULL DEFAULT '',
            `address` varchar(255) DEFAULT NULL,
            `phone` varchar(30) DEFAULT NULL,
            `created_by` bigint(20) unsigned NOT NULL,
            `created_at` datetime NOT NULL,
            PRIMARY KEY (`id`)
        ) $charset_collate";

        if (!function_exists('dbDelta')) {
            require_once ABSPATH . 'wp-admin/includes/upgrade.php';
        }

        dbDelta($schema);
    }
}
