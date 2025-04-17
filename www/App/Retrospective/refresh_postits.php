<?php
require_once '../Protected/database.php';
require_once '../Protected/class_retro.php';
session_start();

$db = Database::getConnection();
$retro = new Retro($db);

// get the messages
$messages = $retro->getPostits($_GET['room_id']);
$positive = $retro->filterByCategory($messages, 'positif');
$negative = $retro->filterByCategory($messages, 'negatif');
$improve = $retro->filterByCategory($messages, 'a_ameliorer');

// generate the HTML
function generatePostItHTML($messages) {
    ob_start();
    foreach ($messages as $msg) {
        include '../Retrospective/postit_template.php';
    }
    return ob_get_clean();
}

// return each message from each column
echo json_encode([
    'positive' => generatePostItHTML($positive),
    'improve' => generatePostItHTML($improve),
    'negative' => generatePostItHTML($negative)
]);
?>