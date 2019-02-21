<?php
    session_start();
    $noNavbar = '';

    if (isset($_SESSION['username'])) {
        header("location:admin.php");
        exit();
    }
    $TitlePage = 'LoginAdmin';
    /*  Not Show Option Language */
    $NoLangOption = true;
    include 'init.php';
    

    // Check If The User Coming From HTTP REQUEST METHOD POST 
    if ($_SERVER['REQUEST_METHOD'] === "POST"){

        $username = filter_var($_POST['username'] , FILTER_SANITIZE_STRING);
        $password = sha1(filter_var($_POST['password'],FILTER_SANITIZE_STRING));
                // check If This Person Exist Or Not

                $stmt = $conn->prepare("SELECT 
                                        userID,
                                        userName,
                                        password,
                                        GroupID 
                                        FROM 
                                        users
                                        WHERE 
                                        userName = ? 
                                        AND 
                                        password = ? 
                                        AND 
                                        GroupID = 1 
                ");
                $stmt->execute(array($username,$password));
                $count = $stmt->rowCount();
                $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
                if ($count) {
                    $_SESSION['username'] = $username;  // save session username 
                    $_SESSION['idUser'] = $row[0]['userID'];
                    
                    header('location:admin.php');
                    exit();
                    
                }else{
?>
                <div class="alert alert-danger  " role="start">
                    <span> <?php echo lang('Sorry'); ?>   :(  <strong> <?php echo lang('YouAreNotAdmin'); ?> </strong>  </span>
                 </div>

<?php
                }

        

    }

?>
<!-- Start Form Login Admin -->

    <form class="login" method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">
        <h4 class="text-center"><?php echo lang('AdminLogin'); ?> </h4>
        <input class="form-control" type="text" name="username" placeholder="<?php echo lang('userName'); ?>" autocomplete="off">
        <input class="form-control" type="password" name="password" placeholder="<?php echo lang('password'); ?>" autocomplete="off">
        <input class="btn btn-primary btn-block" type="submit" value="<?php echo lang('login'); ?>">
    </form>

<!-- End Form Login Admin -->

<?php include $tpl  . 'footer.php';?>
