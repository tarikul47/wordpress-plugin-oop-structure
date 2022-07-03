<?php
namespace Wecoder\Academy;

/**
 * Ajax handle class
 */
class Ajax
{
    public function __construct()
    {
        add_action('wp_ajax_wc_academy_enquiry', [$this, 'submit_enquiry']);
    }

    public function submit_enquiry()
    {
        if (wp_verify_nonce($_REQUEST['_wpnonce'], 'wc-ac-enquiry-form3')) {
            wp_send_json_success([
                'message' => 'Enquiry has been send successfully!',
            ]);
        } else {
            wp_send_json_error([
                'message' => 'Enquiry has been send failed!',
            ]);
        }

    }
}
