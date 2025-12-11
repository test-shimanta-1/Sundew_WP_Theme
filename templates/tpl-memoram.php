<?php 
// Template Name: Our Memorams
get_header();
?>

 <!-- Memorams Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="text-center mx-auto mb-5" style="max-width: 500px;">
                <!-- <h5 class="d-inline-block text-primary text-uppercase border-bottom border-5">Blog Post</h5> -->
                <h1 class="display-4">Our Institute Memorams</h1>
            </div>
            <div class="row g-5">

            <?php
             $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

            $args = array(
                'posts_per_page' => 2,
                'orderby' => 'date',
                'order' => 'DESC',
                 'paged' => $paged,
                'post_type' => 'our_memoriam',
            );
            $wq = new WP_Query($args);
            if ($wq->have_posts()){
                while ($wq->have_posts()){
                    $wq->the_post();
                    $thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
                    $post_id = get_the_ID();
                    ?>

                <div class="col-xl-4 col-lg-6">
                    <div class="bg-light rounded overflow-hidden">
                        <img class="img-fluid w-100" src="<?php echo $thumbnail[0]; ?>" alt="">
                        <div class="p-4">
                            <a class="h3 d-block mb-3" href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a>
                            <p class="m-0"></p>
                        </div>
                        <div class="d-flex justify-content-between border-top p-4">
                            <div class="d-flex align-items-center">
                                <!-- <img class="rounded-circle me-2" src="img/user.jpg" width="25" height="25" alt=""> -->
                                <small><?php echo get_field('person_late_date', $post_id); ?></small>
                            </div>
                            <!-- <div class="d-flex align-items-center">
                                <small class="ms-3"><i class="far fa-eye text-primary me-1"></i>12345</small>
                                <small class="ms-3"><i class="far fa-comment text-primary me-1"></i>123</small>
                            </div> -->
                        </div>
                    </div>
                </div>
                 <?php } wp_reset_postdata(); } ?>

                
                <div class="col-12 text-center">
                    <?php 
                             echo paginate_links(array(
                                'base' => get_pagenum_link(1) . '%_%',
                                'format' => 'page/%#%/',
                                'total' => $wq->max_num_pages,
                                'current' => max(1, $paged),
                                'show_all' => false,
                                'end_size' => 1,
                                'mid_size' => 2,
                                'prev_next' => true,
                                'prev_text' => __('<< Prev.','test'),
                                'next_text' => __('Next >>','test'),
                                'type' => 'list',
                             ));
                            ?>

                </div>
            </div>
        </div>
    </div>
    <!-- Blog End -->

<?php get_footer(); ?>