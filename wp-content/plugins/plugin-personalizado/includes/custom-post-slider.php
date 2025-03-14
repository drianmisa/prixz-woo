<?php

// Register Custom Post Type
function slider_post_type() {

	$labels = array(
		'name'                  => _x( 'sliders', 'Post Type General Name', 'adr_plugin' ),
		'singular_name'         => _x( 'slider', 'Post Type Singular Name', 'adr_plugin' ),
		'menu_name'             => __( 'sliders', 'adr_plugin' ),
		'name_admin_bar'        => __( 'slider', 'adr_plugin' ),
		'archives'              => __( 'Acrhivo sliders', 'adr_plugin' ),
		'attributes'            => __( 'Atributos de slider', 'adr_plugin' ),
		'parent_item_colon'     => __( 'Slider padre', 'adr_plugin' ),
		'all_items'             => __( 'Todos los sliders', 'adr_plugin' ),
		'add_new_item'          => __( 'Agregar nuevo slider', 'adr_plugin' ),
		'add_new'               => __( 'Agregar slider', 'adr_plugin' ),
		'new_item'              => __( 'Nuevo slider', 'adr_plugin' ),
		'edit_item'             => __( 'Editar Slider', 'adr_plugin' ),
		'update_item'           => __( 'Actualizar slider', 'adr_plugin' ),
		'view_item'             => __( 'View Slider', 'adr_plugin' ),
		'view_items'            => __( 'Ver sliders', 'adr_plugin' ),
		'search_items'          => __( 'Buscar slider', 'adr_plugin' ),
		'not_found'             => __( 'No encontrado', 'adr_plugin' ),
		'not_found_in_trash'    => __( 'Slider no encontrado en basura', 'adr_plugin' ),
		'featured_image'        => __( 'Imagen Principal', 'adr_plugin' ),
		'set_featured_image'    => __( 'Cambiar imagen de slider', 'adr_plugin' ),
		'remove_featured_image' => __( 'Remover imagen principal', 'adr_plugin' ),
		'use_featured_image'    => __( 'Usar imagen principal', 'adr_plugin' ),
		'insert_into_item'      => __( 'Insertar dentro de slider', 'adr_plugin' ),
		'uploaded_to_this_item' => __( 'Actualizar este slider', 'adr_plugin' ),
		'items_list'            => __( 'slider list', 'adr_plugin' ),
		'items_list_navigation' => __( 'Lista de navegacion de sliders', 'adr_plugin' ),
		'filter_items_list'     => __( 'Filtrar la lista de sliders', 'adr_plugin' ),
	);
	$rewrite = array(
		'slug'                  => 'sliders',
		'with_front'            => false,
		'pages'                 => false,
		'feeds'                 => false,
	);
	$args = array(
		'label'                 => __( 'slider', 'adr_plugin' ),
		'description'           => __( 'Post type para sliders', 'adr_plugin' ),
		'labels'                => $labels,
		'supports'              => array( 'title' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'menu_icon'             => 'dashicons-images-alt2',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => true,
		'publicly_queryable'    => true,
		'rewrite'               => $rewrite,
		'capability_type'       => 'post',
		'show_in_rest'          => false,
	);
	register_post_type( 'slider', $args );

}
add_action( 'init', 'slider_post_type', 0 );


// Desactivar los campos personalizados en el Custom Post Type 'slider'
function desactivar_campos_personalizados_slider() {
    remove_meta_box('postcustom', 'slider', 'normal');
}
add_action('admin_menu', 'desactivar_campos_personalizados_slider');
