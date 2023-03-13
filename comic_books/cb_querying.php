<html>
    <head>
	<title>
	    Query comic book collection
	</title>
    </head>

    <body>
	<?php
	    mysqli_report(MYSQLI_REPORT_ERROR);

	    // assign passord to PHP variable
	    $psw = $_POST['psw'];

	    // create and check connection to mariaDB
	    $conn = mysqli_connect('localhost', 'root', '', 'cb_collection');
	    if(!$conn) {
		echo "<h3>Cannot connect to MariaDB: </h3>" . mysqli_connect_error();
		exit;
	    } else {
		echo "<h3>Successfully connected to mariaDB.</h3>";
	    }

	    // assign data to PHP variables
	    if(!$_POST['count']) {
		echo "No choice taken";
		exit;
	    } else {
		if($_POST['count'] == 'all') {
		    $series_count = $_POST['count'];                # if we select whole collection, $series will assume the value 'all'
		} else {
		    $series_count = $_POST['chosen_series_count'];  # otherwise it will assume the name of the chosen series
		}
	    }

	    // perform and check query as per the choice taken
	    if($series_count == 'all') {
		$sql = "SELECT COUNT(*) AS 'number of comic books' FROM comic_book";
	    } else {
		$sql = "SELECT COUNT(*) FROM comic_book WHERE series = '$series_count'";
	    }

/*	    if(mysqli_query($conn, $sql)) {
		echo "<h3>Successfully queried the <i>comic_book</i> table.</h3>";
	    } else {
		echo "<h3>ERROR! Could not query the <i>comic_book</i> table: </h3>" . mysqli_error($conn);
	    }
*/
	    // assign the result of the query to a PHP variable
	    $result = mysqli_query($conn, $sql);

	    // print a table to display the query result
	    echo "<br>";
	    echo "<table border = '1'>";

		// print the table fields names
		$fInfo = mysqli_fetch_fields($result);

		echo "<tr>";
		    foreach($fInfo as $val) {
			echo "<td>" . $val -> name . "</td>";
		    }
		echo "</tr>";

		// print the table content
		while($row = mysqli_fetch_assoc($result)) {
		    echo "<tr>";
		    foreach($row as $field => $value) {
			echo "<td>" . $value . "</td>";
		    }
		    echo "<tr>";
		}

	    echo "</table>";
	?>

	<br>
	<p>
	    <a href = 'query_cb.html'><button>Back to the comic books query page</button></a>
	    <a href = 'comic_books.html'><button>Back to the comic books page</button></a>
	    <a href = '..\index.html'><button>Back to the main page</button></a>
	</p>

    </body>
<html>