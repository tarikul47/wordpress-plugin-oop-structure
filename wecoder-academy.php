<?php
/**
 * Plugin Name:       Wecoder Academy
 * Plugin URI:        https://example.com/plugins/the-basics/
 * Description:       Handle the basics with this plugin.
 * Version:           1.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Tarikul Islam
 * Author URI:        https://onlytarikul.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://example.com/my-plugin/
 * Text Domain:       wecoder-academy
 * Domain Path:       /languages
 */

if (!defined('ABSPATH')) {
    exit;
}
require_once __DIR__ . '/vendor/autoload.php';

/**
 * The main plugin class
 */
class WeCoder_Academy
{
    /**
     * plugin version
     * @return String
     */
    const version = '1.0';
    /**
     * class constructor
     */
    private function __construct()
    {
        $this->define_constant();
        register_activation_hook(__FILE__, [$this, 'activate']);
        add_action('plugins_loaded', [$this, 'init_plugin']);
    }

    /**
     * initilize a single instance
     *
     * @return \WeCoder_Academy
     */
    public static function init()
    {
        static $instance = false;
        if (!$instance) {
            $instance = new self();
        }
        return $instance;
    }

    /**
     * Define the required  plugin constatnt
     *
     * @return void
     */
    public function define_constant()
    {
        define('WC_ACADEMY_VERSION', self::version);
        define('WC_ACADEMY_FILE', __FILE__);
        define('WC_ACADEMY_PATH', __DIR__);
        define('WC_ACADEMY_URL', plugins_url('', WC_ACADEMY_FILE));
        define('WC_ACADEMY_ASSETS', WC_ACADEMY_URL . '/assets');
    }

    /**
     * Intialize the plugin
     *
     * @return void
     */
    public function init_plugin()
    {
        if (is_admin()) {
            new Wecoder\Academy\Admin();
        } else {
            new \Wecoder\Academy\Frontend();
        }
    }

    /**
     * Do stauff upon plugin activation
     *
     * @return void
     */
    public function activate()
    {
        $installer = new Wecoder\Academy\Installer();
        $installer->run();
    }

} // class end
/**
 * Initializes the main plugin
 *
 * @return \WeCoder_Academy
 */

function wecoder_academy()
{
    return WeCoder_Academy::init();
}
// kick off the plugin
wecoder_academy();
