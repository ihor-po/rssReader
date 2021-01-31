<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Task\FeedReader;

$rssURI = $argv[1] ?? 'https://www.nu.nl/rss/Sport';

$task = new FeedReader();
$task->setURI($rssURI);
$result = $task->load();

echo $task->getResult($result);




