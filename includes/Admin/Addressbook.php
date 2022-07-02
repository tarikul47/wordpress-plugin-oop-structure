<?php
namespace Wecoder\Academy\Admin;

use Wecoder\Academy\Traits\Form_Error;

/**
 * Address book handler class
 */

class Addressbook
{
    use Form_Error;
    /**
     * Default error property
     */
    public $errors = [];

    public function plugin_page()
    {
        $action = isset($_GET['action']) ? $_GET['action'] : 'list';
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;

        switch ($action) {
            case 'new':
                $template = __DIR__ . '/views/address-new.php';
                break;
            case 'edit':
                $address = wc_ac_get_single_address($id);
                $template = __DIR__ . '/views/address-edit.php';
                break;

            case 'view':
                $template = __DIR__ . '/views/address-view.php';
                break;

            default:
                $template = __DIR__ . '/views/address-list.php';
                break;
        }

        if (file_exists($template)) {
            include $template;
        }
    }

    /**
     * Handler the form
     */

    public function form_handler()
    {
        if (!isset($_POST['submit_address'])) {
            return;
        }
        if (!wp_verify_nonce($_POST['_wpnonce'], 'new-address')) {
            wp_die('Are you cheating?');
        }
        if (!current_user_can('manage_options')) {
            wp_die('Are you cheating?');
        }

        $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
        $name = isset($_POST['name']) ? sanitize_text_field($_POST['name']) : '';
        $address = isset($_POST['address']) ? sanitize_textarea_field($_POST['address']) : '';
        $phone = isset($_POST['phone']) ? sanitize_text_field($_POST['phone']) : '';

        if (empty($name)) {
            $this->errors['name'] = __('Please provide a name', 'wecoder_academy');
        }

        if (empty($phone)) {
            $this->errors['phone'] = __('Please provide a phone number', 'wecoder_academy');
        }

        if (!empty($this->errors)) {
            return;
        }

        $args = [
            'name' => $name,
            'address' => $address,
            'phone' => $phone,
        ];

        if ($id) {
            $args['id'] = $id;
        }
        $insert_id = wc_ac_insert_address($args);

        if (is_wp_error($insert_id)) {
            wp_die($insert_id->get_error_message());
        }

        if ($id) {
            $redirect_to = admin_url('admin.php?page=wecoder-academy&action=edit&address-updated=true&id=' . $id, 'admin');
        } else {
            $redirect_to = admin_url('admin.php?page=wecoder-academy&inserted=true', 'admin');
        }
        // redirect
        wp_redirect($redirect_to);

        // var_dump(wc_ac_insert_address());

        var_dump($_POST);
        //exit;
    }

    public function delete_address()
    {
        if (!wp_verify_nonce($_REQUEST['_wpnonce'], 'wc-ac-delete-address')) {
            wp_die('Are you cheating?');
        }
        if (!current_user_can('manage_options')) {
            wp_die('Are you cheating?');
        }
        $id = isset($_REQUEST['id']) ? intval($_REQUEST['id']) : 0;

        if (wd_ac_delete_address($id)) {
            $redirect_to = admin_url('admin.php?page=wecoder-academy&address-deleted=true', 'admin');
        }else{
            $redirect_to = admin_url('admin.php?page=wecoder-academy&address-deleted=false', 'admin');
        }

        wp_redirect($redirect_to);
        exit;

    }
}
