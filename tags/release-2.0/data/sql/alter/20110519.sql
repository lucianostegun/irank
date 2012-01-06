DELETE FROM news_i18n WHERE news_id >= 3;
DELETE FROM news WHERE id >= 3;

INSERT INTO news VALUES(3, '2011-05-18', 'Taxa de entrada', '/event/', true, true, false, false, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO news VALUES(4, '2011-05-19', 'Eventos freeroll', '/event/', true, true, false, false, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

INSERT INTO news_i18n VALUES(3, 'pt_BR', 'Nova op��o "Taxa de entrada" em eventos', 'Inclus�o da op��o de cobran�a de taxa de entrada nos eventos para acumular cr�dito para cria��o de eventos freeroll');
INSERT INTO news_i18n VALUES(3, 'en_US', 'New "Entrance fee" option on events', '');

INSERT INTO news_i18n VALUES(4, 'pt_BR', 'Crie eventos FREEROLL', 'Agora � poss�vel criar eventos freeroll configurando pr�mios e contando para as posi��es no ranking');
INSERT INTO news_i18n VALUES(4, 'en_US', 'Freeroll events now available', '');