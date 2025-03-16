<?php

    // Función para eliminar los campos personalizados en el CPT
    function adr_remover_campos_personalizados()
    {
        remove_meta_box('postcustom', 'adr_carrusel', 'normal');
        remove_meta_box('postcustom', 'slider', 'normal');
    }
    add_action('admin_menu', 'adr_remover_campos_personalizados');


    // Funcion para manejar los sliders 
    function agregar_script_swiper(){
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



    // Función para generar el formulario de login personalizado
    function login_form_shortcode() {
        if (is_user_logged_in()) {
            return '<script>window.location = "/";</script>';
        } else {
            $form_html = '
            <h3>Iniciar sesion</h3>
            <form name="loginform" id="loginform" action="' . esc_url( site_url( "wp-login.php", "login_post" ) ) . '" method="post" class="shake">
                <p>
                    <input type="text" name="log" id="user_login" class="input" value="" size="20" autocapitalize="off" autocomplete="username" placeholder="Nombre de usuario o correo electrónico" required="required">
                </p>

                <div class="user-pass-wrap">
                    <div class="wp-pwd">
                        <input type="password" name="pwd" id="user_pass" class="input password-input" value="" size="20" autocomplete="current-password" spellcheck="false" placeholder="Contraseña" required="required">
                        <button type="button" class="button button-secondary wp-hide-pw hide-if-no-js" data-toggle="0" aria-label="Mostrar la contraseña">
                            <span class="dashicons dashicons-visibility" aria-hidden="true"></span>
                        </button>
                    </div>
                </div>

                <p class="forgetmenot">
                    <input name="rememberme" type="checkbox" id="rememberme" value="forever"> <label for="rememberme">Recuérdame</label>
                </p>

                <p class="submit">
                    <input type="submit" name="wp-submit" id="wp-submit" class="button button-primary button-large" value="Acceder">
                    <input type="hidden" name="redirect_to" value="' . esc_url( home_url() ) . '">
                    <input type="hidden" name="testcookie" value="1">
                </p>

                <!-- Aquí puedes agregar botones para login social como Facebook, si lo deseas -->
                <div id="nsl-custom-login-form-main">
                    <div class="nsl-container nsl-container-block nsl-container-login-layout-below" data-align="left" style="display: block;">
                        <div class="nsl-container-buttons">
                            <a href="https://prixz.adryslas.com/wp-login.php?loginSocial=facebook" rel="nofollow" aria-label="Continue with <b>Facebook</b>" data-plugin="nsl" data-action="connect" data-provider="facebook" data-popupwidth="600" data-popupheight="679">
                                <div class="nsl-button nsl-button-default nsl-button-facebook" data-skin="dark" style="background-color:#1877F2;">
                                    <div class="nsl-button-svg-container">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1365.3 1365.3" height="24" width="24">
                                            <path d="M1365.3 682.7A682.7 682.7 0 10576 1357V880H402.7V682.7H576V532.3c0-171.1 102-265.6 257.9-265.6 74.6 0 152.8 13.3 152.8 13.3v168h-86.1c-84.8 0-111.3 52.6-111.3 106.6v128h189.4L948.4 880h-159v477a682.8 682.8 0 00576-674.3" fill="#fff"></path>
                                        </svg>
                                    </div>
                                    <div class="nsl-button-label-container">Continuar con <b>Facebook</b></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </form>';

            return $form_html;
        }
    }

    // Registrar el shortcode [login_form]
    function register_login_form_shortcode() {
        add_shortcode('login_form', 'login_form_shortcode');
    }

    // Activar el shortcode cuando el plugin se active
    add_action('init', 'register_login_form_shortcode');



    // Función para redirigir al home después de cerrar sesión
    function redirect_after_logout() {
        wp_redirect(home_url()); 
        exit(); 
    }

    // Hook para ejecutar la función cuando se cierra sesión
    add_action('wp_logout', 'redirect_after_logout');