<?php
/* shortcode [collection_custom_loop] */

// Collectioni filter
function collection_custom_filter_loop_shortcode() {
    ob_start(); ?>

    <style>
        .collection-wrapper {
            display: flex;
            flex-wrap: wrap;
            gap: 2%;
        }
        .collection-filter {
            width: 22%;
        }
        .collection-results {
            width: 76%;
        }
        .collection-results-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 50px;
        }
		.collection-item img {
			height: 450px;
			width: 100%;
			object-fit: cover;
		}
		.accordion-content label:first-child {
			padding-top: 7px !important;
		}
        details.accordion summary {
            cursor: pointer;
            padding: 0px;
            font-weight: bold;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        details.accordion summary::marker { display: none; }
        .accordion-icon {
            transition: transform 0.3s ease;
            width: 16px;
            height: 16px;
        }
        details.accordion[open] .accordion-icon {
            transform: rotate(180deg);
        }
        .accordion-content { 
			padding: 0px;
		}
        .selected-items {
            font-size: 0px;
        }
		.accordion-title {
			font-family: Vulf Sans, sans-serif;
			font-weight: 300;
			line-height: 1.3em;
			letter-spacing: .05em;
			font-size: 20px;
			text-transform: uppercase;
		}
		.accordion-content label {
			font-size: 30px;
			line-height: 1.3em;
			font-family: Vulf Sans, sans-serif;
			font-weight: 500;
			letter-spacing: .02em;
			color: #000 !important;
			padding-top: 5px;
			position: relative;
			transform: translateX(0);
            transition: transform 0.5s ease, background-color 0.3s ease;
		}
		.filter-count {
			/* border-radius: 50%;
			border: 1px solid #000;
			width: 34px;
			display: table;
			text-align: center;
			height: 34px;
			line-height: 1.2em; */
			font-size: 16px;
		}
		.x-button {
			width: 38px;
			line-height: 1.3em;
			border: 1px dashed;
			height: 34px;
			display: flex;
			justify-content: center;
			align-items: center;
		}
		.accordion-content label.selected {
		  transform: translateX(3px);
		}
		.accordion-content label .x-button {
		  display: none;
		  transform: translateX(-3px);
		  transition: transform 0.4s ease, opacity 0.4s ease;
		  pointer-events: none;
		}
		.accordion-content label.selected .x-button {
		  display: flex !important;
		  transform: translateX(0);
		  pointer-events: auto;
		}
		.accordion-content label input {
			/* display: none !important; */
		}
		
		.accordion-content label input[type="checkbox"] {
		  margin-left: auto;
		  margin: 0;
		}	
		/* Modern fallback if you can't add a wrapper/class */
		.accordion-content label:has(> input[type="checkbox"]) { display:flex; width:100%; align-items:center; gap:.5rem; }
		.accordion-content label:has(> input[type="checkbox"]) > input[type="checkbox"] { margin-left:auto; }


		/* === Custom minimal checkbox === */
		label > input[type="checkbox"]{
		  appearance: none;
		  -webkit-appearance: none;
		  inline-size: 1.1rem;   /* size */
		  block-size: 1.1rem;
		  border: 1.5px solid rgba(0,0,0,.6); /* subtle outline like your mock */
		  border-radius: 2px;
		  background: transparent;
		  display: grid;         /* centers the pseudo checkmark */
		  place-content: center;
		  cursor: pointer;
		  flex: 0 0 auto;        /* don't stretch */
		  margin: 0 0 0 auto;    /* normalize + right align */
		}

		/* hover/focus polish */
		label > input[type="checkbox"]:hover {
		  border-color: rgba(0,0,0,.85);
		}
		label > input[type="checkbox"]:focus-visible {
		  outline: 2px solid #000;
		  outline-offset: 2px;
		}

		/* the checkmark */
		label > input[type="checkbox"]::after{
		  content: "";
		  width: .55rem;
		  height: .32rem;
		  border: .15rem solid #000;
		  border-top: 0;
		  border-right: 0;
		  transform: rotate(-45deg) scale(0);
		  transition: transform .15s ease-in-out;
		}
		label > input[type="checkbox"]:checked::after{
		  transform: rotate(-45deg) scale(1);
		}
		/* disabled state (optional) */
		label > input[type="checkbox"]:disabled{
		  opacity: .5;
		  cursor: not-allowed;
		}
		.accordion-content label.selected .x-button svg {
			width: 12px;
		}
		.acf-item-wrapper {
			margin-bottom: 15px;
			display: flex;
    		justify-content: space-between;
    		align-items: center;
		}
		.acf-item-wrapper label {
			font-family: Vulf Sans, sans-serif;
			font-weight: 300;
			line-height: 130%;
			letter-spacing: .05em;
			font-size: 20px;
		}
		.acf-item-wrapper button {
			 border: 1px dashed #000;
			 border-radius: 100%;
			 color: #000;
		}
		.acf-item-wrapper button:visited,
		.acf-item-wrapper button:focus,
		.acf-item-wrapper button:hover {
			background-color: transparent !important;
			color: #000 !important;
		}
		.acf-item-wrapper input[type=number] {
			width: 90px;
			text-align: center;
			color: #000;
			border: none !important;
			font-family: Vulf Sans, sans-serif;
			font-weight: 300;
			line-height: 130%;
			letter-spacing: .05em;
			font-size: 20px;
		}
		.acf-item-wrapper input::placeholder {
			color: #000;
		}
		details.accordion,
		.range-fields .acf-item-wrapper {
			margin-bottom: 15px;
			padding-top: 0px;
			padding-bottom: 27px;
			border-bottom: 1px dashed;
		}
		.collection-destination {
			font-family: Vulf Sans, sans-serif;
			font-weight: 300;
			line-height: 130%;
			letter-spacing: .05em;
			font-size: 20px;
			color: #000;
			margin-bottom: 12px;
			text-transform: uppercase;
		}
		.collection-item h3 a {
			font-size: 35px;
			color: #000 !important;
			font-family: Romie, serif;
			font-weight: 500;
			line-height: 125%;
			letter-spacing: .02em;
		}
		.collection-item p {
			font-family: Vulf Sans, sans-serif;
			font-weight: 300;
			line-height: 125%;
			font-size: 20px;
			color: #000 !important;
		}
		.collection-properties span {
			font-family: Vulf Sans, sans-serif;
			font-weight: 300;
			line-height: 130%;
			letter-spacing: .05em;
			font-size: 20px;
			color: #000 !important;
		}
		.collection-properties {
			padding: 8px 0;
			display: flex;
			justify-content: space-between;
		}
		.collection-properties:not(.no-line) {
			border-bottom: 1px dashed;
		}
		.double-buttons {
			gap: 10px;
		}
		.double-buttons a:first-child {
			width: 50%;
			border: 1px solid #000;
			text-align: center;
			padding: 8px;
			font-size: 18px;
			color: #000 !important;
			font-family: Romie, serif;
			font-weight: 400 !important;
			letter-spacing: .02em;
			text-transform: uppercase;
		}
		.double-buttons a:first-child:hover {
			color: #fff !important;
			background-color: #000000;
		}
		.double-buttons a:last-child {
			width: 50%;
			border: 1px solid #000;
			text-align: center;
			padding: 8px;
			font-size: 18px;
			color: #fff !important;
			background-color: #000000;
			font-family: Romie, serif;
			font-weight: 400 !important;
			letter-spacing: .02em;
			text-transform: uppercase;
		}
		.double-buttons a:last-child:hover {
			color: #000 !important;
			background-color: transparent;
		}
		.collection-properties span {
			flex: 1 0 50%;
			color: #000 !important;
			text-transform: uppercase;
		}
		#load-more {
			padding: 8px 15px;
			font-family: Romie, serif;
			font-weight: 300;
			line-height: 130%;
			letter-spacing: .05em;
			font-size: 18px;
			border: 1px solid #000;
			color: #000;
			text-transform: uppercase;
			background-color: transparent;
			border-radius: 0
		}
		#load-more:hover {
			background-color: transparent;
		}
		#sort_by {
			border: 1px solid #00000070 !important;
			border-radius: 0;
			padding-left: 8px;
			padding-right: 5px;
			background-color: transparent;
			text-transform: uppercase;
		}
		.custom-select-wrapper select {
		  appearance: none;
		  -webkit-appearance: none;
		  -moz-appearance: none;
		  background-color: #fff;
		  background-image: url('/wp-content/uploads/2025/05/dropdown.svg');
		  background-repeat: no-repeat;
		  background-position: right 12px center;
		  background-size: 16px;
		}

		.custom-select-wrapper select:focus {
		  border-color: #00000070;
		  outline: none;
		}
		.sort-toggle .details,
		h3.filter-title {
			font-size: 18px;
			font-weight: 300;
			font-family: Vulf Sans, sans-serif;
    		color: #000000;
			display: flex;
			justify-content: space-between;
			align-items: center;
			margin-bottom: 7px;
		}
		.term-selected .selected-items {
			font-size: 0;
			width: 16px;
			height: 16px;
			display: inline-block;
			background-color: #ff692a;
			border-radius: 100%;
			position: relative;
			top: -15px;
			line-height: 0;
		}
		.clear-all {
			opacity: 0;
			visibility: hidden;
			pointer-events: none;
			transition: opacity 0.3s ease, visibility 0.3s ease;
			background-color: transparent;
			color: #000;
			border: none;
			text-transform: uppercase;
			font-family: Vulf Sans, sans-serif;
			font-size: 20px;
			padding: 0;
		}
		.clear-all:visited,
		.clear-all:focus,
		.clear-all:hover {
			background-color: transparent !important;
			color: #000;
		}
		.clear-all.show {
			opacity: 1;
			visibility: visible;
			pointer-events: auto;
			color: #000;
		}
		summary:not(.term-selected) .selected-items {
			display: none;
		}
		
        @media screen and (max-width: 768px) {
            .collection-wrapper {
                flex-direction: column;
            }
            .collection-filter, .collection-results {
                width: 100%;
            }
            .collection-results-grid {
                grid-template-columns: 1fr;
            }
			.collection-item img {
				height: 440px !important;
			}

        }
		
		@media screen and (min-width: 769px) {
			.collection-filter {
/* 				position: sticky; */
				top: 50px;
				align-self: flex-start;
				height: fit-content;
				transition: all .5s ease-in-out;
			}
		}
    </style>

