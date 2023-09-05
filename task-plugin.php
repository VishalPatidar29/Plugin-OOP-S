<?php

/*
* Plugin Name: Task Plugin

* Description: The Task Plugin is for Demo Purpose.

* Version: 1.0.0

* Author: Zehntech Technologies Pvt. Ltd.

* Author URI: https://www.zehntech.com/

* License: GPL2

* License URI: https://www.gnu.org/licenses/gpl-2.0.html


*/

// defined('ABSPATH') || exit;
if (!defined('ABSPATH')) {
    exit;
}

class CustomPlugin
{

    function __construct()
    {
        $this->require_files();

        // add the css in the Plugin
        $path_style = plugins_url('css/style.css', __FILE__);
        $ver_style = filemtime(plugin_dir_path(__FILE__) . 'css/style.css');
        wp_enqueue_style('my-custom-style', $path_style, '', $ver_style);

        // This code add the jQuery in over plugin
        wp_enqueue_script('jquery');

        // This code add the setting page in admin panel
        add_action('admin_menu', array($this, 'test_plugin_setup_menu'));

        // This code add the contact and address section in User Panel meta fields
        add_filter('user_contactmethods', 'new_contact_methods', 10, 1);

        // This  code show the  value in user panel
        add_filter('manage_users_columns', 'new_modify_user_table', 50, 3);

        // This code for update the custom column
        add_filter('manage_users_custom_column', 'new_modify_user_table_row', 10, 3);

        //This code add approve & not Approve button in user panel  
        add_filter('manage_users_custom_column', 'add_display_value', 50, 3);

        //This code add approve & not Approve value in the table update the values  
        add_action('wp_ajax_save_display_value', 'save_display_value');

        //This code update the value of approve and not approve     
        add_action('admin_footer', 'save_display_value_javascript');

        //This code export the user data Approve or not approve
        add_action('init', 'export_user_data');

    }

    private function require_files()
    {

        require_once __DIR__ . '/includes/display-value.php';
        require_once __DIR__ . '/includes/file-generate.php';
        require_once __DIR__ . '/includes/contact-method.php';

    }


    function test_plugin_setup_menu()
    {
        add_menu_page('Test_Plugin_Page', 'Setting Page', 'manage_options', 'test-plugin', array($this, 'test_init'));
    }

    function test_init()
    {
        ?>

        <div class="container">
            <form method="post">

                <input type="checkbox" id="approve" name="approve" value="approve" class="checkoption">
                <label for="approve"> Aprrove Users</label><br>
                <input type="checkbox" id="alluser" name="alluser" value="alluser" class="checkoption">
                <label for="alluser">All Users</label><br>
                <button type="submit" name="export_data" id="button">Download</button>
            </form>
        </div>
        <script type="text/javascript">
            jQuery(document).ready(function () {

                jQuery('.checkoption').click(function () {
                    jQuery('.checkoption').not(this).prop('checked', false);
                });

            });
        </script>
        <?php

    }

}

$obj = new CustomPlugin();




?>