<html>
	<head>
		<title>
			Update comic book data
		</title>
	</head>

	<body>
		<?php
			# exploit script to perform MySQL connection
			include('../connect.php');

			# assign submitted data to PHP variables
			$attribute = $_POST['attribute'];
			$old = $_POST['old'];
			$new = $_POST['new'];

			# perform and check update of the comic book table
			$sql = "UPDATE comic_book SET $attribute = '$new' WHERE $attribute = '$old'";
			if(mysqli_query($conn, $sql)) {
				echo "<h3>Data from table <i>comic_book</i> was successfully updated</h3>";
			} else {
				echo "<h3>ERROR! Could not update data from table <i>comic_book</i></h3>" . mysqli_error($conn);
			}
		?>

		<br>
		
		<p>
			<a href = '_d_update_cb.html'><button>Back to the update comic book page</button></a>
			<a href = '_a_comic_books.html'><button>Back to the comic books page</button></a>
			<a href = '../index.html'><button>Back to the main page</button></a>
		</p>
	</body>
</html>
