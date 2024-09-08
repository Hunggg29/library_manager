<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $last_nameErr = $first_nameErr = $newpassword = $newpasswordErr = $passwordErr = $re_newpassword = $re_newpasswordErr = $email = $emailErr = $numberphone = $numberErr = $address = $addressErr ="";
  
    if (empty($_POST["last_name"])) {
      $last_nameErr = "Last Name is required";
      
    } else {
      
      $last_name = test_input($_POST["last_name"]);
      // check if name only contains letters and whitespace
    }

    if (empty($_POST["first_name"])) {
        $first_nameErr = "First Name is required";
      } else {
        $first_name = test_input($_POST["first_name"]);
        // check if name only contains letters and whitespace
      }
      if (empty($_POST["password"])) {
        $passwordErr = "Password is required";
    }  
    else{
      $password = test_input($_POST["password"]);
      if($password != $_SESSION["accountpassword"]){
          $passwordErr = "Password wrong";
      }
    }
    if (empty($_POST["newpassword"])) {
        $newpasswordErr = "NewPassword is required";
    }  
    else{
      $newpassword = test_input($_POST["newpassword"]); 
    }
    if (empty($_POST["re_newpassword"])) {
      $re_passwordErr = "Re_newpassword is required";
    } 
    else{
      $re_newpassword = test_input($_POST["re_newpassword"]);
      if($newpassword != $re_newpassword){
        $re_newpasswordErr = "Password not equal repassword";
      }    
    }
       if (empty($_POST["phone"])) {
        $numberErr = "numberphone is required";
      }
      else {
        $numberphone = test_input($_POST["phone"]);
        // check if numberphone only number
        if (!preg_match("/^[0-9]*$/",$numberphone)) {
          $numberErr = "Only Number allowed";
        }
        else{

          $query = 'SELECT * FROM getinfo_allacuser() WHERE phone = \''.$numberphone.'\'';
          $result = pg_query($Conn,$query);
          if(pg_num_rows($result) != 0){
            $numberErr = "numberphone already exists.";
          }
        }
      }
      $query = 'SELECT phone FROM user_info WHERE userinfo_id = '.$_SESSION["account_id"];
      $result = mysqli_query($Conn,$query);
          if($row = mysqli_fetch_assoc($result)){
            if ($row["phone"] == $numberphone){
              $numberErr = "";
            }
          }
      if (empty($_POST["address"])) {
        $addressErr = "Address is required";
      } else {
        $address = test_input($_POST["address"]);
        // check if name only contains letters and whitespace
      }

    if (empty($_POST["email"])) {
      $emailErr = "Email is required";
    } 
     else {
      $email = test_input($_POST["email"]);
      // check if e-mail address is well-formed
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format";
      }
      else {
        $query = 'SELECT * FROM getinfo_allacuser() WHERE email = \''.$email.'\'';
          $result = pg_query($Conn,$query);
          if(pg_num_rows($result) != 0){
            $emailErr = "email already exists.";
          }
      }
    }
    $query = 'SELECT email FROM user_info WHERE userinfo_id = '.$_SESSION["account_id"];
      $result = mysqli_query($Conn,$query);
          if($row = mysqli_fetch_assoc($result)){
            if ($row["email"] == $email){
              $emailErr = "";
            }
          }
    if($last_nameErr == "" && $first_nameErr == "" && $emailErr == "" && $addressErr == ""&&  $passwordErr == "" && $newpasswordErr == ""&&  $re_newpasswordErr == ""&& $numberErr == ""){
        $password = $_POST['password'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
    
        $query = 'UPDATE user_info SET first_name = \''.$first_name.'\',last_name = \''.$last_name.'\',
        password = \''.$newpassword.'\', email = \''.$email.'\', 
        address = \''.$address.'\', phone = \''.$phone.'\'
        WHERE userinfo_id = '.$_SESSION["account_id"];
        $result = pg_query($Conn,$query);
         if (!$result) {
          echo "An error occurred.\n";
          exit;
        ?>
          <script>
          alert('Change User faile!');
        </script>
<?php } else { $_SESSION["accountpassword"] = $newpassword; ?>
                <script>
                  alert('Change User Success!');
                </script>
<?php } ?>
    

<?php }else{ ?>
            <script>
            alert('you have some warning in your information');
          </script>
<?php
  }
    
?>
        
<?php
} 
?>

<?php 

// Perform query
	        if($_SESSION["typeaccount"] == "user") {
            $query = 'SELECT * FROM user_info WHERE userinfo_id = '.$_SESSION["account_id"];
          }
          else if($_SESSION["typeaccount"] == "nhanvien"){
            $query = 'SELECT * FROM nhanvien WHERE nhanvien_id = '.$_SESSION["account_id"];
          }
	$result = pg_query($Conn,$query);
	if (!$result) {
    	echo "An error occurred.\n";
    	exit;
	}
while ($row = pg_fetch_assoc($result)) {
?> 
          <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                    <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin" class="rounded-circle" width="150">
                    <div class="mt-3">
                      <h4><?php echo "Hello ". $row["first_name"]." ".$row["last_name"]."!"; ?></h4>
                      <p class="text-secondary mb-1"><?php echo $_SESSION["typeaccount"].": ".$_SESSION["account_id"]; ?></p>
                      <p class="text-muted font-size-sm"><?php echo $row["address"]; ?></p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-8">
              <div class="card mb-3">
                <div class="card-body">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method= "POST" target="_self">
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">First name</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <input name="first_name" class="form-control" value="<?php echo $row["first_name"]; ?>">
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Last name</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <input name="last_name" class="form-control" value="<?php echo $row["last_name"]; ?>">
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                    <h6 class="mb-0">OLd Password</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <input type="password" name = "password" class="form-control">
                    <span class="error">* <?php if ($_SERVER["REQUEST_METHOD"] == "POST") echo $passwordErr;?></span>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                    <h6 class="mb-0">NewPassword</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <input type="password" name = "newpassword" class="form-control" >
                    <span class="error">* <?php if ($_SERVER["REQUEST_METHOD"] == "POST" ) echo $newpasswordErr;?></span>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                    <h6 class="mb-0">Re-NewPassword</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <input type="password" name = "re_newpassword" class="form-control" >
                    <span class="error">* <?php if ($_SERVER["REQUEST_METHOD"] == "POST" ) echo $re_newpasswordErr;?></span>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Email</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <input type="text" name = "email" class="form-control" value="<?php echo $row["email"]; ?>">
                    <span class="error">* <?php if ($_SERVER["REQUEST_METHOD"] == "POST" ) echo $emailErr;?></span>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Address</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <input type="text" name = "address" class="form-control" value="<?php echo $row["address"]; ?>">
                    <span class="error">* <?php if ($_SERVER["REQUEST_METHOD"] == "POST") echo $addressErr;?></span>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Phone</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <input type="text" name = "phone" class="form-control" value="<?php echo $row["phone"]; ?>">
                    <span class="error">* <?php if ($_SERVER["REQUEST_METHOD"] == "POST") echo $numberErr;?></span>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-12">
                    <input type="submit" name="submit" value="Save Changes" class="btn btn-info"><a href="../profile/profile.php"><a></input>
                    </div>
                  </div>
                </form>
                </div>
              </div>
            </div>
          </div>
<?php } ?>