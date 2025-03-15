<?php 
get_header();

$plugin_url = plugin_dir_url(__DIR__);
$idPost = get_the_ID();
$sliders = get_post_meta($idPost, 'slider_group', true); 

$sliderValido = false; 
$productosSliders = []; 

?>
<div style="width: 100%">

  <swiper-container class="mySwiper" init="false">

    <?php 
    if(is_array($sliders) && count($sliders) > 0){
      foreach($sliders as $slider){  
        if(empty($slider['title_slider'])){
          continue;
        }

        $sliderValido = true; 
        $tituloSlider = esc_html($slider['title_slider']);
        $descuentoSlider = isset($slider['description_slider']) ? esc_html($slider['description_slider']) : '';
        $imagenSlider = isset($slider['image_slider']) ? esc_url($slider['image_slider']) : '';
        $productoSlider = isset($slider['image_slider_producto']) ? esc_url($slider['image_slider_producto']) : '';
        $botonSlider = isset($slider['button_slider']) ? esc_html($slider['button_slider']) : '';

        $catSliderID = isset($slider['product_category']) ? esc_html($slider['product_category']) : '';
        $category_link = get_category_link($catSliderID);
        $productosSliders[] = $productoSlider;
    ?>
    <swiper-slide style="background-image: url(<?php echo $imagenSlider; ?>);">
      <div class="grid-slider">
        <div class="item-slider">
          <img src="<?php echo $productoSlider; ?>" alt="Producto">
        </div>
        <div class="item-slider">
          <h2 class="titulo-slider"><?php echo $tituloSlider; ?></h2>
          <h3 class="descuento-slider"><?php echo $descuentoSlider; ?>% Descuento</h3>
          <a href="<?php echo $category_link; ?>" class="btn-compra">
            <?php echo $botonSlider; ?>
          </a>
        </div>
      </div>
    </swiper-slide>

    <?php 
      }
    } 

    if (!$sliderValido) {
      echo '<p>No se encontraron registros</p>';
    }
    ?>
  </swiper-container>
</div>

<?php get_footer(); ?>
