<?php


/**
 * Include and setup custom metaboxes and fields. (make sure you copy this file to outside the CMB2 directory)
 *
 * Be sure to replace all instances of 'yourprefix_' with your project's prefix.
 * http://nacin.com/2010/05/11/in-wordpress-prefix-everything/
 *
 * @category YourThemeOrPlugin
 * @package  Demo_CMB2
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/CMB2/CMB2
 */

/**
 * Get the bootstrap! If using the plugin from wordpress.org, REMOVE THIS!
 */

 if ( file_exists( dirname( __FILE__ ) . '/cmb2/init.php' ) ) {
	require_once dirname( __FILE__ ) . '/cmb2/init.php';
} elseif ( file_exists( dirname( __FILE__ ) . '/CMB2/init.php' ) ) {
	require_once dirname( __FILE__ ) . '/CMB2/init.php';
}

/**
 * Conditionally displays a metabox when used as a callback in the 'show_on_cb' cmb2_box parameter
 *
 * @param  CMB2 $cmb CMB2 object.
 *
 * @return bool      True if metabox should show
 */
function yourprefix_show_if_front_page( $cmb ) {
	// Don't show this metabox if it's not the front page template.
	if ( get_option( 'page_on_front' ) !== $cmb->object_id ) {
		return false;
	}
	return true;
}

/**
 * Conditionally displays a field when used as a callback in the 'show_on_cb' field parameter
 *
 * @param  CMB2_Field $field Field object.
 *
 * @return bool              True if metabox should show
 */
function yourprefix_hide_if_no_cats( $field ) {
	// Don't show this field if not in the cats category.
	if ( ! has_tag( 'cats', $field->object_id ) ) {
		return false;
	}
	return true;
}





/*********************************************************************************
 * SECCION DE SLIDER
*********************************************************************************/


add_action('cmb2_admin_init', 'box_slider');
/**
 * Hook in and add a metabox to demonstrate repeatable grouped fields
 */
function box_slider(){

	/**
	 * Repeatable Field Groups
	 */
	$slider_group = new_cmb2_box(array(
		'id'           => 'slider_group_metabox',
		'title'        => esc_html__('Sliders', 'cmb2'),
		'object_types' => array('slider'),
		'show_on'      => array(
			'key' => 'post_type',
			'value' => 'slider',  
		),
	));


	$slider_campo_id = $slider_group->add_field( array(
		'id'          => 'slider_group',
		'type'        => 'group',
		'options'     => array(
			'group_title'    => esc_html__( 'Slider {#}', 'cmb2' ),
			'add_button'     => esc_html__( 'Agregar otro slider', 'cmb2' ),
			'remove_button'  => esc_html__( 'Remover slider', 'cmb2' ),
			'sortable'       => true,
		),
	) );

	$slider_group->add_group_field( $slider_campo_id, array(
		'name'       => esc_html__( 'Titulo Slider', 'cmb2' ),
		'id'         => 'title_slider',
		'type'       => 'text',
	) );

	$slider_group->add_group_field( $slider_campo_id, array(
		'name'        => esc_html__( 'Descripcion', 'cmb2' ),
		'description' => esc_html__( 'Escribe la descripcion del slider', 'cmb2' ),
		'id'          => 'description_slider',
		'type'        => 'textarea_small',
	) );

	$slider_group->add_group_field( $slider_campo_id, array(
		'name' => esc_html__( 'Entry Image', 'cmb2' ),
		'id'   => 'image',
		'type' => 'file',
	) );

	$slider_group->add_group_field( $slider_campo_id, array(
		'name' => esc_html__( 'Image Caption', 'cmb2' ),
		'id'   => 'buton_slider',
		'type' => 'text',
	) );
	$slider_group->add_group_field( $slider_campo_id, array(
		'name' => esc_html__( 'Url del boton slider', 'cmb2' ),
		'id'   => 'url_btn_slider',
		'type' => 'text_url',
	) );
	
}
