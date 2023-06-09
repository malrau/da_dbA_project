<html>
	<head>
		<title>
			Inserted starring data
		</title>
	</head>
	
	<body>
		<?php
			# exploit script to perform MySQL connection
			include('../connect.php');
			
			# assign data to PHP variables
			$comic_bookID = $_POST['comic_bookID'];
			$city = $_POST['city'];
			$country = $_POST['country'];
			/* the following code assigns character pseudonym and role to
			   the variables $pseudonym and $figureRole */
			foreach($_POST as $key => $value) {
				if($dashPosition = strpos($key, '-')) {
					/* the string to the left of the dash position is the
					   key storing the value for the character pseudonym */
					$pseudoKey = substr($key, 0, $dashPosition);
					/* note, anyway, that $pseudoKey, within the $_POST
					   array is key and value at the same time */
					$pseudonym = $_POST[$pseudoKey];
					if(!isset($pseudonym)) {
						# this blank row is for 'do nothing'
					} else {
						$tempRole = substr($key, $dashPosition + 1);
						/*	I reconstruct the role key to retrieve the corresponding
							value from the $_POST array */
						$figureRole = $_POST[$pseudoKey . '-' . $tempRole];
						# perform insertion into 'starring' for each character
						$sql = "INSERT INTO starring(comic_bookID, figure, figureRole, city, country) VALUES('$comic_bookID', '$pseudonym', '$figureRole', '$city', '$country')";
						if(mysqli_query($conn, $sql)) {
							echo "<h4>Data was successfully inserted into the <i>starring</i> table.</h4>";
						} else {
							echo "<h3>ERROR! Could not insert data into the <i>starring</i> table: </h3>" . mysqli_error($conn);
						}
					}
				} else {
					echo "<h4>No character and role data found.</h4>";
				}
			}
		?>
		
		<br>

		<p>
			<a href= '_b_insert_cb.html'><button>Back to the insert comic book page</button></a>
			<a href = '_a_comic_books.html'><button>Back to the comic books page</button></a>
			<a href = '../index.html'><button>Back to the main page</button></a>
		</p>
	</body>
</html>
