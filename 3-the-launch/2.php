<?php

/*
-----------------------------------------------------------------------------
3. The Launch 
-----------------------------------------------------------------------------
Your company made a game! When it went live on the app store, the marketing
department went into overdrive advertising the game. 

Our marketing team is paying American (US) and German (DE) Twitch streamers 
for every user they send us that reaches LEVEL 5. After a week the game 
isn't earning a profit (the advertising budget is high). It's also possible
that there is a flaw in the game that we haven't yet discovered.

You intelligently made the choice to record analytics, but unfortunately 
you just logged the data to a CSV file. You need to figure out what's going 
on by writing code to answer the following questions:

1) What percentage of users are completing LEVEL 5?

2) What's the average revenue per user, split by country?

3) Of the users that completed LEVEL 5, what event was the most likely to 
   cause them to not return?
	
The csv file:
https://technical-test.s3.amazonaws.com/analytics.csv

user_id  - the id of the user in question
country  - the country the user is in
time     - what time the event was created
event_id - the id of the event	eg.  LEVEL_{n}_START,  LEVEL_{n}_COMPLETE,  PURCHASE_BOOSER
amount   - amount of real money the user spent for PURCHASE events
*/


// $csv = file("https://technical-test.s3.amazonaws.com/analytics.csv");
// File stored locally for testing purposes, though the above statement would work just file to retrieve contents stored on aws

require_once('common.php');

/**
 * Average revenue per user split by country
 */

function revenuePerUserByCountry($csv)
{    
    $summary = [];  

    // We'll start by looping through csv
    foreach ($csv as $row) {
        $row = formatRow($row);
        
        /* Need to format array to look like this
         ["country_code" => [
                "unique_users" => [{array of users}],
                "revenue" => decimal, // This is a running total
                "average_revenue_per_user" => decimal
            ]
         ]        
        */
        if (!array_key_exists($row['country'], $summary)) {
            // Initialize inner array
            $summary[$row['country']] = [
                'unique_users' => [$row['user']],
                'revenue' => $row['amount']
            ];
        } else {
            // Check to see if user is not in array and then add user to array
            if (!in_array($row['user'], $summary[$row['country']]['unique_users'])){                
                $summary[$row['country']]['unique_users'][] = $row['user'];
            }
            if ($row['amount'] > 0) $summary[$row['country']]['revenue'] += $row['amount'];          
        }
    }

    $countries = array_keys($summary);
    $revenue_per_user_per_country = [];

    foreach ($countries as $country) {
        $revenue_per_user_per_country[$country] = $summary[$country]['revenue'] / count($summary[$country]['unique_users']);
    }

    return $revenue_per_user_per_country;
}

echo "Average revenue per user per country: \n";
print_r(revenuePerUserByCountry($csv));