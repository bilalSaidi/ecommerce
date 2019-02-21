<?php

    session_start();

if (isset($_SESSION['user'])) {
     
   

    $TitlePage = 'New Item';

    include 'init.php';

    if ($_SERVER['REQUEST_METHOD'] == "POST") {


        $uploadedFile = $_FILES['ImagesItem'];
        // Get Info From The Form
        $Image_name = $uploadedFile['name'];
        $Image_type = $uploadedFile['type'];
        $Image_size = $uploadedFile['size'];
        $Image_error = $uploadedFile['error'];
        $Image_temp = $uploadedFile['tmp_name'];

        // Set Allowed File Extension
        $AllowedExtension = array('jpg','png','jpeg','gif');


        $userID = $_SESSION['uid'];

        $Name = filter_var($_POST['name'],FILTER_SANITIZE_STRING);

        $Description = filter_var($_POST['Description'],FILTER_SANITIZE_STRING);

        $price = "$" . filter_var($_POST['price'],FILTER_SANITIZE_NUMBER_INT);

        $Country_Made = filter_var($_POST['Country_Made'],FILTER_SANITIZE_STRING);

        $status = filter_var($_POST['status'],FILTER_SANITIZE_NUMBER_INT);

        $Category = filter_var($_POST['Category'],FILTER_SANITIZE_NUMBER_INT);

        // array Conatin Error Update Information Member
        $errors = array();

        if (empty($Name)) {
            $errors['name'] = "<p class='alert alert-danger'>Field <strong> Name </strong> can't Be Empty </p>";
        }
        if (empty($Description)) {
            $errors['Description'] = "<p class='alert alert-danger'>Field <strong> Description </strong> can't Be Empty </p>";
        }elseif (strlen($Description) < 10 ) {
            $errors['Description'] = "<p class='alert alert-danger'>Field <strong> Description </strong> can't Be Less Then 10 Charecter </p>";
        }
        if (empty($price)) {
            $errors['price'] = "<p class='alert alert-danger'>Field <strong> price </strong> can't Be Empty </p>";
        }
        if (empty($Country_Made)) {
            $errors['Country_Made'] = "<p class='alert alert-danger'>Field <strong> Country Made </strong> can't Be Empty </p>";
        }
        if (empty($status)) {
            $errors['status'] = "<p class='alert alert-danger'>You Must Chose <strong> status </strong> </p>";
        }
        if (empty($Category)) {
            $errors['Category'] = "<p class='alert alert-danger'>You Must Chose <strong> Category </strong> </p>";
        }

        // Valdiation Field 
         // There Is No Image Uploaded 
        $ImageUpload = true;
        if ($Image_error[0] == 4 ) {
                $errors['NoImage'] =  "<p class='alert alert-danger'>  No Image Uploadeed :(  </p>";
                $ImageUpload = false ; 
        }
        // Image Upload
        if ($ImageUpload) {
            // Count Number Image 
            $fileCount = count($Image_name);
            // URL To Upload Images 
            $SrcFileUpload = $_SERVER['DOCUMENT_ROOT'] . "\\"."eComarce\admin\Uploads\Items\\"  ;
            // Seting Array Names DataBase
            $NameImagesDataBase  = array();
            for ($i = 0 ; $i < $fileCount ; $i++){

                // Setting Array Erros Upload Image
                //$errosUploadImages = array();

                // Seting Array Names DataBase

                // Set Image Extension
                $smallLetterIamge  = strtolower($Image_name[$i]);
                $explodemyImage = explode('.',$Image_name[$i]);
                $imageExtension[$i] = end($explodemyImage);

                $randomImage[$i]  = rand(0 , 100000000) . '.' . $imageExtension[$i];


                // Check Size Image
                if ($Image_size[$i] > 4194304 ){
                    $errors[] = "<p class='alert alert-danger'>  Image [".$Image_name[$i]."] Can't Be Than 4MB </p>";

                }else if (! in_array($imageExtension[$i],$AllowedExtension)){
                    $errors[] = "<p class='alert alert-danger'>  File [".$Image_name[$i]."] Is Not Image :(  </p>";
                }

                // Check If  Has No Error
                if (empty($errors)){
                    // Move The Images

                    move_uploaded_file($Image_temp[$i] , $SrcFileUpload . $randomImage[$i]  );

                    // Store Name Image In My Data Base
                    $NameImagesDataBase[] = $randomImage[$i];
                }else{
                    // Loop Through Errors
                    foreach ($errors as $eUI){
                        echo $eUI;
                    }
                }

            } // End Foor Loop
        }
        

        if (empty($errors)) {
            // String Contain Name All Image Uploaded 
             $FiledImagesName = implode(',' ,$NameImagesDataBase );
            $insertItem = $conn->prepare("INSERT INTO 
                                            items(
                                            name, 
                                            ImagesItem,
                                            Description, 
                                            price, 
                                            Country_Made, 
                                            Status, 
                                            Cat_id, 
                                            Member_id) 
                                            VALUES 
                                            (?,?,?,?,?,?,?,?)
            ");
            $insertItem->execute(array($Name,$FiledImagesName,$Description,$price,$Country_Made,$status,$Category,$userID));
            // Echo Success Insert Item 
            if ($insertItem) {
                echo "<div class='alert alert-success'> Item Inserted !!  </div>";
            }else{
                echo "<div class='alert alert-danger'>Error Insert Item :( Try Again </div>";
            }
        }else{

            foreach ($errors as $error) {
                echo $error;
            }

        }
        
        
    }

?>
<h1 class="text-center"> Add New  Item </h1>
<!-- Start Block Information User -->
<div class="information Block ">
	<div class="container">
		<div class="panel   panel-primary">
			<div class="panel-heading">
				Create New Item
			</div>
			<div class="panel-body">
                <div class="row">
    				<div class="col-md-8">
        				<form  
                            class="form-horizontal formAddItem" 
                            method="POST" 
                            action="<?php $_SERVER['PHP_SELF'] ?>" 
                            enctype="multipart/form-data"
                        >
                                <!-- Start  username field -->
                                <div class="form-group form-group-lg">
                                    <label class="col-sm-2 control-label">Name</label>
                                    <div class="col-sm-10 col-md-9">
                                        <input 
                                            class="form-control Live-Name" 
                                            type="text" 
                                            name="name" 
                                            autocomplete="off"  
                                            
                                            placeholder="Name of The Item">
                                    </div>
                                </div>
                                 <!-- Start  username field -->
                                <div class="form-group form-group-lg">
                                    <label class="col-sm-2 control-label"> Images</label>
                                    <div class="col-sm-10 col-md-9">
                                        <input 
                                            class="form-control" 
                                            type="file" 
                                            name="ImagesItem[]" 
                                            autocomplete="off"  
                                            multiple="multiple" 
                                            >
                                    </div>
                                </div>
                                <!-- Start  Description  field -->
                                <div class="form-group form-group-lg">
                                    <label class="col-sm-2 control-label">Description</label>
                                    <div class="col-sm-10 col-md-9">
                                        <input 
                                            class="form-control Live-Desc" 
                                            type="text" 
                                            name="Description" 
                                            autocomplete="off"  
                                            
                                            placeholder="Description of The Item ">
                                    </div>
                                </div>
                                <!-- Start  Price  field -->
                                <div class="form-group form-group-lg">
                                    <label class="col-sm-2 control-label">Price</label>
                                    <div class="col-sm-10 col-md-9">
                                        <input 
                                            class="form-control Live-Price" 
                                            type="text" 
                                            name="price" 
                                            autocomplete="off"  
                                            
                                            placeholder="Price Of The Item ">
                                    </div>
                                </div>
                                <!-- Start  Country Made   field -->
                                <div class="form-group form-group-lg">
                                    <label class="col-sm-2 control-label">Country Made</label>
                                    <div class="col-sm-10 col-md-9">
                                        <input 
                                            class="form-control" 
                                            type="text" 
                                            name="Country_Made" 
                                            autocomplete="off"  
                                            
                                            placeholder="Country Made of The Item  ">
                                    </div>
                                </div>
                                <!-- Start  Status  field -->
                                <div class="form-group form-group-lg">
                                    <label class="col-sm-2 control-label">Status</label>
                                    <div class="col-sm-10 col-md-9">
                                        <select name="status" class="form-control">
                                            <option value="">...</option>
                                            <option value="1">new</option>
                                            <option value="2">Like New </option>
                                            <option value="3">Used </option>
                                            <option value="4"> Very Old </option>
                                        </select>
                                    </div>
                                </div>
                                <!-- Start  Category  field -->
                                <div class="form-group form-group-lg">
                                    <label class="col-sm-2 control-label">Category</label>
                                    <div class="col-sm-10 col-md-9">
                                        <select name="Category" class="form-control">
                                            <option value="">...</option>
                                            <?php
                                                $statement = $conn->prepare("SELECT id, name FROM categories ");
                                                $statement->execute();
                                                $categories =  $statement->fetchAll();
                                                foreach ($categories as $cat) {
                                                    echo "<option value='".$cat['id']."'>".$cat['name']."</option>";
                                                }
                                                
                                            ?>
                                        </select>   
                                    </div>
                                </div>
                                
                                <!-- Start Submit Button -->
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10 col-md-5">
                                        <input 
                                            class="btn btn-primary " 
                                            type="Submit" 
                                            name="Submit" 
                                            value="New Item">
                                    </div>
                                </div>
                        </form>
    				</div>
    				<div class="col-md-4">
    			    	<div class='thumbnail itemBox Live-preview'>
    			    		 <span class='priceTag'>0</span>
    			    		 <img class='img-responsive' src="<?php echo $img ;  ?>itemNone.jpg ">
    			    		 <div class='caption'>
    			    			 <h3>Title</h3>
    			    			 <p>Descreption</p>
    			    		 </div>
    			    	</div>
    				</div>  
                </div>
<?php
/*
    if (!empty($errors)) { // Show Error Message 
           
        } 
*/
?>
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