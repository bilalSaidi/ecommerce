<?php 

/*
=========================================================================================
							Page Comment  

				 You Can 	udate|delete|Approve   Comment   g    From  Here 

=========================================================================================
*/
	
    session_start();

    if (isset($_SESSION['username'])) {

    	// Varibale Contain Name Page 
        $TitlePage = 'Comments';
        // Include File Init 
    	include 'init.php';


    	$do = isset($_GET['do'])	? $_GET['do'] : 'Manage';

        

    	if ($do == 'Manage') {  # Page Manage Comments 

          
            $stmt = $conn->prepare(" SELECT 
                                    comment.* , users.userName , items.name AS nameItem 
                                    from 
                                    comment
                                    INNER JOIN 
                                        items 
                                    ON 
                                        items.item_id = comment.idItem
                                    INNER JOIN
                                        users 
                                    ON 
                                        users.userID = comment.idMember
                                    ORDER BY idComment DESC
                                    ");
            $stmt->execute();
            $rows =  $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (! empty($rows)) {
                
?><!-- Start Html -->
                <h1 class='text-center'> Manage Comments </h1>;
                
                <div class="container">

                    <div  >
                        <table class="  table table-bordered display responsive nowrap" style="width:100%">
                            <thead>
                                <th>#id</th>
                                <th>Comment</th>
                                <th>Add Date</th>
                                <th>User Name </th>
                                <th>Item </th>
                                <th>Control</th>
                            </thead>
                            <tbody>
<?php #Start Code Php 
                            foreach ($rows as $row) {
                                echo "<tr>";
                                    echo '<td>'.$row['idComment'].'</td>';
                                    echo '<td>'.$row['comment'].'</td>';
                                    echo '<td>'.$row['addDate'].'</td>';
                                    echo '<td>'.$row['userName'].'</td>';
                                    echo '<td>' .$row['nameItem']. '</td>';
                                    echo '<td>' ;
                                        echo "<a href='?do=Edit&id= " . $row["idComment"] . "' class='btn btn-success control_member'><i class='fa fa-edit'></i> Edit </a> ";
                                        echo '<a href="?do=Delete&id= '.$row["idComment"] . '" class=" confirm btn btn-danger control_member"> <i class="fa fa-close"></i>Delete </a> ';
                                    
                                    # Member Not Activate 
                                    if ($row['status'] != 1) {

                                        echo '<a href="?do=Approve&id= '.$row["idComment"] . '" class="  btn btn-info control_member"> <i class="fa fa-check"></i>Approve </a> ';
                                    }
                                    echo '</td>' ;
                                echo "</tr>";
                            }
?> <!-- Start Html -->
                            </tbody>
                        </table>
                    </div>
                </div>
      
<?php # Start Php 
            }else{ # Case No Comment To Show 
                echo "<div class='container contMessage' > ";
                    echo "<div class='niceMessage' > " ; 
                        echo "<p> there's No Comment To Show </p>";
                    echo "</div>";
                echo "</div>";
            }
           
        }elseif ($do == "Edit") { # Page Edit Comment 
            // Get Integer Value for Get Request 
            $idComment = intval($_GET['id']);
            // Select All Data Depend On This Id 
            $stmt = $conn->prepare("SELECT * FROM  comment WHERE  idComment = ?  LIMIT 1 ");
            // Execute Query 
            $stmt->execute(array($idComment));
            // Fetch The Data 
            $result= $stmt->fetchAll(PDO::FETCH_ASSOC);
            // The Row Count 
            $Count = $stmt->rowCount();
            
           if ($Count > 0 ) { // If There is Such Id Show The Form
            ?><!-- Start Html  -->
        <h1 class="text-center">Edit Comment </h1>
            <div class="container">
                <form  class="form-horizontal" method="POST" action="?do=Update">
                    <!-- Field Hidden Contain Id Category  -->
                    <input type="hidden" name="idComment" value="<?php echo $result[0]["idComment"] ; ?>">
                    <!-- Start  Name field -->
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Comment</label>
                        <div class="col-sm-10 col-md-5">
                            <textarea name="comment" class="form-control"><?php echo $result[0]["comment"] ; ?></textarea>
                        </div>
                    </div>
                    
                    <!-- Start Submit Button -->
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10 col-md-5">
                            <input class="btn btn-primary btn-lg" type="Submit" name="Submit" value="Save">
                        </div>
                    </div>
                </form>
            </div>
<?php # Start Php 

            }else{ // If There is No Such Id Show The Error Message 
                    echo "<div class='container'>";
                    $msgError = "<div class='alert alert-danger' style='margin-top:10px ; '> Theres No Such Id  </div>";
                    // Redirect Home 
                    redirectHome($msgError);
                    echo "</div>";
            }
        }elseif ($do == "Update") {
            echo "<h1 class='text-center'> Update Comment</h1>";
                echo "<div class='container'>";
                if ($_SERVER['REQUEST_METHOD'] == "POST") {

                        $idComment = $_POST['idComment'];
                        $commentText = $_POST['comment'];
                        $msgError = array();
                        if (empty($commentText)) {
                            $msgError['comment'] = "<div class='alert alert-danger'> Field comment Can't Be Empty  </div>";
                        }
                        // There's No Error 
                        if (empty($msgError)) {
                            
                            $UpdateComment = $conn->prepare("UPDATE comment SET comment = ? WHERE idComment = ? ");
                            $UpdateComment->execute(array($commentText,$idComment));
                            $msg =  "<div class='alert alert-success'>  " . $UpdateComment->rowCount() . " Row Updated </div>";
                            redirectHome($msg,'back');

                        }else{ // Show Errors 
                            foreach ($msgError as $Error) {
                                echo $Error;
                            }
                            $msg = "<div class='alert alert-danger'><strong>Sorry :( </strong> You Must Try Again  </div>";
                            redirectHome($msg,'back');
                        }
                    
                }else{
                    $msg = "<div class='alert alert-danger'><strong>Sorry :( </strong> You Can't Brows This Page Direct </div>";
                    redirectHome($msg);
                }
                
                echo "</div>";
        }elseif ($do == "Delete") {
            echo "<div class='container'>";
                echo "<h1 class='text-center'>Delete Comment</h1>";
                $idComment = intval($_GET['id']);
                $row = checkItem('idComment',' comment',$idComment);
                if ($row >= 1) { # Category Exist 
                    $stmtDelete = $conn->prepare("DELETE  FROM comment WHERE idComment = ? ");
                    $stmtDelete->execute(array($idComment));

                    $msg =  "<div class='alert alert-success'>" . $stmtDelete->rowCount() ." Record Deleted </div>";
                    redirectHome($msg,'back');
                }else{ # Category dont Exist
                        $msg = "<div class='alert alert-danger'><strong> Sorry :( </strong> This Id Not Exist  </div>"; 
                        redirectHome($msg,'back');
                }
                
            echo "</div>";
        }elseif ($do == "Approve") {
            echo '<h1 class="text-center">Approve Comment </h1>';
            echo "<div class='container'>";
            $idComment = intval($_GET['id']);
            $stmt = $conn->prepare("UPDATE comment SET status = 1 WHERE idComment = ?");
            $stmt->execute(array($idComment));
            $row = $stmt->rowCount();
            if ($row) {
                $msg =  "<div class='alert alert-success'> <strong>Good  </strong> Comment Now Activated </div>";
                redirectHome($msg,'back');
            }else{
                #Show Message Error And Redirect Home Page 
                $msg =  "<div class='alert alert-danger'> <strong>Sorry :( </strong> Erorr Activate Member </div>";
                redirectHome($msg);
            }
            echo "</div>";
        }
        
    	include $tpl . 'footer.php';
    }else{

    	header("location:index.php");
    	exit();
    }
?>