<div class="collection-wrapper">
    <div class="collection-filter">
        <form id="collection-filter-form">
			<h3 class="filter-title">
				<div class="clear-wrapper">
					<button type="button" class="clear-all">Clear All</button>
				</div>
			</h3>
				
			<!-- ✅ Sort Dropdown goes here -->
			<div class="sort-ui-wrapper" style="margin-bottom: 40px;">
				<div class="select-none custom-select-wrapper">
					<div class="sort-toggle">
					  <span class="details uppercase">Sort by</span>
					</div>
					<select id="sort_by" name="sort_by">
						<option value="recommended">Recommended</option>
						<option value="price_low_high">Price LOW-HIGH</option>
						<option value="price_high_low">Price HIGH-LOW</option>
						<option value="guests_low_high">Guests LOW-HIGH</option>
						<option value="guests_high_low">Guests HIGH-LOW</option>
						<option value="bedroom_low_high">Bedroom LOW-HIGH</option>
						<option value="bedroom_high_low">Bedroom HIGH-LOW</option>
					</select>

					<!-- Hidden field to store the selected sort value 
					<input type="hidden" id="sort_by" name="sort_by" value="recommended">-->
				</div>
			</div>				
				
			<h3 class="filter-title">
				<span>Filters</span>
			</h3>
				
                <?php foreach ([
                    'destination' => 'Destinations',
                    'collection-type' => 'Types'
                ] as $taxonomy => $label):
                    $terms = get_terms($taxonomy, ['hide_empty' => false]);
                    $slug = $taxonomy === 'collection-type' ? 'collection_type' : $taxonomy;
                ?>
                <details class="accordion" <?php echo ($taxonomy === 'destination') ? 'open' : ''; ?>>
                    <summary>
                        <span class="accordion-title"><?php echo $label; ?> <span class="selected-items <?php echo $slug; ?>-selected"></span></span>
                        <img src="/wp-content/uploads/2025/05/dropdown.svg" class="accordion-icon" alt="Toggle" />
                    </summary>
                    <div class="accordion-content">
                        <?php foreach ($terms as $term): ?>
                            <label>
							<!-- <span class="x-button"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 8 8" class="h-[10rem] w-auto"><path fill="currentColor" d="M6.632.464h.84V.62c-.768.912-2.136 2.592-2.976 3.612.9 1.056 2.436 2.952 3.06 3.612V8h-.9c-.9-1.272-1.764-2.4-2.652-3.42C3.224 5.516 1.94 7.076 1.28 8H.44v-.12c.744-.9 2.22-2.628 3.048-3.696C2.684 3.128 1.292 1.448.584.62V.464h.852c.828 1.164 1.728 2.388 2.58 3.432.636-.732 1.86-2.328 2.616-3.432"></path></svg></span> -->
                                <?php echo esc_html($term->name); ?> <span class="filter-count"><?php echo $term->count; ?></span>
								<input type="checkbox" name="<?php echo $slug; ?>[]" value="<?php echo esc_attr($term->slug); ?>">
                            </label>
                        <?php endforeach; ?>
                    </div>
                </details>
                <?php endforeach; ?>

                <div class="range-fields" style="margin-top:20px;">
                    <?php
                    foreach (['guests' => 'Guests', 'bedroom' => 'Bedrooms', 'bathroom' => 'Bathrooms'] as $field => $label): ?>
                        <div class="acf-item-wrapper">
                            <label style="display:block; margin-bottom:4px;"><strong><?php echo $label; ?></strong></label>
                            <div style="display:flex; align-items:center; gap:10px;">
                                <button type="button" class="decrement" data-target="<?php echo $field; ?>">-</button>
                                <input type="number" name="<?php echo $field; ?>" id="<?php echo $field; ?>" value="" placeholder="Any" min="0">
                                <button type="button" class="increment" data-target="<?php echo $field; ?>">+</button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
				
   </form>
