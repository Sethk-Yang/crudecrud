<head>
<style>
	body { background-color: #DDB0A0; /* change background color to blush red*/
		}
</style>
</head>
<body>
<h2> Database Query </h2>
<h3> This page querys the database and pulls the specific data requested </h3>
<a href = "http://127.0.0.1" >Home Page</a>
<br>

<?php

//this is the php object oriented style of creating a mysql connection
$conn = new mysqli('localhost', 'sethy2', 'sethy2', 'employees' );

//check for connection success
if ($conn->connect_error) {
        die("MySQL Connection Failed: " . $conn->connect_error);
   }


echo "MySQL Connection Succeeded<br><br>";
?>
<p> The current query shows the top 100 paid employees </p>


<?php
//create the SQL select statement, notice the funky string concat at the end to variablize the query
//based on using the GET attribute

$sql = "SELECT employees.emp_no, employees.first_name, employees.last_name, salaries.salary, employees.hire_date 
FROM employees 
JOIN salaries ON employees.emp_no = salaries.emp_no 
ORDER by salaries.salary 
DESC limit 100";

//put the resultset into a variable, again object oriented way of doing things here
$result = $conn->query($sql);

//if there were no records found say so, otherwise create a while loop that loops through all rows
//and echos each line to the screen. You do this by creating some crazy looking echo statements
// in the form of HTMLText . row[column] . HTMLText . row[column].   etc...
// the dot "." is PHP's string concatenator operator
if ($result->num_rows > 0){
//print rows of records found in the database if any
    while($row = $result->fetch_assoc()){
         echo "Salary: $"         . $row["salary"] . "<br>";
         echo "Employee Number: " . $row["emp_no"] . "<br>";
         echo "First Name: "      . $row["first_name"] . "<br>";
         echo "Last Name: "       . $row["last_name"] . "<br>";
	 echo "Hire Date: "       . $row["hire_date"] . "<br>";
         echo "<br>"; // Add a line break for better readability between records
    
}
 } else {
         echo "No Records Found";
 }

//always close the connection to the DB, don't leave 'em hanging
$conn->close();

?>
</body>
