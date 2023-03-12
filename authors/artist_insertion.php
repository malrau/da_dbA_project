<html>
    <head>
	<title>
	    Inserted artist data
	</title>
    </head>

    <body>
	<?php
	    mysqli_report(MYSQLI_REPORT_ERROR);

	    // create and check connection to MariaDB
	    $conn = mysqli_connect('localhost', 'root', '', 'test2');
	    if(!$conn) {
		echo "<h3>Cannot connect to MariaDB: </h3>" . mysqli_connect_error();
		exit;
	    } else {
		echo "<h3>Successfully connected to MariaDB.</h3>";
	    }

	    // assign submitted data to PHP variables
	    $firstName = $_POST['first_name'];
	    $lastName = $_POST['last_name'];
	    $pseudo = $_POST['pseudo'];

	    // perform and check insertion to the chosen table
	    $sql = "INSERT INTO artist(firstName, lastName, pseudonym) VALUES('$firstName', '$lastName', '$pseudo')";
	    if(mysqli_query($conn, $sql)) {
		echo "<h3>Data was successfully inserted into the table <i>artist</i>.</h3>";
	    } else {
		echo "<h3>ERROR! Could not insert data into the table <i>artist</i>: </h3>" . mysqli_error($conn);
	    }
	?>

	<br>
	<p>
	    <a href = 'insert_artist.html'><button>Back to the insert artist page</button></a>
	    <a href = 'authors.html'><button>Back to the authors page</button></a>
	    <a href = '../index.html'><button>Back to the main page</button></a>
	</p>

    </body>
</html>