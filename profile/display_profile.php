<?php 
// Perform query
	        if($_SESSION["typeaccount"] == "user") {
            $query = "CALL getinfo_acuser('" . $_SESSION["accountname"] . "')";
          }
            else if($_SESSION["typeaccount"] == "nhanvien"){
            $query = "CALL getinfo_nhanvien('" . $_SESSION["accountname"] . "')";
            }
	$result = mysqli_query($Conn,$query);
	if (!$result) {
    	echo "An error occurred.\n";
    	exit;
	}
  ?>
  <div style = "margin-top: 50px;">
<?php
while ($row = mysqli_fetch_assoc($result)) {
?> 
          <div class="row gutters-sm" >
            <div class="col-md-4 mb-3">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                    <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin" class="rounded-circle" width="150">
                    <div class="mt-3">
                      <h4><?php echo "Hello ". $row["name"]."!"; ?></h4>
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
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Full name</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <?php echo $row["name"]; ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Username</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <?php echo $_SESSION["accountname"]; ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Email</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <?php echo $row["email"]; ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Address</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <?php echo $row["address"]; ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Phone</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                    <?php echo $row["phone"]; ?>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-12">
                      <a class="btn btn-info " target="__blank" href="../profile/edit.php">Edit</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
<?php
}
?>
</div>
