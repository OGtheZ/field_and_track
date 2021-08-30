<?php

$runningTrack = ['_', '_', '_', '_', '_', '_', '_', '_', '_', '_', '_'];
$stadium = [];

$playerCount = (int) readline("Please enter player count: ");
if (!is_numeric($playerCount) || $playerCount < 1 || $playerCount > 5) {
    echo "Enter a valid player count, 1-5!" . PHP_EOL;
    exit;
}
$possiblePlayers = ["X", "@", "&", "#", "$"];
$players = [];

for ($i =  0; $i < $playerCount; $i++) {
    array_push($stadium, $runningTrack);
    $players[] .= $possiblePlayers[$i];
    $stadium[$i][0] = $players[$i];
}

$theRaceIsLive = true;
$podium = [];

while($theRaceIsLive) {
    foreach($stadium as $runner) {
        echo implode(" ", $runner) . PHP_EOL;
        echo "!-!-!-!-!-!-!-!-!-!-!-!-!-!" . PHP_EOL;
    }

    for ($i = 0; $i < $playerCount; $i++) {
        $position = array_search($players[$i], $stadium[$i]);
        if ($position < count($stadium[$i])-1) {
            $stadium[$i][$position] = "_";
            $stadium[$i][$position + rand(1, 2)] = $possiblePlayers[$i];
        } else {
            $podium[] = $players[$i];
            $podium = array_unique($podium);
        }
        if (count($podium) === $playerCount) {
            $theRaceIsLive = false;
            $winners = array_unique($podium);
            for ($i = 1; $i < $playerCount + 1; $i++) {
                echo "$i." .  $podium[$i-1] . PHP_EOL;
            }
        }
    }
    sleep(1);
}
