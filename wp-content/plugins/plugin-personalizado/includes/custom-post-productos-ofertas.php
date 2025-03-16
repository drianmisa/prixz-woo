<?php

// Función para crear el CPT de Carrusel
function adr_crear_carrusel_cpt() {
    $args = array(
        'labels' => array(
            'name'                  => 'Carrusels',
            'singular_name'         => 'Carrusel',
            'add_new'               => 'Añadir nuevo',
            'add_new_item'          => 'Añadir nueva diapositiva',
            'edit_item'             => 'Editar diapositiva',
            'new_item'              => 'Nueva diapositiva',
            'view_item'             => 'Ver diapositiva',
            'search_items'          => 'Buscar diapositivas',
            'not_found'             => 'No se encontraron diapositivas',
            'not_found_in_trash'    => 'No se encontraron diapositivas en la papelera',
            'parent_item_colon'     => '',
            'all_items'             => 'Todas las diapositivas',
            'menu_name'             => 'Carrusels',
        ),
        'public'             => true,
        'has_archive'        => true,
        'rewrite'            => array('slug' => 'adr-carrusel'),  
        'supports'           => array('title'),
        'show_in_rest'       => false, 
        'show_ui'            => true,
        'menu_position'      => 5, 
        'menu_icon'          => 'dashicons-images-alt2', 
    );

    register_post_type('adr_carrusel', $args);  
}
add_action('init', 'adr_crear_carrusel_cpt');

// Función para agregar la columna con el shortcode en el listado de carrusels
function adr_agregar_columna_shortcode_carrusel($columns) {
    $columns['adr_shortcode'] = 'Shortcode'; 
    return $columns;
}
add_filter('manage_adr_carrusel_posts_columns', 'adr_agregar_columna_shortcode_carrusel');

// Función para mostrar el shortcode en la columna del listado
function adr_mostrar_shortcode_carrusel_columna($column, $post_id) {
    if ($column == 'adr_shortcode') {
        $shortcode = '[adr_carrusel_individual id="' . $post_id . '"]';
        echo '<input type="text" readonly value="' . esc_attr($shortcode) . '" onclick="this.select();">';
    }
}
add_action('manage_adr_carrusel_posts_custom_column', 'adr_mostrar_shortcode_carrusel_columna', 10, 2);

// Hacer que el campo de shortcode sea más accesible y copiable
function adr_agregar_estilos_personalizados() {
    echo '<style>
        .column-adr_shortcode input {
            width: 100%;
            padding: 5px;
            font-size: 14px;
            cursor: pointer;
        }
    </style>';
}
add_action('admin_head', 'adr_agregar_estilos_personalizados');

// Shortcode para mostrar el carrusel
function shortcode_carrusel_adr($atts) {
    $atts = shortcode_atts(array(
        'id' => get_the_ID(),
    ), $atts, 'adr_carrusel_individual');

    $post_id = $atts['id'];

    // Obtener los productos del carrusel
    $carrusels = get_post_meta($post_id, 'productos_oferta', true); 

    // Verificar si existen productos
    if (empty($carrusels)) {
        return '<p>No se encontraron productos para el carrusel.</p>';
    }

    // Crear el HTML para mostrar los productos del carrusel
    $output = '<div class="carrusel-adr">'; 
    $output .= '<swiper-container class="myCarrusel swiper-container-carrucel" init="false" pagination="true" pagination-clickable="true" space-between="30">';

    // Recorrer el array de productos y mostrarlos
    foreach ($carrusels as $product_id) {
        $product_url = get_permalink($product_id);

        $producto = wc_get_product($product_id);

        // Si el producto no existe, saltar al siguiente
        if (!$producto) {
            continue;
        }

        // Obtener los datos del producto
        $imagen_url = wp_get_attachment_url($producto->get_image_id());
        $titulo_producto = $producto->get_title();
        $precio_producto = $producto->get_price_html();
        
        // Mostrar la imagen del producto
        $output .= '<swiper-slide class="producto-item">';
        $output .= '<a href="'. $product_url .'">';
        $output .= '<img class="img-carrusel" src="' . $imagen_url . '" alt="' . esc_attr($titulo_producto) . '">';

        // Mostrar el título del producto
        $output .= '<div class="titulo-producto">' . esc_html($titulo_producto) . '</div>';

        // Mostrar el precio con descuento del producto
        $output .= '<div class="precio-producto">' . $precio_producto . '</div>';

        // Agregar la etiqueta de oferta
        $output .= '<div class="etiqueta-oferta-prod">Oferta</div>';

        $output .= '</a>';
        $output .= '</swiper-slide>';
    }

    $output .= '</swiper-container>';
    $output .= '</div>';

    return $output;
}

// Registrar el shortcode para mostrar el carrusel
add_shortcode('adr_carrusel_individual', 'shortcode_carrusel_adr');

?>
