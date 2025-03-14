<?php
/**
 * Plugin Name: Plugin ADR
 * Description: Plugin que añade un slider y una sección de ofertas en el Home Page.
 * Version: 1.0
 * Author: Adrian Islas
 */

if (!defined('ABSPATH')) {
    exit;
}

// Incluir archivos del plugin
require_once plugin_dir_path(__FILE__) . 'includes/custom-post-slider.php';
require_once plugin_dir_path(__FILE__) . 'includes/deactivate-theme-slider.php';

// Activar el plugin
function mi_plugin_activar() {
    flush_rewrite_rules();
}
register_activation_hook(__FILE__, 'mi_plugin_activar');

// Desactivar el plugin
function mi_plugin_desactivar() {
    flush_rewrite_rules();
}
register_deactivation_hook(__FILE__, 'mi_plugin_desactivar');


//Estilos del plugin
function mi_plugin_estilos() {
    wp_enqueue_style('mi-plugin-css', plugin_dir_url(__FILE__) . 'assets/css/style.css');
}
add_action('wp_enqueue_scripts', 'mi_plugin_estilos');

?>