<?php 

/*
=========================================================================================
							Page Management Members Page  

				 You Can 	isert|udate|delete   maembrs  and other thing    From  Here 

=========================================================================================
*/
	
    session_start();

    if (isset($_SESSION['username'])) {

        

       
    	// Varibale Contain Name Page 
    	// Include File Init 
        $TitlePage = 'Members';
    	include 'init.php';


    	$do = isset($_GET['do']) ?  $_GET['do'] : 'Manage';

    	if ($do == 'Manage') { # Manage Page 

            if (isset($_GET['action']) && $_GET['action'] === 'activate' && !empty($_GET['action']) ) {
            // Select Mumbers Not Activate
                $stmt = $conn->prepare("SELECT * FROM users WHERE GroupID!=1 AND Regstatus != 1 ");

            }elseif (isset($_GET['action']) && ($_GET['action'] !== 'activate' || empty($_GET['action']) ) ) {
                # Error Url 
                echo "<h1 class='text-center'>Error Url </h1>";
                echo "<div class='container'>";
                $msg =  "<div class='alert alert-danger'> <strong> Sorry :(   </strong> This Page Not Found </div>";
                redirectHome($msg);
                echo "</div>";
            }else{
                
                // Select All Members  
                $stmt = $conn->prepare("SELECT * FROM users WHERE GroupID!=1 ORDER BY userID DESC");
            }
            
            
            $stmt->execute();
            $rows =  $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (! empty($rows)) { # Case Exist Members In Data Base 
                
?><!-- Start Html -->
                <h1 class='text-center'> <?php echo lang('ManageMember'); ?> </h1>;
                
                <div class="container">
                   
                    <div >
                        <table class=" table table-bordered display responsive nowrap Manage-Members" style="width:100%">
                            <thead>
                                <th>#<?php echo lang('id'); ?></th>
                                <th>ImageUser</th>
                                <th><?php echo lang('userName'); ?></th>
                                <th><?php echo lang('Email'); ?></th>
                                <th><?php echo lang('fullName'); ?></th>
                                <th><?php echo lang('DateRigestred'); ?></th>
                                <th><?php echo lang('Control'); ?></th>
                            </thead>
                            <tbody>
<?php #Start Code Php 
                            foreach ($rows as $row) {
                                echo "<tr>";
                                    echo '<td>'.$row['userID'].'</td>';
                                    echo "<td>";
                                        if (empty($row['ImageUser'])) {
                                            echo " <img src='Uploads/Avatars/deaultAvatar.jpg' alt='Avatar' class='img-circle' /> ";
                                        }else{
                                           echo " <img src='Uploads/Avatars/".$row['ImageUser']."' alt='Avatar' class='img-circle' /> ";
                                        }
                                       
                                    echo "</td>";
                                    echo '<td>'.$row['userName'].'</td>';
                                    echo '<td>'.$row['Email'].'</td>';
                                    echo '<td>'.$row['FullName'].'</td>';
                                    echo '<td>' .$row['date_Registred']. '</td>';
                                    echo '<td class="groupControl">' ;
                                        
                                        echo '<a href="members.php?do=Delete&id= '.$row["userID"] . '" class=" confirm btn btn-danger control_member"> <i class="fa fa-close"></i>'.lang('Delete') . ' </a> ';
                                    
                                    # Member Not Activate 
                                    if ($row['Regstatus'] != 1) {

                                        echo '<a href="members.php?do=memberActivate&id= '.$row["userID"] . '" class="  btn btn-info control_member Activate"> <i class="fa fa-check"></i>'.lang('Activate') . ' </a> ';
                                    }
                                    echo '</td>' ;
                                echo "</tr>";
                            }
?> <!-- Start Html -->
                            </tbody>
                        </table>

                    </div>
                </div>

<?php # Start Code Php   
        }else{ # Case There's No Member In Data Base 
            echo "<div class='container contMessage' > ";
                echo "<div class='niceMessage' > " ; 
                    echo "<p> ".lang('thereisNoMemberToShow') ."</p>";
                echo "</div>";
                
            echo "</div>";
        }  		 
    	}elseif ($do == 'memberActivate') { # This is Page Activate Member 
            echo '<h1 class="text-center">Activate Member </h1>';
            echo "<div class='container'>";
            $idMember = intval($_GET['id']);
            $stmt = $conn->prepare("UPDATE users SET Regstatus = 1 WHERE userID = ?");
            $stmt->execute(array($idMember));
            $row = $stmt->rowCount();
            if ($row) {
                $msg =  "<div class='alert alert-success'> <strong>Good  </strong> Member Now Activated </div>";
                redirectHome($msg);
            }else{
                #Show Message Error And Redirect Home Page 
                $msg =  "<div class='alert alert-danger'> <strong>Sorry :( </strong> Erorr Activate Member </div>";
                redirectHome($msg);
            }
            echo "</div>";
        }elseif ($do == 'Delete') { # This Is Page Delete Mmeber 
             echo "<div class='container'>" ; 
                echo "<h1 class='text-center'>Delete Member </h1>";
                 $idMember = intval($_GET['id']);
                 $stmt  = $conn->prepare("DELETE FROM users WHERE userID = ?");
                 $stmt->execute(array($idMember));
                 $row = $stmt->rowCount();
                 if ($row) {
                     $msg =  "<div class='alert alert-success'>" . $row . " Record Deleted </div>";
                     redirectHome($msg);
                 }else{
                    #Show Message Error And Redirect Home Page 
                    $msg =  "<div class='alert alert-danger'> <strong>Sorry :( </strong> Erorr Delte Member (Id Not Found )</div>";
                    redirectHome($msg);
                 }
             echo "</div>";
             
        }elseif ($do =='Edit') {   # This Is Page Edit Member 
            // Get Information About Admin 
            if (isset($_GET['id'])) {
                $adminId = intval($_GET['id']);
            }else{
                $adminId = intval($_SESSION['idUser']);
            }

            # Search idUser In DataBase 
            $resualt = checkItem('userID','users',$adminId);

            # Case Id User Exist In Data Base 
            if ($resualt >= 1 ) {
               
            $stmt = $conn->prepare("SELECT  * FROM  `users`   WHERE  userID = ?  LIMIT 1 ");
            $stmt->execute(array($adminId));
            $count = $stmt->rowCount();
            $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
            

?> <!-- Start  Html -->
    		<h1 class="text-center"><?php echo lang('EditMember'); ?> </h1>
            <div class="container">
                <form  class="form-horizontal" method="POST" action="?do=Update" enctype="multipart/form-data">
                    <!-- Start  username field -->
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label"><?php echo lang('userName'); ?></label>
                        <div class="col-sm-10 col-md-5">
                            <input type="hidden" name="userId" value="<?php echo $adminId; ?>">
                            <input class="form-control" type="text" name="username" autocomplete="off" value="<?php echo($row[0]['userName']); ?>" required>
                        </div>
                    </div>
                    <!-- Start  password field -->
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label"><?php echo lang('password'); ?></label>
                        <div class="col-sm-10 col-md-5">

                            <input type="hidden" name="oldpassword" value="<?php  echo($row[0]['password']); ?>">
                            <input class="form-control password" type="password" name="newpassword" autocomplete="off">
                            <i class="fa fa-eye fa-2x show-pass"> </i>

                        </div>
                    </div>
                    <!-- Start  Email field -->
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label"><?php echo lang('Email'); ?></label>
                        <div class="col-sm-10 col-md-5">
                            <input class="form-control" type="email" name="Email" autocomplete="off" value="<?php echo($row[0]['Email']); ?>" required>
                        </div>
                    </div>
                    <!-- Start  fullName field -->
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label"><?php echo lang('fullName'); ?></label>
                        <div class="col-sm-10 col-md-5">
                            <input class="form-control" type="text" name="fullName" autocomplete="off" value="<?php echo($row[0]['FullName']); ?>" required>
                        </div>
                    </div>
                    <!-- Start  Phone field -->
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Phone</label>
                        <div class="col-sm-10 col-md-5">
                            <input class="form-control" type="text" name="phone" autocomplete="off" value="<?php echo($row[0]['phone']); ?>" required>
                        </div>
                    </div>
                    <!-- Start  Upload Avatar Image  -->

                    <div class="form-group form-group-lg">

                        <label class="col-sm-2 control-label">Avatar</label>
                        <div class="col-sm-10 col-md-5">

                            <input class="form-control" type="file" name="avatar" >
                            <p style="color: red; font-size: 16px ;">[ If You Don't Change Your Avatar Don't Upload Image ] <p>
                        </div>
                    </div>
                    
                    <!-- Start Submit Button -->
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10 col-md-5">
                            <input class="btn btn-primary btn-lg" type="Submit" name="Submit" value="<?php echo lang('Save'); ?>">
                        </div>
                    </div>
                </form>
            </div>
    		
<?php # Start Code Php 

         
                 }else{  # Case Value idUser Not Exist In DataBase  
                        echo "<div class='container'>";
                        echo "<h1 class='text-center'>Edit  Member </h1>";
                        $msg = "<div class='alert alert-danger' ><strong>".lang('Sorry')." :( </strong> ".lang('ThatIdIsNotExist')." </div>";
                        redirectHome($msg,'back');
                        echo "</div>";
                 }  

        }elseif ($do == 'Update') { # this is page Update Member
            echo "<div class='container'>";
            echo "<h1 class='text-center'>". lang('UpdateMember') . " </h1>";

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $userId = filter_var($_POST['userId'],FILTER_VALIDATE_INT);
                $username = filter_var($_POST['username'],FILTER_SANITIZE_STRING);
                $phone = filter_var($_POST['phone'],FILTER_SANITIZE_STRING);
                $oldpassword = $_POST['oldpassword'];
                $newpassword = $_POST['newpassword'];
                $Email = filter_var($_POST['Email'],FILTER_VALIDATE_EMAIL);
                $fullName = filter_var($_POST['fullName'],FILTER_SANITIZE_STRING);

                // information  Avatar
                $uploadedFile = $_FILES['avatar'];

                if ($uploadedFile['error'] != 4) {  // Case User Upload New Avatar
                    // Get Info From The Form
                    $Image_name = $uploadedFile['name'];
                    $Image_type = $uploadedFile['type'];
                    $Image_size = $uploadedFile['size'];
                    $Image_error = $uploadedFile['error'];
                    $Image_temp = $uploadedFile['tmp_name'];

                    // Set Allowed File Extension
                    $AllowedExtension = array('jpg','png','jpeg','gif');

                    // Valdiation Field 
                        
                    // URL To Upload Images 
                    $SrcFileUpload = $_SERVER['DOCUMENT_ROOT'] . "\\"."eComarce\admin\Uploads\Avatars\\"  ;
                    
                    $smallLetterIamge  = strtolower($Image_name);
                    $explodemyImage = explode('.',$Image_name);
                    $imageExtension = end($explodemyImage);

                    $randomImage  = rand(0 , 100000000) . '.' . $imageExtension;

                    // array Conatin Error Update Information Member
                    $errors = array();

                    // Check Size Image
                    if ($Image_size > 4194304 ){
                            $errors[] = "<p class='alert alert-danger'>  avatar [".$Image_name."] Can't Be Than 4MB </p>";

                    }else if (! in_array($imageExtension,$AllowedExtension)){
                            $errors[] = "<p class='alert alert-danger'>  File [".$Image_name."] Is Not Image :(  </p>";
                    }

                    // Check If  Has No Error
                    if (empty($errors)){
                                // Move The Images

                        move_uploaded_file($Image_temp, $SrcFileUpload . $randomImage  );

                                
                    }

                }

                // Trick Password And Validation
                $pass = '' ; 
                if (!empty($newpassword)) {
                    if (strlen($newpassword) < 8) {
                        $errors[] = '<div class="alert alert-danger">'.lang('newPasswordcantBe<strong>LessThan8Charecter')  .' </div>';
                    }else{
                        $pass = sha1($newpassword);
                    }
                }else{ # filed Password Not Change  
                    $pass = $oldpassword ; 
                }
                $pass = empty($newpassword) ? $oldpassword : sha1($newpassword) ; 
                // Validation Form 
                // validation userName Field
                if (empty($username)) {
                    $errors[] = '<div class="alert alert-danger">'.lang('userNamecantBe<strong>Empty</strong>') .'</div>';
                }elseif (strlen($username) < 4) {
                    $errors[] = '<div class="alert alert-danger">'.lang('userNamecantBe<strong>lessThan4Charecter</strong>') .'</div>';
                }elseif (strlen($username) > 25) {
                    $errors[] = '<div class="alert alert-danger">'.lang('userNamecantBe<strong>MoreThan25Charecter</strong>').'</div>';
                }
                // vaidation Email filed
                if (empty($Email)) {
                    $errors[] = '<div class="alert alert-danger">'.lang('EmailcantBe<strong>Empty</strong>') .'</div>';
                }
                // validation fullName Field
                if (empty($fullName)) {
                    $errors[] = '<div class="alert alert-danger">'.lang('fullNamecantBe<strong>Empty</strong>') .'</div>';
                }elseif (strlen($fullName) < 4) {
                    $errors[] = '<div class="alert alert-danger">'.lang('fullNamecantBe<strong>lessThan4Charecter</strong>') .'</div>';
                }elseif (strlen($fullName) > 25) {
                    $errors[] = '<div class="alert alert-danger">'.lang('fullNamecantBe<strong>MoreThan25Charecter</strong>') .'</div>';
                } 

                if (!empty($errors)) { # Array Error Update Not Empty 
                    foreach ($errors as $error) {
                        echo $error;
                    }
                    
                    $msg = "<div class='alert alert-warning'>".lang('<strong>Sorry:(</strong>youMustBeTryAgain') ."</div>" ;
                    redirectHome($msg,'back');
                    
                    
                }else{ # No Error Update Information User 
            
                    if(isset($randomImage)){
                            $text = ", ImageUser = ? ";
                            $myvar = array($username,$pass,$phone,$Email,$fullName,$randomImage,$userId);

                            // Function Delete Old Photo 
                            $nameAvatar = deleteOldAvatar($userId) ;
                            unlink("Uploads/Avatars/" . $nameAvatar['ImageUser'] );
                    }else{
                            $text = "";
                            $myvar = array($username,$pass,$phone,$Email,$fullName,$userId);
                    }
                    $stmt = $conn->prepare("UPDATE users SET  userName = ? , password = ? , phone = ? , Email = ? , FullName = ? ".$text." WHERE userId = ? ");
                       
                    $stmt->execute($myvar);
                    $row = $stmt->rowCount();
                        # Show Message Success And Redirect Previous Page 
                        
                        $msg =  "<div class='alert alert-success'>" . $row . lang('RecordUpdated') ." </div>";
                        redirectHome($msg,'back');
                        
                }

            }else{
                # Show Message Error And Redirect Home Page 
                
                $msg = "<div class='alert alert-danger'>".lang('<strong>Sorry:(</strong>youCantBrowsThisPageDirect') ."</div>" ;
                redirectHome($msg);
                
            }

            echo "</div>";
        }

    	//  Include File Footer 
    	include $tpl . 'footer.php';
    }else{

    	header("location:index.php");
    	exit();
    }
