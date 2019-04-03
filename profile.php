<?php


	ob_start();

	
    session_start();

if (isset($_SESSION['user'])) {
     
   

    $TitlePage = 'Profile';

    include 'init.php';

?>
<h1 class="text-center"> Profile : <?php echo $_SESSION['user']; ?> </h1>

<?php

	$do = isset($_GET['do']) ? $_GET['do'] : '';

if ($do =='edit') {   # This Is Page Edit Member 
          
          
            $adminId= $_SESSION['uid'] ; 
            $stmt = $conn->prepare("SELECT  * FROM  `users`   WHERE  userID = ?  LIMIT 1 ");
            $stmt->execute(array($adminId));
            $count = $stmt->rowCount();
            $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
            

?> <!-- Start  Html -->
			<div class="EditProfileInside">
	    		<h2 class="text-center">Edit Profile </h2>
	            <div class="container">
	                <form  class="form-horizontal" method="POST" action="?do=Update" enctype="multipart/form-data">
	                    <!-- Start  username field -->
	                    <div class="form-group form-group-lg">
	                        <label class="col-sm-2 control-label">User Name </label>
	                        <div class="col-sm-10 col-md-5">
	                            <input type="hidden" name="userId" value="<?php echo $adminId; ?>">
	                            <input class="form-control" type="text" name="username" autocomplete="off" value="<?php echo($row[0]['userName']); ?>" required>
	                        </div>
	                    </div>
	                    <!-- Start  password field -->
	                    <div class="form-group form-group-lg">
	                        <label class="col-sm-2 control-label">Password</label>
	                        <div class="col-sm-10 col-md-5">

	                            <input type="hidden" name="oldpassword" value="<?php  echo($row[0]['password']); ?>">
	                            <input class="form-control password" type="password" name="newpassword" autocomplete="off">
	                            <i class="fa fa-eye fa-2x show-pass"> </i>

	                        </div>
	                    </div>
	                    <!-- Start  Email field -->
	                    <div class="form-group form-group-lg">
	                        <label class="col-sm-2 control-label">Email</label>
	                        <div class="col-sm-10 col-md-5">
	                            <input class="form-control" type="email" name="Email" autocomplete="off" value="<?php echo($row[0]['Email']); ?>" required>
	                        </div>
	                    </div>
	                    <!-- Start  fullName field -->
	                    <div class="form-group form-group-lg">
	                        <label class="col-sm-2 control-label">Full Name </label>
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
	                            <input class="btn  btn-lg" type="Submit" name="Submit" value="<?php echo lang('Save'); ?>">
	                        </div>
	                    </div>
	                </form>
	            </div>
        	</div>
    		
<?php # Start Code Php 

         
        

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
                            unlink("admin/Uploads/Avatars/" . $nameAvatar['ImageUser'] );
                    }else{
                            $text = "";
                            $myvar = array($username,$pass,$phone,$Email,$fullName,$userId);
                    }
                    $stmt = $conn->prepare("UPDATE users SET  userName = ? , password = ? , phone = ? , Email = ? , FullName = ? ".$text." WHERE userId = ? ");
                       
                    $stmt->execute($myvar);
                    $row = $stmt->rowCount();
                        # Redirect Profile Page  
                       
                        header("location:profile.php");
                        exit();
                        
                }

            }else{
                # Show Message Error And Redirect Home Page 
                
                $msg = "<div class='alert alert-danger'>".lang('<strong>Sorry:(</strong>youCantBrowsThisPageDirect') ."</div>" ;
                redirectHome($msg);
                
            }

            echo "</div>";
        }








 ?>
<!-- Start Block Information User -->
<div class="information Block ">
	<div class="container">
		<div class="panel   panel-primary">
			<div class="panel-heading">
				Generale Information [<a href="?do=edit" style="color: orange;">Edit Profile</a>]
			</div>
			<div class="panel-body">
<?php
				$GetInfo = $conn->prepare("SELECT * FROM users WHERE userName = ? LIMIT 1 ");
				$GetInfo->execute(array($_SESSION['user'])); 
				
				$Resualt = $GetInfo->fetchAll();

?>
				<ul class="list-unstyled">
					<li>
						<i class="fa fa-unlock-alt"></i>
						<span>User Name : </span>
						<?php echo $Resualt[0]['userName'] ; ?>
					</li>
					<li>
						<i class="fa fa-envelope-o"></i>
						<span>Email : </span>
						<?php echo $Resualt[0]['Email'] ; ?>
					</li>
					<li>
						<i class="fa fa-user"></i>
						<span>Full Name  : </span>
						<?php echo $Resualt[0]['FullName'] ; ?>
					</li>
					<li>
						<i class="fa fa-calendar"></i>
						<span>Date Registred : </span>
						<?php echo $Resualt[0]['date_Registred'] ; ?>
					</li>
					<li>
						<i class="fa fa-phone"></i>
						<span>phone : </span>
						<?php echo '0' . $Resualt[0]['phone'] ; ?>
					</li>
				</ul>

			</div>
		</div>
	</div>
</div>

<!-- Start Block Information adv  -->
<div class="information Block ">
	<div class="container">
		<div class="panel   panel-primary">
			<div class="panel-heading">
				Your ADV
			</div>
			<div class="panel-body">
<?php

				 if(!empty (getItems('Member_id',$Resualt[0]['userID']))){
				 		echo "<div class='row'> ";
				 			foreach (getItems('Member_id',$Resualt[0]['userID']) as $Item) {
									$imageName = $Item['ImagesItem'];
									$arrayImages = explode(',',$imageName );
									
									
									echo "<div class='col-md-3 col-sm-3'>";
									  echo "<div class=' itemBox CategoryImages'>";
									   
									   if ($Item['Approve'] == 0) {
						    				echo "<span class='ItemApprove'> Waiting For Approve Item  </span>";
						    			}
									   // If There is No Image 

									   if (empty($imageName)) {
										
											echo '<img class="img-responsive  image-default" src="admin/Uploads/Items/defaultItem.jpg"  />' ;

										}else{ // Case Exist Image 
													
											echo '<img class="img-responsive " src="admin/Uploads/Items/'.$arrayImages[0] .'"  />' ;	
										}

									   echo "<div class='caption'>";
									    echo "<h4> <a href='Items.php?idItem=".$Item['item_id']."' target='_blanck'> " . $Item['name'] . "</a></h4>";
									    echo "<span class='priceTag'>".$Item['price']."</span>";
									    echo "<p>" . substr($Item['Description'], 0,28) . "</p>";
									    
									   echo "</div>";
									  echo "</div>";
									  
									echo "</div>";
			   				 }
				 		echo "</div>";
				 }else{
				 	echo " there's No Item To Show ";
				 }
?>
			</div>
		</div>
	</div>
</div>

<!-- Start Block Comment -->
<div class="information Block ">
	<div class="container">
		<div class="panel   panel-primary">
			<div class="panel-heading">	
				Your Comment 
			</div>
			<div class="panel-body">
				this is Comment user 
			</div>
		</div>
	</div>
</div>
<?php

 }else{
 	header("Location:loginAccount.php");
 	exit();
 }

    include $tpl . 'footer.php';

    ob_end_flush();