<?php
/*
 * Class for work with database. Use PDO. Singleton pattern.
 */
class MySQL {
    
    private static $link;
    protected static $_instance;
    private function __construct(){}

    private function __clone(){}
    private function __wakeup() {}  
   
     /**
     * Get instance
     * @author Maxim Shiryaev
     * @return self
     */
    public static function getInstance() {
        if (null === self::$_instance) {
            self::$_instance = new self();
            self::connect();
        }
        return self::$_instance;
    }
    
     /**
     * Connect to database
     * @author Maxim Shiryaev
     * @return PDO
     */
    private function connect() {
        try {
            self::$link = new PDO("mysql:host=". DATABASE_HOSTNAME .";dbname=". DATABASE_NAME .";charset=utf8", DATABASE_USERNAME, DATABASE_PASSWORD);
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }

    /**
     * For SELECT queries
     * @author Maxim Shiryaev
     * @param string $query - query string
     * @return array
     */
    public function selectQuery($query) {
        $executedQuery = self::$link->query($query);
        $result = $executedQuery->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     * For INSERT, UPDATE, DELETE queries
     * @author Maxim Shiryaev
     * @param string $query - query string
     * @return integer
     */
    public function query($query) {
        $result = self::$link->exec($query);
        return $result;
    } 
    
     /**
     * Close connection
     * @author Maxim Shiryaev
     * @return null
     */
    public function closeConnect() {
        self::$link = null;
    }

}
