<!DOCTYPE html>

<head>
	<link rel="stylesheet" type="text/css" href="/css/fonts.css" />
</head>

<style>
body {
	font-family: UbuntuRegular, 'Lucida Grande', Calibri, Arial, sans-serif;
	font-size: 14px;
	width: 100%;
	color: #666;
	background-color: #f2f2f2;
}

h1, h2, h3, h4, h5, h6 {
	font-family: YanoneKaffeesatz, 'Arial Narrow', Arial, Helvetica, sans-serif;
}

table {
	border-collapse: collapse;
}

table, th, td {
	border-top: 1px solid #ccc;
	border-bottom: 1px solid #ccc;
	border-left: none;
	border-right: none;
}

th {
	background-color: #333;
	color: #f2f2f2;
}

th, td {
	padding: 5px;
}

tr td.number-column, tr.alternate-row td.number-column {
	font-size: 1.2em;
	font-weight: bold;
	text-align: center;
}

tr.alternate-row td {
	background-color: #f8f8f8;
}

#wrapper {
	width: 90%;
	margin: 0px auto;
}

#inner {
	width: 90%;
}

</style>

<?php

$server = "localhost";

$username = "ld_user";

$password = "18Oct04.";

$db = "ld";

$query = "SELECT learning_object.sort, screen.sort, learning_object.id, learning_object.title, learning_object.time, learning_object.module_id, screen.screen_id, screen.title, screen.screen_template_id
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

    // print table

	echo "<table>";

    // print table headers

	echo "<tr>";
	$i = 0;
	while ($i < mysqli_num_fields($result)) {
        	$column = mysqli_fetch_field($result);
        	echo "<th>".$column->name."</th>";
		$i++;
	}
	echo "</tr>";

    // print data
    $alternate = 0;  
    while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
	        if ($alternate == 0) {
			echo "<tr class=\"alternate-row\">";
			$alternate = 1;
    		}
    		else
    		{
			echo "<tr>";
			$alternate = 0;
    		}
      	foreach ($row as $key => $value) {
    		if ($key <= 1) {
			echo "<td class=\"number-column\">".$value."</td>";
		}
		else {
			echo "<td>".$value."</td>";
		}
	}
	echo "</tr>";
	
    }
    echo "</table>";
        mysqli_free_result($result);
	mysqli_close($link);
}
else {
	echo "Query failed";
}



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
