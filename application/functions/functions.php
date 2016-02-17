<?php

/*
		Bare bones library of MySQL query and manipulation functions for
		basic SELECT, INSERT, and UPDATE queries.

		Library has a VERY LIGHTWEIGHT wrapper to sanitize data and run simple
		queries. In other words, it's going to need a fix... yesterday.

		Functions assume a MySQL connection has been established, and that a
		database has been selected, e.g.
		<code>
		$db = mysql_connect(MYSQL_SERVER, MYSQL_USER, MYSQL_PASSWORD) or
		      die('I cannot connect to the database because: ' . mysql_error());
		mysql_select_db(MYSQL_DATABASE);
		</code>
*/

/*
	Function to generate a multi-dimensional associate array from a MySQL resource
*/
function mysql_array($result, $assoc=TRUE) {
  // start with a null results set
  $results = array();

  if ($assoc) {
    // grab the first fieldname to key the array with
    $first = mysql_field_name($result, 0);

    // loop through each row and build an assoc. array
    while ($row = mysql_fetch_assoc($result))
      $results += array($row[$first] => $row);
    } else {
         // loop through each row and build an array
         while ($row = mysql_fetch_assoc($result))
           $results[] = $row;
    }

    // strip slashes and return
    return stripslashes_deep($results);
}

/*
	Returns an array of a single MySQL result row
*/
function mysql_row_array($result) {
  // verify we have a valid MySQL resource, otherwise return empty array
  if (!result) return array();

  // verify there are results to the query, otherwise return empty array
  if (mysql_num_rows($result) == 0) return array();

  // strip slashes and return the result of mysql_fetch_assoc
  return stripslashes_deep(mysql_fetch_assoc($result));
}

/*
	Generates SQL query, sanitizes data, and inserts row in database
*/
function mysql_insert($table, $data) {
  // build query
  $sql = "INSERT INTO `table` (";
  foreach ($data as $field => $value) $sql .= "`$field`, ";
  $sql = substr($sql, 0, strlen($sql)-2) . ") VALUES (";
  foreach ($data as $field => $value) $sql .= "'" . mysql_real_escape_string($value) . "', ";

  // remove last comma
  $sql = substr($sql, 0, strlen($sql)-2) . ")";

  // run query and return either ID or false (error)
  if (mysql_query($sql)) return mysql_insert_id();
  else return false;
}

/*
	Generates SQL query, sanitizes data, and updates row in database
*/
function mysql_update($table, $data, $query, $connector = "AND") {
  // format the SQL query
  $sql = "UPDATE `$table` SET ";
  foreach ($data as $field => $value)
    $sql .= "`$field` = '" . mysql_real_escape_string($value) ."', ";
  $sql = substr($sql, 0, strlen($sql)-2) . " WHERE ";
  foreach ($query as $field => $value) $sql .= "`$field` = '$value' $connector ";

  // remove the last connector
  $sql = substr($sql, 0, strlen($sql)-(strlen($connector)+1));

  // return a bool with the query's results
  if (mysql_query($sql)) return true;
  else return false;
}

/*
	Generates SQL query, sanitizes data, and removes row in database
*/
function mysql_remove($table, $query=array(), $connector = "AND") {
  // build the SQL query
  $sql = "DELETE FROM `$table` WHERE ";
  foreach ($query as $field => $value)
    $sql .= "`$field` = '" . mysql_real_escape_string($value) . "' $connector ";

  // remove the last connector
  $sql = substr($sql, 0, strlen($sql)-(strlen($connector)+1));

  // return a bool with the query's result
  if (mysql_query($sql)) return true;
  return false;
}

/*
	Generates SQL query, sanitizes data, and returns a MySQL resource object
	with the results.

	For example, to return an entire table:
	<code>
	mysql_select('Players');
	</code>
	Or to return a select set of results:
	<code>
	$query = array('Name'=>'Tom');
	mysql_select('Players', $query);
	</code>
*/
function mysql_select($table, $query=array(), $connector = "AND") {
  // build the SQL query
  $sql = "SELECT * FROM `$table` ";

  // if there is no WHERE clause, just run the query
  if (sizeof($query) > 0) {
    $sql .= "WHERE ";

    // loop through the fields/values
    foreach ($query as $field => $value)
      $sql .= "`$field` = '" . mysql_real_escape_string($value) . "' $connector";

    // remove the last connector
    $sql = substr($sql, 0, strlen($sql)-(strlen($connector)+1));
  }

  // run the query
  $result = mysql_query($sql);

  // output an error if applicable
  if (mysql_error()) echo "<p>" . mysql_error() . ": $sql</p>";

  // return the result (as a MySQL resource)
  return $result;
}

