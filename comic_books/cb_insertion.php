<html>
    <head>
	<title>
	    Inserted comic book data
	</title>
    </head>

    <body>
	<?php
	    // the following line allows me to report connection errors,
	    // otherwise a blank page would occur in case of errors
	    mysqli_report(MYSQLI_REPORT_ERROR);

	    // assign password to PHP variable
	    $config = parse_ini_file('../config.ini');
	    foreach($config as $val) $psw = $val;

	    // create and check connection to MariaDB
	    $conn = mysqli_connect('localhost', 'root', $psw, 'cb_collection');
	    if(!$conn) {
		echo "<h3>Cannot connect to MariaDB: </h3>" . mysqli_connect_error();
		exit;
	    } else {
		echo "<h3>Successfully connected to MariaDB.</h3>";
	    }

	    // assign data to PHP variables
	    $series = $_POST['insert_series'];
	    $issue = $_POST['insert_issue'];
	    $title = $_POST['cover_title'];

	    // perform and check insertion into the chosen table
	    $sql = "INSERT INTO comic_book(series, issueNumber, coverTitle) VALUES('$series', '$issue', '$title')";
	    if(mysqli_query($conn, $sql)) {
		echo "<h3>Data was successfully inserted into the table <i>comic_book</i>.</h3>";
	    } else {
		echo "<h3>ERROR! Could not insert data into the table <i>comic_book</i>: </h3>" . mysqli_error($conn);
	    }
	?>

	<br>
	<p>
	    <a href = 'insert_cb.html'><button>Back to the insert comic book page</button></a>
	    <a href = 'comic_books.html'><button>Back to the comic books page</button></a>
	    <a href = '../index.html'><button>Back to the main page</button></a>
	</p>
    </body>
</html>
