<?php
	session_start();
	if(!isset($_SESSION['med_admin']))
	{
		header("Location: index.html");
		exit();
	}
	if(isset($_POST['sqlq']))
	{
		$sqlq = $_POST['sqlq'];

		include 'config.php';
		if(!($dbconn = @mysqli_connect($dbhost, $dbuser, $dbpass))) exit('Error connecting to database.');
		mysqli_select_db($dbconn, $db);
		$sqlq = mysqli_query($dbconn, $sqlq);
		if(!$sqlq)
		{
			echo "Query Failed.<br />";
			exit;
		}
		$num_rows = mysqli_num_rows($sqlq);
		echo "<pre>Fetched ".$num_rows." rows. Output:<br /><br />";
		echo "<table border=1><tr>";
		/*for($i = 0; $i < mysqli_num_fields($sqlq); $i++)
		{
    			$field_info = mysqli_fetch_field($sqlq)[$i];
			echo "<th>{$field_info->name}</th>";
		}*/
		while ($field_info = mysqli_fetch_field($sqlq)) {
			echo "<th>{$field_info->name}</th>";
		}
		echo "</tr>";
		while($row = mysqli_fetch_row($sqlq))
		{
			echo "<tr>";
			foreach($row as $_column)
			{
				echo "<td>{$_column}</td>";
			}
			echo "</tr>";
		}
		echo "</table>";
	}
?>
