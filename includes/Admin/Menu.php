<?php
namespace Wecoder\Academy\Admin;

/**
 * The Menu handler class
 */
class Menu
{

    public $addressbook;
    /**
     * Initialize the class
     */
    public function __construct($addressbook)
    {
        $this->addressbook = $addressbook;
        add_action('admin_menu', [$this, 'admin_menu']);
    }

    /**
     * Register admin menu
     *
     * @return void
     */
    public function admin_menu()
    {
        $parent_slug = 'wecoder-academy';
        $capabilty = 'manage_options';
        $hook = add_menu_page(__('Wecoder Academy', 'wecoder-academy'), __('Academy', 'wecoder-academy'), 'manage_options', 'wecoder-academy', [$this->addressbook, 'plugin_page'], 'dashicons-welcome-learn-more');
        //add_menu_page(__('Wecoder Academy', 'wecoder-academy'), __('Academy', 'wecoder-academy'), 'manage_options', 'wecoder-academy', [$this->addressbook, 'plugin_page'], 'dashicons-welcome-learn-more');
        add_submenu_page($parent_slug, __('Address Book', 'wecoder-academy'), __('Address Book', 'wecoder-academy'), $capabilty, $parent_slug, [$this->addressbook, 'plugin_page']);

        add_submenu_page($parent_slug, __('Settings', 'wecoder-academy'), __('Settings', 'wecoder-academy'), $capabilty, 'wecoder-academy-settings', [$this, 'settings_page']);

        add_action('admin_head-'.$hook, [$this, 'enqueue_assets']);

    }

    /**
     * Render the plugin page
     *
     * @return void
     */
    public function settings_page()
    {
        echo 'Hello from setting page';
    }

    public function enqueue_assets(){
        wp_enqueue_style('admin-menu-style');
    }
}
