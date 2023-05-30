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
			
			#echo $_POST['count'];

			# assign data and queriy to PHP variables
			if(!isset($_POST['count'])) {
				echo "<p>";
				echo "<h4>Make your choice: </h4>";
				echo "<a href = '_e_query_cb.html'><button>Back to the query comic books page</button></a>";
				echo "</p>";
			} elseif($_POST['count'] == 'all') {
				$sql = "SELECT * FROM comic_book";
			} elseif($_POST['count'] == 'not_all') {
				if(!isset($_POST['chosen_series_coll'])) {
					echo "<h4>Choose the series you want to be shown: </h4>";
					echo "<a href = '_e_query_cb.html'><button>Back to the query comic books page</button></a>";
				} else {
					$series_coll = $_POST['chosen_series_coll'];
					$sql = "SELECT series AS Series, issueNumber AS Issue, coverTitle AS Title FROM comic_book WHERE series = '$series_coll'";
				}
			}
				
/*				
		    } elseif($_POST['count'] == 'not_all') {
				if(!$_POST['chosen_series_coll']) {
					echo "<h4>Choose the series you want to be shown: </h4>";
					echo "<a href = '_e_query_cb.html'><button>Back to the query comic books page</button></a>";
				} else {
					$series_coll = $_POST['chosen_series_coll'];
					$sql = "SELECT series AS Series, issueNumber AS Issue, coverTitle AS Title FROM comic_book WHERE series = '$series_coll'";
				}
			} else {
				echo "<h4>Make your choice: </h4>";
				echo "<a href = '_e_query_cb.html'><button>Back to the query comic books page</button></a>";
			} */

			# perform and check show collection query as per the choice taken
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
			<a href = '_e_query_cb.html'><button>Back to the comic books query page</button></a>
			<a href = '_a_comic_books.html'><button>Back to the comic books page</button></a>
			<a href = '../index.html'><button>Back to the main page</button></a>
		</p>
    </body>
<html>
