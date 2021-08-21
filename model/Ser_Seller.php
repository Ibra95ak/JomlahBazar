<?php

class Ser_Seller{

    /*database connection variable*/
    private $conn;
    /*constructor*/
    public function __construct()
    {
        /*connecting to database*/
        require_once 'DB_Connect.php';
        /*creating connection instance*/
        $db = new DB_Connect();
        $this->conn = $db->connect();
    }

    public function GetSellerOrdersStats($userId,$status)
    {
        $stmt = $this->conn->prepare("CALL sp_GetSellerOrdersStats(?,?)");
        $stmt->bind_param("ii", $userId, $status);
        $result = $stmt->execute();
        $users = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        if ($users) {
            return $users;
        } else {
            return null;
        }
    }
    public function GetSellerSalesStatsDaily($userId)
    {
        $stmt = $this->conn->prepare("CALL sp_GetSellerSalesStatsDaily(?)");
        $stmt->bind_param("i", $userId);
        $result = $stmt->execute();
        $users = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        if ($users) {
            return $users;
        } else {
            return null;
        }
    }
    public function GetSellerSalesStatsWeekly($userId)
    {
        $stmt = $this->conn->prepare("CALL sp_GetSellerSalesStatsWeekly(?)");
        $stmt->bind_param("i", $userId);
        $result = $stmt->execute();
        $users = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        if ($users) {
            return $users;
        } else {
            return null;
        }
    }
    public function GetSellerSalesStatsMonthly($userId)
    {
        $stmt = $this->conn->prepare("CALL sp_GetSellerSalesStatsMonthly(?)");
        $stmt->bind_param("i", $userId);
        $result = $stmt->execute();
        $users = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        if ($users) {
            return $users;
        } else {
            return null;
        }
    }
    public function GetSellerCartsStats($userId)
    {
        $stmt = $this->conn->prepare("CALL sp_GetSellerCartsStats(?)");
        $stmt->bind_param("i", $userId);
        $result = $stmt->execute();
        $users = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        if ($users) {
            return $users;
        } else {
            return null;
        }
    }
    public function GetSellerWishlistsStats($userId)
    {
        $stmt = $this->conn->prepare("CALL sp_GetSellerWishlistsStats(?)");
        $stmt->bind_param("i", $userId);
        $result = $stmt->execute();
        $users = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        if ($users) {
            return $users;
        } else {
            return null;
        }
    }
    public function GetSellersStats()
    {
        $stmt = $this->conn->prepare("CALL sp_GetSellersStats()");
        $result = $stmt->execute();
        $users = $stmt->get_result()->fetch_assoc();
        $stmt->close();
        if ($users) {
            return $users;
        } else {
            return null;
        }
    }
}
