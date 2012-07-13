DELETE FROM news_i18n WHERE news_id >= 3;
DELETE FROM news WHERE id >= 3;

INSERT INTO news VALUES(3, '2011-05-18', 'Taxa de entrada', '/event/', true, true, false, false, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO news VALUES(4, '2011-05-19', 'Eventos freeroll', '/event/', true, true, false, false, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

INSERT INTO news_i18n VALUES(3, 'pt_BR', 'Nova opção "Taxa de entrada" em eventos', 'Inclusão da opção de cobrança de taxa de entrada nos eventos para acumular crédito para criação de eventos freeroll');
INSERT INTO news_i18n VALUES(3, 'en_US', 'New "Entrance fee" option on events', '');

INSERT INTO news_i18n VALUES(4, 'pt_BR', 'Crie eventos FREEROLL', 'Agora é possível criar eventos freeroll configurando prêmios e contando para as posições no ranking');
INSERT INTO news_i18n VALUES(4, 'en_US', 'Freeroll events now available', '');