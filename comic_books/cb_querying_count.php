<html>
    <head>
		<title>
			Query comic book collection
		</title>
    </head>

    <body>
		<?php
			# exploit script to perform MySQL connection
			include('../connect.php');
			
			echo "<br>";

			# assign data and queriy to PHP variables
			/* first check if radio control element is set
			   (notice, though, that this is no longer necessary,
			    since I set the value 'not_all' to be checked
			    by default, so the element will always be defined) */
			if(!isset($_POST['count'])) {
				echo "<p>";
				echo "<h4>Make your choice: </h4>";
				echo "<a href = '_e_query_cb.php'><button>Back to the query comic books page</button></a>";
				echo "</p>";
			} elseif($_POST['count'] == 'all') {
				$sql = "SELECT COUNT(*) AS 'No. of comic books' FROM comic_book";
			} else {
				if($_POST['chosen_series_count'] == '') {
					echo "<h4>Choose the series you want to be shown: </h4>";
					echo "<a href = '_e_query_cb.php'><button>Back to the query comic books page</button></a>";
				} else {
					$series_count = $_POST['chosen_series_count'];
					$sql = "SELECT series AS Series, COUNT(*) AS 'No. of comic books' FROM comic_book WHERE series = '$series_count'";
				}
			}

			# perform and check counting query as per the choice taken and show it in a html table
			if(!isset($sql)) {
				exit;
			} else {
				$result = mysqli_query($conn, $sql);

				# print a table to display the query result
				echo "<br>";
				echo "<table border = '1'>";

				# print the table fields names
				$fInfo = mysqli_fetch_fields($result);

				echo "<tr>";
				foreach($fInfo as $val) {
					echo "<th>" . $val -> name . "</th>";
				}
				echo "</tr>";

				# print the table content
				while($row = mysqli_fetch_assoc($result)) {
					echo "<tr>";
					foreach($row as $field => $value) {
						echo "<td>" . $value . "</td>";
					}
					echo "<tr>";
				}

				echo "</table>";
			}

		?>

		<br>

		<p>
			<a href = '_e_query_cb.php'><button>Back to the comic books query page</button></a>
			<a href = '_a_comic_books.html'><button>Back to the comic books page</button></a>
			<a href = '../index.html'><button>Back to the main page</button></a>
		</p>
    </body>
<html>
