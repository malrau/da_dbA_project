<html>
    <head>
	<title>
	    Deleted comic book data
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

	    // Assign data to PHP variables
	    $series = $_POST['delete_series'];
	    $issue = $_POST['delete_issue'];
	
	    // perform and check deletion from the chosen table
	    $sql = "DELETE FROM comic_book WHERE series = '$series' and issueNumber = '$issue'";
	    if(mysqli_query($conn, $sql)) {
		echo "<h3>Data was successfully removed from the table <i>comic_book</i>.</h3>";
	    } else {
		echo "<h3>ERROR! Could not remove data from the table <i>comic_book</i>: </h3>" . mysqli_error($conn);
	    }

	?>

	<br>
	<p>
	    <a href = '_c_delete_cb.html'><button>Back to the delete comic book page</button></a>
	    <a href = '_a_comic_books.html'><button>Back to the comic books page</button></a>
	    <a href = '../index.html'><button>Back to the main page</button></a>
	</p>
    </body>
</html>
