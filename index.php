<?php

	ob_start();
	session_start();

    include 'init.php';

    // Get Three Random Items For Slider





  ?>
<div class="PageIndex">

	<!-- Start Slider -->
	<div class="container">
		<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">


		  <!-- Wrapper for slides -->
		  <div class="carousel-inner" role="listbox">
		    <div class="item active">
		      <img src="layout\images\sliderImages\01.png" alt="...">

		    </div>
		    <div class="item ">
		      <img src="layout\images\sliderImages\02.png" alt="...">

		    </div>
		    <div class="item ">
		      <img src="layout\images\sliderImages\03.png" alt="...">

		    </div>
		    <div class="item ">
		      <img src="layout\images\sliderImages\04.png" alt="...">

		    </div>
		  </div>
          <!-- Controls -->
          <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
          </a>
          <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
          </a>
		</div>
	</div>

	<!-- End Slider -->


	<?php
		$Category = getCat() ;
	     foreach ($Category as $cat) {


	?>

		<div  class="container">
			<div class="product_popular">
				<p> <?php  echo $cat['name']; ?> </p>
				<?php
				echo "<span><a href='category.php?id=".$cat['id']."'> See more >  </a> </span>";
				?>

			</div>
			<div class="showProductIndex">
			 	<div class='container'>
					<div class="row">

					    <div class="col-md-12">

							<?php

								$ItemsCat = getSomeItems($cat['id']);
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

	 </div>
	<?php
	     }

	?>


	 </div>
</div>
<?php
    include $tpl . 'footer.php';

    ob_end_flush();
