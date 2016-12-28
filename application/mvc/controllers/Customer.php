<?php
/*
 * Customer Controller
 */
class Customer extends Controller {

    /**
     * Customer registration
     * @author Maxim Shiryaev
     * @return null
     */
    public function register() {
        $postData = $_POST;
        
        if (isset($postData['action']) && $postData['action'] == 'add_customer')  {
            $customer = new CustomerModel($postData);
        }
        Load::view('customer_register');
    }
    
}

      