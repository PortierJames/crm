<?php

function displayContacts($results, $limit=0, $fields=array(0 => "ID",1 => "Name",2 => "Title",3 => "Org"))
{
	?>
	<table class="table table-striped table-bordered table-hover table-condensed">
	  <div class="container">
	    <div class="row">
	      <h3 class="col-md-8">Contacts</h3>
	      <a class="btn btn-default col-md-1 col-xs-2" href="contact.php" role="button">Add Contact</a>
	    </div> <!-- /.row -->
		</div> <!-- /.container -->
  <thead>
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Title</th>
      <th>Org</th>
    </tr>
  </thead>
		<tbody>
		<?php
		if ($limit != 0) {
		  $i = 0;
		  $limit = min($limit, mysql_num_rows($results));
		  for ($i; $i < $limit; $i++) {
		    $row = mysql_fetch_assoc($results);
		    echo "<tr>";
		    echo "<td>" . $row['id'] . "</td>";
			  echo "<td><a href='./contact.php?id=".$row['id']."'>".$row['name']."</a></td>";
			  echo "<td>".$row["title"]."</td>";
			  echo "<td><a href='./organization.php?id=".$row["org"]."'>".$row["org"]."</a></td>";
			  echo "</tr>";
		  }
		}
		else {
		  $i = 1;
		  while ($row = mysql_fetch_assoc($results))
		  {
			  echo "<tr>";
			  echo "<td>" . $row['id'] . "</td>";
			  echo "<td><a href='./contact.php?id=".$row['id']."'>".$row['name']."</a></td>";
			  echo "<td>".$row["title"]."</td>";
			  echo "<td><a href='./organization.php?id=".$row["org"]."'>".$row["org"]."</a></td>";
			  echo "</tr>";
			  $i++;
		}
		}
		if ($i == 1)
		{
			echo "<tr><td colspan='5'>No Contacts found!</td></tr>";
		}
		?>
		</tbody>
	</table>
	<?php
}

?>

<?php

function displayOrganizations($results, $limit=0, $fields=array(0 => "ID",1 => "NAME",2 => "EMPLOYEES",3 => "INDUSTRY", 4 => "FOUNDED", 5 => "URL", 6 => "crawled"))
{
	?>
	<table class="table table-striped table-bordered table-hover table-condensed">
	  <div class="container">
			<div class="row">
	      <h3 class="col-md-8">Contacts</h3>
	      <a class="btn btn-default col-md-1 col-xs-2" href="organization.php" role="button">Add Org</a>
	    </div> <!-- /.row -->
		</div> <!-- /.container -->


  <thead>
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Employees</th>
      <th>Industry</th>
			<th>Founded</th>
			<th>URL</th>
			<th>crawled</th>
    </tr>
  </thead>

		<tbody>

		<?php
		if ($limit != 0) {
		  $i = 0;
		  $limit = min($limit, mysql_num_rows($results));
		  for ($i; $i < $limit; $i++) {
		    $row = mysql_fetch_assoc($results);
		    echo "<tr>";
		    echo "<td>".$row['ID']."</td>";
			  echo "<td><a href='./organization.php?id=".$row['ID']."'>".$row['NAME']."</a></td>";
			  echo "<td>".$row['EMPLOYEES']."</td>";
				echo "<td>".$row['INDUSTRY']."</td>";
				echo "<td>".$row['FOUNDED']."</td>";
				echo "<td> <a href='http://".$row['URL']."'>".$row['URL']."</a></td>";
				echo "<td>".$row['crawled']."</td>";
			  echo "</tr>";
		  }
		}
		else {
		  $i = 1;
		  while ($row = mysql_fetch_assoc($results))
		  {
			  echo "<tr>";
				echo "<td>".$row['ID']."</td>";
				echo "<td><a href='./organization.php?id=".$row['ID']."'>".$row['NAME']."</a></td>";
				echo "<td>".$row['EMPLOYEES']."</td>";
				echo "<td>".$row['INDUSTRY']."</td>";
				echo "<td>".$row['FOUNDED']."</td>";
				echo "<td> <a href='http://".$row['URL']."'>".$row['URL']."</a></td>";
				echo "<td>".$row['crawled']."</td>";
			  echo "</tr>";
			  $i++;
			}
		}
		if ($i == 1)
		{
			echo "<tr><td colspan='5'>No Contacts found!</td></tr>";
		}
		?>
		</tbody>
	</table>
	<?php
}

function displaySearchResults($search_results, $limit)
{
	return 0;
}

?>
