INSERT INTO rooms (id, name, code, user_id, created_at) VALUES
(1, 'Feedback App Mobile', 'MOB123', 1, '2023-10-15 14:48:00'),
(2, 'Revue Design System', 'DS456', 1, '2023-11-20 09:15:00'),
(3, 'Tests Utilisateurs V2', 'TUV789', 1, '2023-12-05 16:30:00');

INSERT INTO nameless (id, pseudo, image_profile, created_at) VALUES
(1, 'Anon1', 'anon1.jpg', '2023-10-15 15:00:00'),
(2, 'Anon2', 'anon2.jpg', '2023-10-15 15:05:00'),
(3, 'Anon3', 'anon3.jpg', '2023-11-20 09:30:00'),
(4, 'Anon4', 'anon4.jpg', '2023-12-05 16:45:00');

INSERT INTO room_members (room_id, nameless_id, joined_at) VALUES
(1, 1, '2023-10-15 15:00:00'),
(1, 2, '2023-10-15 15:05:00'),
(2, 3, '2023-11-20 09:30:00'),
(3, 4, '2023-12-05 16:45:00');