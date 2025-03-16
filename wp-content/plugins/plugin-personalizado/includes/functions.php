<?php

// Función para eliminar los campos personalizados en el CPT 'adr_carrusel'
function adr_remover_campos_personalizados()
{
    remove_meta_box('postcustom', 'adr_carrusel', 'normal');
    remove_meta_box('postcustom', 'slider', 'normal');
}
add_action('admin_menu', 'adr_remover_campos_personalizados');


// Funcion para manejar los sliders


function agregar_script_swiper()
{
?>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-element-bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const swiperEl = document.querySelector('swiper-container');

            if (swiperEl) {
                const params = {
                    navigation: true,
                    autoplay: {
                        delay: 3000,
                        disableOnInteraction: false
                    },
                    loop: true
                };

                Object.assign(swiperEl, params);
                swiperEl.initialize();
            } else {
                console.error("Swiper no encontrado en el DOM");
            }




            const productoItems = document.querySelectorAll('.producto-item');

            productoItems.forEach(item => {
                item.addEventListener('mouseenter', function() {
                    this.classList.add('hovered');
                });

                item.addEventListener('mouseleave', function() {
                    this.classList.remove('hovered');
                });
            });

            // Inicializar Swiper después de manipular el DOM
            const swiperEl1 = document.querySelector('.swiper-container-carrucel');
            const swiperParams = {
                slidesPerView: 1,
                spaceBetween: 30,
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                breakpoints: {
                    640: {
                        slidesPerView: 2,
                    },
                    1024: {
                        slidesPerView: 4,
                    },
                },
                on: {
                    init() {
                        console.log("Swiper inicializado!");
                    },
                },

                autoplay: {
                        delay: 3000,
                        disableOnInteraction: false
                    },
            };

            Object.assign(swiperEl1, swiperParams);
            swiperEl1.initialize();
        });
    </script>
<?php
}

add_action('wp_footer', 'agregar_script_swiper');
