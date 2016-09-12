<!DOCTYPE html>

<head>
	<link rel="stylesheet" type="text/css" href="styles.css" />
	<script>
	function enableElement(element)
	{
		document.getElementById(element).disabled = false;
		document.getElementById(element).style.color = 'green';
	};

	function enableRow(row, columns)
	{
		if (document.getElementById('field-' + row + '-' + '0').disabled) {
			for (var i = 0; i <= columns; i++)
			{
				document.getElementById('field-' + row + '-' + i).disabled = false;
				document.getElementById('field-' + row + '-' + i).style.color = 'green';
			}
		}
		else {
			for (var i = 0; i <= columns; i++)
			{
				document.getElementById('field-' + row + '-' + i).disabled = true;
				document.getElementById('field-' + row + '-' + i).style.color = 'gray';
			}
		}
	};

	</script>
</head>

<?php

$server = "localhost";

$username = "maybefac_al";

$password = "18Oct04.";

$db = "maybefac_learning";

$query = "SELECT learning_object.sort AS LO, screen.sort AS Screen, learning_object.id AS 'LO Id', learning_object.title AS LO, learning_object.time AS Time, learning_object.module_id AS Module, screen.screen_id AS 'Screen Id', screen.title AS 'Screen Title', screen.screen_template_id AS Template
FROM learning_object, screen
WHERE (learning_object.id = screen.learning_object_id) ORDER BY learning_object.sort ASC, screen.sort ASC";

$link = mysqli_connect ($server, $username, $password, $db);

echo "<body>";
echo "<div id=\"wrapper\">";
echo "<div id=\"inner\">";
echo "<div id=\"content\">";
echo "<div class=\"module no-padding\">";

/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

/* Select queries return a resultset */
if ($result = mysqli_query($link, $query)) {
    echo "<h2>Query: ".$query."</h2>";
    echo "<h2>Returned: ".mysqli_num_rows($result)." rows</h2>";

	// create fields

	echo "<table>";
	echo "<tbody>";

    // print table headers

	echo "<tr>";
	$current_column = 0;
	while ($current_column < mysqli_num_fields($result)) {
        	$column = mysqli_fetch_field($result);
        	echo "<th>".$column->name."</th>";
		$current_column++;
	}
	
        // add 2 columns for the buttons
        echo "<th></th>";
        echo "<th></th>";

	echo "</tr>";

    // print editable data fields

    // print list

        $alternate = 0;
        $current_row = 0;
	while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
	// print alternate rows and make them editable with double click
		if ($alternate == 0) {
			echo "<tr class=\"alternate-row\" ondblclick=\"enableRow('$current_row', '$current_column')\">";
			$alternate = 1;
    		}
    		else
    		{
			echo "<tr ondblclick=\"enableRow('$current_row', '$current_column')\">";
			$alternate = 0;
    		}
    	// print columns inside every row
    		foreach ($row as $key => $value) {
    			echo "<td><input class=\"column-$key\" disabled=\"true\" type=\"text\" style=\"display: inline\" id=\"field-$current_row-$key\" value=\"$value\"></td>";
		}
	// create edit button in every row	
		echo "<td><button onclick=\"enableRow('$current_row', '$key')\" name=\"edit-$current_row\" type=\"submit\" value=\"edit-$current_row\">Edit</button></td>";
		echo "<td><button onclick=\"\" name=\"save-$current_row\" type=\"submit\" value=\"save-$current_row\">Save</button></td>";

		$current_row++;
	        echo "</tr>";
    	}

    echo "</tbody>";
    echo "</table>";
 
	mysqli_free_result($result);
	mysqli_close($link);
}
else {
	echo "Query failed";
}

echo "</form>";

// close module no-padding
echo "</div>";

// close content-default
echo "</div>";

// close inner
echo "</div>";

// close wrapper
echo "</div>";

// close body
echo "</body>";
?>
</html>
