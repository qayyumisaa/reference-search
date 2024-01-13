<?php

$servername = "localhost";
$username = "root"; // replace with your username
$password = ""; // replace with your password

// Define the database-specific details
$databases = [
    ["name" => "Manuscripts_Catalog", "table" => "manuscripts_catalog", "columns" => ["Tajuk", "Penulis", "No_Rujukan_Lama"],"name2" => "Daftar Rujukan Manuskrip"],
    // ... Add other databases with their respective table and column names ...
];

$search = $_GET['search'];
$counter = 1;
$resultsFound = false; // Flag to track if any results are found

foreach ($databases as $dbInfo) {
    $conn = new mysqli($servername, $username, $password, $dbInfo['name']);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Construct the search query for multiple columns
    $searchQueryParts = [];

    foreach ($dbInfo['columns'] as $column) {
        $searchQueryParts[] = "$column LIKE '%$search%'";
    }
    $searchQuery = implode(' OR ', $searchQueryParts);

    $sql = "SELECT * FROM " . $dbInfo['table'] . " WHERE " . $searchQuery;
    $result = $conn->query($sql);

    $specStrings = ['<', '>'];

    if ($result && $result->num_rows > 0) {
        $resultsFound = true; // Set the flag to true as results are found
        echo "<p class='align-items-center text-center'>Showing search result for \"" . $search . "\"</p>";
        echo "<div class='search-result-box card-box'>";
        echo "<div class='card' style='width: 100%;'>";
        echo "<div class='card-header align-items-center text-center'>";
        echo "<h4 style='margin-bottom: 0;'>" . $dbInfo['name2'] . "</h4>";
        echo $result->num_rows . " results found";
        echo "</div>";
        while ($row = $result->fetch_assoc()) {
            
            // Display the title
            echo "<ul class='list-group list-group-flush'>";
            echo "<li class='list-group-item title pe-auto' onclick='openModal(\"modal$counter\")'>" . $row["Tajuk"] . "<br><span>" . $row["Penulis"] . "</span>" . "</li>";
            // echo "<li class='list-group-item title pe-auto' onclick='openModal(\"modal$counter\")'>" .$counter . ". " . $row["Tajuk"] . "<br><span>" . $row["Penulis"] . "</span>" . "</li>";

            // echo "<br />";
            echo "</ul>";
            // Hidden modal
            echo "<div id='modal$counter' class='modal' style='display:none;'>";
            echo "<div class='modal-dialog'>";
            echo "<div class='modal-content'>";
            echo "<div class='modal-header mx-auto'><h5 class='modal-title'>Full Information</h5></div>";
            
            echo "<div class='modal-body'";
            // Iterate over each column in the row
            foreach ($row as $columnName => $columnValue) {
                if ($columnValue !== null) {
                    // Replace underscores with spaces and capitalize the column name for display
                    $displayName = ucwords(str_replace('_', ' ', $columnName));
                    echo "<p>" . htmlspecialchars($displayName) . ": " . htmlspecialchars($columnValue) . "</p>";
                }
            }
            echo "</div>";
            echo "      <div class='modal-footer'>
            <button type='button' class='btn btn-danger' onclick='closeModal(\"modal$counter\")' data-bs-dismiss='modal'>Close</button>
          </div>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
            $counter++;

        }
        echo "</div>";
        // echo "<br>";
        echo "</div>";
    } 
    $conn->close();
}

if (!$resultsFound) {
    echo "
    <div class='container card-box text-center' style='width:40%; position:center; margin-top: -20%'>No results found.</div>";
}

?>
