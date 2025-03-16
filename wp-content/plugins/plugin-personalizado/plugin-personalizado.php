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

function styles_plugin(){
    wp_enqueue_style('mi-plugin-css', plugin_dir_url(__FILE__) . 'assets/css/style.css');
}
add_action('wp_enqueue_scripts', 'styles_plugin');

function scripts_plugin() {
    wp_enqueue_script('app-js', plugin_dir_url(__FILE__) . 'assets/js/script.js', array(), null, true);
}

add_action('wp_enqueue_scripts', 'scripts_plugin');



require_once plugin_dir_path(__FILE__) . 'includes/functions.php';
require_once plugin_dir_path(__FILE__) . 'includes/custom-boxes.php';
require_once plugin_dir_path(__FILE__) . 'includes/cmb2.php';
require_once plugin_dir_path(__FILE__) . 'includes/custom-post-slider.php';
require_once plugin_dir_path(__FILE__) . 'includes/custom-post-productos-ofertas.php';


function templates_plugin($template) {
    if (is_singular('slider')) {
        $plugin_path = plugin_dir_path(__FILE__) . 'templates/single-slider.php';

        if (file_exists($plugin_path)) {
            return $plugin_path;
        } else {
            echo 'No se encontró la plantilla en: ' . $plugin_path;
        }
    }

    if (is_singular('adr_carrusel')) {
        $plugin_path = plugin_dir_path(__FILE__) . 'templates/single-carrucel.php';

        if (file_exists($plugin_path)) {
            return $plugin_path;
        } else {
            echo 'No se encontró la plantilla en: ' . $plugin_path;
        }
    }

    return $template;
}
add_filter('template_include', 'templates_plugin');




