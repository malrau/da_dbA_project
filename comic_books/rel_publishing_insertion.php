<html>
	<head>
		<title>
			Insert now publisher data
		</title>
	</head>

	<body>
		<?php
			# exploit script to perform MySQL connection
			include('../connect.php');
			
			/*********************************
			*** STEP 1: COMPLETE INSERTION ***
			***** FROM _b_insert_cb.html *****
			**********************************/
			// assign data to PHP variables
			$series = $_POST['insert_series'];
			$issue = $_POST['insert_issue'];
			$title = $_POST['cover_title'];
			// perform and check insertion into the chosen table
			$sql = "INSERT INTO comic_book(series, issueNumber, coverTitle) VALUES('$series', '$issue', '$title')";
			if(mysqli_query($conn, $sql)) {
				echo "<h4>Data was successfully inserted into the table <i>comic_book</i>.</h4>";
			} else {
				echo "<h3>ERROR! Could not insert data into the table <i>comic_book</i>: </h3>" . mysqli_error($conn);
			}

			/*  now that I have inserted the comic book data, the comic book 
				ID has been created and I need to feed it to the 'authoring'
				table together with the editor name, which is the primary
				key of the table 'editor' (which stores info about the
				editor of my comic books collection). */

			/* Introduce what you have to do in the current page, after
			   the comic book insertion */
			echo "<br>";
			echo "<p>";
			echo "<center>";
			echo "<h2>In this page you can submit data about the editor</h2>";
			echo "<h2>of the last comic book inserted in your database</h2>";
			echo "</center>";
			echo "</p>";

			# FORM START
			echo "<form method = 'post' action = 'rel_authoring_insertion.php'>";
		   
		   /**********************************
			*** STEP 2: FEED COMIC BOOK ID ***
			**********************************/
			echo "<br>";
			$sqlCb = "SELECT * FROM comic_book WHERE cbID = (SELECT MAX(cbID) FROM comic_book)";
			/* I query the 'comic_book' table for the latest insertion
			   the one where the cbID is the largest */
			if($resultCb = mysqli_query($conn, $sqlCb)) {
				if(mysqli_num_rows($resultCb) > 0) {
					/* if comic_book table is not empty create a form to
					   show the latest comic book issue inserted */
					echo "<p>";
					echo "<h4>The latest comic book inserted was: </h4>";
					while($rowCb = mysqli_fetch_array($resultCb)) {
						echo "<input type = 'radio' name = 'comic_bookID' value = $rowCb[0] checked>";
						echo " ";
						echo $rowCb[1] . ' ' . 'N.' . $rowCb[2] . ',' . ' ';
						echo "<i>$rowCb[3]</i>";
						echo "<br>";
					}
					echo "</p>";
					mysqli_free_result($resultCb);
				} else {
					echo "<h4>No matching comic books are found.</h4>";
				}
			} else {
				echo "<h3>ERROR. Cannot execute $sqlCb: </h3>" . mysqli_error($conn);
			}

		   /**********************************
			***  STEP 3: FEED  THE EDITOR  ***
			**********************************/
			$sqlEditor = "SELECT name FROM editor";
			/* I also query the 'editor' table for editors already in the
			   database, so to associate it to the latest comic book inserted */
			if($resultEditor = mysqli_query($conn, $sqlEditor)) {
				if(mysqli_num_rows($resultEditor) > 0) {
					echo "<p>";
					echo "<h4>Select its editor: </h4>";
					echo "<select name = 'editor'>";
					while($rowEditor = mysqli_fetch_array($resultEditor)) {
						echo "<option value = '$rowEditor[0]'>";
						echo $rowEditor[0];
						echo "</option>";
					}
					echo"</select>";
					echo "</p>";
					mysqli_free_result($resultEditor);
				} else {
					echo "<h4>No matching records are found.</h4>";
				}
			} else {
				echo "<h3>ERROR. Cannot execute $sqlEditor: </h3>" . mysqli_error($conn);
			}
			echo "<br><br>";
			echo "<input type = 'submit' value = 'submit editor'>";
			echo "<input type = 'reset' value = 'reset fields'>";

			# FORM END
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
