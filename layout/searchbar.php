<?php
// define variables and set to empty values

$searchbookErr = $searchbook = "";
if ($_SERVER["REQUEST_METHOD"] == "GET") {
	
	if(empty($_GET["searchbook"])){
		$searchbookErr = "search is required";
	}
	else
  $searchbook = test_input($_GET["searchbook"]);
}
?>
<div class = "searchbar">
		<form method="GET" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" target = "_self" >
			<input type = "search" placeholder ="Search Book" autocomplete="on" name="searchbook"> 
			<button type="submit"><i class="fa fa-search"></i></button>
		</form>
</div>