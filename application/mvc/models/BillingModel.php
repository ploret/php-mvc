<?php
/*
 * Billing model
 */
class BillingModel {

    /**
     * Get earnings of Service firm
     * @author Maxim Shiryaev
     * @param array $postData - timestamp data in associative array
     * @return float
     */
    
    public static function getEarnings($postData) {
        $startTimestamp  = addslashes($postData['start_timestamp']);
        $finishTimestamp = addslashes($postData['finish_timestamp']);
        
        $result = MySQL::getInstance()->selectQuery("SELECT SUM(S.profit) as earnings
                                                     FROM purchased_services AS PS
                                                     INNER JOIN services AS S ON (S.id = PS.service_id)
                                                     WHERE PS.purchased_date >= '{$startTimestamp}' AND PS.purchased_date <= '{$finishTimestamp}'");
                                    
        if (isset($result[0]['earnings']) && intval($result[0]['earnings']) > 0) {
            return intval($result[0]['earnings']);
        }
        return 0;
    }
    
}
    