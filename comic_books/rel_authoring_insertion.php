<html>
	<head>
		<title>
			Insert now authors data
		</title>
	</head>

	<body>
		<?php
			# exploit script to perform MySQL connection
			include('../connect.php');
			
			/*********************************
			*** STEP 1: COMPLETE INSERTION ***
			************** FROM **************
			** rel_publishing_insertion.php **
			**********************************/
			// assign data to PHP variables
			$editor = $_POST['editor'];
			$comic_bookID = $_POST['comic_bookID'];
			// perform and check insertion into the chosen table
			$sql = "INSERT INTO publishing(editor, comic_bookID) VALUES('$editor', '$comic_bookID')";
			if(mysqli_query($conn, $sql)) {
				echo "<h3>Data was successfully inserted into the table <i>publishing</i>.</h3>";
			} else {
				echo "<h3>ERROR! Could not insert data into the table <i>publishing</i>: </h3>" . mysqli_error($conn);
			}

			/*  now I have to feed the comic book ID to the 'authoring'
				table together with the writer and artist ID, which are
				primary keys of the tables 'writer' and 'artist' (which
				store info about the authors of my comic books collection). */

			/* Introduce what you have to do in the current page, after
			   the editor insertion */
			echo "<br>";
			echo "<p>";
			echo "<center>";
			echo "<h2>In this page you can submit data about the authors</h2>";
			echo "<h2>of the last comic book inserted in your database</h2>";
			echo "</center>";
			echo "</p>";

			# FORM START
			echo "<form method = 'post' action = 'rel_starring_insertion.php'>";

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
					echo "<h3>No matching comic books are found.</h3>";
				}
			} else {
				echo "<h3>ERROR. Cannot execute $sqlCb: </h3>" . mysqli_error($conn);
			}

			/**********************************
			*** STEP 3: FEED THE AUTHORS ID ***
			**********************************/
			echo "<br>";
			/* I query the 'writer' and 'artist' tables for the authors
			in my database, so to choose those that have authored the
			last comic book	inserted */
			$sqlWriter = "SELECT * FROM writer";
			$sqlArtist = "SELECT * FROM artist";
			
			# writers
			if($resultWriter = mysqli_query($conn, $sqlWriter)) {
				if(mysqli_num_rows($resultWriter) > 0) {
					echo "<p>";
					echo "<h4>Select its writer: </h4>";
					echo "<select name = 'writerID'>";
					while($rowWriter = mysqli_fetch_array($resultWriter)) {
						echo "<option value = '$rowWriter[0]'>";
						echo $rowWriter[1] . ' ' . $rowWriter[2];
						echo "</option>";
					}
					echo "</select>";
					echo "</p>";
					mysqli_free_result($resultWriter);
				} else {
					echo "<h4>No records in the <i>writer</i> table.</h4>";
				}
			} else {
				echo "<h4>ERROR. Cannot execute $sqlWriter: </h4>" . mysqli_error($conn);
			}
			
			echo "<br>";
			
			# artists
			if($resultArtist = mysqli_query($conn, $sqlArtist)) {
				if(mysqli_num_rows($resultArtist) > 0) {
					echo "<p>";
					echo "<h4>Select its artist: </h4>";
					echo "<select name = 'artistID'>";
					while($rowArtist = mysqli_fetch_array($resultArtist)) {
						echo "<option value = '$rowArtist[0]'>";
						echo $rowArtist[1] . ' ' . $rowArtist[2];
						echo "</option>";
					}
					echo "</select>";
					echo "</p>";
					mysqli_free_result($resultArtist);
				} else {
					echo "<h4>No records in the <i>artist</i> table.</h4>";
				}
			} else {
				echo "<h4>ERROR. Cannot execute $sqlArtist: </h4>" . mysqli_error($conn);
			}

			echo "<br><br>";
			
			echo "<input type = 'submit' value = 'submit authors'>";
			echo "<input type = 'reset' value = 'reset fields'>";
			
			# FORM END
			echo "</form>";
		?>
		
		<br>
		
		<p>
			<a href ='_b_insert_cb.html'><button>Back to the insert comic book page</button></a>
			<a href = '_a_comic_books.html'><button>Back to the comic books page</button></a>
			<a href = '../index.html'><button>Back to the main page</button></a>
		</p>
	</body>
</html>
