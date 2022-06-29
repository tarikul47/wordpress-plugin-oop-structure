<?php
namespace Wecoder\Academy;

/**
 * The admin class
 */
class Admin
{
    /**
     * Initialize the class
     */
    public function __construct()
    {
        $this->dispatch_actions();
        new Admin\Menu();
    }

    /**
     * Utility Function bind with admin init 
     *
     * @return void
     */
    public function dispatch_actions()
    {
        $addressbook = new Admin\Addressbook();
        add_action('admin_init', [$addressbook, 'form_handler']);
    }
}
