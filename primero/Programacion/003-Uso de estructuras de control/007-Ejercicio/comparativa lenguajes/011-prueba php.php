<?php
// Start the timer
$inicio = microtime(true);
echo "Start time: " . $inicio . "\n";

// Number of iterations
$iteraciones = 1000000000;
$numero = 1.00000000065;

// Loop
for ($i = 0; $i < $iteraciones; $i++) {
    $numero *= 1.000000045;
}

// End the timer
$final = microtime(true);
echo "End time: " . $final . "\n";

// Calculate elapsed time
$elapsed = $final - $inicio;
echo "Elapsed time: " . $elapsed . " seconds\n";
?>