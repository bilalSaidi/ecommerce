<?php 

/*
=========================================================================================
							Page Items  

				 You Can 	isert|udate|delete   Item   and other thing    From  Here 

=========================================================================================
*/
	
    session_start();

    if (isset($_SESSION['username'])) {

    	// Varibale Contain Name Page 
        $TitlePage = 'Items';
        // Include File Init 
    	include 'init.php';


    	$do = isset($_GET['do'])	? $_GET['do'] : 'Manage';

        

    	if ($do == 'Manage') {  # Page Manage Items 
 
            // Select All Items  
            $stmt = $conn->prepare("SELECT 
                                        items.* , categories.name AS catName , users.userName AS nameMember from items 
                                    INNER JOIN 
                                        categories 
                                    ON 
                                        categories.id = items.Cat_id
                                    INNER JOIN 
                                        users 
                                    ON 
                                        users.userID = items.Member_id 
                                    ORDER BY item_id DESC
                                    ");
            $stmt->execute();
            $Items =  $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (! empty($Items)) { # Exist Items In Data Base 
           
?><!-- Start Html -->
                <h1 class='text-center'> Manage Item </h1>;

                <div class="container">
                    <a href='?do=add' class="btn btn-primary btnAddCat"><i class="fa fa-plus"></i> Add New Item </a>
                    <div  >
                        <table class=" table table-bordered display responsive nowrap" style="width:100%">
                            <thead>
                                <th>#ID</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>price</th>
                                <th>Add_Date</th>
                                <th>Country Made</th>
                                <th>Category</th>
                                <th>User Name </th>
                                <th>Control</th>
                            </thead>
                            <tbody>
<?php #Start Code Php 
                            foreach ($Items as $Item) {
                                echo "<tr>";
                                    echo '<td>'.$Item['item_id'].'</td>';
                                    echo '<td>'.$Item['name'].'</td>';
                                    echo '<td>'.$Item['Description'].'</td>';
                                    echo '<td>'.$Item['price'].'</td>';
                                    echo '<td>'.$Item['Add_Date'].'</td>';
                                    echo '<td>' .$Item['Country_Made']. '</td>';
                                    echo '<td>' .$Item['catName']. '</td>';
                                    echo '<td>' .$Item['nameMember']. '</td>';
                                    echo '<td>' ;
                                        echo "<a href='?do=Edit&id= " . $Item["item_id"] . "' class='btn btn-success control_member'><i class='fa fa-edit'></i> Edit </a> ";
                                        echo '<a href="?do=Delete&id= '.$Item["item_id"] . '" class=" confirm btn btn-danger control_member"> <i class="fa fa-close"></i>Delete </a> ';
                                    
                                    # Member Not Activate 
                                    if ($Item['Approve'] != 1) {

                                        echo '<a href="?do=ItemActivate&id= '.$Item["item_id"] . '" class="  btn btn-info control_member"> <i class="fa fa-check"></i>Activate </a> ';
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
        }else{ # Case No Item In Data Base 
            echo "<div class='container contMessage' > ";
                echo "<div class='niceMessage' > " ; 
                    echo "<p> there's No Item To Show </p>";
                echo "</div>";
                $stmt2= $conn->prepare(" SELECT * FROM categories ");
                $stmt2->execute();
                $resault = $stmt2->rowCount();
                if ($resault == 0) {
                    echo "<a href='?do=wrongAdd' class='btn btn-primary btnAddNoOption'><i class='fa fa-plus'></i> Add New Item </a>";
                }else{
                    echo "<a href='?do=add' class='btn btn-primary btnAddNoOption'><i class='fa fa-plus'></i> Add New Item </a>";
                }
                
            echo "</div>";
        }   
        }elseif ($do == "wrongAdd") {
            echo "<div class='container'>";
            $msg =  "<div class='alert alert-danger' style='margin-top:10px;'>Sorry You Must <strong>Create Category Before Create Item</strong> </div>";
            redirectHome($msg,'back');
            echo "</div>";
            
        }elseif($do == 'add'){  # Page Add New Item 
        
?><!-- Html Start Here -->
        <h1 class="text-center">Add New Item  </h1>
            <div class="container">
                <form  class="form-horizontal" method="POST" action="?do=insert" enctype="multipart/form-data">
                    <!-- Start  Name Item  field -->
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-10 col-md-5">
                            <input 
                                class="form-control" 
                                type="text" 
                                name="name" 
                                autocomplete="off"  
                                required="required"
                                placeholder="Name of The Item">
                        </div>
                    </div>
                     <!-- Start  Images Item   field -->
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label" for="UploadFile">Upload Images </label>
                        <div class="col-sm-10 col-md-5">
                            <input 
                                class="form-control" 
                                id="UploadFile"
                                type="file" 
                                name="Images" 
                                autocomplete="off" 
                                multiple="multiple" 
                                required="required"
                                placeholder="Name of The Item">
                        </div>
                    </div>
                    <!-- Start  Description  field -->
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Description</label>
                        <div class="col-sm-10 col-md-5">
                            <input 
                                class="form-control" 
                                type="text" 
                                name="Description" 
                                autocomplete="off"  
                                required="required"
                                placeholder="Description of The Item ">
                        </div>
                    </div>
                    <!-- Start  Price  field -->
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Price</label>
                        <div class="col-sm-10 col-md-5">
                            <input 
                                class="form-control" 
                                type="text" 
                                name="price" 
                                autocomplete="off"  
                                required="required"
                                placeholder="Price Of The Item ">
                        </div>
                    </div>
                    <!-- Start  Country Made   field -->
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Country Made</label>
                        <div class="col-sm-10 col-md-5">
                            <input 
                                class="form-control" 
                                type="text" 
                                name="Country_Made" 
                                autocomplete="off"  
                                required="required"
                                placeholder="Country Made of The Item  ">
                        </div>
                    </div>
                    <!-- Start  Status  field -->
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Status</label>
                        <div class="col-sm-10 col-md-5">
                            <select name="status" class="form-control">
                                <option value="0">...</option>
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
                        <div class="col-sm-10 col-md-5">
                            <select name="Category" class="form-control">
                                <option value="0">...</option>
                                <?php
                                   
                                    $categories =  getCat();
                                    foreach ($categories as $cat) {
                                        echo "<option value='".$cat['id']."'>".$cat['name']."</option>";
                                        $childCat =  getCat($cat['id']);

                                        foreach ($childCat as $child) {
                                                echo "<option value='".$child['id']."'> --- ".$child['name']."</option>";
                                        }
                                        
                                    }
                                    
                                ?>
                            </select>   
                        </div>
                    </div>
                    <!-- Start  Member  field -->
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Member</label>
                        <div class="col-sm-10 col-md-5">
                            <select name="Member" class="form-control">
                                <option value="0">...</option>
                                <?php
                                    $statement2 = $conn->prepare("SELECT userID, userName FROM users  ");
                                    $statement2->execute();
                                    $members =  $statement2->fetchAll();
                                    foreach ($members as $Member) {
                                        echo "<option value='".$Member["userID"]."'>".$Member["userName"]."</option>";
                                    }
                                    
                                ?>
                            </select>
                        </div>
                    </div>
                    <!-- Start Submit Button -->
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10 col-md-5">
                            <input 
                                class="btn btn-primary btn-lg" 
                                type="Submit" 
                                name="Submit" 
                                value="Add New Item">
                        </div>
                    </div>
                </form>
            </div>
<?php # Php Start Here 
        }elseif($do == 'insert'){ # Page Insert Item 

            echo "<div class='container'>";
            echo "<h1 class='text-center'>Insert  Item </h1>";

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $name = $_POST['name'];
                $Description = $_POST['Description'];
                $price = $_POST['price'];
                $Country_Made = $_POST['Country_Made'];
                $status = $_POST['status'];
                $Category = $_POST['Category'];
                $Member = $_POST['Member'];
                
                // array Conatin Error Update Information Member
                $errors = array();
                // Valdiation Field 
                if (empty($name)) {
                    $errors['name'] = "<div class='alert alert-danger'>Field <strong> Name </strong> can't Be Empty </div>";
                }
                if (empty($Description)) {
                    $errors['Description'] = "<div class='alert alert-danger'>Field <strong> Description </strong> can't Be Empty </div>";
                }
                if (empty($price)) {
                    $errors['price'] = "<div class='alert alert-danger'>Field <strong> price </strong> can't Be Empty </div>";
                }
                if (empty($Country_Made)) {
                    $errors['Country_Made'] = "<div class='alert alert-danger'>Field <strong> Country_Made </strong> can't Be Empty </div>";
                }
                if ($status == 0) {
                    $errors['status'] = "<div class='alert alert-danger'>You Must Chose <strong> status </strong> </div>";
                }
                if ($Category == 0) {
                    $errors['Category'] = "<div class='alert alert-danger'>You Must Chose <strong> Category </strong> </div>";
                }
                if ($Member == 0) {
                    $errors['Member'] = "<div class='alert alert-danger'>You Must Chose <strong> Member </strong> </div>";
                }

                if (!empty($errors)) { # Array Error Insert Not Empty 
                    foreach ($errors as $error) {
                        echo $error;
                    }
                    $msg =  "<div class='alert alert-warning'> <strong>Sorry :( </strong> You Must Try Again  </div>";
                    redirectHome($msg,'back',6);
                }else{ # No Error Insert Item 
                        
                        $stmt = $conn->prepare("INSERT INTO items (name,Description,price,Add_Date,Country_Made,Status,Cat_id,Member_id) VALUES(?,?,?,now(),?,?,?,?)");
                        $stmt->execute(array($name,$Description,$price,$Country_Made,$status,$Category,$Member));
                        $row = $stmt->rowCount();
                        # Show Message Success And Redirect Prevois Page 
                        $msg =  "<div class='alert alert-success'>" . $row ." Record Updated </div>";
                        redirectHome($msg,'back');
                     
                }

            }else{
                # Show Message Error And Redirect Home Page 
                $msg =  "<div class='alert alert-danger'> <strong>Sorry  :( </strong> You Can't Brows This Page  Direct</div> ";
                redirectHome($msg,4);
            }

            echo "</div>";

        }elseif ($do == 'Delete') {   
            echo "<div class='container'>" ; 
                echo "<h1 class='text-center'>Delete Item </h1>";
                 $idItem = intval($_GET['id']);

                 // Delete Store Images

                 $NameImages = getItem($idItem);
                 $arrayImages = explode(',', $NameImages['ImagesItem']);
                 if (! empty($arrayImages)) {

                     foreach ($arrayImages as $Images) {
                         unlink('Uploads/Items/'.$Images );
                     }
                 }
                 

                 $stmt  = $conn->prepare("DELETE FROM items WHERE item_id = ?");
                 $stmt->execute(array($idItem));
                 $row = $stmt->rowCount();
                 if ($row) {
                     $msg =  "<div class='alert alert-success'>" . $row . " Record Deleted </div>";
                     redirectHome($msg,'back');
                 }else{
                    #Show Message Error And Redirect Home Page 
                    $msg =  "<div class='alert alert-danger'> <strong>Sorry :( </strong> Erorr Delte Item (Id Not Found )</div>";
                    redirectHome($msg);
                 }
        
             echo "</div>";

        }elseif ($do == 'ItemActivate') {
            echo '<h1 class="text-center">Activate Item </h1>';
            echo "<div class='container'>";
            $idItem = intval($_GET['id']);
            $stmt = $conn->prepare("UPDATE  items SET Approve = 1 WHERE item_id = ?");
            $stmt->execute(array($idItem));
            $row = $stmt->rowCount();
            if ($row) {
                $msg =  "<div class='alert alert-success'> <strong>Good  </strong> Item Now Activated </div>";
                redirectHome($msg,'back');
            }else{
                #Show Message Error And Redirect Home Page 
                $msg =  "<div class='alert alert-danger'> <strong>Sorry :( </strong> Erorr Activate Item </div>";
                redirectHome($msg);
            }
            echo "</div>";
            
        }elseif ($do =='Edit') { 
        // Get Integer Value for Get Request 
            $idItem = intval($_GET['id']);
            // Select All Data Depend On This Id 
            $stmt = $conn->prepare("SELECT * FROM  items WHERE  item_id = ?  LIMIT 1 ");
            // Execute Query 
            $stmt->execute(array($idItem));
            // Fetch The Data 
            $result= $stmt->fetchAll(PDO::FETCH_ASSOC);
            // The Row Count 
            $Count = $stmt->rowCount();
            
           if ($Count > 0 ) { // If There is Such Id Show The Form
               
           

?><!-- Start Html  -->
        <h1 class="text-center">Edit Item </h1>
            <div class="container">
                <form  class="form-horizontal" method="POST" action="?do=Update">
                    <!-- Field Hidden Contain Id Category  -->
                    <input type="hidden" name="idItem" value="<?php echo $result[0]["item_id"] ; ?>">
                    <!-- Start  Name field -->
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-10 col-md-5">
                            <input 
                                class="form-control" 
                                type="text" 
                                name="Name"  
                                required="required" 
                                value="<?php echo $result[0]["name"] ;  ?>">
                        </div>
                    </div>
                    <!-- Start  Descreption field -->
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Description</label>
                        <div class="col-sm-10 col-md-5">
                            <input 
                                class=" password form-control" 
                                type="text" 
                                name="Description"  
                                required="required"
                                value="<?php echo $result[0]["Description"] ;  ?>">
                        </div>
                    </div>
                    <!-- Start  Price field -->
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Price</label>
                        <div class="col-sm-10 col-md-5">
                            <input 
                                class="form-control" 
                                type="text" 
                                name="Price" 
                                required="required"
                                value="<?php echo $result[0]["price"] ;  ?>" >
                        </div>
                    </div>
                    <!-- Start  Country Made  field -->
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Country Made</label>
                        <div class="col-sm-10 col-md-5">
                            <input 
                                class="form-control" 
                                type="text" 
                                name="Country_Made" 
                                required="required"
                                value="<?php echo $result[0]["Country_Made"] ;  ?>" >
                        </div>
                    </div>
                    <!-- Start  Status  field -->
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Status</label>
                        <div class="col-sm-10 col-md-5">
                            <select name="status" class="form-control">
                                <option value="0">...</option>
                                <option value="1" <?php if($result[0]["Status"] == 1){ echo "selected";} ?>>new</option>
                                <option value="2" <?php if($result[0]["Status"] == 2){ echo "selected";} ?>>Like New </option>
                                <option value="3" <?php if($result[0]["Status"] == 3){ echo "selected";} ?>>Used </option>
                                <option value="4" <?php if($result[0]["Status"] == 4){ echo "selected";} ?>> Very Old </option>
                            </select>
                        </div>
                    </div>
                    <!-- Start  Category  field -->
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Category</label>
                        <div class="col-sm-10 col-md-5">
                            <select name="Category" class="form-control">
                                <option value="0">...</option>
                                <?php
                                    $statement = $conn->prepare("SELECT id, name FROM categories ");
                                    $statement->execute();
                                    $categories =  $statement->fetchAll();
                                    foreach ($categories as $cat) {

                                        echo "<option value = ' " .  $cat['id'] . "'";
                                        if($cat['id'] == $result[0]['Cat_id']){echo 'selected';}
                                        echo ">". $cat['name'] . "</option>";

                                    }
                                    
                                ?>
                            </select>   
                        </div>
                    </div>
                    <!-- Start  Member  field -->
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Member</label>
                        <div class="col-sm-10 col-md-5">
                            <select name="Member" class="form-control">
                                <option value="0">...</option>
                                <?php
                                    $statement2 = $conn->prepare("SELECT userID, userName FROM users  ");
                                    $statement2->execute();
                                    $members =  $statement2->fetchAll();
                                    foreach ($members as $Member) {
                                        echo "<option value = ' " .  $Member['userID'] . "'";
                                        if($Member['userID'] == $result[0]['Member_id']){echo 'selected';}
                                        echo ">". $Member['userName'] . "</option>";
                                    }
                                    
                                ?>
                            </select>
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
           
        }elseif ($do == 'Update') { 
  echo "<div class='container'>";
            echo "<h1 class='text-center'>Update  Item </h1>";

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $idItem = $_POST['idItem'];
                $name = $_POST['Name'];
                $Description = $_POST['Description'];
                $price = $_POST['Price'];
                $Country_Made = $_POST['Country_Made'];
                $status = $_POST['status'];
                $Category = $_POST['Category'];
                $Member = $_POST['Member'];
                
                // array Conatin Error Update Information Member
                $errors = array();
                // Valdiation Field 
                if (empty($name)) {
                    $errors['name'] = "<div class='alert alert-danger'>Field <strong> Name </strong> can't Be Empty </div>";
                }
                if (empty($Description)) {
                    $errors['Description'] = "<div class='alert alert-danger'>Field <strong> Description </strong> can't Be Empty </div>";
                }
                if (empty($price)) {
                    $errors['price'] = "<div class='alert alert-danger'>Field <strong> price </strong> can't Be Empty </div>";
                }
                if (empty($Country_Made)) {
                    $errors['Country_Made'] = "<div class='alert alert-danger'>Field <strong> Country_Made </strong> can't Be Empty </div>";
                }
                if ($status == 0) {
                    $errors['status'] = "<div class='alert alert-danger'>You Must Chose <strong> status </strong> </div>";
                }
                if ($Category == 0) {
                    $errors['Category'] = "<div class='alert alert-danger'>You Must Chose <strong> Category </strong> </div>";
                }
                if ($Member == 0) {
                    $errors['Member'] = "<div class='alert alert-danger'>You Must Chose <strong> Member </strong> </div>";
                }

                if (!empty($errors)) { # Array Error Update Not Empty 
                    foreach ($errors as $error) {
                        echo $error;
                    }
                    $msg =  "<div class='alert alert-warning'> <strong>Sorry :( </strong> You Must Try Again  </div>";
                    redirectHome($msg,'back',6);
                    
                }else{ # No Error Update Item 
                        
                        $stmt = $conn->prepare("UPDATE 
                                                `items` 
                                                SET 
                                                    name= ? ,
                                                    Description = ?,
                                                    price = ?,
                                                    Country_Made = ?,
                                                    Status = ? ,
                                                    Cat_id = ?,
                                                    Member_id = ? 
                                                    WHERE 
                                                    item_id = ?
                                                ");
                        $stmt->execute(array($name,$Description,$price,$Country_Made,$status,$Category,$Member,$idItem));
                        $row = $stmt->rowCount();
                        # Show Message Success And Redirect Prevois Page 
                        $msg =  "<div class='alert alert-success'>" . $row ." Record Updated </div>";
                        redirectHome($msg,'back');
                     
                }

            }else{
                # Show Message Error And Redirect Home Page 
                $msg =  "<div class='alert alert-danger'> <strong>Sorry  :( </strong> You Can't Brows This Page  Direct</div> ";
                redirectHome($msg,4);
            }

            echo "</div>";

        }elseif ($do == 'Delete') {   
            echo "<div class='container'>" ; 
                echo "<h1 class='text-center'>Delete Item </h1>";
                 $idItem = intval($_GET['id']);
                 $stmt  = $conn->prepare("DELETE FROM items WHERE item_id = ?");
                 $stmt->execute(array($idItem));
                 $row = $stmt->rowCount();
                 if ($row) {
                     $msg =  "<div class='alert alert-success'>" . $row . " Record Deleted </div>";
                     redirectHome($msg,'back');
                 }else{
                    #Show Message Error And Redirect Home Page 
                    $msg =  "<div class='alert alert-danger'> <strong>Sorry :( </strong> Erorr Delte Item (Id Not Found )</div>";
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
