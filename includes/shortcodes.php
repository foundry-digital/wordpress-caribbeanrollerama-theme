<?php

/******************************************************************************************************
 * 
 *  SHORTCODE PROGRAM
 */

add_shortcode('program', function ($attr) {

  $attributes = shortcode_atts([
    'date' => '',
    'category' => '',
  ], $attr);



  if (isset($_GET['category'])) {
    $value = htmlspecialchars($_GET['category']);
  } else {
    $value = $attributes['category'];
  }

  ob_start();

  $args = array(
    'post_type' => 'events',
    'posts_per_page' => -1,
    'facetwp' => true,
    'meta_query' => array(
      'relation'      => 'AND',
      array(
        'key' => 'event_start_date',
        'value' => $attributes['date'],
        'compare' => 'LIKE'
      ),
      array(
        'key' => 'event_category', // name of custom field
        'value' => $value,
        'compare' => 'LIKE'
      ),
    ),
    'orderby'        => 'meta_value',
    'meta_key'       => 'event_start_date',
    'meta_type'      => 'DATETIME',
    'order'          => 'ASC',
  );
  $parent = new WP_Query($args);

  $uniqueCategories = [];

?>

  <?php if ($parent->have_posts()) : ?>

    <?php while ($parent->have_posts()) : $parent->the_post(); ?>

      <div class="accordion-item">
        <div class="accordion-header">
          <span><?php echo date('g:ia', strtotime(get_field('event_start_date'))); ?></span>
          <?php the_title(); ?>
        </div>
        <div class="accordion-content">
          <?php the_content(); ?>
        </div>
      </div>

    <?php endwhile; ?>

  <?php else : ?>
    <p class="no-results">No events found.</p>
  <?php endif;

  wp_reset_query();

  return ob_get_clean();
});
