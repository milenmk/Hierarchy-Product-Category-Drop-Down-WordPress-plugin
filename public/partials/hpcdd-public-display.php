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
    <div class="hpcdd-selector-box" id="hpcdd_widget">
        <div class="block-content">

            <form method="post">

                <div class="row">
                    <select class="hpcdd-select" name="lvl1" id="lvl1">
                        <option value=""><?php echo __('Select Main Category', 'hpcdd') ?></option>
                        <?php
                        foreach ($this->getTopLevelCategories() as $category) {
                            print '<option value="' . $category->term_id . '">' . $category->name . ' (' . $category->count . ')</option>';
                        }
                        ?>
                    </select>
                </div>

                <div class="row">
                    <select class="hpcdd-select" name="lvl2" id="lvl2">
                        <option value=""><?php echo __('Select First Subcategory', 'hpcdd') ?></option>
                    </select>
                </div>

                <?php if (get_option('hpcdd_levels_setting') == 3 || get_option('hpcdd_levels_setting') == 4) { ?>
                    <div class="row">
                        <select class="hpcdd-select" name="lvl3" id="lvl3">
                            <option value=""><?php echo __('Select Second Subcategory', 'hpcdd') ?></option>
                        </select>
                    </div>
                <?php } ?>

                <?php if (get_option('hpcdd_levels_setting') == 4) { ?>
                    <div class="row">
                        <select class="hpcdd-select" name="lvl4" id="lvl4">
                            <option value=""><?php echo __('Select Third Subcategory', 'hpcdd') ?></option>
                        </select>
                    </div>
                <?php } ?>

                <div class="hpcdd-button">
                    <button type="submit" name="submit" title="<?php echo __('Show Products', 'hpcdd') ?>"
                            class="button hpcdd-submit">
                        <span><?php echo __('Show Products', 'hpcdd') ?></span>
                    </button>
                </div>

            </form>

        </div>
    </div>

<?php

if (isset($_POST['submit'])) {

    $url = '';

    $tmp1 = $this->clean($_POST['lvl1']);
    $tmp2 = $this->clean($_POST['lvl2']);
    $tmp3 = $this->clean($_POST['lvl3']);
    $tmp4 = $this->clean($_POST['lvl4']);

    $tmp1 = sanitize_text_field($tmp1);
    $tmp2 = sanitize_text_field($tmp2);
    $tmp3 = sanitize_text_field($tmp3);
    $tmp4 = sanitize_text_field($tmp4);

    if (isset($tmp1) && !empty($tmp1)) {
        $cat1 = $this->getCategorySlug($tmp1);
        $url .= '?product-category=' . $cat1;
    }

    if (isset($tmp1) && isset($tmp2) && !empty($tmp1) && !empty($tmp2)) {
        $cat2 = $this->getCategorySlug($tmp2);
        $url .= '&product-category=' . $cat2;
    }

    if (isset($tmp3) && !empty($tmp3)) {
        $cat3 = $this->getCategorySlug($tmp3);
        $url .= '&product-category=' . $cat3;
    }
    if (isset($tmp4) && !empty($tmp4)) {
        $cat4 = $this->getCategorySlug($_POST['lvl4']);
        $url .= '&product-category=' . $cat4;
    }

    header('Location: ' . get_option('siteurl') . '/shop/' . $url . '');
}
