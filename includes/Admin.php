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
        $addressbook = new Admin\Addressbook();
        $this->dispatch_actions($addressbook);
        new Admin\Menu($addressbook);
    }

    /**
     * Utility Function bind with admin init
     *
     * @return void
     */
    public function dispatch_actions($addressbook)
    {
        add_action('admin_init', [$addressbook, 'form_handler']);
        add_action('admin_post_wc-ac-delete-address', [$addressbook, 'delete_address']);
    }
}
