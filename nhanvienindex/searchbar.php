<?php
// define variables and set to empty values

$searchtransactionErr = $searchtransaction = "";
if ($_SERVER["REQUEST_METHOD"] == "GET") {
	if(empty($_GET["searchtransaction"])){
		$searchtransactionErr = "search is required";
	}
	else
  $searchtransaction = test_input($_GET["searchtransaction"]);
}
?>
<div class = "searchbar">
		<form method="GET" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" target = "_self" >
			<input type = "search" placeholder ="Search By Name of User" autocomplete="on" name="searchtransaction"> 
			<button type="submit"><i class="fa fa-search"></i></button>
		</form>
</div>