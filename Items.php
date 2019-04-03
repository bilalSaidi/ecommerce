<?php
	ob_start();
	session_start();

	$TitlePage = 'Show Item';

	include 'init.php';

	$itemID = isset($_GET['idItem']) && is_numeric($_GET['idItem']) ? intval($_GET['idItem']) : 0 ; 
	if ($itemID !== 0) {
		
	
		// Select All Data Depend On This Id 
		$stmt = $conn->prepare("SELECT 
								items.* ,
								categories.name AS NameCategory ,
								users.userName AS UserAddItem ,
								users.phone AS phoneUser 
								FROM 
								items
								INNER JOIN
								categories
								ON 
								categories.id = items.Cat_id
								INNER JOIN
								users
								ON 
								users.userID = items.Member_id
 								WHERE 
 								item_id = ? 
 								AND 
 								items.Approve = 1
 								LIMIT 1 
 		");

		$stmt->execute(array($itemID));

		// Count 

		$count = $stmt->rowCount();
		if ($count > 0) {
			
		// Fetch The Data 

		$item = $stmt->fetch();

		// URL To Upload Images 
		$SrcFileUpload = $_SERVER['DOCUMENT_ROOT'] . "\\"."eComarce\admin\Uploads\Items\\"  ;
		$imageName = $item['ImagesItem'];
		$arrayImages = explode(',',$imageName );

	?>


	<h1 class="text-center"> <?php echo $item['name']; ?> </h1>
	<div class="container">
		<div class="row">
			<div class="col-md-12 ItemInfo">
				<ul class="list-unstyled col-md-6">
					<li>
						<h3><?php echo $item['name'];  ?></h3>
					</li>
					<li>
						<p><?php echo  $item['Description']; ?></p>
					</li>
					<li>
						<i class="fa fa-calendar fa-fw"></i>
						<span>Added Date   </span><?php echo ": " . date("20y-m-d",strtotime($item['Add_Date'])); ?>
					</li>
					<li>
						<i class="fa fa-money fa-fw"></i>
						<span>Price </span><?php echo ": " .   $item['price']; ?>
					</li>
					<li>
						<i class="fa fa-building fa-fw"></i>
						<span>Made In   </span><?php echo ": " . $item['Country_Made']; ?>
					</li>
					<li>
						<i class="fa fa-tag fa-fw"></i>
						<span>Categoey  </span>
						<a href="category.php?id=<?php echo $item['Cat_id'] ;  ?>"><?php echo ": " . $item['NameCategory']; ?></a>
					</li>
					
					<li>
						<i class="fa fa-user fa-fw"></i>
						<span>Added By   </span><?php echo ": " . $item['UserAddItem']; ?>
					</li>
					<li>
						<i class="fa fa-phone"></i>
						<span>phone  </span><?php echo ": 0" . $item['phoneUser']; ?>
					</li>
				</ul> 
				<div class="mainImage col-md-6">
<?php
					echo '<img class="img-responsive img-thumbnail" src="admin/Uploads/Items/'.$arrayImages[0] .'"  />' ;
?>
				</div>
			</div>
			<div class="col-md-12">

				<?php
					
					if (empty($imageName)) {
						
						echo '<img class="img-responsive img-thumbnail image-default" src="admin/Uploads/Items/defaultItem.jpg"  />' ;

					}
				 ?>
				 <h3>Images : </h3>
				<div class="cards">
				<?php
					

					if (! empty($imageName)) {
						foreach ($arrayImages as $image) {
							echo "<div class='  col-md-2 col-sm-4'>";
							echo "<a href='admin/Uploads/Items/".$image."'  data-lightbox='roadtrip' data-title='".$item['name']."' >" ;
								echo '<img class="img-responsive img-thumbnail" src="admin/Uploads/Items/'.$image .'"  />' ;
							echo "</a>";
							echo "</div>";
						}
					}
					
				?>
				</div>
			</div>


		</div>
		
		<?php  if (isset($_SESSION['user'])) {?>
		<!-- Start Add Comment -->
		<div class="row">
			<div class="sendComment">
				<div class="addComment">
					<h4> Add Your Comment </h4>
					
					<form action="<?php echo $_SERVER['PHP_SELF'] . '?idItem=' . $item['item_id']  ?>" method="POST">
						<textarea class="form-control" rows="3" name="Comment"></textarea>
						<input type="submit" value="Send Comment" class="btn btn-primary">
					</form>
					<?php
						if ($_SERVER['REQUEST_METHOD'] === 'POST') {
							$Comment = filter_var($_POST['Comment'] , FILTER_SANITIZE_STRING);
							$Member = $_SESSION['uid'] ;
							$Item = $item['item_id'] ;
							if (empty($Comment)) {
								echo "<p class='alert alert-danger'>There's No Comment :( </p>";
							}else{
								$stmtSendComment = $conn->prepare("INSERT INTO comment(comment,idMember,idItem) VALUES (?,?,?)");
								$stmtSendComment->execute(array($Comment,$Member,$Item));
								if ($stmtSendComment) {
									echo "<p class='alert alert-success'>Comment Send Successfully :)  </p>";
								}else{
									echo "<p class='alert alert-danger'>Sorry Error Send Comment Try Again :(  </p>";
								}
							}
						}
					?>
				</div>
			</div>
		</div>
		<!-- End Add Comment -->
		
		<?php } else { echo "<span class='alertRegisterComment'>You Must By <a href='loginAccount.php'>Login</a> Or <a href='loginAccount.php'>SignUp</a> To Add Comment</span> ";} ?>
		
		<!--  Show Comment Item  -->
			<?php
				$showComment = $conn->prepare("SELECT 
							comment.* ,
							users.userName AS userComment ,
							users.ImageUser AS AvatarUser
							FROM 
							comment
							INNER JOIN 
							users 
							ON 
							users.userID = comment.idMember
							WHERE
							comment.idItem = ? 
							AND 
							comment.status = 1
				");
				$showComment->execute(array($item['item_id'] )); 
				$count = $showComment->rowCount();
				$Comments = $showComment->fetchAll();
				if ($count > 0) {
					foreach ($Comments as $Comment) { ?>
						<div class="row">
							<div class="Comment">
<?php
						              if (empty($Comment['AvatarUser'])) {
						                  echo " <img src='admin/Uploads/Avatars/deaultAvatar.jpg' alt='Avatar' class='comment-avatar' /> ";
						              }else{
						                  echo " <img src='admin/Uploads/Avatars/".$Comment['AvatarUser']."' alt='Avatar' class='comment-avatar' /> "; 
						              }
             						   
?> 
								
								<div class="comment-body">
									<span class="comment-author"><?php echo  $Comment['userComment'] ; ?></span>
									<abbr class="comment-date">
										<?php echo  date('20y-m-d',strtotime($Comment['addDate'])); ?>
									</abbr>
									<div class="comment-text">
										<p><?php echo   $Comment['comment']; ?></p>
									</div>
								</div>
							</div>
						</div>
						
					<?php }
				}else{
					echo "<p class='text-center'> There's No Comment To Show </p>";
				}
			?>	
	</div>




<?php
		
		}else{ // No Id Found 
			echo "<p class='alert alert-danger'>There's No Such ID Or Waiting For Approve This Item </p>";
		} 
	}else{ // Error Url 
		header("location:index.php");
		exit();
	}

include $tpl . 'footer.php';

ob_end_flush();