<?php 

/*
=========================================================================================
							Page Categories 

				 You Can 	isert|udate|delete   Categorie  and other thing    From  Here 

=========================================================================================
*/
	
    session_start();

    if (isset($_SESSION['username'])) {

    	// Varibale Contain Name Page 
        $TitlePage = 'categories';
        // Include File Init 
    	include 'init.php';


    	$do = isset($_GET['do'])	? $_GET['do'] : 'Manage';

        $sort = 'ASC' ; 
        $sortList = array('ASC','DESC');
        if (isset($_GET['sort']) && in_array($_GET['sort'], $sortList)) {
            $sort = $_GET['sort'] ; 
        }

    	if ($do == 'Manage') { # Manage Page 
                $stat = $conn->prepare("SELECT * FROM categories ORDER BY ordering $sort ");
                $stat->execute();
                $categories = $stat->fetchAll();
                if (! empty($categories)) { #  if Exist Category In Data Base Show The Form 
                    
            	echo "<div class='container'>";
                echo "<h1 class='text-center'>Manage Categories</h1>";

?> <!-- Start Html  -->
                <a href='?do=add' class="btn btn-primary btnAddCat"><i class="fa fa-plus"></i> Add New Category </a>
                <div class="panel panel-default panel-cat">
                    <div class="panel-heading">
                        Manage Members 
                        <div class="ordering pull-right">
                            Ordering:
                            <a href="?sort=ASC " class="<?php if($sort == ASC){echo  'active' ; } ?>">ASC</a> | 
                            <a href="?sort=DESC" class="<?php if($sort == DESC ){echo 'active' ; } ?>">DESC</a>
                        </div>
                    </div>
                    <div class="panel-body">

<?php # Start Code Php 
                        foreach ($categories as $cat ) {
                            echo "<div class='category'>";
                                
                                echo "<h3>" . $cat['name'] . "</h3>";

                                echo "<div class='hideShowInfo'>";
                                    if (empty($cat['descreption'])) {
                                        echo "<p> No descreption To Show </p>";
                                    }else{
                                        echo "<p>" . $cat['descreption'] . "</p>";  
                                    }

                                    if($cat['visibility'] == 1 ){ echo "<span class='vis'> Private </span>";}else{echo "<span class='vis'> visibl </span>";} ;
                                    if($cat['allow_comment'] == 1 ){ echo "<span class='com'> No Comments </span>";}else{echo "<span class='com'> Allow Comments </span>";} ;

                                    if($cat['allow_ads'] == 1 ){ echo "<span class='ad'> No ads </span>";}else{echo "<span class='ad'> Allow ads </span>";} ;
                                echo "</div>";

                                echo "<div class='btn_control'>";
                                    echo '<a href="?do=Delete&id= '.$cat["id"] . '" class=" confirm btn btn-danger control_member control_member_dl "> <i class="fa fa-close"></i>Delete </a> ';
                                    echo "<a href='?do=Edit&id= " . $cat["id"] . "' class='btn btn-success control_member  '><i class='fa fa-edit'></i> Edit </a> ";
                                echo "</div>";
                                
                                echo "<hr>";
                            echo "</div>";
                            
                        }


?> <!-- Start Html  -->
                        
                    </div>

                </div>
<?php # Start Code Php 
                echo "</div>";
            }else{ # No Category Exist In Data Base 
                echo "<div class='container contMessage' > ";
                echo "<div class='niceMessage' > " ; 
                    echo "<p> there's No Category To Show </p>";
                echo "</div>";
                echo "<a href='?do=add' class='btn btn-primary btnAddCat btnAddNoOption '><i class='fa fa-plus'></i> Add New Category </a>";
                echo "</div>";
            }
            
        }elseif($do == 'add'){  # This Page Add New Category 
?><!-- Start Html  -->
		<h1 class="text-center">Add New Category </h1>
            <div class="container">
                <form  class="form-horizontal" method="POST" action="?do=insert">
                    <!-- Start  Name field -->
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-10 col-md-5">
                            <input class="form-control" type="text" name="Name"  required="required" placeholder="Name Of The Category">
                        </div>
                    </div>
                    <!-- Start  Descreption field -->
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Description</label>
                        <div class="col-sm-10 col-md-5">
                            <input class=" password form-control" type="text" name="Description"  placeholder="Description The Category">
                        </div>
                    </div>
                    <!-- Start  Ordering field -->
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Ordering</label>
                        <div class="col-sm-10 col-md-5">
                            <input class="form-control" type="text" name="Ordering" placeholder="Number To Arrange The Category" >
                        </div>
                    </div>
                    <!-- Start  Visible field -->
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Visible</label>
                        <div class="col-sm-10 col-md-5">
                            <div>
                            	<input id="vis-yes" type="radio" name="Visible" value="0" checked />
                            	<label for="vis-yes">Yes</label>
                            </div>
                            <div>
                            	<input id="vis-no" type="radio" name="Visible" value="1">
                            	<label for="vis-no">No</label>
                            </div>
                        </div>
                    </div>
                    <!-- Start  Allow Comment  field -->
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Allow Comment</label>
                        <div class="col-sm-10 col-md-5">
                            <div>
                            	<input id="vis-yes" type="radio" name="Allow_Comment" value="0" checked />
                            	<label for="vis-yes">Yes</label>
                            </div>
                            <div>
                            	<input id="vis-no" type="radio" name="Allow_Comment" value="1">
                            	<label for="vis-no">No</label>
                            </div>
                        </div>
                    </div>
                    <!-- Start  Allow Ads field -->
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Allow Ads</label>
                        <div class="col-sm-10 col-md-5">
                            <div>
                            	<input id="vis-yes" type="radio" name="Allow_Ads" value="0" checked />
                            	<label for="vis-yes">Yes</label>
                            </div>
                            <div>
                            	<input id="vis-no" type="radio" name="Allow_Ads" value="1">
                            	<label for="vis-no">No</label>
                            </div>
                        </div>
                    </div>

                    
                    <!-- Start Submit Button -->
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10 col-md-5">
                            <input class="btn btn-primary btn-lg" type="Submit" name="Submit" value="Add New Category">
                        </div>
                    </div>
                </form>
            </div>
<?php # Start Php 

        }elseif ($do == 'Delete') {   # Page Delete

            echo "<div class='container'>";
                echo "<h1 class='text-center'>Delete Category</h1>";
                $idCat = intval($_GET['id']);
                $row = checkItem('id',' categories',$idCat);
                if ($row >= 1) { # Category Exist 
                    $stmtDelete = $conn->prepare("DELETE  FROM categories WHERE id = ? ");
                    $stmtDelete->execute(array($idCat));

                    $msg =  "<div class='alert alert-success'>" . $stmtDelete->rowCount() ." Record Deleted </div>";
                    redirectHome($msg,'back');
                }else{ # Category dont Exist
                        $msg = "<div class='alert alert-danger'><strong> Sorry :( </strong> This Id Not Exist  </div>"; 
                        redirectHome($msg,'back');
                }
                
            echo "</div>";
            
             
        }elseif ($do == 'insert') { # This Page Insert  New Category 

        	echo "<div class='container'>";
            echo "<h1 class='text-center'>Insert  Category </h1>";

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                $name = $_POST['Name'];
                $Description = $_POST['Description'];
                $Ordering = $_POST['Ordering'];
                $Visible = $_POST['Visible'];
                $Allow_Comment = $_POST['Allow_Comment'];
                $Allow_Ads = $_POST['Allow_Ads'];

                // array Conatin Error Insert Information Category
                $errors = array();
                
                // Validation Form 
                // validation Name Field
                if (empty($name)) {
                    $errors[] = '<div class="alert alert-danger">Name can\'t Be <strong> Empty  </strong> </div>';
                }elseif (strlen($name) < 2) {
                    $errors[] = '<div class="alert alert-danger">Name can\'t Be <strong> less Than 2 Charecter  </strong> </div>';
                }elseif (strlen($name) > 25) {
                    $errors[] = '<div class="alert alert-danger">Name can\'t Be <strong> More Than 25 Charecter  </strong> </div>';
                }else { # Search If Name Exist In DataBase Or  Not 

                	$row = checkItem("name","categories",$name);
                    if ($row) { # Case  Name Exist Show Message Error 
                        $errors[] = '<div class="alert alert-danger"><strong>Sorry :( </strong> Name :'.$name.' Is Already Exist Try Another Name </div>';
                    }
                }
                
                if (!empty($errors)) { # Array Error Insert Not Empty 
                    foreach ($errors as $error) {
                        redirectHome($error,'back');
                    }
                }else{ # No Error Insert Information Category 
                   
                        $stmt = $conn->prepare("INSERT INTO categories (name,descreption,ordering,visibility,allow_comment,allow_ads) VALUES(?,?,?,?,?,?)");
                        $stmt->execute(array($name,$Description,$Ordering,$Visible,$Allow_Comment,$Allow_Ads));
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

        }elseif ($do =='Edit') {   # Page Edit 
            // Get Integer Value for Get Request 
            $idCat = intval($_GET['id']);
            // Select All Data Depend On This Id 
            $stmt = $conn->prepare("SELECT * FROM  categories WHERE  id = ?  LIMIT 1 ");
            // Execute Query 
            $stmt->execute(array($idCat));
            // Fetch The Data 
            $result= $stmt->fetchAll(PDO::FETCH_ASSOC);
            // The Row Count 
            $Count = $stmt->rowCount();
            
           if ($Count > 0 ) { // If There is Such Id Show The Form
               
           

?><!-- Start Html  -->
        <h1 class="text-center">Edit Category </h1>
            <div class="container">
                <form  class="form-horizontal" method="POST" action="?do=Update">
                    <!-- Field Hidden Contain Id Category  -->
                    <input type="hidden" name="idCat" value="<?php echo $result[0]["id"] ; ?>">
                    <!-- Start  Name field -->
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-10 col-md-5">
                            <input class="form-control" type="text" name="Name"  required="required" value="<?php echo $result[0]["name"] ;  ?>">
                        </div>
                    </div>
                    <!-- Start  Descreption field -->
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Description</label>
                        <div class="col-sm-10 col-md-5">
                            <input class=" password form-control" type="text" name="Description"  value="<?php echo $result[0]["descreption"] ;  ?>">
                        </div>
                    </div>
                    <!-- Start  Ordering field -->
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Ordering</label>
                        <div class="col-sm-10 col-md-5">
                            <input class="form-control" type="text" name="Ordering" value="<?php echo $result[0]["ordering"] ;  ?>" >
                        </div>
                    </div>
                    <!-- Start  Visible field -->
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Visible</label>
                        <div class="col-sm-10 col-md-5">
                            <div>
                                
                                <input id="vis-yes" type="radio" name="Visible" value="0" <?php if($result[0]["visibility"] == 0) echo "checked"; ?> />
                                <label for="vis-yes">Yes</label>
                            </div>
                            <div>
                                <input id="vis-no" type="radio" name="Visible" value="1" <?php if($result[0]["visibility"] == 1) echo "checked"; ?>>
                                <label for="vis-no">No</label>
                            </div>
                        </div>
                    </div>
                    <!-- Start  Allow Comment  field -->
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Allow Comment</label>
                        <div class="col-sm-10 col-md-5">
                            <div>
                                <input id="vis-yes" type="radio" name="Allow_Comment" value="0" <?php if($result[0]["allow_comment"] == 0) echo "checked"; ?> />
                                <label for="vis-yes">Yes</label>
                            </div>
                            <div>
                                <input id="vis-no" type="radio" name="Allow_Comment" value="1" <?php if($result[0]["allow_comment"] == 1) echo "checked"; ?>>
                                <label for="vis-no">No</label>
                            </div>
                        </div>
                    </div>
                    <!-- Start  Allow Ads field -->
                    <div class="form-group form-group-lg">
                        <label class="col-sm-2 control-label">Allow Ads</label>
                        <div class="col-sm-10 col-md-5">
                            <div>
                                <input id="vis-yes" type="radio" name="Allow_Ads" value="0" <?php if($result[0]["allow_ads"] == 0) echo "checked"; ?> />
                                <label for="vis-yes">Yes</label>
                            </div>
                            <div>
                                <input id="vis-no" type="radio" name="Allow_Ads" value="1" <?php if($result[0]["allow_ads"] == 1) echo "checked"; ?>>
                                <label for="vis-no">No</label>
                            </div>
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
<?php # Start Php Code 
             // Select  Items This Category   
                
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
                                    WHERE 
                                        items.Cat_id   = ?
                                    ");
            $stmt->execute(array($idCat));
            $stmt->execute();
            $Items =  $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (! empty($Items)) { # Exist Items In Data Base 
           
?><!-- Start Html -->
                <h1 class='text-center'> Manage [ <?php echo $result[0]["name"]; ?> ] Item </h1>;
                
                <div class="container">

                    <div class="table-responsive">
                        <table class="main-table table table-bordered table-striped">
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
                                        echo "<a href='items.php?do=Edit&id= " . $Item["item_id"] . "' class='btn btn-success control_member'><i class='fa fa-edit'></i> Edit </a> ";
                                        echo '<a href="items.php?do=Delete&id= '.$Item["item_id"] . '" class=" confirm btn btn-danger control_member"> <i class="fa fa-close"></i>Delete </a> ';
                                    
                                    # Member Not Activate 
                                    if ($Item['Approve'] != 1) {

                                        echo '<a href="items.php?do=ItemActivate&id= '.$Item["item_id"] . '" class="  btn btn-info control_member"> <i class="fa fa-check"></i>Activate </a> ';
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
                            echo "<h4 class='text-center'> there's No Item To Show </h4>";
                    echo "</div>";
                }  

            }else{ // If There is No Such Id Show The Error Message 
                    echo "<div class='container'>";
                    $msgError = "<div class='alert alert-danger' style='margin-top:10px ; '> Theres No Such Id  </div>";
                    // Redirect Home 
                    redirectHome($msgError);
                    echo "</div>";
            }
           
        }elseif ($do == 'Update') { 

                echo "<h1 class='text-center'> Update Category</h1>";
                echo "<div class='container'>";
                if ($_SERVER['REQUEST_METHOD'] == "POST") {

                        $idCat = $_POST['idCat'];
                        $name = $_POST['Name'];
                        $desc = $_POST['Description'];
                        $order = intval($_POST['Ordering']);
                        $visibility = $_POST['Visible'];
                        $allow_comment = $_POST['Allow_Comment'];
                        $allow_ads = $_POST['Allow_Ads'];
                        $msgError = array();
                        if (empty($name)) {
                            $msgError['name'] = "<div class='alert alert-danger'> Field Name Can't Be Empty  </div>";
                        }
                        // There's No Error 
                        if (empty($msgError)) {
                            
                            $UpdateCat = $conn->prepare("UPDATE categories 
                                                        SET 
                                                        name = ?,
                                                        descreption = ?,
                                                        ordering = ?,
                                                        visibility = ?,
                                                        allow_comment = ?,
                                                        allow_ads = ? 
                                                        WHERE 
                                                        id = ? 
                            ");
                            $UpdateCat->execute(array($name,$desc,$order,$visibility,$allow_comment,$allow_ads,$idCat));
                            $msg =  "<div class='alert alert-success'>  " . $UpdateCat->rowCount() . " Row Updated </div>";
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
        }
           
    	//  Include File Footer 
    	include $tpl . 'footer.php';
    }else{

    	header("location:index.php");
    	exit();
    }
