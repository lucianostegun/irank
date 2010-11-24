DELETE FROM virtual_table WHERE virtual_table_name = 'peopleType';
INSERT INTO virtual_table VALUES(nextval('virtual_table_seq'), 'peopleType', 'Usu�rio administrativo', 'userAdmin', true, true, false, false, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO virtual_table VALUES(nextval('virtual_table_seq'), 'peopleType', 'Usu�rio do site', 'userSite', true, true, false, false, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO virtual_table VALUES(nextval('virtual_table_seq'), 'peopleType', 'Membro de ranking', 'rankingPlayer', true, true, false, false, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

DELETE FROM virtual_table WHERE virtual_table_name = 'gameType';
INSERT INTO virtual_table VALUES(nextval('virtual_table_seq'), 'gameType', 'Texas Hold''em', 'holdem', true, true, false, false, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO virtual_table VALUES(nextval('virtual_table_seq'), 'gameType', 'Stud', 'stud', true, true, false, false, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO virtual_table VALUES(nextval('virtual_table_seq'), 'gameType', 'Omaha', 'omaha', true, true, false, false, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO virtual_table VALUES(nextval('virtual_table_seq'), 'gameType', 'Todos', 'mixed', true, true, false, false, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

DELETE FROM virtual_table WHERE virtual_table_name = 'gameStyle';
INSERT INTO virtual_table VALUES(nextval('virtual_table_seq'), 'gameStyle', 'Torneio', 'tournament', true, true, false, false, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO virtual_table VALUES(nextval('virtual_table_seq'), 'gameStyle', 'Ring game', 'ring', true, true, false, false, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO virtual_table VALUES(nextval('virtual_table_seq'), 'gameStyle', 'Sit & Go', 'sitngo', true, true, false, false, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

DELETE FROM virtual_table WHERE virtual_table_name = 'rankingType';
INSERT INTO virtual_table VALUES(nextval('virtual_table_seq'), 'rankingType', 'Valor', 'value', true, true, false, false, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO virtual_table VALUES(nextval('virtual_table_seq'), 'rankingType', 'Posi��o', 'score', true, true, false, false, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO virtual_table VALUES(nextval('virtual_table_seq'), 'rankingType', 'Balan�o', 'balance', true, true, false, false, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO virtual_table VALUES(nextval('virtual_table_seq'), 'rankingType', 'M�dia x Eventos', 'average', true, true, false, false, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

DELETE FROM virtual_table WHERE virtual_table_name = 'userSiteOption';
INSERT INTO virtual_table VALUES(nextval('virtual_table_seq'), 'userSiteOption', 'Receber confirma��o de presen�a dos convidados para os eventos', 'receiveFriendEventConfirmNotify', true, true, false, false, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO virtual_table VALUES(nextval('virtual_table_seq'), 'userSiteOption', 'Notificar eventos agendados para o dia', 'receiveEventReminder0', true, true, false, false, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO virtual_table VALUES(nextval('virtual_table_seq'), 'userSiteOption', 'Notificar eventos agendados para 3 dias', 'receiveEventReminder3', true, true, false, false, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
INSERT INTO virtual_table VALUES(nextval('virtual_table_seq'), 'userSiteOption', 'Notificar eventos agendados para 7 dias', 'receiveEventReminder7', true, true, false, false, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);