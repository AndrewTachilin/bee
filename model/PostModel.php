<?php

require_once('../model/dbconnect.php');

 class  PostModel
 {

    public function inputTask($name,$email,$text,$image)
    {
        $con = DbConnect::getConnect();
            $query = $con->query("INSERT INTO tasks (name, task,isGuest,status, email,image)
            VALUES ('$name', '$text','1','0', '$email','$image');");
    }


    public function select()
    {

        $con = DbConnect::getConnect();
        $result = $con->query("SELECT * from tasks");
        $show = $result->fetchAll(PDO::FETCH_ASSOC);

        return $show;


    }
    public function pagination($start,$field,$sort){
        $con = DbConnect::getConnect();

        $resultPagination = $con->query("SELECT * from tasks ORDER BY $field $sort LIMIT $start,3");
$resultPagination = $resultPagination->fetchAll(PDO::FETCH_ASSOC);
        return $resultPagination;

    }
    public function UpdateTaskByAdmin($task,$id,$status = 1){
        $con = DbConnect::getConnect();
        $query = $con->query("UPDATE tasks 
            set task='$task', status='$status' where id ='$id';");
    }


}




