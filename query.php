<?php

$conn = new mysqli("localhost", "root", "secret", "barcode");

$qr_num = $_POST['qr'];
$string = "insert into item (barcode_number) values ('$qr_num')";
$display = "select * from item order by id DESC";

if ($conn->query($string)) {
	$query = $conn->query($display);

	echo "<table border style='cellspadding: 10px; margin: 0px auto;'>";
	echo "<tr>";
	echo "<th>";
	echo "ID";
	echo "</th>";
	echo "<th>";
	echo "Student ID";
	echo "</th>";
	echo "<th>";
	echo "Date";
	echo "</th>";
	echo "</tr>";

	while ($result = $query->fetch_assoc()) {
		echo "<tr>";
		echo "<td>";
		echo $result["id"];
		echo "</td>";
		echo "<td>";
		echo $result["barcode_number"];
		echo "</td>";
		echo "<td>";
		echo $result["sale_date"];
		echo "</td>";
		echo "</tr>";
	}
	echo "</table>";
} else {
	echo "invalid";
}
