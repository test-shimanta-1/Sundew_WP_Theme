<?php get_header(); 
global $post;

$thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'post');
?>

<br>

<?php if($thumb[0]){ ?>
<img src="<?php echo $thumb[0]; ?>" class="img-fluid" alt="">
<?php } ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post();
  the_content();
endwhile;
else: ?>
  <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
<?php endif;

 get_footer(); ?>