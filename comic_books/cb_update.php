<html>
    <head>
	<title>
	    Update comic book data
	</title>
    </head>

    <body>
	<?php
	    mysqli_report(MYSQLI_REPORT_ERROR);

	    // assign password to PHP variable
	    $psw = $_POST['psw'];

	    // create and check connection to MariaDB
	    $conn = mysqli_connect('localhost', 'root', $psw, 'cb_collection');
	    if(!$conn) {
		echo "<h3>Cannot connect to MariaDB: </h3>" . mysqli_connect_error();
		exit;
	    } else {
		echo "<h3>Successfully connected to MariaDB.</h3>";
	    }

	    // assign submitted data to PHP variables
	    $attribute = $_POST['attribute'];
	    $old = $_POST['old'];
	    $new = $_POST['new'];

	    // perform and check update of the comic book table
	    $sql = "UPDATE comic_book SET $attribute = '$new' WHERE $attribute = '$old'";
	    if(mysqli_query($conn, $sql)) {
		echo "<h3>Data from table <i>comic_book</i> was successfully updated</h3>";
	    } else {
		echo "<h3>Could not update data from table <i>comic_book</i></h3>" . mysqli_error($conn);
	    }

	?>

	<br>
	<p>
	    <a href = 'update_cb.html'><button>Back to the update comic book page</button></a>
	    <a href = 'comic_books.html'><button>Back to the comic books page</button></a>
	    <a href = '../index.html'><button>Back to the main page</button></a>
	</p>

    </body>
</html>
