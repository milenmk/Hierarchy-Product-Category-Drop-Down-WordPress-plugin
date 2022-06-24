<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://blacktiehost.com
 * @since      1.0.0
 *
 * @package    Hpcdd
 * @subpackage Hpcdd/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Hpcdd
 * @subpackage Hpcdd/admin
 * @author     Milen Karaganski <milen@blacktiehost.com>
 */
class Hpcdd_Admin
{

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string $plugin_name The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string $version The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @param string $plugin_name The name of this plugin.
     * @param string $version The version of this plugin.
     * @since    1.0.0
     */
    public function __construct($plugin_name, $version)
    {

        $this->plugin_name = $plugin_name;
        $this->version = $version;
        add_action('admin_menu', array($this, 'addPluginAdminMenu'), 9);
        add_action('admin_init', array($this, 'registerAndBuildFields'));

    }

    /**
     * Register the stylesheets for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_styles()
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Hpcdd_Loader as all the hooks are defined
         * in that particular class.
         *
         * The Hpcdd_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/hpcdd-admin.css', array(), $this->version);

    }

    /**
     * Register the JavaScript for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts()
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Hpcdd_Loader as all the hooks are defined
         * in that particular class.
         *
         * The Hpcdd_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/hpcdd-admin.js', array('jquery'), $this->version);

    }

    public function addPluginAdminMenu()
    {
        //add_menu_page( $page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position );
        add_menu_page($this->plugin_name, 'HPCDD', 'administrator', $this->plugin_name, array($this, 'displayPluginAdminDashboard'), plugin_dir_url( __FILE__ ) . 'img/hpcdd.png', 26);

        //add_submenu_page( '$parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function );
        add_submenu_page($this->plugin_name, __('HPCDD Settings', 'hpcdd'), __('Settings', 'hpcdd'), 'administrator', $this->plugin_name . '-settings', array($this, 'displayPluginAdminSettings'));
    }

    public function displayPluginAdminDashboard()
    {
        require_once 'partials/' . $this->plugin_name . '-admin-display.php';
    }

    public function displayPluginAdminSettings()
    {

        $tab = Hpcdd()->cleanPostStringVal($_GET['tab']);

        // set this var to be used in the settings-display view
        $active_tab = $tab ?? 'general';
        if (isset($_GET['error_message'])) {
            add_action('admin_notices', array($this, 'hpcddSettingsMessages'));
            do_action('admin_notices', $_GET['error_message']);
        }
        require_once 'partials/' . $this->plugin_name . '-admin-settings-display.php';
    }

    public function hpcddSettingsMessages($error_message)
    {
        switch ($error_message) {
            case '1':
                $message = __('There was an error adding this setting. Please try again.  If this persists, shoot us an email.', 'hpcdd');
                $err_code = esc_attr('hpcdd_levels_setting');
                $setting_field = 'hpcdd_levels_setting';
                break;
        }
        $type = 'error';
        add_settings_error(
            $setting_field,
            $err_code,
            $message,
            $type
        );
    }

    public function registerAndBuildFields()
    {
        /**
         * First, we add_settings_section. This is necessary since all future settings must belong to one.
         * Second, add_settings_field
         * Third, register_setting
         */
        add_settings_section(
        // ID used to identify this section and with which to register options
            'hpcdd_general_section',
            // Title to be displayed on the administration page
            '',
            // Callback used to render the description of the section
            array($this, 'hpcdd_display_general_account'),
            // Page on which to add this section of options
            'hpcdd_general_settings'
        );
        unset($args);
        $args = array(
            'type' => 'input',
            'subtype' => 'number',
            'id' => 'hpcdd_levels_setting',
            'name' => 'hpcdd_levels_setting',
            'required' => 'required="required"',
            'step' => '1',
            'min' => '2',
            'max' => '4',
            'value_type' => 'normal',
            'wp_data' => 'option'
        );

        add_settings_field(
            'hpcdd_levels_setting',
            __('Number of dropdown select fields', 'hpcdd'),
            array($this, 'hpcdd_render_settings_field'),
            'hpcdd_general_settings',
            'hpcdd_general_section',
            $args
        );


        register_setting(
            'hpcdd_general_settings',
            'hpcdd_levels_setting'
        );

    }

    public function hpcdd_display_general_account()
    {
        echo '<p>' . __('These settings apply to all HPCDD functionality', 'hpcdd') . '.</p>';
    }

    public function hpcdd_render_settings_field($args)
    {
        /* EXAMPLE INPUT
                            'type'      => 'input',
                            'subtype'   => '',
                            'id'    => $this->plugin_name.'_example_setting',
                            'name'      => $this->plugin_name.'_example_setting',
                            'required' => 'required="required"',
                            'get_option_list' => "",
                                'value_type' = serialized OR normal,
        'wp_data'=>(option or post_meta),
        'post_id' =>
        */
        if ($args['wp_data'] == 'option') {
            $wp_data_value = get_option($args['name']);
        } elseif ($args['wp_data'] == 'post_meta') {
            $wp_data_value = get_post_meta($args['post_id'], $args['name'], true);
        }

        switch ($args['type']) {

            case 'input':
                $value = ($args['value_type'] == 'serialized') ? serialize($wp_data_value) : $wp_data_value;
                if ($args['subtype'] != 'checkbox') {
                    $prependStart = (isset($args['prepend_value'])) ? '<div class="input-prepend"> <span class="add-on">' . $args['prepend_value'] . '</span>' : '';
                    $prependEnd = (isset($args['prepend_value'])) ? '</div>' : '';
                    $step = (isset($args['step'])) ? 'step="' . $args['step'] . '"' : '';
                    $min = (isset($args['min'])) ? 'min="' . $args['min'] . '"' : '';
                    $max = (isset($args['max'])) ? 'max="' . $args['max'] . '"' : '';
                    if (isset($args['disabled'])) {
                        // hide the actual input bc if it was just a disabled input the info saved in the database would be wrong - bc it would pass empty values and wipe the actual information
                        echo esc_html($prependStart) . '<input type="' . esc_attr($args['subtype']) . '" id="' . esc_attr($args['id']) . '_disabled" ' . esc_attr($step) . ' ' . esc_attr($max) . ' ' . esc_attr($min) . ' name="' . esc_attr($args['name']) . '_disabled" size="40" disabled value="' . esc_attr($value) . '" /><input type="hidden" id="' . $args['id'] . '" ' . $step . ' ' . $max . ' ' . $min . ' name="' . $args['name'] . '" size="40" value="' . esc_attr($value) . '" />' . esc_html($prependEnd);
                    } else {
                        echo esc_html($prependStart) . '<input type="' . esc_attr($args['subtype']) . '" id="' . esc_attr($args['id']) . '" "' . esc_attr($args['required']) . '" ' . esc_attr($step) . ' ' . esc_attr($max) . ' ' . esc_attr($min) . ' name="' . esc_attr($args['name']) . '" size="40" value="' . esc_attr($value) . '" />' . esc_html($prependEnd);
                    }
                } else {
                    $checked = ($value) ? 'checked' : '';
                    echo '<input type="' . esc_attr($args['subtype']) . '" id="' . esc_attr($args['id']) . '" "' . esc_attr($args['required']) . '" name="' . esc_attr($args['name']) . '" size="40" value="1" ' . esc_attr($checked) . ' />';
                }
                break;
            default:
                # code...
                break;
        }
    }

}
