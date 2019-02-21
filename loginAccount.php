<?php

    session_start();

    if (isset($_SESSION['user'])) {
        header("location:index.php"); // Redirect Home Page  
        exit();
    }

    $TitlePage = 'Login';

    include 'init.php'; 

    // Check If The User Coming From HTTP REQUEST METHOD POST 
    if ($_SERVER['REQUEST_METHOD'] === "POST"){ 
    		if (isset($_POST['Login'])) { 
    			
		        $user = filter_var($_POST['userName'] , FILTER_SANITIZE_STRING); 
		        $pass = sha1(filter_var($_POST['password'],FILTER_SANITIZE_STRING)); 
		                // check If This Person Exist Or Not

		        $stmt = $conn->prepare("SELECT  
		        						userID,
		                                userName, 
		                                password 
		                                FROM  
		                                users
		                                WHERE 
		                                userName = ? 
		                                AND 
		                                password = ? 
		        ");

		        $stmt->execute(array($user,$pass));
		        $resault = $stmt->fetch();
		        $count = $stmt->rowCount();
		            
		        if ($count) {
		            $_SESSION['user'] = $user;  // save session username 
		            $_SESSION['uid'] = $resault['userID']; // Save Seesion userID
		            header('location:index.php');
		            exit();
		                    
		        }
    		}else{
    			$Name = filter_var($_POST['userName'],FILTER_SANITIZE_STRING);
    			$Pass = $_POST['password'];
    			$PassConfirm = $_POST['password2'];
    			$Email = filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);

    			$Error = array();
    			// Validation Field Name 
    			if (empty($Name)) {
    				$Error['Name'] =  "Field Name Can't By Empty  ";
    			}elseif (strlen($Name) < 4 ) {
    				$Error['Name'] = "Name Can't Be Less Then 4  Charecter  ";
    			}elseif (strlen($Name) > 20 ) {
    				$Error['Name'] = "Name Can't Be More Than 20 Charecter " ;
    			}
    			// Validation Password 
    			if (empty($Pass)) {
    				$Error['Pass'] = "Filed Password Can't Be Empty ";
    			}elseif (strlen($Pass) < 8 ) {
    				$Error['Pass'] = "Filed Password Can't Be Less Than 8 Charecter ";
    			}elseif ($Pass !== $PassConfirm) {
    				$Error['Pass'] = "Password And Password Confirm Not Match ";
    			}
    			// Encrypte Password 
    			$HashPassword = sha1($Pass);
    			// Validation Email 
    			if(empty($Email)){
    				$Error['Email'] = "Field Email Can't Be Empty";
    			}elseif (filter_var($Email,FILTER_VALIDATE_EMAIL) != true) {
    				$Error['Email'] = "This Email Is Not Valid ";
    			}

    			// Check If UserName Exist In Data Base 
    			if(checkItem('userName','users',$Name) == 1 ){
    				$Error['Name'] = "This User Exist Try Another Name ";
    			}

    			// If Thers's No Error Insert User Into Data Base 
    			if (empty($Error)) {
    				$insertUser = $conn->prepare("INSERT INTO
    					 							`users`(
    					 							`userName`, 
    					 							`password`,
    					 							`Email`,
    					 							`GroupID`,
    					 							`Regstatus`) 
    					 							VALUES 
    					 							(?,?,?,0,0)
    				");
    				$insertUser->execute(array($Name,$HashPassword,$Email));
    				// Show Success Masseage
    				$MasseageSuccess = "<p class='alert alert-success'> You Can Now Login To Your Account </p>";
    			}

    		}
    }

?>
	<div class="container loginAccount">
		<h1 class="text-center">
			<span class="active" data-class="login">Login </span> | <span  data-class="SignUp">SignUp</span>
		</h1>
		<!-- Start Login -->
		<form class="login" method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">
			<div class="FormContent">
				
				<input 
					class="form-control" 
					type="text" 
					name="userName"
					placeholder="Type Your Name "
					autocomplete="off" 
					required>
			</div>
			<div class="FormContent">
				
				<input 
					class="form-control" 
					type="password" 
					name="password"
					placeholder="Type Your password "
					autocomplete="new-password" 
					required>
			</div>
			<input 
				class="btn btn-lg btn-primary btn-block" 
				type="submit" 
				name="Login" 
				value="Login">
		</form>
		<!-- End Login -->
		<!-- Start SignUp -->
		<form class="SignUp" method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">
			<div class="FormContent">
				<input 
					class="form-control" 
					type="text" 
					name="userName"
					placeholder="Type Your User  Name "
					minlength="4"
					autocomplete="off" 
					required>
			</div>
			<div class="FormContent">
				<input 
					class="form-control" 
					type="password" 
					name="password"
					placeholder="Type Your password "
					minlength="8" 
					required>
			</div>
			<div class="FormContent">
				<input 
					class="form-control" 
					type="password" 
					name="password2"
					minlength="8" 
					placeholder="Confirm Your password "
					required>
			</div>
			<div class="FormContent">
				<input 
					class="form-control" 
					type="email" 
					name="email"  
					placeholder="Type a Valid Email "
					autocomplete="off" 
					required>
			</div>
			<input 
				class="btn btn-lg btn-success btn-block" 
				type="submit" 
				name="SignUp" 
				value="SignUp">
		</form>
		<!-- Start SignUp -->
		<!-- Start Message Error -->
		<div class="text-center Message-Error">
<?php
		if (!empty($Error)) {
		 	foreach($Error as $error){
		 		echo "<p class='alert alert-danger'>" . $error  . "</p>";
		 	}
		}elseif(isset($MasseageSuccess)){
			echo $MasseageSuccess;
		} 
?>
		</div>
		<!-- End Message Error -->
	</div>
<?php
    include $tpl . 'footer.php';