<?php
	ob_start();
	session_start();
	$TitlePage = 'Category';
	include 'init.php';
	$idCat = intval($_GET['id']);
	$CatName = gatCategory('id',$idCat);
	$ItemsCat = getItems('Cat_id', $idCat,'Approved');	 // Get Only Approve Items 
	$resaultFound = count($ItemsCat);
?>

	<div class="content_Category">
		<div class="content_Category_overlay">
  			<h1 class='text-center'><?php echo $CatName['name']; ?></h1>
  		</div>
  	</div>
 <div class="showProduct">
 	<div class='container'> 
		<div class="row">
					
		    <div class="col-md-12">
		    	<div class="InfoAndSort">
		    		<h4 class="foundReasault"><?php echo $resaultFound; ?>   product found </h4>
		    		
		    	</div>
		    	<hr>
				<?php
					
					foreach ($ItemsCat as $Item) {
									$imageName = $Item['ImagesItem'];
									$arrayImages = explode(',',$imageName );
									
									
									echo "<div class='col-md-2 col-sm-3'>";
									  echo "<div class=' itemBox CategoryImages'>";
									   
									   
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
				?>    		 
		    </div>
    </div>
</div>
 </div>

<?php 
    include $tpl . 'footer.php';
    ob_end_flush();
