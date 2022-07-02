<?php
namespace Wecoder\Academy;

/**
 * Assets handler
 */

class Assets
{
    public function __construct()
    {
        add_action('wp_enqueue_scripts', [$this, 'register_assets']);
        add_action('admin_enqueue_scripts', [$this, 'register_assets']);
    }

    public function get_scripts()
    {
        return [
            'new-script' => [
                'src' => WC_ACADEMY_ASSETS . '/js/frontend.js',
                'version' => filemtime(WC_ACADEMY_PATH . '/assets/js/frontend.js'),
                'deps' => ['jquery'],
            ],
        ];
    }

    public function get_style()
    {
        return [
            'new-style' => [
                'src' => WC_ACADEMY_ASSETS . '/css/frontend.css',
                'version' => filemtime(WC_ACADEMY_PATH . '/assets/css/frontend.css'),
            ], 
            'admin-menu-style' => [
                'src' => WC_ACADEMY_ASSETS . '/css/admin.css',
                'version' => filemtime(WC_ACADEMY_PATH . '/assets/css/admin.css'),
            ],
        ];
    }

    public function register_assets()
    {
        $scripts = $this->get_scripts();
        foreach ($scripts as $handle => $script) {
            $deps = isset($script['deps']) ? $script['deps'] : false;
            wp_register_script($handle, $script['src'], $deps, $script['version'], true);
        }
        $styles = $this->get_style();
        foreach ($styles as $handle => $style) {
            wp_register_style($handle, $style['src'], false, $style['version']);
        }
    }
}
