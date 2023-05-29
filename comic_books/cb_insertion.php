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

		   /**********************************
			*** STEP 1: COMPLETE INSERTION ***
			**********************************/
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

			/*  now that I have inserted the comic book data, the comic book 
				ID has been created and I need to feed it to the 'starring'
				table together with the character pseudonym, which is the
				primary key of the table figure (which stores info about
				the characters in my comic books collection). The 'starring'
				table also needs city and country attributes. I collect all
				of this data in different form control elements within the
				same form */
			
			echo "<br>";
			echo "<p>";
			echo "<center>";
			echo "<h2>In this page you can submit data about the characters</h2>";
			echo "<h2>appearing and the places where the action takes place</h2>";
			echo"</center>";
			echo"</p>";
			
		   /**********************************
			*** STEP 2: FEED COMIC BOOK ID ***
			**********************************/
			echo "<br>";
			/* I query the 'comic_book' table for the latest insertion
			   the one where the cbID is the largest */
			$sqlCb = "SELECT * FROM comic_book WHERE cbID = (SELECT MAX(cbID) FROM comic_book)";
			
			
			echo "<form method = 'post' action = 'starring_insertion.php'>";
			
			if($resultCb = mysqli_query($conn, $sqlCb)) {
				if(mysqli_num_rows($resultCb) > 0) {
					/* if comic_book table is not empty create a form to
					   show the latest comic book issue inserted */
					echo "<p>";
					echo "<h4>The latest comic book inserted was: </h4>";
					while($rowCb = mysqli_fetch_array($resultCb)) {
						echo "<input type = 'checkbox' name = 'cbID' value = $rowCb[0]>";
						echo " ";
						echo $rowCb[1] . ' ' . 'N.' . $rowCb[2] . ',' . ' ';
						echo "<i>$rowCb[3]</i>";
						echo "<br>";
					}
					echo "</p>";
				} else {
					echo "<h3>No matching comic books are found.</h3>";
				}
			} else {
				echo "<h3>ERROR. Cannot execute $sqlCb: </h3>" . mysqli_error($conn);
			}
			
		   /**********************************
			***  STEP 3: FEED  CHARACTERS  ***
			**********************************/
			echo "<br>";
			/* I also query the 'figure' table for the characters in my
			   database, so to choose those that appear in the latest one
			   inserted */
			$sqlFigure = "SELECT * FROM figure";
			/* I retrieve data from the query and build a form with a
			   checkbox control element */
			if($resultFigure = mysqli_query($conn, $sqlFigure)) {
				if(mysqli_num_rows($resultFigure) > 0) {
					echo "<p>";
					echo "<h4>Select the characters appearing in the comic book: </h4>";
					while($rowFigure = mysqli_fetch_array($resultFigure)) {
						echo "<input type = 'checkbox' name = '$rowFigure[2]', value = '$rowFigure[2]'>";
						/* I must refer to the figure table schema, where I have
						   character first name as first attribute, last name as
						   second and pseudonym (the primary key) as third
						   I must pass the primary key to the table starring */
						echo " ";
						echo $rowFigure[2] . ' ';
						echo " - Input role: ";
						// here I set a different name for each textbox generated
						// but I attach the same pattern '-role'
						$role = $rowFigure[2] . '-role';
						echo "<input type = 'text' name = '$role'>";
						echo "<br>";
					}
					echo "</p>";
				} else {
					echo "<h3>No matching records are found.</h3>";
				}
			} else {
				echo "<h3>ERROR. Could not perform $sqlFigure: </h3>" . mysqli_error($conn);
			}

		   /**********************************
			*** STEP 4: FEED LOCATION DATA ***
			**********************************/
			echo "<br>";
			echo "<p>";
			echo "<h4>Input data about where the action takes place: </h4>";
			echo "Input the city (or cities) where the action takes place: ";
			echo "<input type = 'text' name = 'city'>";
			echo "<br>";
			echo "Input the country (or countries) where the action takes place: ";
			echo "<input type = 'text' name = 'country'>";
			echo "</p>";
			echo "<br><br>";
			echo "<input type = 'submit' value = 'submit data'>";
			echo "<input type = 'reset' value = 'reset fields'>";
			
			echo "</form>";
			
		?>

		<br>
		<p>
			<a href = '_b_insert_cb.html'><button>Back to the insert comic book page</button></a>
			<a href = '_a_comic_books.html'><button>Back to the comic books page</button></a>
			<a href = '../index.html'><button>Back to the main page</button></a>
		</p>
    </body>
</html>
