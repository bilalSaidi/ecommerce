<?php 

/*
=========================================================================================
							Page Slider  

				 You Can 	udate|delete   Images Slider     From  Here 

=========================================================================================
*/
	
    session_start();

    if (isset($_SESSION['username'])) {

    	// Varibale Contain Name Page 
        $TitlePage = 'Slider';
        // Include File Init 
    	include 'init.php';

        

        $do = isset($_GET['do']) ? $_GET['do']  : 'Manage' ; 

        if ($do == "Manage") {
                echo "Manage Slider Images From Here ";
        }else if ($do == "Edit"){
                echo "Edit Silder ";
        } else if ($do == "delete") {
            echo "Delete Slider ";

        }else{
            header("location:?$do='Manage'");
            exit();
        }
        
    	include $tpl . 'footer.php';
    }else{

    	header("location:index.php");
    	exit();
    }
?>
