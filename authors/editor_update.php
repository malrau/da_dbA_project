<html>
	<head>
		<title>
			Updated editor data
		</title>
	</head>

	<body>
		<?php
			# exploit script to perform MySQL connection
			include('../connect.php');

			# assign data to PHP variables
			$editor = $_POST['editor'];	// VARIABLE NOT USED
			echo $editor;
			$attribute = $_POST['attribute'];
			$old = $_POST['old'];
			$new = $_POST['new'];

			
			$sql = "UPDATE editor SET $attribute = '$new' WHERE $attribute = '$old'";
			
			if(mysqli_query($conn, $sql)) {
				echo "<h3>Attribute <i>$attribute</i> from table <i>editor</i> has been successfully updated.</h3>";
			} else {
				echo "<h3>Could not update attribute $attribute from table <i>editor</i>.</h3>";
			}
		?>

		<br>

		<p>
			<a href = '_d_update_editor.php'><button>Back to the update editor page</button></a>
			<a href = '_a_authors.html'><button>Back to the authors page</button></a>
			<a href = '../index.html'><button>Back to the main page</button></a>
			
		</p>
	</body>
</html>
