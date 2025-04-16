    <?php
    class Retro {
        private $db;

        public function __construct($pdo) {
            $this->db = $pdo;
        }

        public function getRoom($name, $roomId) {
            $stmt = $this->db->prepare("SELECT * FROM rooms WHERE id = ? AND name = ?");
            $stmt->execute([$roomId, $name]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function getPostits($roomId, $currentUserId = null) {
            // get the informations from the post it and with the join if it's the owner

            $stmt = $this->db->prepare("SELECT m.*, 
                                    COALESCE(u.pseudo, n.pseudo) as author,
                                    COALESCE(u.image_profile, n.image_profile) as author_image,
                                    (m.user_id = ?) as is_owner,
                                    (r.user_id = ?) as is_room_owner
                                    FROM messages m
                                    LEFT JOIN users u ON m.user_id = u.id
                                    LEFT JOIN nameless n ON m.nameless_id = n.id
                                    LEFT JOIN rooms r ON m.room_id = r.id
                                    WHERE m.room_id = ?
                                    ORDER BY m.created_at DESC");

            $stmt->execute([$currentUserId, $currentUserId, $roomId]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function createPostit($roomId, $userId, $namelessId, $content, $category) {
            // create the new post it
            $isAuthor = ($userId !== null) ? 1 : 0;

            $stmt = $this->db->prepare("INSERT INTO messages 
                                    (room_id, is_author, user_id, nameless_id, content, category) 
                                    VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->execute([$roomId, $isAuthor, $userId, $namelessId, $content, $category]);
            
            return;
        }

        public function updatePostit($id, $content, $category) {
            // check if the category is valid
            $validCategories = ['positif', 'negatif', 'a_ameliorer'];

            if (!in_array($category, $validCategories)) {
                throw new Exception("Catégorie invalide");
            }

            // update the post it
            $stmt = $this->db->prepare("UPDATE messages 
                                    SET content = ?, category = ?
                                    WHERE id = ?");
            return $stmt->execute([$content, $category, $id]);
        }

        public function deletePostit($id) {
            $stmt = $this->db->prepare("DELETE FROM messages WHERE id = ?");
            return $stmt->execute([$id]);
        }

        public function filterByCategory($messages, $category) {
            // take the $messages and take only the one with the category you want

            return array_filter($messages, function($msg) use ($category) {
                return $msg['category'] === $category;
            });
        }

        public function namelessAcces($namelessId, $roomId) {
            // check if the nameless is a room member

            $stmt = $this->db->prepare("SELECT 1
                                       FROM room_members
                                       WHERE room_id = ? AND nameless_id = ?");
            $stmt->execute([$roomId, $namelessId]);
            return (bool)$stmt->fetch();
        }

        public function isOwner($userId, $roomId) {
            // check if the user connected is the owner of the room

            $stmt = $this->db->prepare("SELECT 1
                                       FROM rooms
                                       WHERE id = ? AND user_id = ?");
            $stmt->execute([$roomId, $userId]);
            return (bool)$stmt->fetch();
        }
    }
    ?>