/*
	Runs a simple MySQL SELECT query and returns true or false if results are found
*/
function mysql_exists($table, $query=array(), $connector="AND") {
  $result = mysql_select($table, $query, $connector);
  if (mysql_num_rows($result) != 0) return true;
  else return false;
}

/*
	Removes slashes from multi-dimensional arrays. Runs stripslashes() on all
	values in a multi-dimensional array. Used with mysql_array to remove slashes
	added by add_slashes() from mysql_insert().
	Also accepts standard arrays.
*/
function stripslashes_deep($value) {
  $value = is_array($value) ? array_map('stripslashes_deep', $value) : stripslashes($value);
  return $value;
}

function processLogin($post)
{
	$conn = getConnection();

	$query = "select * from users where user='" . $post['username']."' and password=password('" . $post['password'] . "') LIMIT 1;";
	$results = mysql_query($query);

	if(mysql_numrows($results)>0)
	{
		$row = mysql_fetch_assoc($results);
		$_SESSION["LoggedIn"] = true;
		$_SESSION["id"] = $row["id"];
		$_SESSION["username"] = $row["username"];
		$_SESSION["LoggedIn"] = true;
		return true;
	}
	return false;
}

/*

Functions to construct:
Create one contact     - saveContact($post)
Get all contacts       - getContacts() (these two should be combined as getContacts($id=0) { if $id==0 { getAll()} else {getOne($id)})
Get one contact        - getContact($id)
Edit one contact       - saveContact($post)
Delete one contact     - deleteContact($id)
Delete all contacts of - deleteContacts(array($post)) (delete all contacts related to a list-comprehension of an SQL query, preferably)

Create one org   - saveOrg($post)
Get all org      - getOrgs()
Get one org      - getOrg($id)
Edit one org     - saveOrg($post)
Delete one org   -
*/

function getContacts()
{
	$conn = getConnection();
	$query = "select * from codex limit 100;";
	$results = mysql_query($query);
	return $results;
}

function getContact($id)
{
	$conn = getConnection();
	$query = "select * from codex where id ='$id'";
	$results = mysql_query($query);
	return $results;
}

function updateContact($post)
{
	$conn = getConnection();

	$query = "update codex set name='" . $post["name"] . "',title ='".$post["title"]."',".
			 "org='".$post["org"]."' where id='".$post['id']."';";
	$results = mysql_query($query);

	if(mysql_affected_rows()>0)
	{
		return true;
	}
	echo $query;
	return false;
}

function saveContact($post)
{
	$conn = getConnection();

	$query = "insert into codex (name, title, org) values ('".$post["name"]."','".$post["title"]."','".$post["org"]."');";
	$results = mysql_query($query);

	if(mysql_affected_rows()>0)
	{
	  $row = mysql_fetch_row($results);
	  echo $row['id'];
		return true;
	}
  echo $query;
	return false;
}

function getOrganizations()
{
	$conn = getConnection();
	$query = "select * from umn;";
	$results = mysql_query($query);
	return $results;
}

function getOrganization($id)
{
	$conn = getConnection();
	$query = "select * from umn where id ='$id'";
	$results = mysql_query($query);
	return $results;
}

function updateOrganization($post)
{
	$conn = getConnection();

	$query = "update umn set NAME='" . $post["NAME"] . "',EMPLOYEES ='".$post["EMPLOYEES"]."',".
			 "INDUSTRY='".$post["INDUSTRY"]."',FOUNDED='".$post["FOUNDED"]."',URL='".$post["URL"]."' where id='".$post['id']."';";
	$results = mysql_query($query);

	if(mysql_affected_rows()>0)
	{
		return true;
	}
	echo $query;
	return false;
}

function saveOrganization($post)
{
	$conn = getConnection();

	$query = "insert into umn (NAME,EMPLOYEES,INDUSTRY,FOUNDED,URL) values ('".$post["NAME"]."','".$post["EMPLOYEES"]."','".$post["INDUSTRY"]."','".$post["FOUNDED"]."','".$post["URL"]."');";
	$results = mysql_query($query);

	if(mysql_affected_rows()>0)
	{
	  $row = mysql_fetch_row($results);
	  echo $row['id'];
		return true;
	}
  echo $query;
	return false;
}

function getConnection()
{
  $db = mysql_connect('localhost:/tmp/mysql.sock', 'james', 'existence');
  if(!$db) {
    return false;
  }
  $conn = mysql_select_db('test', $db);
  if(!$conn) {
    return false;
  }

  return $conn;
}

function displayErrorMessage($msg)
{
	echo "<div class='container'>{$msg}</div>";
}

function search($search_term)
{
  $clean_search_term = mysql_real_escape_string($search_term);

  $query  = "SELECT url FROM pages WHERE MATCH(html) AGAINST('" . $clean_search_term . "');";
  $query_result = mysql_query($query);
  return $query_result;
}
?>
