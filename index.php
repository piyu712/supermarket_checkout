<?php
//Global setting
require_once 'config/global.php';

//load the controller and execute the action
if(isset($_GET["controller"]))
{
    $controllerObj=getController($_GET["controller"]);
    launchAction($controllerObj);
}
else
{
    $controllerObj=getController(PRODUCTS_TABLE);
    launchAction($controllerObj);
}


function getController($controller)
{
    switch ($controller) {
        case 'checkout':
            $controllerString='controller/checkoutController.php';
            require_once $controllerString;
            $controllerObj=new CheckoutController();
            break;
        
        default:
            $controllerString='controller/checkoutController.php';
            require_once $controllerString;
            $controllerObj=new CheckoutController();
            break; 
    }
    return $controllerObj;
}

function launchAction($controllerObj){
    if(isset($_GET["action"])){
        $controllerObj->run($_GET["action"]);
    }else{
        $controllerObj->run(DEFAULT_ACTION);
    }
}

?>