</div>
        <div class="collection-results">
            <div id="collection-results" class="collection-results-grid"></div>
			<div style="margin-top: 80px; text-align: center;">
				<button id="load-more" style="padding: 10px 20px; display: none;">Load More</button>
			</div>
        </div>
    </div>


<script>
    jQuery(function($){
		let page = 1;
// 	   	function fetchCollections(reset = false, doClearAll = false) {
// 			const data = $('#collection-filter-form').serializeArray();
// 			data.push({ name: 'action', value: 'filter_collections_ajax' });
// 			data.push({ name: 'page', value: page });

// 			// Add sort_by value
// 			const sortVal = $('#sort_by').val();
// 			if (sortVal) {
// 				data.push({ name: 'sort_by', value: sortVal });
// 			}

// 			if (doClearAll) {
// 				data.push({ name: 'clear_all', value: '1' });
// 			}

// 			$.post('<?php echo admin_url('admin-ajax.php'); ?>', data, function(response){
// 				if (reset) $('#collection-results').html(response);
// 				else $('#collection-results').append(response);

// 				const maxPages = parseInt($('#collection-pagination').data('max-pages')) || 1;
// 				$('#load-more').toggle(page < maxPages);
// 			});
// 		}

		// added promise to check loading feature
		function fetchCollections(reset = false, doClearAll = false) {
			const data = $('#collection-filter-form').serializeArray();
			data.push({ name: 'action', value: 'filter_collections_ajax' });
			data.push({ name: 'page', value: page });

			// Add sort_by value
			const sortVal = $('#sort_by').val();
			if (sortVal) {
				data.push({ name: 'sort_by', value: sortVal });
			}

			if (doClearAll) {
				data.push({ name: 'clear_all', value: '1' });
			}

			// Return the AJAX promise so we can chain .then()
			return $.post('<?php echo admin_url('admin-ajax.php'); ?>', data).done(function(response) {
				if (reset) {
					$('#collection-results').html(response);
				} else {
					$('#collection-results').append(response);
				}

				const maxPages = parseInt($('#collection-pagination').data('max-pages')) || 1;
				$('#load-more').toggle(page < maxPages);
			});
		}

		

			$('#collection-filter-form').on('change', 'input, select', function() {
				page = 1;
				fetchCollections(true);
			});

			$(document).on('click', '.increment, .decrement', function () {
				const target = $(this).data('target');
				const input = $('[name="' + target + '"]');
				let val = parseInt(input.val()) || 0;
				val = $(this).hasClass('increment') ? val + 1 : Math.max(0, val - 1);
				input.val(val).trigger('change');
			});

// 			$('#load-more').on('click', function() {
//  				page++;
//  				fetchCollections();
// 			});

			// Loading while pormise running
			$('#load-more').on('click', function () {
				const $btn = $(this);
				const originalText = $btn.text();

				$btn.prop('disabled', true).text('Loading...');

				page++;

				// Use .then() to revert text AFTER loading
				fetchCollections().then(() => {
					$btn.prop('disabled', false).text(originalText);
				});
			});
		
		
			$('.clear-all').on('click', function() {
				$('#collection-filter-form input[type="checkbox"]').prop('checked', false).closest('label').removeClass('selected');
				$('#collection-filter-form input[type="number"]').val('');
				$('.selected-items').empty();
				$('summary').removeClass('term-selected');
				page = 1;
				fetchCollections(true, true);
			});

			fetchCollections(true);
		});

		// accordion items select to add an extra class
		function updateSelectedTermsUI(name) {
			const $checked = $(`input[name="${name}[]"]:checked`);
			const $summarySpan = $(`.${name}-selected`);
			const $summary = $summarySpan.closest('summary');

			if ($checked.length > 0) {
				const labels = $checked.map(function () {
					// Get the label text, excluding count and trim
					return $(this).parent().contents().filter(function () {
						return this.nodeType === 3; // Text node
					}).text().replace(/\(\d+\)/g, '').trim();
				}).get();

				$summarySpan.text(labels.join(', '));
				$summary.addClass('term-selected');
			} else {
				$summarySpan.text('');
				$summary.removeClass('term-selected');
			}
		}

		// Clear ALL Button
		jQuery(function($) {
			function isAnyFilterActive() {
				const checkboxes = $('#collection-filter-form input[type="checkbox"]:checked').length;
				const numbers = ['guests', 'bedroom', 'bathroom'].some(field => {
					const val = $(`[name="${field}"]`).val();
					return val && parseInt(val) > 0;
				});
				return checkboxes > 0 || numbers;
			}

			function toggleClearAllButton() {
				if (isAnyFilterActive()) {
					$('.clear-all').addClass('show');
				} else {
					$('.clear-all').removeClass('show');
				}
			}

			// Listen to changes on checkboxes and number fields
			$('#collection-filter-form').on('change input', 'input[type="checkbox"], input[type="number"]', function() {
				toggleClearAllButton();
			});

			// Also listen to increment/decrement buttons
			$('.increment, .decrement').on('click', function() {
				toggleClearAllButton();
			});

			// Clear All click
			$('.clear-all').on('click', function () {
				// ✅ Reset checkboxes
				$('#collection-filter-form input[type="checkbox"]').prop('checked', false).closest('label').removeClass('selected');

				// ✅ Reset number fields
				$('#collection-filter-form input[type="number"]').val('');

				// ✅ Clear visual selections
				$('.selected-items').empty();
				$('summary').removeClass('term-selected');

				// ✅ Hide the button
				$(this).removeClass('show');

				// ✅ Reset pagination
				page = 1;

				// ✅ Important: manually clear any query inputs before sending
				$('#collection-filter-form').find('input[name^="destination"], input[name^="collection_type"]').each(function () {
					$(this).prop('checked', false);
				});

				// ✅ Force fetch all
				fetchCollections(true);
			});


			// Run once on load
			toggleClearAllButton();
		});

        // Toggle selected class for checkboxes
		jQuery(document).on('change', '.accordion-content input[type="checkbox"]', function () {
			const $input = jQuery(this);
			const $label = $input.closest('label');
			const name = $input.attr('name').replace('[]', ''); // e.g. "destination"
			const $checked = jQuery(`input[name="${name}[]"]:checked`);

			// Toggle "selected" class on the label
			$label.toggleClass('selected', $input.is(':checked'));

			// Get selected labels (for summary count)
			const labels = $checked.map(function () {
				return jQuery(this).parent().contents().filter(function () {
					return this.nodeType === 3;
				}).text().replace(/\(\d+\)/, '').trim();
			}).get();

			// Update selected-items span
			const $targetSpan = jQuery(`.${name}-selected`);
			const $summary = $targetSpan.closest('summary');
			const $accordionTitle = $summary.find('.accordion-title');

			if (labels.length) {
				$targetSpan.text(labels.join(', '));
				$summary.addClass('term-selected');
				$accordionTitle.addClass('term-selected');
			} else {
				$targetSpan.text('');
				$summary.removeClass('term-selected');
				$accordionTitle.removeClass('term-selected');
			}

			// Trigger filter
			jQuery('#collection-filter-form').trigger('change');
		});

