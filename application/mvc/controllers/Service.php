<?php
/*
 * Service controller
 */
class Service extends Controller {

    /**
     * Service search
     * @author Maxim Shiryaev
     * @return null
     */
    public function searchService() {
        $postData = $_POST;
        
        if (isset($postData['action']) && $postData['action'] == 'get_services') {
            header('Content-Type: application/json');
            $services = ServiceModel::getServicesByFirm($postData['firm_name']);
            echo json_encode($services);
            exit;
        }
              
        
        if (isset($postData['action']) && $postData['action'] == 'service_search') 
        {
            $loginExists = CustomerModel::checkLoginExists($postData['login']);
            if ($loginExists) {
                echo "ok";
                exit;
            }
        }

        Load::view('service_search');
    }
    

    /**
     * Purchase service
     * @author Maxim Shiryaev
     * @return null
     */
     public function buyService() {
        $postData = $_POST;
        $result = ServiceModel::buyService($postData);
        
        if ($result) {
             echo "ok";
        }
     }
     

    /**
     * Add service
     * @author Maxim Shiryaev
     * @return null
     */
    public function addService() {
        $postData = $_POST;
        
        if (isset($postData['action']) && $postData['action'] == 'add_service')
        {
            $service = new ServiceModel($postData);
        }
        
        $firms = FirmModel::getFirms();
        Load::view('add_service', array('firms' => $firms));
    }
    
    
    /**
     * Get customers, that used service
     * @author Maxim Shiryaev
     * @return null
     */
    public function customersUsedService() {
        $postData = $_POST;
        
        if (isset($postData['action']) && $postData['action'] == 'get_customers') {
            header('Content-Type: application/json');
            $customers = CustomerModel::getCustomersUsedService($postData['service_name']);
            echo json_encode($customers);
            exit;
        }
        Load::view('customers_used_service');
    }

}

      