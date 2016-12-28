<?php
/*
 * Billing Controller
 */
class Billing extends Controller {
    
    /**
     * Get earnings of Service firm
     * @author Maxim Shiryaev
     * @return null
     */
    public function earnings() {
        $postData = $_POST;

        if (isset($postData['action']) && $postData['action'] == 'get_earnings')  {
            $earnings = BillingModel::getEarnings($postData);
            echo $earnings;
            exit;
        }
        Load::view('earnings');
    }
    

}