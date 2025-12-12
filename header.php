<!doctype html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php wp_title(); ?></title>
    <?php wp_head(); ?>
  </head>
  <body <?php body_class(); ?> >

  <main>

  <?php //echo get_template_part('template-parts/topbar-header'); ?>

  <!-- Navbar Start -->
    <div class="container-fluid sticky-top bg-white shadow-sm">
        <div class="container">
            <nav class="navbar navbar-expand-lg bg-white navbar-light py-3 py-lg-0">
                <a href="<?php echo get_home_url(); ?>" class="navbar-brand">
                    <h1 class="m-0 text-uppercase text-primary"><i class="fa fa-clinic-medical me-2"></i>Medinova</h1>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto py-0">
                        <?php
                        // wp_nav_menu(array(
                        // 'menu' => 'Navbar-Menu',
                        // 'container' => false,
                        // 'items_wrap' => '%3$s'
                        // ));
                        ?>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <!-- Navbar End -->