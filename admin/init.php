<?php
    
    include 'connect.php'; // File Connect DataBase


    // Routes

    $tpl = 'includes/templets/' ; //templets Directory
    $css = 'layout/css/' ; // css Directory
    $img = 'layout/images/' ; // images  Directory
    $js = 'layout/js/'  ;// js Directory
    $lang = 'includes/lang(ar_eng)/'; // lang Directory
    $func = 'includes/functions/'; // Function Directory
    // include Important Files 
    include $func . 'function.php';


    include $lang . 'config.php';
    

    
    include $tpl . 'header.php' ;
    

    // Include File Navbar When I Need 
    	if (!isset($noNavbar)) {
    		include $tpl . 'navbar.php' ;
    	}
    	
    
    