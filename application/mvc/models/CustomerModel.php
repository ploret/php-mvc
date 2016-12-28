<?php
/*
 * Customer model
 */
class CustomerModel {
    
    private $fio;
    private $login;
    private $phone;
    private $email;
  
    /**
     * Add new customer
     * @author Maxim Shiryaev
     * @param array $postData - customer data in associative array
     * @return null
     */
    function __construct($postData) {

        $this->fio = addslashes($postData['name']);
        $this->login = addslashes($postData['login']);
        $this->phone = addslashes($postData['phone']);
        $this->email = addslashes($postData['email']);

        $result = MySQL::getInstance()->query("INSERT INTO customers(fio, login, phone, email) VALUES("
                                            . " '{$this->fio}',"
                                            . " '{$this->login}', "
                                            . " '{$this->phone}',"
                                            . " '{$this->email}')");
        if ($result) {
            echo "ok";
        }
    }
    
    /**
     * Check if customer exists
     * @author Maxim Shiryaev
     * @param string $login - customer login
     * @return integer
     */
    public static function checkLoginExists($login) {
        $login = addslashes($login);
        $result = MySQL::getInstance()->selectQuery("SELECT COUNT(*) as count FROM customers WHERE login = '{$login}'");
        
        return $result[0]['count'];
    }

    /**
     * Get customers that used service
     * @author Maxim Shiryaev
     * @param string $serviceName - service name
     * @return array
     */
    public static function getCustomersUsedService($serviceName) {
        $serviceName = addslashes($serviceName);
        $result = MySQL::getInstance()->selectQuery("SELECT DISTINCT(C.fio) as customer_name, C.email as customer_email
                                                    FROM purchased_services AS PS
                                                    INNER JOIN customers AS C ON (C.login = PS.customer_login)
                                                    INNER JOIN services as S ON (PS.service_id = S.id)
                                                    WHERE S.name = '{$serviceName}'");
        return $result;
    }
    

    /**
     * Get customers that used firm
     * @author Maxim Shiryaev
     * @param string $firmName - firm name
     * @return array
     */
    public static function getCustomersUsedFirm($firmName) {
        $firmName = addslashes($firmName);
        $result = MySQL::getInstance()->selectQuery("SELECT DISTINCT(C.fio) as customer_name, C.email as customer_email
                                                    FROM purchased_services AS PS
                                                    INNER JOIN customers AS C ON (C.login = PS.customer_login)
                                                    INNER JOIN services as S ON (S.id = PS.service_id)
                                                    INNER JOIN firms as F ON (S.firm_id = F.id)
                                                    WHERE F.name = '{$firmName}'");
        return $result;
    }


    /*
     * Getters and Setters methods below
     */
    public function getFio() {
        return $this->fio;
    }
    
    public function setFio($fio) {
        $this->fio = $fio;
    }
    
    public function getLogin() {
        return $this->login;
    }
    
    public function setLogin($login) {
        $this->login = $login;
    }

    public function getPhone() {
        return $this->phone;
    }
    
    public function setPhone($phone) {
        $this->phone = $phone;
    }
    
    
    public function getEmail() {
        return $this->email;
    }
    
    public function setEmail($email) {
        $this->email = $email;
    }
    
    
}