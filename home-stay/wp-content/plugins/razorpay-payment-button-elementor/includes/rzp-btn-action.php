<?php

use Razorpay\Api\Api;
use Razorpay\Api\Errors;
use Razorpay\PaymentButtonElementor\Errors as BtnErrors;

require_once __DIR__ . '/../includes/rzp-payment-buttons.php';

class RZP_Button_Action_Elementor
{
    public function __construct()
    {
        $this->razorpay = new RZP_Payment_Button_Elementor_Loader(false);

        $this->api = $this->razorpay->get_razorpay_api_instance();
    }

    /**
     * Generates admin page options using Settings API
    **/
    function process() 
    {
        $btn_id = sanitize_text_field($_POST['btn_id']);
        $action = sanitize_text_field($_POST['btn_action']);
        $paged = sanitize_text_field($_POST['paged']);
        $page_url = admin_url('admin.php?page=rzp_button_view_elementor&btn='.$btn_id .'&paged='.$paged);

        try
        {
            $this->api->paymentPage->$action($btn_id);
        }
        catch (Exception $e)
        {
            $message = $e->getMessage();

            throw new Errors\Error(
                $message,
                BtnErrors\Payment_Button_Elementor_Error_Code::API_PAYMENT_BUTTON_ACTION_FAILED,
                400
            );
        }
        wp_redirect($page_url);
    }
}
