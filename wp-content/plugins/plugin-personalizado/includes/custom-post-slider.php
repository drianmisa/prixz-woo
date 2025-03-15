<?php

// // Función para crear el CPT de Slider
// function crear_slider_cpt() {
//     $args = array(
//         'labels' => array(
//             'name'                  => 'Sliders',
//             'singular_name'         => 'Slider',
//             'add_new'               => 'Añadir nuevo',
//             'add_new_item'          => 'Añadir nueva diapositiva',
//             'edit_item'             => 'Editar diapositiva',
//             'new_item'              => 'Nueva diapositiva',
//             'view_item'             => 'Ver diapositiva',
//             'search_items'          => 'Buscar diapositivas',
//             'not_found'             => 'No se encontraron diapositivas',
//             'not_found_in_trash'    => 'No se encontraron diapositivas en la papelera',
//             'parent_item_colon'     => '',
//             'all_items'             => 'Todas las diapositivas',
//             'menu_name'             => 'Sliders',
//         ),
//         'public'             => true,
//         'has_archive'        => true,
//         'rewrite'            => array('slug' => 'slider'),
//         'supports'           => array('title', 'editor', 'thumbnail'),
//         'show_in_rest'       => false, 
//         'show_ui'            => true,
//         'menu_position'      => 5, 
//         'menu_icon'          => 'dashicons-images-alt2', 
//     );

//     register_post_type('slider', $args);
// }
// add_action('init', 'crear_slider_cpt');

// // Desactivar los campos personalizados para el slider
// function desactivar_campos_personalizados_slider() {
//     remove_meta_box('postcustom', 'slider', 'normal');
// }
// add_action('admin_menu', 'desactivar_campos_personalizados_slider');

// // Función para mostrar los sliders en el frontend
// function shortcode_slider_individual($atts) {
//     $atts = shortcode_atts(array(
//         'id' => get_the_ID(),
//     ), $atts, 'slider_individual');

//     $post_id = $atts['id'];
//     $post = get_post($post_id);

//     // Verificar si el post existe y es del tipo 'slider'
//     if (!$post || $post->post_type !== 'slider') {
//         return '<p>No se encontró el slider.</p>';
//     }

//     // Obtener los datos de los campos repetibles (slider_group)
//     $sliders = get_post_meta($post_id, 'slider_group', true);

//     // Verificar si existen sliders
//     if (empty($sliders)) {
//         return '<p>No se encontraron sliders.</p>';
//     }

//     // Crear el HTML para mostrar los sliders
//     $output = '<div class="slider-individual">';
//     $output .= '<swiper-container class="mySwiper" init="false">';

//     // Recorrer el array de sliders y mostrarlos
//     foreach ($sliders as $slider) {
//         // Obtener los datos del slider
//         $titulo = isset($slider['title_slider']) ? esc_html($slider['title_slider']) : 'Sin título';
//         $descuento = isset($slider['description_slider']) ? esc_html($slider['description_slider']) : 'No hay descuento';
//         $imagen = isset($slider['image_slider']) ? esc_url($slider['image_slider']) : '';
//         $producto = isset($slider['image_slider_producto']) ? esc_url($slider['image_slider_producto']) : '';
//         $boton = isset($slider['button_slider']) ? esc_html($slider['button_slider']) : 'Ver más';
//         $catSliderID = isset($slider['product_category']) ? $slider['product_category'] : '';
        
//         // Obtener el enlace de la categoría de producto
//         $category_link = $catSliderID ? get_category_link($catSliderID) : '#';

//         $output .= '<swiper-slide style="background-image: url(' . $imagen . ');">';
//         $output .= '<div class="grid-slider">';
//         $output .= '<div class="item-slider">';
//         $output .= '<img src="' . $producto . '" alt="Producto">';
//         $output .= '</div>';
//         $output .= '<div class="item-slider">';
//         $output .= '<h2 class="titulo-slider">' . $titulo . '</h2>';
//         $output .= '<h3 class="descuento-slider">' . $descuento . '% Descuento</h3>';
//         $output .= '<a href="' . $category_link . '" class="btn-compra">' . $boton . '</a>';
//         $output .= '</div>';
//         $output .= '</div>';
//         $output .= '</swiper-slide>';
//     }

//     $output .= '</swiper-container>';
//     $output .= '</div>';  

//     return $output;
// }

// add_shortcode('slider_individual', 'shortcode_slider_individual');




