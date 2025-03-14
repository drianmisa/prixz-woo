<? 

// Desactivar el plugin
function plugin_personalizado_desactivar() {
    // Limpiar las reglas de reescritura
    flush_rewrite_rules();

    // Eliminar opciones de la base de datos (si es necesario)
    delete_option('plugin_personalizado_option');
}
register_deactivation_hook(__FILE__, 'plugin_personalizado_desactivar');

// Desinstalar el plugin
function plugin_personalizado_desinstalar() {
    delete_option('plugin_personalizado_option');
}
register_uninstall_hook(__FILE__, 'plugin_personalizado_desinstalar');

// Estilos del plugin
function plugin_personalizado_estilos() {
    if (is_page('home') || is_single() || is_archive()) {  
        wp_enqueue_style('plugin-personalizado-css', plugin_dir_url(__FILE__) . 'assets/css/style.css');
    }
}
add_action('wp_enqueue_scripts', 'plugin_personalizado_estilos');