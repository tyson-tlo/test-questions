<?php
// $csv = file("https://technical-test.s3.amazonaws.com/analytics.csv");
// File stored locally for testing purposes, though the above function would work just fine to retrieve contents stored on aws
$csv = file("analytics.csv");
// Remove header row of csv
array_shift($csv);

// Quick fomat of row for legibility when working with this data in order to make it more understandable
// As well, makes sure that vars are properly typed as row comes in as a string
function formatRow(string $row) {
    $row = explode(',', $row);
    return [
        'user' => $row[0],
        'country' => $row[1],
        'time' => (int) $row[2],
        'event_id' => $row[3],
        'amount' => (int) $row[4]
    ];
}

// Function built to complete exercise #2
// Function also built to complete exercise #3
function usersCompletedLevel(int $level, array $csv) {
    $completed = [];

    foreach ($csv as $row) {
        $row = formatRow($row);
        $lvl = explode('_', $row['event_id'])[1];
        if (strpos($row['event_id'], $level . '_COMPLETE') !== false) {            
            $completed[$row['user']] = $row['event_id'];
        }
        // If the user has alread completed level 5 and is in the array, then update event_id in order to find out the last event completed.
        if (array_key_exists($row['user'], $completed)) {
            $completed[$row['user']] = $row['event_id'];
        }
    }
    return $completed;
}

function calculatePercentage($num1, $num2) {
    return $num1 / $num2 * 100;
}