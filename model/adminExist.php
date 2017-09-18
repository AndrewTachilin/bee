<?php

require_once  ('../model/dbconnect.php');
require_once ('../controllers/AdminController.php');

class AdminExist{

    /**
     * @param $query string building in AdminController
     * @param $inputUserName input by user in form
     * @param $inputPassword input by user in form
     * @return array true when matcher=true
     */
    public function issetAdmin($query){

        $con = DbConnect::getConnect();
        $result =$con->query($query);
        $show = $result->fetchAll(PDO::FETCH_ASSOC);
        return $show;
    }

}


