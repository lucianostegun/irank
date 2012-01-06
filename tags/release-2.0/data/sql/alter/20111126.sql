INSERT INTO file(file_name, file_path, description, file_size, created_at, updated_at) 
    VALUES('signWelcomeApp.htm', 'templates/signWelcomeApp.htm', 'E-mail de boas vindas (iOS App)', null, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO auxiliar_text(description, file_id, tag_name, enabled, visible, locked, deleted, created_at, updated_at)
    VALUES('E-mail de boas vindas (iOS App)', (SELECT MAX(id) FROM file), 'signWelcomeApp', true, true, false, false, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);