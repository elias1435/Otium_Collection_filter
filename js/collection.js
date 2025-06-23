jQuery(document).ready(function ($) {
  let page = 1;
  let isLoading = false;

  	// Load collection items
function loadCollections(reset = false) {
  if (isLoading) return;
  isLoading = true;

  if (reset) {
    $('#collection-results').html('');
    page = 1;
  }

  const data = {
    action: 'filter_collections_ajax',
    page: page,
    destination: $('#filter-destination').val(),
    collection_type: $('#filter-type').val(),
    guests: $('#filter-guests').val()
  };

  $.post(collectionData.ajax_url, data, function (response) {
    let result;
    try {
      result = JSON.parse(response);
    } catch (e) {
      console.error('Invalid JSON returned:', e);
      isLoading = false;
      return;
    }

    if (reset) {
      $('#collection-results').html(result.html);
    } else {
      $('#collection-results').append(result.html);
    }

    if (!result.html) {
      $('#collection-results').html('<p>No collections found.</p>');
      $('#load-more').hide();
    } else if (result.has_more) {
      $('#load-more').show();
    } else {
      $('#load-more').hide();
    }

    isLoading = false;
  });
}



  // Apply default filters from localized data
  $('#filter-destination').val(collectionData.default_filters.destination);
  $('#filter-type').val(collectionData.default_filters.collection_type);

  // Initial load
  loadCollections(true);

// Filter events (old)
//   $('#filter-destination, #filter-type, #filter-guests').on('change input', function () {
//     loadCollections(true);
//   });
   
// For dropdowns, use change
$('#filter-destination, #filter-type').on('change', function () {
  loadCollections(true);
});

// For number field, use input + debounce
let guestsTimer;
$('#filter-guests').on('input', function () {
  clearTimeout(guestsTimer);
  guestsTimer = setTimeout(() => {
    loadCollections(true);
  }, 300);
});

	
	
  // Load more button click
  $('#load-more').on('click', function () {
    page++;
    loadCollections(false);
  });
});
