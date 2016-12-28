<?php
/*
 * Service model
 */
class ServiceModel {
    
    private $name;
    private $description;
    private $profit;
    private $firm;
    
     /**
     * Add new service
     * @author Maxim Shiryaev
     * @param array $postData - service data
     * @return null
     */
    function __construct($postData) {

        $this->name        = addslashes($postData['name']);
        $this->description = addslashes($postData['description']);
        $this->profit      = addslashes($postData['profit']);
        $this->firm        = addslashes($postData['firm_id']);

        $result = MySQL::getInstance()->query("INSERT INTO services(firm_id, profit, description, name) VALUES("
                                            . " '{$this->firm}',"
                                            . " '{$this->profit}',"
                                            . " '{$this->description}',"
                                            . " '{$this->name}')");     
                                           
        if ($result) {
            echo "ok";
        }
    }
   
        
    /**
     * Get service by firm
     * @author Maxim Shiryaev
     * @param string $firmName - firm name
     * @return array
     */
    public static function getServicesByFirm($firmName) {
        $firmName = addslashes($firmName);
        $result = MySQL::getInstance()->selectQuery("SELECT S.id as service_id, S.name as service_name, S.description AS service_description
                                                    FROM services AS S
                                                    INNER JOIN firms AS F ON (S.firm_id = F.id)
                                                    WHERE F.name = '{$firmName}'");
        return $result;
    }
    
    
    /**
     * Purchase service
     * @author Maxim Shiryaev
     * @param array $postData
     * @return integer
     */
     public static function buyService($postData) {
         
        $postData['service_id'] = addslashes($postData['service_id']);
        $postData['login']      = addslashes($postData['login']);
        $timestamp = time();
        
        $result = MySQL::getInstance()->query("INSERT INTO purchased_services (service_id, customer_login, purchased_date) VALUES("
                                            . " '{$postData['service_id']}',"
                                            . " '{$postData['login']}',"
                                            . " '{$timestamp}')");                        
        return $result;
    }
     
    /*
     * Getters and Setters methods below
     */
    public function getDescription() {
        return $this->description;
    }
    
    public function setDescription($description) {
        $this->description = $description;
    }
    

    public function getProfitPercentage() {
        return $this->profit;
    }
    
    public function setProfitPercentage($profit) {
        $this->profit = $profit;
    }
    
    
}