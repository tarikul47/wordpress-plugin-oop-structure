<?php
namespace Wecoder\Academy\Frontend;

/**
 * shortcode handler class
 */
class Shortcode
{
    /**
     * Initializes the class
     */
    public function __construct()
    {
        add_shortcode('wecoder-academy', [$this, 'render_shortcode']);
    }

    /**
     *
     * @param [array] $atts
     * @param [string] $content
     * @return string
     */
    
    public function render_shortcode($atts, $content)
    {
        wp_enqueue_script('new-script');
        wp_enqueue_style('new-style');
        return '<div class ="academy-shortcode">Hello from Shortcode</div>';
    }


}
