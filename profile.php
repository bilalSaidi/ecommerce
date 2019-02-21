<?php

    session_start();

if (isset($_SESSION['user'])) {
     
   

    $TitlePage = 'Profile';

    include 'init.php';

?>
<h1 class="text-center"> Profile : <?php echo $_SESSION['user']; ?> </h1>
<!-- Start Block Information User -->
<div class="information Block ">
	<div class="container">
		<div class="panel   panel-primary">
			<div class="panel-heading">
				Generale Information 
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
						<i class="fa fa-tag"></i>
						<span>Fav Category : </span><?php echo ""; ?>
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
						    	echo "<div class='col-md-3 col-sm-6'>";
						    		echo "<div class='thumbnail itemBox'>";
						    			if ($Item['Approve'] == 0) {
						    				echo "<span class='ItemApprove'> Waiting For Approve Item  </span>";
						    			}
						    			echo "<span class='priceTag'>".$Item['price']."</span>";
						    			echo "<img class='img-responsive' src=' " . $img . "itemNone.jpg'>";
						    			echo "<div class='caption'>";
						    				echo "<h3> <a href='Items.php?idItem=".$Item['item_id']."' target='_blanck'> " . $Item['name'] . "</a></h3>";
						    				echo "<p>" . substr($Item['Description'], 0,28) . "</p>";
						    				echo " <div class='date'> " . date('20y-m-d',strtotime($Item['Add_Date'])) . " </div> ";
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