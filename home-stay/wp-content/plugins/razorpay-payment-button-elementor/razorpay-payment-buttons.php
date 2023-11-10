<?php
/**
 * Plugin Name: Razorpay Payment Button for Elementor
 * Plugin URI:  https://github.com/razorpay/payment-button-elementor-plugin
 * Description: Razorpay Payment Button for Elementor
 * Version:     1.2.5
 * Author:      Razorpay
 * Author URI:  https://razorpay.com
 */

require_once __DIR__.'/razorpay-sdk/Razorpay.php';
require_once __DIR__.'/includes/rzp-btn-view.php';
require_once __DIR__.'/includes/rzp-btn-action.php';
require_once __DIR__.'/includes/rzp-btn-settings.php';
require_once __DIR__.'/includes/rzp-payment-buttons.php';
require_once __DIR__.'/widget/Widget.php';

use Razorpay\Api\Api;
use Razorpay\Api\Errors;

add_action('admin_enqueue_scripts', 'bootstrap_scripts_enqueue_elementor', 0);
add_action('admin_post_rzp_btn_elementor_action', 'razorpay_payment_button_elementor_action', 0);

function bootstrap_scripts_enqueue_elementor($admin_page)
{
    if ($admin_page != 'admin_page_rzp_button_view_elementor')
    {
        return;
    }
    wp_register_style('bootstrap-css-elementor', plugin_dir_url(__FILE__)  . 'public/css/bootstrap.min.css',
                null, null);
    wp_register_style('button-css-elementor', plugin_dir_url(__FILE__)  . 'public/css/button.css',
                null, null);
    wp_enqueue_style('bootstrap-css-elementor');
    wp_enqueue_style('button-css-elementor');

    wp_enqueue_script('jquery');
}

/**
 * This is the RZP Payment button loader class.
 *
 * @package RZP WP List Table
 */
if (!class_exists('RZP_Payment_Button_Elementor_Loader')) 
{

    // Adding constants
    if (!defined('RZP_PAYMENT_ELEMENTOR_BASE_NAME'))
    {
        define('RZP_PAYMENT_ELEMENTOR_BASE_NAME', plugin_basename(__FILE__));
    }

    if (!defined('RZP_REDIRECT_URL'))
    {
        // admin-post.php is a file that contains methods for us to process HTTP requests
        define('RZP_REDIRECT_URL', esc_url(admin_url('admin-post.php')));
    }

    class RZP_Payment_Button_Elementor_Loader
    {
        /**
         * Start up
         */
        public function __construct()
        {
            add_action('admin_menu', array($this, 'rzp_add_plugin_page'));

            add_filter('plugin_action_links_' . RZP_PAYMENT_ELEMENTOR_BASE_NAME, array($this, 'razorpay_plugin_links'));

            $this->settings = new RZP_Payment_Button_Elementor_Setting();
        }

        /**
         * Creating the menu for plugin after load
        **/
        public function rzp_add_plugin_page()
        {
            /* add pages & menu items */
            add_menu_page(esc_attr__('Razorpay Payment Button', 'textdomain'), esc_html__('Razorpay Buttons Elementor', 'textdomain'),
            'administrator','razorpay_button_elementor',array($this, 'rzp_view_buttons_page'), '', 10);

            add_submenu_page(esc_attr__('razorpay_button_elementor', 'textdomain'), esc_html__('Razorpay Settings', 'textdomain'),
            'Settings', 'administrator','razorpay_elementor_settings', array($this, 'razorpay_elementor_settings'));

            add_submenu_page(esc_attr__('', 'textdomain'), esc_html__('Razorpay Buttons Elementor', 'textdomain'),
            'Razorpay Buttons Elementor', 'administrator','rzp_button_view_elementor', array($this, 'rzp_button_view_elementor'));
        }

        /**
         * Initialize razorpay api instance
        **/
        public function get_razorpay_api_instance()
        {
            $key = get_option('key_id_field');

            $secret = get_option('key_secret_field');

            if(empty($key) === false and empty($secret) === false)
            {
                return new Api($key, $secret);
            }

            wp_die('<div class="error notice">
                        <p>RAZORPAY ERROR: Please set Razorpay Key Id and Secret in plugin settings.</p>
                     </div>'); 
        } 

        /**
         * Creating the settings link from the plug ins page
        **/
        function razorpay_plugin_links($links)
        {
            $pluginLinks = array(
                            'settings' => '<a href="'. esc_url(admin_url('admin.php?page=razorpay_elementor_settings')) .'">Settings</a>',
                            'docs'     => '<a href="https://razorpay.com/docs/payment-button/supported-platforms/wordpress/elementor/">Docs</a>',
                            'support'  => '<a href="https://razorpay.com/contact/">Support</a>'
                        );

            $links = array_merge($links, $pluginLinks);

            return $links;
        }
    
        /**
         * Razorpay Payment Button Page
         */
        public function rzp_view_buttons_page()
        {
            $rzp_payment_buttons = new RZP_Payment_Buttons_Elementor();

            $rzp_payment_buttons->rzp_buttons(); 
        }	

        /**
         * Razorpay Setting Page
         */
        public function razorpay_elementor_settings()
        {
            $this->settings->razorpaySettings();
        }  

        /**
         * Razorpay Setting Page
         */
        public function rzp_button_view_elementor()
        {
            $new_button = new RZP_View_Button_Elementor();

            $new_button->razorpay_view_button();
        }
    }
}
        
/**
* Instantiate the loader class.
*
* @since     2.0
*/
$RZP_Payment_Button_Elementor_Loader = new RZP_Payment_Button_Elementor_Loader();

function razorpay_payment_button_elementor_action()
{
    $btn_action = new RZP_Button_Action_Elementor();
    
    $btn_action->process();
}
