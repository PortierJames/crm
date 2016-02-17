<?php
/*
levenshteinUtf8
*/

session_start();
if(!$_SESSION["LoggedIn"])
{
	header('Location: index.php');
}

include_once("application/functions/functions.php");
include_once("application/views/partial/header.php");
include_once("application/views/views.php");

if (isset($_POST['submitted'])) {
    $conn = getConnection();
    $search_terms = $_POST['SearchTerms'];
    $sanitized_search_terms = mysql_real_escape_string($search_terms);

		$subquery = "MATCH(html) AGAINST('" . $sanitized_search_terms . "')";

		$query = "SELECT url, " . $subquery . " FROM pages WHERE " . $subquery . " ORDER BY " . $subquery . " DESC LIMIT 10;";
		//echo "<div class='container'>" . $query . "</div>";
		$search_result = mysql_query($query);

		echo "<div class='container'>Search results for: <i>" . $sanitized_search_terms . "</i></div>";
		$count = mysql_num_rows($search_results);
		$i = 1;
		for ($i; $i < 11; $i++) {
			$row = mysql_fetch_assoc($search_result);
		  echo "<div class='container'>" . $i . " <a href='" . $row['url'] . "'>" . $row['url'] . "</a> " . $row[$subquery] . "</div>";
		}

    //$displaySearchResults($search_result, 10);
		?>
		<div class="container">
		  <form class="form-signin" method="post" action="">
		    <h2 class="form-signin-heading">Search</h2>
		      <label for="SearchTerms" class="col-sm-2 control-label"></label>
		      <input type="text" name="SearchTerms" id="SearchTerms" class="form-control" required autofocus>
		      <br />
		      <button class="btn btn-lg btn-primary btn-block" type="submit" name="submitted" value="Search">Search</button>
		  </form>
		</div> <!-- /container -->

		<?php
}
else {
	?>
<div class="container">
  <form class="form-signin" method="post" action="">
    <h2 class="form-signin-heading">Search</h2>
      <label for="SearchTerms" class="col-sm-2 control-label"></label>
      <input type="text" name="SearchTerms" id="SearchTerms" class="form-control" required autofocus>
      <br />
      <button class="btn btn-lg btn-primary btn-block" type="submit" name="submitted" value="Search">Search</button>
  </form>
</div> <!-- /container -->
<?php
}

include_once('application/views/partial/footer.php');

?>
