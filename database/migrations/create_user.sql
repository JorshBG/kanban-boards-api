CREATE USER 'kb_admin'@'localhost' IDENTIFIED BY 'KbAdmin+12';
GRANT ALL PRIVILEGES ON kanban_boards.* TO 'kb_admin'@'localhost';
FLUSH PRIVILEGES;
