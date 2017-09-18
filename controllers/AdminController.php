<?php

include_once('../view/head.php');

class AdminController
{
    /**
     * @param in second if, send 3 @param into model, first it's query, 2,3 @param user data
     * @return true when user exist in database
     */
    public function actionIndex()
    {
        if(isset($_POST['submit2']) && isset($_POST['password']) && isset($_POST['admin'])) {
            include '../model/adminExist.php';
            $modelAdmin = new AdminExist();

            $isAdmin = $modelAdmin->issetAdmin("SELECT * FROM admin");
            if($isAdmin){

                foreach($isAdmin as $accsess) {

                    if(($accsess['admin']) == $_POST['admin'] && ($accsess['password'] == $_POST['password'])) {
                        $_SESSION['admin'] = true;
                    }else{
                        $_SESSION['admin'] = true;
                    }

                }
                
            }
        }
        return $_SESSION['admin'];
    }
}
$adminExist = new AdminController();
$result = $adminExist->actionIndex();
