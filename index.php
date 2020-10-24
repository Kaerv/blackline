<?php
     require 'libs/Smarty.class.php';	


     session_start();
 
     if(!isset($_SESSION['token'])) {	
         $token = md5(time().'1Q1F0awJivwwGys');	
         $_SESSION['token'] = $token;	
     }	
     else {	
         $token = $_SESSION['token'];	
     }	
 
 
     $smarty = new Smarty();
     //$smarty->debugging = true;	
 
     define('STYLES_PATH', 'styles');	
 
     if(isset($_GET["page"])) {	
         $page = $_GET["page"];	
     }	
     else {	
         $page = 'index';	
     }	
 
     $smarty->assign('page', $page);	
     $smarty->assign('token', $token);	
 
 
     if($page == "panel") {	
         $smarty->display("panel.tpl");	
     }	
 
     else if ($page == "cytaty") {	
     }	
 
     else {	
         $smarty->display('page.tpl');	
     }
?>