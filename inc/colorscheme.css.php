<?php
$primary_color = get_theme_mod('yuri_color_scheme_1', "#149ddd");
$primary_color_light = yuri_lucas_adjust_brightness($primary_color, 0.3);
$secondary_color = get_theme_mod('yuri_color_scheme_2', "#173b6c");
$text_color = get_theme_mod('yuri_text_color', "#040b14");
$link_color = get_theme_mod('yuri_link_color', "#149ddd");
$link_color_hover = get_theme_mod('yuri_link_hover_color', "#37b3ed");
$sidebar_menu_text_color = get_theme_mod('yuri_sidebar_menu_text_color', "#f4f6fd");
?>
<style>
    /*--------------------------------------------------------------
# General
--------------------------------------------------------------*/
    body {
        color: #272829;
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
    }

    a {
        color: <?php echo $link_color; ?>;
    }

    a:hover {
        color: <?php echo $link_color_hover; ?>;
    }

    h1,
    h2,
    h4,
    h6 {
        color: <?php echo $primary_color ?>;
    }

    h3,
    h5 {
        color: <?php echo $secondary_color ?>;
    }

    .section-title h2 {
        color: <?php echo $primary_color ?>;
    }

    .about .content h3 {
        color: <?php echo $secondary_color ?>;
    }

    .primary-color-scheme {
        background: <?php echo $primary_color ?> !important;
        /* color: <?php // echo $sidebar_menu_text_color 
                    ?> !important; */
    }

    .secondary-color-scheme {
        background: <?php echo $secondary_color ?> !important;
        color: <?php echo $sidebar_menu_text_color ?> !important;
    }

    #footer {
        color: <?php echo $sidebar_menu_text_color ?> !important;
    }

    .nav-menu a,
    .nav-menu a:focus {
        color: <?php echo $sidebar_menu_text_color ?> !important;
    }

    /*--------------------------------------------------------------
  # Back to top button
  --------------------------------------------------------------*/
    .back-to-top {
        background: <?php echo $primary_color ?>;
    }

    .back-to-top i {
        color: <?php echo $sidebar_menu_text_color ?>;
    }

    .back-to-top:hover {
        background: <?php echo $primary_color ?>;
        color: #fff;
    }

    .bg-light {
        color: black !important;
    }

    .bg-light .credits {
        color: black !important;
    }

    .bg-light .profile h1 a,
    .bg-light .profile h1 a:hover {
        color: #040b14 !important;
    }

    .bg-light a.nav-link {
        color: black;
    }

    .bg-primary {
        background-color: #149ddd !important;
    }

    .bg-primary a.nav-link {
        color: white;
    }

    .btn-primary {
        background: <?php echo $primary_color ?>;
        color: #fff;
    }
    
    .btn-secondary {
        background: <?php echo $secondary_color ?>;
        color: #fff;
    }

    /*--------------------------------------------------------------
  # Header
  --------------------------------------------------------------*/
    #header .profile .social-links a:hover {
        background: <?php echo $primary_color ?>;
        color: #fff;
    }

    /*--------------------------------------------------------------
  # Navigation Menu
  --------------------------------------------------------------*/
    .nav-menu a:hover i,
    .nav-menu .active i,
    .nav-menu .active:focus i,
    .nav-menu li:hover>a i {
        color: <?php echo $primary_color ?>;
    }

    .mobile-nav-toggle {
        background-color: <?php echo $primary_color ?>;
    }

    #hero p span {
        color: #fff;
        padding-bottom: 4px;
        letter-spacing: 1px;
        border-bottom: 3px solid <?php echo $primary_color ?>;
    }

    .section-title h2::after {
        background: <?php echo $primary_color ?>;
    }

    .about .content ul i {
        color: <?php echo $primary_color ?>;
    }

    .facts .count-box i {
        color: <?php echo $primary_color ?>;
    }

    .skills .progress-bar {
        background-color: <?php echo $primary_color ?>;
    }

    .portfolio #portfolio-flters li:hover,
    .portfolio #portfolio-flters li.filter-active {
        color: <?php echo $primary_color ?>;
    }

    .portfolio .portfolio-wrap .portfolio-links a {
        color: #fff;
        font-size: 28px;
        text-align: center;
        background: <?php echo $primary_color; ?>;
        transition: 0.3s;
        width: 50%;
    }

    .portfolio .portfolio-wrap .portfolio-links a:hover {
        background: <?php echo $primary_color_light; ?>;
    }

    .portfolio .portfolio-wrap .portfolio-links a+a {
        border-left: 1px solid <?php echo $primary_color; ?>;
    }

    .portfolio-details .portfolio-details-slider .swiper-pagination .swiper-pagination-bullet {
        background-color: #fff;
        border: 1px solid <?php echo $primary_color ?>;
    }

    .portfolio-details .portfolio-details-slider .swiper-pagination .swiper-pagination-bullet-active {
        background-color: <?php echo $primary_color ?>;
    }

    .services .icon {
        background: <?php echo $primary_color ?>;
        border: 1px solid <?php echo $primary_color ?>;
    }

    .services .icon-box:hover .icon i {
        color: <?php echo $primary_color ?>;
    }

    .services .title a:hover {
        color: <?php echo $primary_color ?>;
    }

    .testimonials .swiper-pagination .swiper-pagination-bullet {
        width: 12px;
        height: 12px;
        background-color: #fff;
        opacity: 1;
        border: 1px solid <?php echo $primary_color ?>;
    }

    .testimonials .swiper-pagination .swiper-pagination-bullet-active {
        background-color: <?php echo $primary_color ?>;
    }

    .contact .info i {
        color: <?php echo $primary_color ?>;
        background: #dff3fc;
    }

    .contact .info .social-links a:hover {
        background: <?php echo $primary_color ?>;
        color: #fff;
    }

    .contact .info .email:hover i,
    .contact .info .address:hover i,
    .contact .info .phone:hover i {
        background: <?php echo $primary_color ?>;
        color: #fff;
    }

    .contact .php-email-form .validate {
        color: red;
    }

    .contact .php-email-form .error-message {
        color: #fff;
        background: #ed3c0d;
    }

    .contact .php-email-form .sent-message {
        color: #fff;
        background: #18d26e;
    }

    .contact .php-email-form .loading {
        background: #fff;
    }

    .contact .php-email-form .loading:before {
        border: 3px solid #18d26e;
        border-top-color: #eee;
    }

    .contact .php-email-form button[type="submit"] {
        background: <?php echo $primary_color ?>;
        color: #fff;
    }

    .contact .php-email-form button[type="submit"]:hover {
        background: <?php echo $link_color_hover; ?>;
    }

    .reply small:hover {
        color: green;
    }

    .card-img span {
        background: <?php echo $primary_color ?>;
    }

    .btn-card {
        background-color: <?php echo $primary_color ?>;
    }

    .btn-card:hover {
        background: <?php echo $primary_color_light ?>;
    }

    .post-categories a {
        color: #eee !important;
    }
</style>