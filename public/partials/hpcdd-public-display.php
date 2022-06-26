<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://blacktiehost.com
 * @since      1.0.0
 *
 * @package    Hpcdd
 * @subpackage Hpcdd/public/partials
 */
?>
    <div class="hpcdd-selector-box" id="<?php echo $this->getWidgetId(); ?>">
        <div class="block-content hpcdd-form">

            <form method="post">

                <div class="row">
                    <select class="hpcdd-select lvl1" name="lvl1">
                        <option value=""><?php echo __('Select Main Category', 'hpcdd') ?></option>
                        <?php
                        foreach ($this->getTopLevelCategories() as $category) {
                            print '<option value="' . $category->term_id . '">' . $category->name . ' (' . $category->count . ')</option>';
                        }
                        ?>
                    </select>
                </div>

                <div class="row">
                    <select class="hpcdd-select lvl2" name="lvl2">
                        <option value=""><?php echo __('Select First Subcategory', 'hpcdd') ?></option>
                    </select>
                </div>

                <?php if (get_option('hpcdd_levels_setting') == 3 || get_option('hpcdd_levels_setting') == 4) { ?>
                    <div class="row">
                        <select class="hpcdd-select lvl3" name="lvl3">
                            <option value=""><?php echo __('Select Second Subcategory', 'hpcdd') ?></option>
                        </select>
                    </div>
                <?php } ?>

                <?php if (get_option('hpcdd_levels_setting') == 4) { ?>
                    <div class="row">
                        <select class="hpcdd-select lvl4" name="lvl4">
                            <option value=""><?php echo __('Select Third Subcategory', 'hpcdd') ?></option>
                        </select>
                    </div>
                <?php } ?>

                <div class="hpcdd-button">
                    <button type="submit" name="submit_<?php echo $this->getWidgetId(); ?>"
                            title="<?php echo __('Show Products', 'hpcdd') ?>"
                            class="button hpcdd-submit">
                        <span><?php echo __('Show Products', 'hpcdd') ?></span>
                    </button>
                </div>

                <img class="hpcdd-loader" src="<?php print plugins_url('/', __DIR__) . 'img/loader.gif' ?>"
                     hidden/>

            </form>

        </div>
    </div>

<?php

if (isset($_POST['submit_' . $this->getWidgetId()])) {

    $url = '';

    $tmp1 = $this->cleanPostStringVal($_POST['lvl1']);
    $tmp2 = $this->cleanPostStringVal($_POST['lvl2']);
    $tmp3 = $this->cleanPostStringVal($_POST['lvl3']);
    $tmp4 = $this->cleanPostStringVal($_POST['lvl4']);

    $taxonomy = get_option('hpcdd_taxonomy_setting');

    if ($taxonomy == "product_cat") {
        $perma = get_option('woocommerce_permalinks');

        if (isset($tmp4) && !empty($tmp4)) {
            $cat4 = $this->getCategorySlug($_POST['lvl4']);
            $url .= '?' . $perma['category_base'] . '=' . $cat4;
        } elseif (isset($tmp3) && !empty($tmp3)) {
            $cat3 = $this->getCategorySlug($tmp3);
            $url .= '?' . $perma['category_base'] . '=' . $cat3;
        } elseif (isset($tmp2) && !empty($tmp2)) {
            $cat2 = $this->getCategorySlug($tmp2);
            $url .= '?' . $perma['category_base'] . '=' . $cat2;
        } elseif (isset($tmp1) && !empty($tmp1)) {
            $cat1 = $this->getCategorySlug($tmp1);
            $url .= '?' . $perma['category_base'] . '=' . $cat1;
        }

        $link = get_permalink(wc_get_page_id('shop')) . '' . esc_html($url);
        wp_redirect($link);
        exit();
    } else {
        if (isset($tmp4) && !empty($tmp4)) {
            $cat4 = $this->getCategorySlug($_POST['lvl4']);
            $url .= $taxonomy . '/' . $cat4;
        } elseif (isset($tmp3) && !empty($tmp3)) {
            $cat3 = $this->getCategorySlug($tmp3);
            $url .= $taxonomy . '/' . $cat3;
        } elseif (isset($tmp2) && !empty($tmp2)) {
            $cat2 = $this->getCategorySlug($tmp2);
            $url .= $taxonomy . '/' . $cat2;
        } elseif (isset($tmp1) && !empty($tmp1)) {
            $cat1 = $this->getCategorySlug($tmp1);
            $url .= $taxonomy . '/' . $cat1;
        }

        $link = get_home_url() . '/' . esc_html($url);
        wp_redirect($link);
        exit();
    }

}