<html>
	<head>
		<title>
			Deleted editor data
		</title>
	</head>

	<body>
		<?php
			# exploit script to perform MySQL connection
			include('../connect.php');
			
			# assign submitted data to php variable
			$editorName = $_POST['editorName'];
			
			# perform and check deletion from the chosen table by name
			$sqlName = "DELETE FROM editor WHERE name = '$editorName'";
			if(mysqli_query($conn, $sqlName)) {
				echo "<h3>Data was successfully removed from the table <i>editor</i>.</h3>";
			} else {
				echo "<h3>ERROR Could not remove data from the table <i>editor</i>.</h3>";
			}
		?>

		<br>

		<p>
			<a href = '_c_delete_editor.php'><button>Back to the delete editor page</button></a>
			<a href = '_a_authors.html'><button>Back to the authors page</button></a>
			<a href = '../index.html'><button>Back to the main page</button></a>
		</p>
	</body>
</html>
