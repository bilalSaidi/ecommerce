<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <!--  Title -->
        <title><?php echo getTitle() ; ?></title>
        <!-- Favicon  -->
    	<link rel="icon" href="<?php echo $img ; ?>favicon.png">
    	<!-- Core Style Css -->
        <link rel="stylesheet" href="<?php echo $css ; ?>bootstrap.min.css">
        <?php
            if ($isArabic == true) {
                echo ' <link rel="stylesheet" href="'.$css.'bootstrap.rtl.min.css"> ';
             } 
        ?>
        <link rel="stylesheet" href="<?php echo $css ; ?>font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo $css ; ?>dataTables.bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo $css ; ?>responsive.dataTables.min.css">
        <link rel="stylesheet" href="<?php echo $css ; ?>styleBackEnd.css">
        <?php
            if ($isArabic == true) {
                echo ' <link rel="stylesheet" href="'.$css.'styleBackEndArabic.css"> ';
                
            } 
        ?>
    </head>
    <body>
        
       

