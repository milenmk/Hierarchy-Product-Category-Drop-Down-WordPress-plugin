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
                            class="button hpcdd-submit"/>
                    <span><?php echo __('Show Products', 'hpcdd') ?></span>
                    </button>
                </div>

            </form>

        </div>
    </div>

<?php

if (isset($_POST['submit'])) {

    $url = '';

    if (isset($_POST['lvl1']) && !empty($_POST['lvl1'])) {
        $cat1 = $this->getCategorySlug($_POST['lvl1']);
        $url .= '?product-category=' . $cat1;
    }

    if (isset($_POST['lvl1']) && isset($_POST['lvl2']) && !empty($_POST['lvl1']) && !empty($_POST['lvl2'])) {
        $cat2 = $this->getCategorySlug($_POST['lvl2']);
        $url .= '&product-category=' . $cat2;
    }

    if (isset($_POST['lvl3']) && !empty($_POST['lvl3'])) {
        $cat3 = $this->getCategorySlug($_POST['lvl3']);
        $url .= '&product-category=' . $cat3;
    }
    if (isset($_POST['lvl4']) && !empty($_POST['lvl4'])) {
        $cat4 = $this->getCategorySlug($_POST['lvl4']);
        $url .= '&product-category=' . $cat4;
    }

    header('Location: ' . get_option('siteurl') . '/shop/' . $url . '');
}
