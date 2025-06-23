<?php
$guests = get_field('guests');
$bedroom = get_field('bedroom');
$bathroom = get_field('bathroom');
$price = get_field('price');
$tourist_license = get_field('tourist_license');
$pleasures = get_field('pleasures');
$image = get_the_post_thumbnail_url(get_the_ID(), 'large');
$destination = get_the_terms(get_the_ID(), 'destination');
$destination_name = $destination && !is_wp_error($destination) ? $destination[0]->name : '';
?>
<div class="collection-item">
  <?php if ($image): ?>
    <a href="<?php the_permalink(); ?>"><img src="<?= esc_url($image); ?>" alt="<?= esc_attr(get_the_title()); ?>" class="item-image"></a>
  <?php endif; ?>
  <p class="collection-destination"><?= esc_html($destination_name); ?></p>
  <h3><a href="<?php the_permalink(); ?>"><?= esc_html(get_the_title()); ?></a></h3>
  <p><?= esc_html(wp_trim_words(get_the_excerpt(), 20)); ?></p>
  <div class="collection-infos">
    <div class="collection-properties"><span>Guests</span><span><?= esc_html($guests); ?></span></div>
    <div class="collection-properties"><span>Rooms</span><span><?= esc_html($bedroom); ?>, <?= esc_html($bathroom); ?></span></div>
    <div class="collection-properties"><span>Tourist License</span><span><?= esc_html($tourist_license); ?></span></div>
    <div class="collection-properties"><span>Pleasures</span><span><?= esc_html($pleasures); ?></span></div>
    <div class="collection-properties"><span>Price from</span><span>€<?= esc_html($price); ?></span></div>
  </div>
</div>
