<nav class="navbar ">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navDrop" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php"><?php echo lang('Home_Area'); ?></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="navDrop">
      <ul class="nav navbar-nav">
	      <li><a href="categories.php"><?php echo lang('Categories'); ?></a></li>
	      <li><a href="items.php"><?php echo lang('Items'); ?></a></li>
	      <li><a href="members.php"><?php echo lang('Members'); ?></a></li>
        <li><a href="comment.php"><?php echo lang('Comments'); ?></a></li>
        <li><a href="slider.php"><?php echo 'Slider' ?></a></li>
 	  </ul>
      <ul class="nav navbar-nav navbar-right">
        <?php
          $userName =  $_SESSION['username'];
          $stmt = $conn->prepare("SELECT  ImageUser FROM users WHERE userName = ? " );
          $stmt->execute(array($userName));
          $resault =  $stmt->fetch(PDO::FETCH_ASSOC);
        ?>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            <?php
              if (empty($resault['ImageUser'])) {
                  echo " <img src='Uploads/Avatars/deaultAvatar.jpg' alt='Avatar' class='img-circle avatarUser' /> ";
              }else{
                  echo " <img src='Uploads/Avatars/".$resault['ImageUser']."' alt='Avatar' class='img-circle avatarUser' /> "; 
              }
              echo $userName ;  
            ?> 
            
          </a>
          <ul class="dropdown-menu">
            <li><a href="../index.php" target="_blanck"><?php echo lang('Visit Shope'); ?></a></li>
            <li><a href="members.php?do=Edit"><?php echo lang('Edit Profile'); ?></a></li>
            <li><a href="#"><?php echo lang('Settings'); ?></a></li>
            <li><a href="<?php echo 'logOut.php'; ?>"><?php echo lang('Log Out'); ?></a></li>
            
          </ul>
        </li>
        <!-- Start Option Langage -->
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-globe fa-fw Langage "></i>
          </a>
          <ul class="dropdown-menu">      
            <li><a href="?lang=english">English</a></li>
            <li><a href="?lang=arabic">Arabic</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>

