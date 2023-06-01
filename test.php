<?php
// Run the command and capture the output
$output = shell_exec('task export');

// Check if the command executed successfully
if ($output === null) {
    echo "Failed to execute the command.";
} else {
    // Process the output as needed
    // For example, if the output is JSON, you can decode it
    $data = json_decode($output);

    // Check if JSON decoding was successful
    if ($data === null) {
        echo "Invalid JSON output.";
    } else {
        // JSON decoding successful, you can now work with the data
        // Example: Accessing a property
        echo "Task ID: " . $data[0]->id;
    }
}

var_dump($data);

?>