// Función para crear el CPT de Slider
function crear_slider_cpt() {
    $args = array(
        'labels' => array(
            'name'                  => 'Sliders',
            'singular_name'         => 'Slider',
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
            'menu_name'             => 'Sliders',
        ),
        'public'             => true,
        'has_archive'        => true,
        'rewrite'            => array('slug' => 'slider'),
        'supports'           => array('title', 'editor', 'thumbnail'),
        'show_in_rest'       => false, 
        'show_ui'            => true,
        'menu_position'      => 5, 
        'menu_icon'          => 'dashicons-images-alt2', 
    );

    register_post_type('slider', $args);
}
add_action('init', 'crear_slider_cpt');

// Función para agregar la columna con el shortcode en el listado de sliders
function agregar_columna_shortcode_slider($columns) {
    $columns['shortcode'] = 'Shortcode'; // Añadir una columna para el shortcode
    return $columns;
}
add_filter('manage_slider_posts_columns', 'agregar_columna_shortcode_slider');

// Función para mostrar el shortcode en la columna del listado
function mostrar_shortcode_slider_columna($column, $post_id) {
    if ($column == 'shortcode') {
        // Crear el shortcode del slider basado en el ID del post
        $shortcode = '[slider_individual id="' . $post_id . '"]';
        echo '<input type="text" readonly value="' . esc_attr($shortcode) . '" onclick="this.select();">';
    }
}
add_action('manage_slider_posts_custom_column', 'mostrar_shortcode_slider_columna', 10, 2);

// Hacer que el campo de shortcode sea más accesible y copiable
function agregar_estilos_personalizados() {
    echo '<style>
        .column-shortcode input {
            width: 100%;
            padding: 5px;
            font-size: 14px;
            cursor: pointer;
        }
    </style>';
}
add_action('admin_head', 'agregar_estilos_personalizados');

// Función para mostrar los sliders en el frontend
function shortcode_slider_individual($atts) {
    $atts = shortcode_atts(array(
        'id' => get_the_ID(),
    ), $atts, 'slider_individual');

    $post_id = $atts['id'];
    $post = get_post($post_id);

    // Verificar si el post existe y es del tipo 'slider'
    if (!$post || $post->post_type !== 'slider') {
        return '<p>No se encontró el slider.</p>';
    }

    // Obtener los datos de los campos repetibles (slider_group)
    $sliders = get_post_meta($post_id, 'slider_group', true);

    // Verificar si existen sliders
    if (empty($sliders)) {
        return '<p>No se encontraron sliders.</p>';
    }

    // Crear el HTML para mostrar los sliders
    $output = '<div class="slider-individual">';
    $output .= '<swiper-container class="mySwiper" init="false">';

    // Recorrer el array de sliders y mostrarlos
    foreach ($sliders as $slider) {
        // Obtener los datos del slider
        $titulo = isset($slider['title_slider']) ? esc_html($slider['title_slider']) : 'Sin título';
        $descuento = isset($slider['description_slider']) ? esc_html($slider['description_slider']) : 'No hay descuento';
        $imagen = isset($slider['image_slider']) ? esc_url($slider['image_slider']) : '';
        $producto = isset($slider['image_slider_producto']) ? esc_url($slider['image_slider_producto']) : '';
        $boton = isset($slider['button_slider']) ? esc_html($slider['button_slider']) : 'Ver más';
        $catSliderID = isset($slider['product_category']) ? $slider['product_category'] : '';
        
        // Obtener el enlace de la categoría de producto
        $category_link = $catSliderID ? get_category_link($catSliderID) : '#';

        $output .= '<swiper-slide style="background-image: url(' . $imagen . ');">';
        $output .= '<div class="grid-slider">';
        $output .= '<div class="item-slider">';
        $output .= '<img src="' . $producto . '" alt="Producto">';
        $output .= '</div>';
        $output .= '<div class="item-slider">';
        $output .= '<h2 class="titulo-slider">' . $titulo . '</h2>';
        $output .= '<h3 class="descuento-slider">' . $descuento . '% Descuento</h3>';
        $output .= '<a href="' . $category_link . '" class="btn-compra">' . $boton . '</a>';
        $output .= '</div>';
        $output .= '</div>';
        $output .= '</swiper-slide>';
    }

    $output .= '</swiper-container>';
    $output .= '</div>';  

    return $output;
}

add_shortcode('slider_individual', 'shortcode_slider_individual');


function agregar_script_swiper() {
    ?>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-element-bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const swiperEl = document.querySelector('swiper-container');

            if (swiperEl) {
                const params = {
                    navigation: true,
                    // autoplay: {
                    //     delay: 3000,
                    //     disableOnInteraction: false
                    // },
                    loop: true
                };

                Object.assign(swiperEl, params);
                swiperEl.initialize();
            } else {
                console.error("Swiper no encontrado en el DOM");
            }
        });
    </script>
    <?php
}

add_action('wp_footer', 'agregar_script_swiper');










