<?php
/* new Filter */
// Enqueue scripts and styles for the collection archive and taxonomy pages
add_action('wp_enqueue_scripts', 'enqueue_collection_scripts');
function enqueue_collection_scripts() {
	wp_enqueue_script('collection-js', get_stylesheet_directory_uri() . '/js/collection.js', ['jquery'], null, true);

	// Detect current taxonomy term (if applicable)
	$current_term = get_queried_object();
	$default_filters = [
		'destination' => '',
		'collection_type' => '',
	];

	if ($current_term && isset($current_term->taxonomy)) {
		if ($current_term->taxonomy === 'destination') {
			$default_filters['destination'] = $current_term->slug;
		} elseif ($current_term->taxonomy === 'collection-type') {
			$default_filters['collection_type'] = $current_term->slug;
		}
	}

	wp_localize_script('collection-js', 'collectionData', [
		'ajax_url' => admin_url('admin-ajax.php'),
		'default_filters' => $default_filters,
	]);
}


// AJAX handler
add_action('wp_ajax_filter_collections_ajax', 'handle_collection_ajax');
add_action('wp_ajax_nopriv_filter_collections_ajax', 'handle_collection_ajax');

function handle_collection_ajax() {
    $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
    $posts_per_page = 9;

    $args = [
        'post_type'      => 'collection',
        'post_status'    => 'publish',
        'posts_per_page' => $posts_per_page,
        'paged'          => $page,
    ];

    // Taxonomy filters
    $tax_query = [];
    if (!empty($_POST['destination'])) {
        $tax_query[] = [
            'taxonomy' => 'destination',
            'field'    => 'slug',
            'terms'    => sanitize_text_field($_POST['destination']),
        ];
    }

    if (!empty($_POST['collection_type'])) {
        $tax_query[] = [
            'taxonomy' => 'collection-type',
            'field'    => 'slug',
            'terms'    => sanitize_text_field($_POST['collection_type']),
        ];
    }

    if (!empty($tax_query)) {
        $args['tax_query'] = $tax_query;
    }

    // ACF meta query
    $meta_query = [];
    if (!empty($_POST['guests'])) {
        $meta_query[] = [
            'key'     => 'guests',
            'value'   => intval($_POST['guests']),
            'compare' => '>=',
            'type'    => 'NUMERIC'
        ];
    }

    if (!empty($meta_query)) {
        $args['meta_query'] = $meta_query;
    }

    $query = new WP_Query($args);
    ob_start();

    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();

            $guests           = get_field('guests');
            $bedroom          = get_field('bedroom');
            $bathroom         = get_field('bathroom');
            $price            = get_field('price');
            $tourist_license  = get_field('tourist_license');
            $pleasures        = get_field('pleasures');
			$image_url = get_the_post_thumbnail_url(get_the_ID(), 'large');
            $destination      = get_the_terms(get_the_ID(), 'destination');
            $destination_name = ($destination && !is_wp_error($destination)) ? $destination[0]->name : '';
	
			if (!$image_url) {
				$image_url = get_stylesheet_directory_uri() . '/assets/images/fallback.webp'; // Use a real fallback image path
			}

            ?>
            <div class="collection-item">
                <?php if ($image_url): ?>
                    <a href="<?php the_permalink(); ?>">
                        <img src="<?php echo esc_url($image_url); ?>" alt="<?php the_title_attribute(); ?>" class="item-image" />
                    </a>
                <?php endif; ?>
                <p class="collection-destination"><?php echo esc_html($destination_name); ?></p>
                <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                <p class="desciption"><?php echo esc_html(wp_trim_words(get_the_excerpt(), 20)); ?></p>
                <div class="collection-infos">
                    <div class="collection-properties"><span>Guests</span><span><?php echo esc_html($guests); ?></span></div>
                    <div class="collection-properties"><span>Rooms</span><span><?php echo esc_html($bedroom); ?>, <?php echo esc_html($bathroom); ?></span></div>
                    <div class="collection-properties"><span>Tourist License</span><span><?php echo esc_html($tourist_license); ?></span></div>
                    <div class="collection-properties"><span>Pleasures</span><span><?php echo esc_html($pleasures); ?></span></div>
                    <div class="collection-properties"><span>Price from</span><span>€<?php echo esc_html($price); ?></span></div>
                </div>
            </div>
            <?php

        endwhile;
    endif;

    wp_reset_postdata();

    $html = ob_get_clean();
    $has_more = ($query->max_num_pages > $page);

    echo json_encode([
        'html'      => $html,
        'has_more'  => $has_more
    ]);

    wp_die();
}
