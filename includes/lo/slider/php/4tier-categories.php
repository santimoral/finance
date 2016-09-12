<!DOCTYPE html>

<head>

</head>

<style>
body {
	font-family: UbuntuRegular, 'Lucida Grande', Calibri, Arial, sans-serif;
	font-size: 14px;
	width: 100%;
	color: #666;
	background-color: #f2f2f2;
}

table {
	border-collapse: collapse;
}

table, th, td {
	border: 1px solid #ccc;
}

th {
	background-color: #333;
	color: #f2f2f2;
}

th, td {
	padding: 5px;
}

.number-column {
	font-size: 1.2em;
	font-weight: bold;
	text-align: center;
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

$username = "maybefac_al";

$password = "18Oct04.";

$db = "maybefac_learning";

$query = "SELECT 4tier_category.id, 4tier_ability_type.name, 4tier_category.name, 4tier_category.maturity_target, 4tier_category.behavior, 4tier_category.examples
FROM 4tier_category, 4tier_ability_type WHERE (4tier_category.ability_type_id = 4tier_ability_type.id)";

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
    
    while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
	echo "<tr>";
    	foreach ($row as $key => $value) {
		if ($key <= 3 && $key > 0) {
			echo "<td class=\"number-column\">".$value."</td>";
		}
		else {
			echo "<td>".$value."</td>";
		}
	}
	echo "</tr>";
	
    }
    echo "</table>";

    // free memory and close connection
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
