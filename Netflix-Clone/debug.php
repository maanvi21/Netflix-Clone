<?php
include 'db.php';

echo "<h1>User Database Debug</h1>";
$query = "SELECT * FROM users";
$result = mysqli_query($conn, $query);

echo "<table border='1'>";
echo "<tr><th>Email</th><th>Password (stored value)</th></tr>";

while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>" . $row['email'] . "</td>";
    echo "<td>" . $row['password'] . "</td>";
    echo "</tr>";
}
echo "</table>";

echo "<h2>Password Test</h2>";
echo "Example password hash: " . password_hash("Szy$10", PASSWORD_BCRYPT);
?>