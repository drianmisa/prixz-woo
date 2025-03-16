<?php 
get_header();

$plugin_url = plugin_dir_url(__DIR__);
$idPost = get_the_ID();
$carrusels = get_post_meta($idPost, 'productos_oferta', true); 

$carruselsValidos = false; 
$productosSliders = []; 

if(is_array($carrusels) && count($carrusels) > 0){
  foreach ($carrusels as $carrusel) {
    $product = wc_get_product($carrusel); 
    if ($product) {
      $productosSliders[] = $product;  
    }
  }
}
?>

<body>

<swiper-container init="false" class="mySwiper" pagination="true" pagination-clickable="true" space-between="30">
  <?php
  // Mostrar los productos en el carrusel
  if (!empty($productosSliders)) {
    foreach ($productosSliders as $product) {
      $imagen_url = wp_get_attachment_url($product->get_image_id());
      $titulo_producto = $product->get_title();
      $precio_producto = $product->get_price_html();
      $add_to_cart_url = esc_url($product->add_to_cart_url());
      $product_id = $product->get_id();

      // Verificar si el producto está en el carrito
      $cart_item_key = WC()->cart->find_product_in_cart(WC()->cart->generate_cart_id($product_id));
      $is_in_cart = !empty($cart_item_key);  
      ?>
      <swiper-slide class="producto-item">
        <img class="img-carrusel" src="<?php echo $imagen_url; ?>" alt="<?php echo esc_attr($titulo_producto); ?>">
        <div class="titulo-producto"><?php echo esc_html($titulo_producto); ?></div>
        <div class="precio-producto"><?php echo $precio_producto; ?></div>
        <div class="etiqueta-oferta-prod">Oferta</div>
      </swiper-slide>
    <?php
    }
  }
  ?>
</swiper-container>


<?php get_footer(); ?>


