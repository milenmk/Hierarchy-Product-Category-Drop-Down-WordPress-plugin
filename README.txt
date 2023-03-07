=== Plugin Name ===
Contributors: milenmk
Tags: category dropdowns, dependent category selects, product categories, search by category, woocommerce categories
Requires at least: 3.4
Tested up to: 6.1.1
Stable tag: 1.5.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Show hierarchy dropdown to search woocommerce products per category.

== Description ==

This plugin displays a drop-down select with WooCommerce product categories.
It is possible to select just one or two selects and click the search button.
It displays only the categories that have products.

== Main Features: ==

Displays product categories as dependent drop-down selects.

Can be added to any page as a widget or with a shortcode.

Max depth of categories: 3 (one main category and 3 sub-categories) i.e.
- Main category
-- First subcategory
--- Second subcategory
---- Third subcategory

Use shortcode `[hpcdd_show_selector]` to display the dropdown selects on your website

This plugin is inspired by the abandoned Product Category Dropdowns.

== Shortcode parameters ==
`hplevels` – set the number of dropdows, overriding the global plugin settings. For example, setting this to `hplevels="2"` will show 2 drop-downs

`hptaxonomy` – set the taxonomy to be used for the dropdown. Default is `product_cat`

`taxonomy_id` – set the id of the taxonomy and populate the drops-downs with it's child levels. See demo for usage.

== Installation ==

=== Manual from zip file ===
1. Upload `hpcdd.zip` file to the `/wp-content/plugins/` directory and unpack it
2. Activate the plugin through the 'Plugins' menu in WordPress

=== Using WordPress Installer (Option 1) ===
1. Go to Plugins > Add new > Upload
2. Select `hpcdd.zip` file and click Install
3. Activate the plugin through the 'Plugins' menu in WordPress

=== Using WordPress Installer (Option 2)===
1. Go to Plugins > Add new
2. Search for "Hierarchy Product Category Drop Down"
3. Click Install

After plugin activation, use shortcode `[hpcdd_show_selector]` to display the dropdown selects on your website

== Changelog ==

= 1.5.0 - Released: Mar, 07 - 2023 =
* NEW: Options to set parent taxonomy ID via shortcode parameter

= 1.4.3 - Released: Mar, 01 - 2023 =
* bug fixes

= 1.4.2 - Released: Mar, 01 - 2023 =
* minor fixes

= 1.4.1 - Released: Mar, 01 - 2023 =
* minor fixes
* NEW: CSS styling for submit button

= 1.4.0 - Released: Frb, 22 - 2023 =
* NEW: Option to set form submit button always active

= 1.3.1 - Released: Oct, 26 - 2022 =
* Minor fixes

= 1.3.0 - Released: Oct, 24 - 2022 =
* NEW: Select dropdown is disabled until parent option is selected
* NEW: Submit button is disabled until last option is selected

= 1.2.1 - Released: Oct, 4 - 2022 =
* NEW setting to show or hide number of products after category name in drop-down

= 1.2.0 - Released: Jul, 10 - 2022 =
* fixed compatibility with some themes (showing categories instead of products)

= 1.1.0 - Released: Jun, 26 - 2022 =
* added parameters to shortcode
* can set number of dropdown selects with shortcode parameter
* can set the taxonomy with shortcode parameter
* FIX: search not working on some WordPress themes

= 1.0.1 - Released: Jun, 24 - 2022 =
* minor bug fixes

= 1.0.0 - Released: Jun, 21 - 2022 =
* Initial release

== Translators ==

= Available Languages =
* English (Default)
* Bulgarian

== LINKS ==

[DEMO](https://hpcdd.blacktiehost.com/)

For questions and Support: milen@blacktiehost.com