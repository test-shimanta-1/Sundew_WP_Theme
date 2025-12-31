<?php
// Template Name: Data Table
get_header();
?>

<br>
<br>

<div class="container">
  <table class="table display" id="myTable">
    <thead>
      <tr>
        <th scope="col">Inventor</th>
        <th scope="col">Title</th>
        <th scope="col">IPA</th>
        <th scope="col">Filling Date</th>
        <th scope="col">Grant No</th>
        <th scope="col">Grant Date</th>
        <th scope="col">Financial Year</th>
        <th scope="col">Calendar Year</th>
      </tr>
      <!-- Search row -->
      <tr class="filters">
        <th><input type="text" placeholder="Search Inventor"></th>
        <th><input type="text" placeholder="Search Title"></th>
        <th><input type="text" placeholder="Search IPA"></th>
        <th><input type="text" placeholder="Search Date"></th>
        <th><input type="text" placeholder="Search Grant No"></th>
        <th><input type="text" placeholder="Search Grant Date"></th>
        <th><input type="text" placeholder="Search FY"></th>
        <th><input type="text" placeholder="Search CY"></th>
      </tr>
    </thead>
    <tbody>
      <?php
      $args = array(
        'posts_per_page' => -1,
        'orderby' => 'date',
        'order' => 'DESC',
        'post_type' => 'our_indentor',
        'post_status' => 'publish',
      );
      $wq = new WP_Query($args);
      if ($wq->have_posts()):
        while ($wq->have_posts()):
          $wq->the_post();
          ?>
          <tr>
            <td><?php echo get_the_title(); ?></td>
            <td><?php echo get_the_content(); ?></td>
            <td><?php echo get_field("ipa_number", get_the_ID()); ?></td>
            <td><?php echo get_field("filling_date", get_the_ID()); ?></td>
            <td><?php echo get_field("grant_no", get_the_ID()); ?></td>
            <td><?php echo get_field("grant_date", get_the_ID()); ?></td>
            <td><?php echo get_field("finalcial_year", get_the_ID()); ?></td>
            <td><?php echo get_field("calendar_year", get_the_ID()); ?></td>
          </tr>
        <?php endwhile;
        wp_reset_postdata();
      endif; ?>

    </tbody>
  </table>
</div>



<?php get_footer(); ?>