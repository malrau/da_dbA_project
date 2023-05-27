<html>
    <head>
	<title>
	    Query comic book collection
	</title>
    </head>

    <body>
	<?php
	    // the following line allows me to report connection errors,
	    // otherwise a blank page would occur in case of errors
	    mysqli_report(MYSQLI_REPORT_ERROR);

		// return settings from configuration file into an associative array
	    $config = parse_ini_file('../config.ini');
	    // get parameters to access MySQL from associative array and
	    // assign them to PHP variables
	    $servername = $config['servername'];
	    $username = $config['username'];
	    $password = $config['password'];
	    $dbname = $config['dbname'];

	    // create and check connection to MySQL
	    $conn = mysqli_connect($servername, $username, $password, $dbname);
	    if(!$conn) {
		echo "<h3>Cannot connect to MySQL: </h3>" . mysqli_connect_error();
		exit;
	    } else {
		echo "<h3>Successfully connected to MySQL.</h3>";
	    }

	    // assign data to PHP variables
	    if(!$_POST['count'] and !$_POST['collection']) {
		echo "<br><h3>No choice taken</h3>";
		exit;
	    } else {
		if($_POST['count']) {
		    if($_POST['count'] == 'all') {
			$series_count = $_POST['count'];                # if we select whole collection, $series_count will assume the value 'all'
		    } else {
			$series_count = $_POST['chosen_series_count'];  # otherwise it will assume the name of the chosen series
		    }
		}
		if($_POST['collection']) {
		    if($_POST['collection'] == 'all') {
			$series_coll = $_POST['collection'];            # if we select whole collection, $series_coll will assume the value 'all'
		    } else {
			$series_coll = $_POST['chosen_series_coll'];    # otherwise it will assume the name of the chosen series
		    }
		}
	    }

	    // perform counting query as per the choice taken and show it in a html table
	    if($series_count) {
		if($series_count == 'all') {
		    $sql = "SELECT COUNT(*) AS 'No. of comic books' FROM comic_book";
		} else {
		    $sql = "SELECT COUNT(*) FROM comic_book WHERE series = '$series_count'";
		}

		// assign the result of the query to a PHP variable
		$result = mysqli_query($conn, $sql);

		// print a table to display the query result
		echo "<br>";
		echo "<table border = '1'>";

		    // print the table fields names
		    $fInfo = mysqli_fetch_fields($result);

		    echo "<tr>";
			foreach($fInfo as $val) {
			    echo "<th>" . $val -> name . "</th>";
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
	    }

	    // perform and check show collection query as per the choice taken
	    if($series_coll) {
		if($series_coll == 'all') {
		    $sql2 = "SELECT * FROM comic_book";
		} else {
		    $sql2 = "SELECT series AS Series, issueNumber AS Issue, coverTitle AS Title FROM comic_book WHERE series = '$series_coll'";
		}
		// assign the result of the query to a PHP variable
		$result2 = mysqli_query($conn, $sql2);

		// print a table to display the query result
		echo "<br>";
		echo "<table border = '1'>";

		    // print the table fields names
		    $fInfo = mysqli_fetch_fields($result2);

		    echo "<tr>";
			foreach($fInfo as $val) {
			    echo "<th>" . $val -> name . "</th>";
			}
		    echo "</tr>";

		    // print the table content
		    while($row = mysqli_fetch_assoc($result2)) {
			echo "<tr>";
			foreach($row as $field => $value) {
			    echo "<td>" . $value . "</td>";
			}
			echo "<tr>";
		    }

		echo "</table>";
	    }

	?>

	<br>
	<p>
	    <a href = '_e_query_cb.html'><button>Back to the comic books query page</button></a>
	    <a href = '_a_comic_books.html'><button>Back to the comic books page</button></a>
	    <a href = '../index.html'><button>Back to the main page</button></a>
	</p>

    </body>
<html>
