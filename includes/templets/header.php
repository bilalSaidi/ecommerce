<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <!--  Title -->
        <title><?php echo getTitle() ; ?></title>
        <!-- Favicon  -->
    	<link rel="icon" href="">
    	<!-- Core Style Css -->
        <link rel="stylesheet" href="<?php echo $css ; ?>bootstrap.min.css">
        <?php
            if ($isArabic == true) {
                echo ' <link rel="stylesheet" href="'.$css.'bootstrap.rtl.min.css"> ';
             } 
        ?>
        <link rel="stylesheet" href="<?php echo $css ; ?>font-awesome.min.css">

        <link rel="stylesheet" href="<?php echo $css ; ?>lightbox.min.css">
        
        <link rel="stylesheet" href="<?php echo $css ; ?>style.css">
        <?php
            if ($isArabic == true) {
                echo ' <link rel="stylesheet" href="'.$css.'styleBackEndArabic.css"> ';
                
            } 
        ?>
    </head>
    <body>
        <div class="topHeader">
             
                 <nav class="navbar">
                   <div class="container">
                        <ul class="nav navbar-nav  infoContact  ">
                             <li>
                               <a>
                                
                                <img src="<?php echo $img ; ?>phone.png" />
                                  <span>+2130668815130 </span>
                                </a>
                            </li>
                             <li>
                               <a>
                                <img src="<?php echo $img ; ?>mail.png" />
                                  <span>  b.saidi@esi-sba.dz </span>
                                </a>
                            </li>
                         </ul>
                         <ul class="navbar navbar-right">
<?php
            if (isset($_SESSION['user'])) {
?>
                
                  <li class="dropdown  msgWecomUser">
                      
                      <a data-toggle="dropdown">
                          <span class="userName">
                              <?php echo $_SESSION['user']; ?> 
                          </span>
                          <span class="caret"></span>
                      </a>
                      <ul class="dropdown-menu" >
                        <li ><a href="profile.php" >My Profile</a></li>
                        <li ><a href="newADV.php" >New Item</a></li>
                        <li><a href="logOut.php" >logOut</a></li>
                        
                      </ul>
                      
                    </li>    
<?php
                $statUser = StatusReg($_SESSION['user']);
                if ($statUser == 1) {
                   // User Not Activated :( 
                }

            }else{     // No Session Exist   

?>
             <p class="navbar-text ">
                                <img src="<?php echo $img ; ?>user.png" />
                                <a href="loginAccount.php" class="navbar-link">
                                     <span>Register</span>
                                </a>
                                  | 
                                 <a href="loginAccount.php" class="navbar-link">
                                     <span>SignIn</span>
                                </a>
             </p>

<?php
            } // End Else No Session Exist  
?>     
                            
                         </ul>
                 
            </div>
            </nav>
        </div>
        
        
        <div class="SearchItem">
          <div class="container">    
            <div class="col-md-4">
                <h2 ><a href="index.php">Ecommerce Shope </a>  </h2>
            </div>
            <!-- Start Serach Form -->
            <div class="searchForm">
              <div class="col-md-8">
                  <form class="navbar-form navbar-right">
                      <div class="form-group">
                          <input type="text" class="form-control" placeholder="Search For Item ">
                      </div>
                          <button type="submit" class="btn btn-default">Search</button>
                  </form>
              </div>
            </div>
            <!-- End Search Form -->
          </div>   
        </div>

      <nav class="navbar navbar-inverse MainNavbar">
       
        <div class="container">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navDrop" aria-expanded="false">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>

          </div>
          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="navDrop">

            <ul class="nav navbar-nav menuCategory ">

                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Categories <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <?php
                      $Category = getCat() ; 

                      foreach ($Category as $cat) {
                        $subCategories = getCat("{$cat["id"]}");
                        if (! empty($subCategories)) {
                            $chevron = "<i class='fa fa-chevron-right'></i>";
                        }else{
                            $chevron = "";
                        }
                         echo "<li>";
                          echo "<a href='category.php?id=".$cat['id']."'>" . strtoupper($cat['name']) . " $chevron</a>";
                          if (!empty($subCategories)) {
                            echo "<ul>";
                              foreach ($subCategories as $subcat) {
                                echo "<li>";
                                  echo "<a href='category.php?id=".$subcat['id']."'>" . $subcat['name'] . " </a>";
                                echo "</li>";
                              
                              }
                            echo "</ul>";
                              
                          }
                         echo "</li>";
                      }
                    ?>
                  </ul>
             
                </li>

                
            </ul>
          </div><!-- /.navbar-collapse -->

        </div><!-- /.container-fluid -->
       
      </nav>


      


       

