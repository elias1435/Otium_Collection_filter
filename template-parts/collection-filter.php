<div class="collection-filters">
  <label>
    Destination:
    <select id="filter-destination">
      <option value="">All</option>
      <?php foreach (get_terms('destination', ['hide_empty' => false]) as $term): ?>
        <option value="<?= esc_attr($term->slug); ?>"><?= esc_html($term->name); ?></option>
      <?php endforeach; ?>
    </select>
  </label>

  <label>
    Type:
    <select id="filter-type">
      <option value="">All</option>
      <?php foreach (get_terms('collection-type', ['hide_empty' => false]) as $term): ?>
        <option value="<?= esc_attr($term->slug); ?>"><?= esc_html($term->name); ?></option>
      <?php endforeach; ?>
    </select>
  </label>

  <label>
    Guests:
    <input type="number" id="filter-guests" min="0" placeholder="Any">
  </label>
</div>
