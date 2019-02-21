<?php

	global $isArabic;

 if (isset($_GET['lang']) && !empty($_GET['lang'])) {
        
         if ($_GET['lang'] == "arabic") {
            
            $val1 = "0" ; 
            $name1 = "English";
            $stmt1 = $conn->prepare("UPDATE langlist SET Status= ? WHERE NameLang = ? ");
            $stmt1->execute(array($val1,$name1));
            $val2 = "1" ; 
            $name2 = "Arabic";
            $stmt2 = $conn->prepare("UPDATE langlist SET Status= ? WHERE NameLang = ? ");
            $stmt2->execute(array($val2,$name2));

         }elseif ($_GET['lang'] == "english") {
            
            $val1 = "0" ; 
            $name1 = "Arabic";
            $stmt1 = $conn->prepare("UPDATE langlist SET Status= ? WHERE NameLang = ? ");
            $stmt1->execute(array($val1,$name1));
            $val2 = "1" ; 
            $name2 = "English";
            $stmt2 = $conn->prepare("UPDATE langlist SET Status= ? WHERE NameLang = ? ");
            $stmt2->execute(array($val2,$name2));
         }
    }
    
    $stmtLang = $conn->prepare("SELECT * FROM LangList");
    $stmtLang->execute();
    $resault = $stmtLang->fetchAll();
    /*
    
    */
    foreach ($resault as $res) {

        if ( ($res['NameLang'] == "Arabic") && ($res['Status'] == 1)  )  {
        	$MyLang = "arabic";
        	$isArabic = true;
        }elseif( ($res['NameLang'] == "English") && ($res['Status'] == 1)  ){
            $MyLang = "english";
        }

    }
    
    include $lang . $MyLang . ".php";