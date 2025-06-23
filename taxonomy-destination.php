<?php get_header(); ?>
<div class="page-wrapper">
  <div class="page-header"><div class="title-container"><h1>A curated collection of villas, homes and chalets that enliven the senses and nourish the soul.</h1></div></div>
  <?php get_template_part('template-parts/collection-filter'); ?>
  <div id="collection-results" class="collection-grid"></div>
  <div style="text-align:center;margin-top:20px;">
    <button id="load-more">Load More</button>
  </div>
</div>

<?php echo do_shortcode('[elementor-template id="3616"]'); ?>



<style>
body {
  background-color: var(--e-global-color-primary);
}

h1, h2, h3, h4, h5, h6, .font-feature {
  line-height: 87%;
  letter-spacing: .01em;
  font-feature-settings: "ss11" on, "ss12" on, "ss14" on, "ss15" on !important;
  overflow-wrap: break-word;
}

.title-container {
  max-width: 900px;
  margin: 0 auto;
}

.page-header {
  background-color: var(--e-global-color-primary);
  padding: 50px 10px;
  width: 100%;
}

.page-header h1 {
  font-feature-settings: "ss11" off, "ss12" off, "ss14" off, "ss15" off !important;
  font-family: "Romie Regular", Sans-serif;
  font-size: 3.7rem;
  font-weight: 300;
  color: #000000;
  text-align: center;
  line-height: 1em;
}

.page-wrapper {
  max-width: 1140px;
  margin: 0 auto;
  width: 100%;
  padding: 50px 10px;
}

/* Filter UI */
.collection-filters {
  display: flex;
  flex-wrap: wrap;
  background-color: #ffffff6b;
  border-radius: 5px;
  padding: 20px 10px 10px;
  margin-bottom: 30px;
}

.collection-filters label {
  flex: 1 1 33.33%;
  padding: 0 10px;
  margin-bottom: 10px;
  border-right: 1px solid #efe7e3;
  display: flex;
  flex-direction: column;
  font-weight: 500;
  font-family: sans-serif;
}

.collection-filters label:last-child {
  border-right: none;
}

.collection-filters select,
.collection-filters input[type="number"] {
  margin-top: 5px;
  padding: 6px 10px;
  font-size: 14px;
  border-radius: 3px;
  width: 100%;
  box-sizing: border-box;
}

/* Grid Layout */
.collection-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
  gap: 30px;
  margin-top: 40px;
}

.collection-item {
  padding: 0;
  transition: box-shadow 0.3s ease;
  overflow: hidden;
}

.collection-item img.item-image {
  width: 100%;
  height: 280px;
  object-fit: cover;
  display: block;
}

.collection-destination {
  font-family: Vulf Sans, sans-serif;
  font-weight: 300;
  line-height: 130%;
  letter-spacing: .05em;
  font-size: 20px;
  color: #000;
  margin: 15px 0 10px;
  text-transform: uppercase;
}

.collection-item h3 a {
  font-size: 28px;
  color: #000;
  font-family: Romie, serif;
  font-weight: 500;
  line-height: 125%;
  letter-spacing: .02em;
  display: block;
  margin: 0 0 10px;
}

p.desciption {
  font-family: Vulf Sans, sans-serif;
  font-weight: 300;
  font-size: 16px;
  color: #000;
  line-height: 1.4;
}

/* .collection-infos {
  padding: 10px 20px 20px;
} */

.collection-properties {
  padding: 8px 0;
  border-bottom: 1px dashed #ddd;
  display: flex;
  justify-content: space-between;
}

.collection-properties span {
  flex: 1 0 50%;
  color: #000;
  text-transform: uppercase;
  font-family: Vulf Sans, sans-serif;
  font-weight: 300;
  letter-spacing: .05em;
  font-size: 14px;
}

/* Buttons & Spinner */
#collection-app button {
  padding: 10px 20px;
  font-family: Vulf Sans, sans-serif;
  font-weight: 300;
  font-size: 16px;
  border: 1px dashed #000;
  color: #000;
  text-transform: uppercase;
  background-color: transparent;
  display: table;
  margin: 30px auto 0;
  cursor: pointer;
}
#load-more {
    padding: 10px 20px;
    font-family: Vulf Sans, sans-serif;
    font-weight: 300;
    line-height: 130%;
    letter-spacing: .05em;
    font-size: 18px;
    border: 1px dashed #000;
    color: #000;
    text-transform: uppercase;
    background-color: transparent;
}
.spinner {
  margin: 30px auto;
  border: 4px solid #eee;
  border-top: 4px solid #333;
  border-radius: 50%;
  width: 30px;
  height: 30px;
  animation: spin 1s linear infinite;
}

@keyframes spin {
  to { transform: rotate(360deg); }
}

/* Responsive */
@media (max-width: 767px) {
  .collection-filters label {
    flex: 1 1 100%;
    border-right: none;
  }

  .collection-item h3 a {
    font-size: 22px;
  }
}
</style>




<?php get_footer(); ?>