// Sort By Dropdown Logic
jQuery(function($) {
	let page = 1;

	// Toggle the custom sort dropdown (if using custom UI)
	$(document).on('click', '.sort-toggle', function(e) {
		e.preventDefault();
		$('.select-menu').slideToggle(200);
	});

	// If using a native <select> dropdown instead
	$(document).on('change', '#sort_by', function () {
		const sortValue = $(this).val();
		const sortLabel = $(this).find('option:selected').text().trim();

		// Update UI display (optional, based on your design)
		$('.sort-toggle .details.uppercase').text('Sort by: ' + sortLabel);

		// Fetch with new sort
		page = 1;
		fetchCollections(true);
	});

	// Also handle custom <ul><li><button> dropdown clicks (if used)
	$(document).on('click', '.select-menu button', function (e) {
		e.preventDefault();

		const sortValue = $(this).data('sort');
		const sortLabel = $(this).text().trim();

		// Set hidden field or <select> value (use .trigger('change') to auto-submit)
		$('#sort_by').val(sortValue).trigger('change');

		// Optional: close dropdown UI
		$('.select-menu').slideUp(200);
	});
});

</script>

    <?php
    return ob_get_clean();
}
add_shortcode('collection_custom_loop', 'collection_custom_filter_loop_shortcode');


