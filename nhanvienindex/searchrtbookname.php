<?php
// define variables and set to empty values

$searchrtbook = $searchrtbookErr = "";
if ($_SERVER["REQUEST_METHOD"] == "GET") {
	if(empty($_GET["searchrtbook"])){
		$searchrtbookErr = "search is required";
	}
	else
  $searchrtbook = test_input($_GET["searchrtbook"]);
}
?>
<div class = "searchbar">
		<form method="GET" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" target = "_self" >
			<input type = "search" placeholder ="Search By BookName" autocomplete="on" name="searchrtbook"> 
			<button type="submit"><i class="fa fa-search"></i></button>
		</form>
</div>