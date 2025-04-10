<?php
class Retro {
    private $db;

    public function __construct($pdo) {
        $this->db = $pdo;
    }

    public function getRoom($userId, $roomId) {
        $stmt = $this->db->prepare("SELECT * FROM rooms WHERE id = ? AND user_id = ?");
        $stmt->execute([$roomId, $userId]);
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
    public function createPostit($roomId, $userId, $isAuthor, $content, $category) {

        $stmt = $this->db->prepare("INSERT INTO messages 
                                  (room_id, user_id, is_author, content, category) 
                                  VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$roomId, $userId, $isAuthor, $content, $category]);
        
        return $this->getPostitById($this->db->lastInsertId());
    }

    public function getPostitById($id) {
        $stmt = $this->db->prepare("SELECT m.*, u.pseudo as author, u.image_profile as author_image
                                    FROM messages m
                                    JOIN users u ON m.user_id = u.id
                                    WHERE m.id = ?");
        $stmt->execute([$id]);
        $message = $stmt->fetch(PDO::FETCH_ASSOC);
        return $message;
    }

    public function updatePostit($id, $content, $category) {
        // Validation de la catégorie
        $validCategories = ['positif', 'negatif', 'a_ameliorer'];
        if (!in_array($category, $validCategories)) {
            throw new Exception("Catégorie invalide");
        }

        $stmt = $this->db->prepare("UPDATE messages 
                                  SET content = ?, category = ?, updated_at = NOW() 
                                  WHERE id = ?");
        return $stmt->execute([$content, $category, $id]);
    }

    public function deletePostit($id) {
        $stmt = $this->db->prepare("DELETE FROM messages WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function filterByCategory($messages, $category) {
        return array_filter($messages, function($msg) use ($category) {
            return $msg['category'] === $category;
        });
    }
}
?>