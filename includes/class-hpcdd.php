<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://blacktiehost.com
 * @since      1.0.0
 *
 * @package    Hpcdd
 * @subpackage Hpcdd/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Hpcdd
 * @subpackage Hpcdd/includes
 * @author     Milen Karaganski <milen@blacktiehost.com>
 */
class Hpcdd
{

    /**
     * The loader that's responsible for maintaining and registering all hooks that power
     * the plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      Hpcdd_Loader $loader Maintains and registers all hooks for the plugin.
     */
    protected $loader;

    /**
     * The unique identifier of this plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      string $plugin_name The string used to uniquely identify this plugin.
     */
    protected $plugin_name;

    /**
     * The current version of the plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      string $version The current version of the plugin.
     */
    protected $version;

    protected $_pluginUrl;
    protected $_pluginPath;
    protected $_widgetId = '';

    /**
     * Define the core functionality of the plugin.
     *
     * Set the plugin name and the plugin version that can be used throughout the plugin.
     * Load the dependencies and set the hooks for the admin area and
     * the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function __construct()
    {
        if (defined('HPCDD_VERSION')) {
            $this->version = HPCDD_VERSION;
        } else {
            $this->version = '1.0.0';
        }
        $this->plugin_name = 'hpcdd';

        $this->load_dependencies();
        $this->set_locale();
        $this->define_admin_hooks();
        $this->define_public_hooks();

        $this->_pluginPath = plugin_dir_path(__FILE__);
        $this->_pluginUrl = plugins_url('/', __FILE__);

    }

    /**
     * Load the required dependencies for this plugin.
     *
     * Include the following files that make up the plugin:
     *
     * - Hpcdd_Loader. Orchestrates the hooks of the plugin.
     * - Hpcdd_i18n. Defines internationalization functionality.
     * - Hpcdd_Admin. Defines all hooks for the admin area.
     * - Hpcdd_Public. Defines all hooks for the public side of the site.
     *
     * Create an instance of the loader which will be used to register the hooks
     * with WordPress.
     *
     * @since    1.0.0
     * @access   private
     */
    private function load_dependencies()
    {

        /**
         * The class responsible for orchestrating the actions and filters of the
         * core plugin.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-hpcdd-loader.php';

        /**
         * The class responsible for defining internationalization functionality
         * of the plugin.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-hpcdd-i18n.php';

        /**
         * The class responsible for defining all actions that occur in the admin area.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'admin/class-hpcdd-admin.php';

        /**
         * The class responsible for defining all actions that occur in the public-facing
         * side of the site.
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'public/class-hpcdd-public.php';

        /**
         * File with functions used by the module
         */
        require_once plugin_dir_path(dirname(__FILE__)) . 'includes/functions.php';

        $this->loader = new Hpcdd_Loader();

    }

    /**
     * Define the locale for this plugin for internationalization.
     *
     * Uses the Hpcdd_i18n class in order to set the domain and to register the hook
     * with WordPress.
     *
     * @since    1.0.0
     * @access   private
     */
    private function set_locale()
    {

        $plugin_i18n = new Hpcdd_i18n();

        $this->loader->add_action('plugins_loaded', $plugin_i18n, 'load_plugin_textdomain');

    }

    /**
     * Register all of the hooks related to the admin area functionality
     * of the plugin.
     *
     * @since    1.0.0
     * @access   private
     */
    private function define_admin_hooks()
    {

        $plugin_admin = new Hpcdd_Admin($this->get_plugin_name(), $this->get_version());

        $this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_styles');
        $this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts');

    }

    /**
     * The name of the plugin used to uniquely identify it within the context of
     * WordPress and to define internationalization functionality.
     *
     * @return    string    The name of the plugin.
     * @since     1.0.0
     */
    public function get_plugin_name()
    {
        return $this->plugin_name;
    }

    /**
     * Retrieve the version number of the plugin.
     *
     * @return    string    The version number of the plugin.
     * @since     1.0.0
     */
    public function get_version()
    {
        return $this->version;
    }

    /**
     * Register all of the hooks related to the public-facing functionality
     * of the plugin.
     *
     * @since    1.0.0
     * @access   private
     */
    private function define_public_hooks()
    {

        $plugin_public = new Hpcdd_Public($this->get_plugin_name(), $this->get_version());

        $this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_styles');
        $this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_scripts');

        add_action('wp_ajax_getLvl2', 'getLvl2');
        add_action('wp_ajax_nopriv_getLvl2', 'getLvl2');
        add_action('wp_ajax_getLvl3', 'getLvl3');
        add_action('wp_ajax_nopriv_getLvl3', 'getLvl3');
        add_action('wp_ajax_getLvl4', 'getLvl4');
        add_action('wp_ajax_nopriv_getLvl4', 'getLvl4');

        add_shortcode('hpcdd_category_selector', array($this, 'show_selector_by_shortcode'));

    }

    public function getWidgetId()
    {
        return $this->_widgetId;
    }

    public function setWidgetId($id)
    {
        $this->_widgetId = $id;
    }

    public function show_selector_by_shortcode()
    {
        $this->setWidgetId(rand(1, 99999));

        ob_start();

        $this->toHtml();

        return ob_get_clean();
    }

    /**
     *
     */
    public function toHtml()
    {
        include plugin_dir_path(dirname(__FILE__)) . 'public/partials/hpcdd-public-display.php';
    }

    /**
     * Clean data coming from the select, input etc. fields
     *
     * @param int $parent Data to be cleaned
     */
    public function clean($parent)
    {
        $parent = htmlspecialchars($parent);
        $parent = stripslashes($parent);
        return trim($parent);
    }

    /**
     * @return array
     */
    public function getTopLevelCategories()
    {

        $show_count = 1;      // 1 for yes, 0 for no
        $pad_counts = 1;      // 1 for yes, 0 for no
        $hierarchical = 1;    // 1 for yes, 0 for no
        $title = '';
        $empty = 0;
        $parentid = 0;

        $args = array(
            'taxonomy' => 'product_cat',
            'orderby' => 'name',
            'show_count' => $show_count,
            'pad_counts' => $pad_counts,
            'hierarchical' => $hierarchical,
            'title_li' => $title,
            'hide_empty' => $empty,
            'parent' => $parentid
        );

        return get_categories($args);
    }

    public function getCategorySlug($id)
    {
        $cat_slug = get_term($id, 'product_cat');

        return $cat_slug->slug;
    }

    /**
     * Run the loader to execute all of the hooks with WordPress.
     *
     * @since    1.0.0
     */
    public function run()
    {
        $this->loader->run();
    }

    /**
     * The reference to the class that orchestrates the hooks with the plugin.
     *
     * @return    Hpcdd_Loader    Orchestrates the hooks of the plugin.
     * @since     1.0.0
     */
    public function get_loader()
    {
        return $this->loader;
    }

}