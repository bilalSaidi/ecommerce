<?php

    session_start();

    if (isset($_SESSION['username'])) {
    	// Varibale Contain Name Page 
    	$TitlePage = 'Dashboard';
    	// Include File Init 
    	include 'init.php';

        /* Start Dashboead */
?><!-- Start Html -->
            <div class="container">
                <h1 class="text-center"><?php echo lang('AdminArea'); ?> </h1>
                <div class="row">
                    <!-- Start Stat Mmeber -->
                    <div class="col-md-3">
                        <div class="stat choix1">
                            <i class="fa fa-users"></i>
                            <div class="info">
                                <a href="members.php"><?php echo lang('TotalMember'); ?> </a>
                                <span>

<?php # Start Code Php 

                    $totelMumber = caclItems('userID','users');
                    echo $totelMumber;
?>        
                                </span>
                            </div>
                        </div>
                    </div>
                    <!-- Start Stat Pending Mmeber -->
                    <div class="col-md-3">
                        <div class="stat choix2">
                            <i class="fa fa-user-plus"></i>
                            <div class="info">
                                   <a href="members.php?action=activate"><?php echo lang('PendingMember'); ?> </a>
                                  <span>
                            
<?php # Start Code Php 

            $totelPendingMumber = caclItems('userID','users','Regstatus',0);
            echo $totelPendingMumber;
?>   
                                </span>
                            </div>
                        </div>
                    </div>
                    <!-- Start Stat Total Items  -->
                    <div class="col-md-3">
                        <div class="stat choix3">
                            <i class="fa fa-tag"></i>
                            <div class="info">
                                <a href="items.php"><?php echo lang('TotalItems'); ?> </a>
                                <span>
<?php # Start Code Php 
                                $totalItems = caclItems('item_id','items');
                                echo $totalItems;
?>
                                </span>
                            </div>
                        </div>
                    </div>
                     <!-- Start Stat Total Comment  -->
                    <div class="col-md-3">
                        <div class="stat choix4">
                            <i class="fa fa-comments"></i>
                            <div class="info">
                                <a href="comment.php"><?php echo lang('TotalComment'); ?> </a>
                                
                                <span>
 <?php # Start Code Php 
                                $totalComment = caclItems('idComment','comment');
                                echo $totalComment;
?>
                                </span>
                            </div>
                        </div>
                    </div>
                </div> <!-- End Row  -->
                <div class="row">
                    <!-- Start Panel Mmbers -->
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <i class="fa fa-users"></i>
                                <?php 
                                    $numberLatestItems = 6 ;   // Number Of Latest Mmeber 
                                    echo $numberLatestItems ;  
                                ?>
                                <?php echo lang('LatestRegistredMmebers'); ?>
                                <span class="toggle-info pull-right">
                                    <i class="fa fa-plus   "></i>
                                </span>
                            </div>
                            <div class="panel-body">
<?php # Start Code Php
                            
                            $latesItems = getLatest('*','users','userID',$numberLatestItems);   // Return Array Contain Latest Member In My DataBase  
                            echo "<ul class='list-unstyled latest_item'>"; 
                            foreach($latesItems as $Latest){
                                    echo "<li>";
                                        echo '<span class="name_user">' . $Latest['userName'].'</span>';
                                        //echo "<span class='btn btn-success pull-right'>Edit</span>";
                                        echo "<a href='members.php?do=Edit&id= " . $Latest["userID"] . "' class='btn btn-success control_member pull-right'><i class='fa fa-edit'></i> ". lang('Edit') ."</a> ";
                                        # Member Not Activate 
                                        if ($Latest['Regstatus'] != 1) {   # Show Button Activate 

                                            echo '<a href="members.php?do=memberActivate&id= '.$Latest["userID"] . '" class="  btn btn-info  pull-right control_member item_active"> <i class="fa fa-check"></i>'.lang('Activate').' </a> ';
                                        }
                                    echo "</li>";
                            }
                            echo "</ul>";
?><!-- Html Start Here -->
                            </div>
                        </div>  <!-- End Panel Mmbers -->
                    </div>
                    <!-- Start Panel Items -->
                    <div class="col-md-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <i class="fa fa-tag"></i>
                                <?php 
                                    $numberLatestItems = 6 ;   // Number Of Latest Items 
                                    echo $numberLatestItems ;  
                                ?>
                                <?php echo lang('LatestRegistredItems'); ?>
                                <span class="toggle-info pull-right">
                                    <i class="fa fa-plus   "></i>
                                </span>
                                
                            </div>
                            <div class="panel-body">
<?php # Start Code Php
                            
                            $latesItems = getLatest('*','items','item_id',$numberLatestItems);   // Return Array Contain Latest Items In My DataBase  
                            if (! empty($latesItems)) { # Case Exist Items In Data Base    
                                echo "<ul class='list-unstyled latest_item'>"; 
                                foreach($latesItems as $Item){
                                        echo "<li>";
                                            echo '<span class="name_user">' . $Item['name'].'</span>';
                                            echo "<a href='items.php?do=Edit&id= " . $Item["item_id"] . "' class='btn btn-success control_member pull-right'><i class='fa fa-edit'></i>" . lang('Edit') ." </a> ";
                                            # Item Not Approved 
                                            if ($Item['Approve'] != 1) {   # Show Button Approve 

                                                echo '<a href="items.php?do=ItemActivate&id= '.$Item["item_id"] . '" class="  btn btn-info  pull-right control_member item_active"> <i class="fa fa-check"></i> '.lang('Approve').' </a> ';
                                            }
                                        echo "</li>";
                                }
                                echo "</ul>";
                            }else{ # Case There's No Item In Data Base 
                                echo "<p>" .lang('There"sNoItemToShow') ."</p>";
                            }
?> <!-- Start Html -->

                            </div>
                        </div>
                    </div> <!--  End Panel Members -->
                </div>
                <!-- Start Row 02  -->
                <div class="row">
                    <!-- Start Panel Mmbers -->
                    <div class="col-md-6 ">
                        <div class="panel panel-default ">
                            <div class="panel-heading">
                                <i class="fa fa-comments-o"></i>
                                <?php 
                                    $numberLatestComment = 6 ;   // Number Of Latest Items 
                                    echo $numberLatestComment ;  
                                ?>
                                <?php echo lang('LatestRegistredComment'); ?>
                                <span class="toggle-info pull-right">
                                    <i class="fa fa-plus   "></i>
                                </span>
                            </div>
                            <div class="panel-body">
<?php # Start Php 
                            $stmtCom = $conn->prepare("SELECT 
                                                        comment.idComment , comment.comment , comment.status ,comment.idMember , users.userName 
                                                       FROM 
                                                        comment
                                                       INNER JOIN 
                                                        users 
                                                       ON 
                                                       users.userID = comment.idMember
                                                       LIMIT 6");
                            $stmtCom->execute();
                            $resault = $stmtCom->fetchAll(PDO::FETCH_ASSOC);
                            if (empty($resault)) {
                                echo "<p>".lang('There"sNoCommentToShow')."</p>";
                            }else{
                                foreach ($resault as $res) {
                                    echo "<div class='areaComment'>";
                                        echo "<span class='commentUser'>".$res['userName']."</span>";
                                        echo "<span class='commentText'>".$res['comment']."</span>";
                                        echo "<div class='option'>";
                                            echo "<a href='comment.php?do=Edit&id= " . $res["idComment"] . "' class='btn btn-success control_member pull-right'><i class='fa fa-edit'></i>". lang('Edit')." </a> ";
                                            # Item Not Approved 
                                            if ($res['status'] != 1) {   # Show Button Approve 

                                                echo '<a href="comment.php?do=Approve&id= '.$res["idComment"] . '" class="  btn btn-info  pull-right control_member item_active"> <i class="fa fa-check"></i>'.lang('Approve').' </a> ';
                                            }
                                        echo "</div>";
                                    echo "</div>";
                                }
                            }
?>
                            </div>
                        </div>  <!-- End Panel Mmbers -->
                    </div>
                    
                </div> <!-- End Row 02 -->

            </div> <!-- End Container -->
<?php # Start Php 
        /* End Dashboard */
    	
    	


    	//  Include File Footer 
    	include $tpl . 'footer.php';
    }else{
    	header("location:index.php");
    	exit();
    }