<?php
// Database connection parameters
$servername = "localhost"; // Change if your database server is different
$username = "root"; // Your MySQL username
$password = "anuj"; // Your MySQL password
$dbname = "chess_tutorials"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from the database
$sql = "SELECT id, name, email, phone, created_at FROM users1";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Users</title>
    <link href="./dist/tailwind.css" rel="stylesheet" />
</head>
<body class="bg-gray-200 text-black font-semibold">
    <div class="container mx-auto p-5">
        <h2 class="text-2xl font-bold mb-4">Registered Users</h2>
        <table class="min-w-full bg-white border border-gray-300">
            <thead>
                <tr>
                    <th class="border px-4 py-2">ID</th>
                    <th class="border px-4 py-2">Name</th>
                    <th class="border px-4 py-2">Email</th>
                    <th class="border px-4 py-2">Phone</th>
                    <th class="border px-4 py-2">Created At</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Check if there are results and output data
                if ($result->num_rows > 0) {
                    // Output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td class='border px-4 py-2'>" . $row["id"] . "</td>";
                        echo "<td class='border px-4 py-2'>" . htmlspecialchars($row["name"]) . "</td>";
                        echo "<td class='border px-4 py-2'>" . htmlspecialchars($row["email"]) . "</td>";
                        echo "<td class='border px-4 py-2'>" . htmlspecialchars($row["phone"]) . "</td>";
                        echo "<td class='border px-4 py-2'>" . $row["created_at"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5' class='border px-4 py-2 text-center'>No users found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>