add_action('wp_ajax_filter_collections_ajax', 'filter_collections_ajax');
add_action('wp_ajax_nopriv_filter_collections_ajax', 'filter_collections_ajax');

function filter_collections_ajax() {
    $paged = isset($_POST['page']) ? intval($_POST['page']) : 1;
    $do_clear_all = isset($_POST['clear_all']) && $_POST['clear_all'] === '1';

    $args = [
        'post_type'      => 'collection',
        'post_status'    => 'publish',
        'posts_per_page' => 6,
        'paged'          => $paged,
    ];

    if (!$do_clear_all) {
        $tax_query = ['relation' => 'AND'];
        $meta_query = ['relation' => 'AND'];

        if (!empty($_POST['destination']) && is_array($_POST['destination'])) {
            $tax_query[] = [
                'taxonomy' => 'destination',
                'field'    => 'slug',
                'terms'    => array_map('sanitize_text_field', $_POST['destination']),
            ];
        }

        if (!empty($_POST['collection_type']) && is_array($_POST['collection_type'])) {
            $tax_query[] = [
                'taxonomy' => 'collection-type',
                'field'    => 'slug',
                'terms'    => array_map('sanitize_text_field', $_POST['collection_type']),
            ];
        }

        foreach (['guests', 'bedroom', 'bathroom'] as $field) {
            if (!empty($_POST[$field])) {
                $meta_query[] = [
                    'key'     => $field,
                    'value'   => (int) $_POST[$field],
                    'compare' => '<=',
                    'type'    => 'NUMERIC',
                ];
            }
        }

        if (count($tax_query) > 1) {
            $args['tax_query'] = $tax_query;
        }

        if (count($meta_query) > 1) {
            $args['meta_query'] = $meta_query;
        }
    }
	
	// sorting start
	if (!empty($_POST['sort_by'])) {
		switch ($_POST['sort_by']) {
			case 'price_low_high':
				$args['meta_key'] = 'cprice';
				$args['orderby'] = 'meta_value_num';
				$args['order'] = 'ASC';
				$args['meta_query'][] = [
					'key'     => 'cprice',
					'value'   => '', // exclude empty values
					'compare' => '!=',
					'type'    => 'NUMERIC',
				];
				break;
			case 'price_high_low':
				$args['meta_key'] = 'cprice';
				$args['orderby'] = 'meta_value_num';
				$args['order'] = 'DESC';
				$args['meta_query'][] = [
					'key'     => 'cprice',
					'value'   => '',
					'compare' => '!=',
					'type'    => 'NUMERIC',
				];
				break;
			case 'guests_low_high':
				$args['meta_key'] = 'guests';
				$args['orderby'] = 'meta_value_num';
				$args['order'] = 'ASC';
				$args['meta_type'] = 'NUMERIC';
				break;
			case 'guests_high_low':
				$args['meta_key'] = 'guests';
				$args['orderby'] = 'meta_value_num';
				$args['order'] = 'DESC';
				$args['meta_type'] = 'NUMERIC';
				break;
			case 'bedroom_low_high':
				$args['meta_key'] = 'bedroom';
				$args['orderby'] = 'meta_value_num';
				$args['order'] = 'ASC';
				$args['meta_type'] = 'NUMERIC';
				break;
			case 'bedroom_high_low':
				$args['meta_key'] = 'bedroom';
				$args['orderby'] = 'meta_value_num';
				$args['order'] = 'DESC';
				$args['meta_type'] = 'NUMERIC';
				break;
			default:
				$args['orderby'] = 'date';
				$args['order'] = 'DESC';
		}
	}

	// sorting end
	// sorting debug
	error_log('Sort by: ' . ($_POST['sort_by'] ?? 'not set'));
	

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
			
			
            $image     = get_the_post_thumbnail(get_the_ID(), 'full');
            $title     = get_the_title();
            $excerpt   = wp_trim_words(get_the_excerpt(), 30, '...');
            $link      = get_permalink();
            $destination = get_the_terms(get_the_ID(), 'destination');
            $guests    = get_field('guests');
            $bedroom   = get_field('bedroom');
			$bathroom   = get_field('bathroom');
            $tourist_license  = get_field('tourist_license');
			$pleasures  = get_field('pleasures');
			$price  = get_field('cprice');
            ?>
			
            <div class="collection-item">
                <?php if ($image): ?>
                    <a href="<?php echo esc_url($link); ?>"><?php echo $image; ?></a>
                <?php endif; ?>

                 <div class="collection-destination">
                    <?php
                    if (!empty($destination)) {
                        $names = wp_list_pluck($destination, 'name');
                        echo implode(', ', $names);
                     }
                    ?>
                </div>

                <h3><a href="<?php echo esc_url($link); ?>"><?php echo esc_html($title); ?></a></h3>
                <p><?php// echo esc_html($excerpt); ?></p>

                <div class="collection-infos">
					<div class="collection-properties"><span>Guests</span> <span><?php echo esc_html($guests); ?></span></div>
                    <div class="collection-properties"><span>Rooms</span> <span><?php echo esc_html($bedroom); ?> Bedrooms, <?php echo esc_html($bathroom); ?> Bathrooms</span></div>
                    <div class="collection-properties"><span>Tourist License</span> <span><?php echo esc_html($tourist_license); ?></span></div>
					<div class="collection-properties"><span>Pleasures</span> <span><?php echo esc_html($pleasures); ?></span></div>
					<div class="collection-properties no-line"><span>price from</span><span><?php echo $price ? '€ ' . esc_html($price) : '0'; ?></span></div>

					<div class="collection-properties no-line double-buttons"><a href="<?php echo esc_url($link); ?>">Read More</a><a href="#">Book Now</a></div>
                </div>
            </div>

            <?php
        }
        echo '<div id="collection-pagination" data-max-pages="' . esc_attr($query->max_num_pages) . '" style="display:none;"></div>';
        wp_reset_postdata();
    } else {
        echo '<p>No collections found.</p>';
    }

    wp_die();
}
