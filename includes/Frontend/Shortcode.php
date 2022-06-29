<?php
namespace Wecoder\Academy\Frontend;

/**
 * shortcode handler class
 */
class Shortcode{
    /**
     * Initializes the class
     */
    public function __construct()
    {
        add_shortcode('wecoder-academy',[$this,'render_shortcode']);
    }
    /**
     * shortcode handler class
     *
     * @param [array] $atts
     * @param [string] $content
     * @return string 
     */
    public function render_shortcode($atts, $content){
        return 'Hello from Shortcode';
    }
}