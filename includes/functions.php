<?php

/**
 * The file that defines functions used by the plugin
 *
 * @link       https://blacktiehost.com
 * @since      1.0.0
 *
 * @package    Hpcdd
 * @subpackage Hpcdd/includes
 */

/**
 * Get subcategories for second drop-down menu
 */
function getLvl2()
{
    $parent = $_POST['lvl1'];

    $parent = clean($parent);

    sanitize_text_field($parent);

    options($parent);
}

/**
 * Get subcategories for third drop-down menu
 */
function getLvl3()
{
    $parent = $_POST['lvl2'];

    $parent = clean($parent);

    sanitize_text_field($parent);

    options($parent);
}

/**
 * Get subcategories for fourth drop-down menu
 */
function getLvl4()
{
    $parent = $_POST['lvl3'];

    $parent = clean($parent);

    sanitize_text_field($parent);

    options($parent);
}

/**
 * Clean data coming from the select, input etc. fields
 *
 * @param int $parent Data to be cleaned
 */
function clean($parent)
{
    $parent = htmlspecialchars($parent);
    $parent = stripslashes($parent);
    return trim($parent);
}

/**
 * Global options used when fetching sub-categories
 *
 * @param string $parent
 */
function options(string $parent)
{
    $show_count = 1;      // 1 for yes, 0 for no
    $pad_counts = 1;      // 1 for yes, 0 for no
    $hierarchical = 1;    // 1 for yes, 0 for no
    $title = '';
    $empty = 0;

    $args = array(
        'taxonomy' => 'product_cat',
        'orderby' => 'name',
        'show_count' => $show_count,
        'pad_counts' => $pad_counts,
        'hierarchical' => $hierarchical,
        'title_li' => $title,
        'hide_empty' => $empty,
        'parent' => $parent
    );

    $terms = get_categories($args);

    $option = '';

    foreach ($terms as $child) {
        $option .= '<option value="' . $child->term_id . '">';
        $option .= $child->name . ' (' . $child->count . ')';
        $option .= '</option>';
    }

    echo json_encode($option);
    wp_die();
}