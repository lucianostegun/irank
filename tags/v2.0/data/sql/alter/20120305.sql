INSERT INTO news(id, news_date, news_title, internal_link, enabled, visible, locked, deleted, created_at, updated_at)
VALUES(6, CURRENT_DATE, 'Pontuação personalizada', '/ranking', true, true, false, false, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);


INSERT INTO news_i18n VALUES(6, 'pt_BR', '<span style="font-weight: bold; color: #9F0000">Fórmula de pontuação personalizada</span>', 'Já está disponível no cadastro de rankings uma nova opção para cálculo de pontuação dos eventos.<br/><br/>Agora você pode escolher entre os modelos de pontuação pré-definidos pelo iRank ou criar sua própria fórmula a partir das variáveis disponíveis.');
INSERT INTO news_i18n VALUES(6, 'en_US', '<span style="font-weight: bold; color: #9F0000">Custom scoring formula</span>', 'Now available in your rankings a new option for calculating scores of events. <br/><br/>Now you can choose between models of iRank pre-defined score or create your own formula based on the variables available.');