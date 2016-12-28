<?php
/*
 * Firm model
 */
class FirmModel {
    
    private $name;
    private $phone;
    private $contactFio;
    private $address;
    private $login;
    private $city;
    
    /**
     * Add new firm
     * @author Maxim Shiryaev
     * @param array $postData - firm data
     * @return null
     */
    function __construct($postData) {
        
        $this->name       = addslashes($postData['name']);
        $this->phone      = addslashes($postData['phone']);
        $this->contactFio = addslashes($postData['fio']);
        $this->address    = addslashes($postData['address']);
        $this->login      = addslashes($postData['login']);
        $this->city       = addslashes($postData['city_id']);
        
        $result = MySQL::getInstance()->query("INSERT INTO firms(name, phone, contact_fio, address, login, city) VALUES("
                                            . " '{$this->name}',"
                                            . " '{$this->phone}',"
                                            . " '{$this->contactFio}',"
                                            . " '{$this->address}',"
                                            . " '{$this->login}',"
                                            . " '{$this->city}')");                        
        if ($result) {
            echo "ok";
        }
    }
    
  
    
    /**
     * Get firms that offer this service
     * @author Maxim Shiryaev
     * @param string $serviceName - service name
     * @return array
     */
    public static function getFirmsByService($serviceName) {
        $serviceName = addslashes($serviceName);
        $result = MySQL::getInstance()->selectQuery("SELECT F.name as firm_name
                                                    FROM services AS S
                                                    INNER JOIN firms AS F ON (S.firm_id = F.id)
                                                    WHERE S.name = '{$serviceName}'");
        return $result;
    }

    
    /**
     * Get services and firms in this city
     * @author Maxim Shiryaev
     * @param integer $cityId - city id
     * @return array
     */
    public static function getResultByCity($cityId) {
        $cityId = addslashes($cityId);
        $result = MySQL::getInstance()->selectQuery("SELECT F.name as firm_name, S.name AS service_name
                                                    FROM services AS S
                                                    INNER JOIN firms AS F ON (S.firm_id = F.id)
                                                    INNER JOIN cities AS C ON (F.city = C.id)
                                                    WHERE C.id = '{$cityId}'");
        return $result;
    }


    /**
     * Get list of cities
     * @author Maxim Shiryaev
     * @return array
     */
    public static function getCities() {
        $result = MySQL::getInstance()->selectQuery("SELECT C.id, C.name from cities as C");
        return $result;
    }
    

     /**
     * Get list of firms
     * @author Maxim Shiryaev
     * @return array
     */
    public static function getFirms() {
        $result = MySQL::getInstance()->selectQuery("SELECT F.id, F.name from firms as F");
        return $result;
    }
    
    /*
     * Getters and Setters methods below
     */
    
    public function getName() {
        return $this->name;
    }
    
    public function setName($name) {
        $this->name = $name;
    }
    
    
    public function getPhone() {
        return $this->phone;
    }
    
    public function setPhone($phone) {
        $this->phone = $phone;
    }
    
    public function getContactFio() {
        return $this->contactFio;
    }
    
    public function setContactFio($contactFio) {
        $this->contactFio = $contactFio;
    }
    
    
    public function getAddress() {
        return $this->address;
    }
    
    public function setAddress($address) {
        $this->address = $address;
    }
    
    public function getLogin() {
        return $this->login;
    }
    
    public function setlogin($login) {
        $this->login = $login;
    }
    
    
    public function getCity() {
        return $this->city;
    }
    
    public function setCity($city) {
        $this->city = $city;
    }
}