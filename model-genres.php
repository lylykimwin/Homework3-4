<?php
require_once("util-db.php");

function selectGenres() {
    $conn = get_db_connection();
    if (!$conn) {
        die("Database connection failed.");
    }

    $sql = "
        SELECT g.genre_id, g.genre_name, g.show_id, s.title AS show_title
        FROM genres g
        JOIN shows s ON g.show_id = s.show_id
    ";
    $result = $conn->query($sql);

    $genres = [];
    if ($result && $result->num_rows > 0) {
        // Fetch the data
        while ($row = $result->fetch_assoc()) {
            $genres[] = $row;
        }
    }

    if ($result) {
        $result->close();
    }

    $conn->close();

    return $genres;
}
?>