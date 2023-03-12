<html>
    <head>
	<title>
	    Inserted editor data
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
	    $editorName = $_POST['editor_name'];
	    $editorCity = $_POST['editor_city'];

	    // perform and check insertion into the chosen table
	    $sql = "INSERT INTO editor(name, city) VALUES('$editorName', '$editorCity')";
	    if(mysqli_query($conn, $sql)) {
		echo "<h3>Data was successfully inserted into the table <i>editor</i>.</h3>";
	    } else {
		echo "ERROR! Could not insert data into the table <i>editor</i>: " . mysqli_error($conn);
	    }
	?>

	<br>
	<p>
	    <a href = 'insert_editor.html'><button>Back to the insert editor page</button></a>
	    <a href = 'authors.html'><button>Back to the authors page</button></a>
	    <a href = '../index.html'><button>Back to the main page</button></a>
	</p>

    </body>
</html>
