<?php
/*
 * Firm controller
 */
class Firm extends Controller {
    
    /**
     * Get firms by search
     * @author Maxim Shiryaev
     * @return null
     */
    public function searchFirm() {
        $postData = $_POST;
        
        /*
         * get action name and send response
         */
        if (isset($postData['action']) && $postData['action'] == 'get_firms') {
            header('Content-Type: application/json');
            $firms = FirmModel::getFirmsByService($postData['service_name']);
            echo json_encode($firms);
            exit;
        }
              
        
         /*
         * get action name and send response
         */
        if (isset($postData['action']) && $postData['action'] == 'firm_search') 
        {
            $loginExists = CustomerModel::checkLoginExists($postData['login']);
            if ($loginExists) {
                echo "ok";
                exit;
            }
            
        }

        
        Load::view('firm_search');
    }
    
    /**
     * Search firms and service by city
     * @author Maxim Shiryaev
     * @return null
     */
    public function searchByCity() {
        $postData = $_POST;

        if (isset($postData['action']) && $postData['action'] == 'get_search_results') {
            header('Content-Type: application/json');
            $result = FirmModel::getResultByCity($postData['city_id']);
            echo json_encode($result);
            exit;
        }

        if (isset($postData['action']) && $postData['action'] == 'search_by_city')
        {
            $loginExists = CustomerModel::checkLoginExists($postData['login']);
            if ($loginExists) {
                echo "ok";
                exit;
            }
        }

        $cities = FirmModel::getCities();
        Load::view('city_search', array('cities' => $cities));
    }
    

    /**
     * Add firm
     * @author Maxim Shiryaev
     * @return null
     */
    public function addFirm() {
        $postData = $_POST;

        if (isset($postData['action']) && $postData['action'] == 'add_firm')
        {
            $firm = new FirmModel($postData);
        }

        $cities = FirmModel::getCities();
        Load::view('add_firm', array('cities' => $cities));

    }
    
  
    /**
     * Customers that used firm
     * @author Maxim Shiryaev
     * @return null
     */
    public function customersUsedFirm() {
        $postData = $_POST;

        if (isset($postData['action']) && $postData['action'] == 'get_customers') {
            header('Content-Type: application/json');
            $customers = CustomerModel::getCustomersUsedFirm($postData['firm_name']);
            echo json_encode($customers);
            exit;
        }

        Load::view('customers_used_firm');
    }
 
}

      