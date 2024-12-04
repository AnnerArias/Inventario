<?php

class DashboardController{

    //Llamado plantilla principal
    public function Index(){
        require_once 'view/header.php';
        require_once 'view/dashboard/index.php';
        require_once 'view/footer.php';
    }

   
}
