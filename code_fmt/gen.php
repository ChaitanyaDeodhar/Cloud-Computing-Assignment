<?php
// Gotta change to our source and target directory
$srcDir = './source';
$targetDir = './files';

// Function to monitor the source directory for new files
function monitorDirectory($dir) {
    // Use inotify extension if available
    if (extension_loaded('inotify')) {
        $inotify = inotify_init();
        inotify_add_watch($inotify, $dir, IN_CREATE);
        while (true) {
            $events = inotify_read($inotify);
            foreach ($events as $event) {
                if ($event['mask'] & IN_CREATE) {
                    $newFile = $event['name'];
                    processNewFile($newFile);
                }
            }
        }
    } else {
        // Simple file system polling mechanism (less efficient)
        while (true) {
            $files = scandir($dir);
            foreach ($files as $file) {
                if (!file_exists("$targetDir/$file.html")) {
                    processNewFile($file);
                }
            }
            sleep(1); // adjust the sleep time according to your needs
        }
    }
}

// Function to process a new file
function processNewFile($newFile) {
    // Extract necessary information from the file path or name
    $userid =...; // extract from file path or name
    $projectid =...; // extract from file path or name
    $srcfile = $newFile;

    // Run the highlighting command
    $target_file = "$targetDir/$userid/$projectid/$srcfile";
    $target_html = $target_file. '.html';
    $cmd = "highlight -l -f --inline-css --enclose-pre  -i $target_file -o $target_html";
    exec($cmd);
}

// Start monitoring the source directory
monitorDirectory($srcDir);
?>