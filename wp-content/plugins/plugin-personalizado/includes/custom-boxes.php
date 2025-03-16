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

if (file_exists(dirname(__FILE__) . '/cmb2/init.php')) {
    require_once dirname(__FILE__) . '/cmb2/init.php';
} elseif (file_exists(dirname(__FILE__) . '/CMB2/init.php')) {
    require_once dirname(__FILE__) . '/CMB2/init.php';
}

/**
 * Conditionally displays a metabox when used as a callback in the 'show_on_cb' cmb2_box parameter
 *
 * @param  CMB2 $cmb CMB2 object.
 *
 * @return bool      True if metabox should show
 */
function yourprefix_show_if_front_page($cmb)
{
    // Don't show this metabox if it's not the front page template.
    if (get_option('page_on_front') !== $cmb->object_id) {
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
function yourprefix_hide_if_no_cats($field)
{
    // Don't show this field if not in the cats category.
    if (! has_tag('cats', $field->object_id)) {
        return false;
    }
    return true;
}





/*********************************************************************************
 * SECCION DE SLIDER
 *********************************************************************************/

add_action('cmb2_admin_init', 'box_slider');

/**
 * Agrega un metabox para sliders con campos repetibles
 */
function box_slider()
{

    // Crear el metabox para el slider
    $slider_group = new_cmb2_box(array(
        'id'           => 'slider_group_metabox',
        'title'        => esc_html__('Sliders', 'cmb2'),
        'object_types' => array('slider'),
        'show_on'      => array(
            'key'   => 'post_type',
            'value' => 'slider',
        ),
    ));

    // Crear el grupo de sliders
    $slider_campo_id = $slider_group->add_field(array(
        'id'      => 'slider_group',
        'type'    => 'group',
        'options' => array(
            'group_title'    => esc_html__('Slider {#}', 'cmb2'),
            'add_button'     => esc_html__('Agregar otro slider', 'cmb2'),
            'remove_button'  => esc_html__('Remover slider', 'cmb2'),
            'sortable'       => true,
        ),
    ));

    // Campo: Título del Slider
    $slider_group->add_group_field($slider_campo_id, array(
        'name' => esc_html__('Título Slider', 'cmb2'),
        'id'   => 'title_slider',
        'type' => 'text',
    ));

    // Campo: Descuento (Número entre 0 y 100)
    $slider_group->add_group_field($slider_campo_id, array(
        'name'        => esc_html__('Descuento', 'cmb2'),
        'description' => esc_html__('Escribe el porcentaje de descuento', 'cmb2'),
        'id'          => 'description_slider',
        'type'        => 'text_small',
        'attributes'  => array(
            'type'  => 'number',
            'min'   => '0',
            'max'   => '100',
            'step'  => '1',
        ),
    ));

    // Campo: Imagen de fondo del Slider
    $slider_group->add_group_field($slider_campo_id, array(
        'name' => esc_html__('Background Slider', 'cmb2'),
        'id'   => 'image_slider',
        'type' => 'file',
        'text' => array(
            'add_upload_file_text' => esc_html__('Agregar Imagen', 'cmb2'),
        ),
        'query_args'    => array(
            'type' => 'image',
        ),
        'preview_size'  => array(100, 100),
    ));

    // Campo: Imagen del producto en el Slider
    $slider_group->add_group_field($slider_campo_id, array(
        'name' => esc_html__('Imagen Producto', 'cmb2'),
        'id'   => 'image_slider_producto',
        'type' => 'file',
        'text' => array(
            'add_upload_file_text' => esc_html__('Agregar Imagen Producto', 'cmb2'),
        ),
        'query_args'    => array(
            'type' => 'image',
        ),
        'preview_size'  => array(100, 100),
    ));

    // Campo: URL del botón en el Slider
    $slider_group->add_group_field($slider_campo_id, array(
        'name' => esc_html__('Texto boton', 'cmb2'),
        'id'   => 'button_slider',
        'type' => 'text',
    ));

    // Obtener categorías de productos en WooCommerce
    $categories = get_terms(array(
        'taxonomy'   => 'product_cat',
        'hide_empty' => false,
    ));

    $options = array();

    if (!empty($categories) && !is_wp_error($categories)) {
        foreach ($categories as $category) {
            $options[$category->term_id] = $category->name;
        }
    }

    // Campo: Selección de categoría de producto
    $slider_group->add_group_field($slider_campo_id, array(
        'name'        => esc_html__('Categoría de Producto', 'cmb2'),
        'description' => esc_html__('Selecciona una categoría de productos de WooCommerce', 'cmb2'),
        'id'          => 'product_category',
        'type'        => 'select',
        'options'     => $options,
    ));
}



/*********************************************************************************
 * CARRUSEL PRODUCTOS
 *********************************************************************************/


add_action('cmb2_admin_init', 'box_productos');
function box_productos()
{
    // Crear el metabox para el carrusel
    $carrusel_group = new_cmb2_box(array(
        'id'           => 'carrusel_group_metabox',
        'title'        => esc_html__('Carruseles', 'cmb2'),
        'object_types' => array('adr_carrusel'),  
        'show_on'      => array(
            'key'   => 'post_type',
            'value' => 'adr_carrusel',  
        ),
    ));

    $productos_en_oferta = get_posts(array(
        'post_type'      => 'product',
        'posts_per_page' => -1, 
        'meta_key'       => '_sale_price', 
        'meta_value'     => '',  
        'meta_compare'   => '>', 
    ));

    $productos_opciones = array();

    foreach ($productos_en_oferta as $producto) {
        $productos_opciones[$producto->ID] = $producto->post_title; 
    }

    $carrusel_group->add_field(array(
        'name'    => esc_html__('Selecciona productos en oferta', 'cmb2'),
        'desc'    => esc_html__('Selecciona productos que están en oferta. Máximo 9 productos.', 'cmb2'),
        'id'      => 'productos_oferta', 
        'type'    => 'multicheck',  
        'options' => $productos_opciones, 
        'column'  => true,
    ));

    add_action('admin_footer', 'limitar_seleccion_productos');
}
add_action('cmb2_admin_init', 'box_productos');

function limitar_seleccion_productos(){
?>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            var maxSeleccion = 6; 
            $('input[name="productos_oferta[]"]').on('change', function() {
                var checked = $('input[name="productos_oferta[]"]:checked').length;
                if (checked > maxSeleccion) {
                    alert('Solo puedes seleccionar un máximo de ' + maxSeleccion + ' productos.');
                    $(this).prop('checked', false); 
                }
            });
        });
    </script>
<?php
}