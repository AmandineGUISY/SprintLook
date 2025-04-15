<?php
require_once 'Protected/database.php';
require_once 'Protected/class_retro.php';
session_start();


// verify if the user is connected
if (!isset($_SESSION['user_id']) && !isset($_SESSION['nameless_id'])) {
    header('Location: login.php');
    exit();
}

$room_id = $_GET['room_id'];
$room_name = $_GET['room_name'];
$user_id = NULL;
$nameless_id = NULL;

if (!isset($_SESSION['user_id'])) {$user_id = $_SESSION['user_id'];}
if (!isset($_SESSION['nameless_id'])) {$nameless_id = $_SESSION['nameless_id'];}

$db = Database::getConnection();
$retro = new Retro($db);

$room = $retro->getRoom($room_name, $room_id);

if (!$room) {
    die("Salle non trouvée ou accès refusé");
}

$messages = $retro->getPostits($room_id);
$positive = $retro->filterByCategory($messages, 'positif');
$negative = $retro->filterByCategory($messages, 'negatif');
$improve = $retro->filterByCategory($messages, 'a_ameliorer');

$postits = $retro->getPostits($roomId, $_SESSION['user_id']);
$isRoomOwner = $retro->getRoom($_SESSION['user_id'], $roomId) !== false;

function renderPostItButtons($msg, $isRoomOwner, $currentUserId, $currentNamelessId) {
    $canEdit = ($msg['user_id'] == $currentUserId) || 
               ($msg['nameless_id'] == $currentNamelessId) || 
               $isRoomOwner;
    
    if (!$canEdit) return '';

    return '
    <div class="absolute top-2 right-2 flex space-x-2">
        <button class="edit-postit text-blue-500 hover:text-blue-700 transition-colors"
                data-id="'.$msg['id'].'"
                data-category="'.$msg['category'].'"
                data-content="'.htmlspecialchars($msg['content']).'"
                title="Modifier">
            <i class="fas fa-edit text-sm"></i>
        </button>
        <button class="delete-postit text-red-500 hover:text-red-700 transition-colors"
                data-id="'.$msg['id'].'"
                title="Supprimer">
            <i class="fas fa-trash text-sm"></i>
        </button>
    </div>';
}

function renderPostItContent($msg) {
    return '
    <div class="flex items-start mb-2">
        <img src="'.htmlspecialchars($msg['author_image'] ?? '/Resources/Images/SprintLook.png').'" 
            alt="Profile" class="w-6 h-6 md:w-8 md:h-8 rounded-full mr-2 object-cover">
        <span class="font-semibold text-sm md:text-base">'.htmlspecialchars($msg['author']).'</span>
    </div>
    <p class="whitespace-pre-wrap text-xs md:text-sm mt-1">'.htmlspecialchars($msg['content']).'</p>
    <div class="text-xs text-gray-500 mt-2">
        '.date('d/m/Y H:i', strtotime($msg['created_at'])).'
    </div>';
}

$columns = [
    'positif' => [
        'title' => '<i class="fas fa-smile mr-2"></i>Positif',
        'class' => 'bg-green-50 border-green-200',
        'border' => 'border-green-500',
        'messages' => $positive
    ],
    'a_ameliorer' => [
        'title' => '<i class="fas fa-lightbulb mr-2"></i>À améliorer',
        'class' => 'bg-orange-50 border-orange-200',
        'border' => 'border-orange-500',
        'messages' => $improve
    ],
    'negatif' => [
        'title' => '<i class="fas fa-frown mr-2"></i>Négatif',
        'class' => 'bg-red-50 border-red-200',
        'border' => 'border-red-500',
        'messages' => $negative
    ]
];
?>