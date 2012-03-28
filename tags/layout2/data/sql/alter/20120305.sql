INSERT INTO news(id, news_date, news_title, internal_link, enabled, visible, locked, deleted, created_at, updated_at)
VALUES(6, CURRENT_DATE, 'Pontua��o personalizada', '/ranking', true, true, false, false, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);


INSERT INTO news_i18n VALUES(6, 'pt_BR', '<span style="font-weight: bold; color: #9F0000">F�rmula de pontua��o personalizada</span>', 'J� est� dispon�vel no cadastro de rankings uma nova op��o para c�lculo de pontua��o dos eventos.<br/><br/>Agora voc� pode escolher entre os modelos de pontua��o pr�-definidos pelo iRank ou criar sua pr�pria f�rmula a partir das vari�veis dispon�veis.');
INSERT INTO news_i18n VALUES(6, 'en_US', '<span style="font-weight: bold; color: #9F0000">Custom scoring formula</span>', 'Now available in your rankings a new option for calculating scores of events. <br/><br/>Now you can choose between models of iRank pre-defined score or create your own formula based on the variables available.');