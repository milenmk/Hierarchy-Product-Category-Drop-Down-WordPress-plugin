<?php

declare(strict_types = 1);

/**
 * Provide an admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://blacktiehost.com
 * @since      1.0.0
 *
 * @package    Hpcdd
 * @subpackage Hpcdd/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="wrap">
    <h2>Hierarchy Product Category Drop Down (HPCDD)</h2>

    <br><br>
    <img src="<?php print plugins_url('/', __DIR__) . 'img/hpcdd_action.png' ?>" alt="hcpdd" width="80%" height="auto" />
    <br><br>

    <p>This plugin displays a drop-down select with WooCommerce product categories.<br>
        It is possible to select just one or two selects and click the search button.<br>
        It displays only the categories that have products.</p>

    <h3>Main Features:</h3>
    <ul>
        <li>Displays product categories as dependent drop-down selects.</li>
        <li>Can be added to any page as a widget or with a shortcode.</li>
        <li>Max depth of categories: 3 (one main category and 3 sub-categories) i.e.<br>
            - Main category<br>
            -- First subcategory<br>
            --- Second subcategory<br>
            ---- Third subcategory<br>
        </li>
    </ul>

    This plugin is inspired by the abandoned <a href="https://wordpress.org/plugins/product-category-dropdowns/">Product Category Dropdowns</a>.<br><br>

    For questions and Support: <a href="mailto:milen@blacktiehost.com">milen@blacktiehost.com</a>
</div>