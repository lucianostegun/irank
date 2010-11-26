ALTER TABLE ranking_player RENAME COLUMN score TO total_score;
ALTER TABLE ranking_player RENAME COLUMN events TO total_events;
ALTER TABLE ranking_player RENAME COLUMN balance TO total_balance;
ALTER TABLE ranking_player RENAME COLUMN average TO total_average;

CREATE SEQUENCE faq_seq;
CREATE TABLE faq (
    id INTEGER NOT NULL DEFAULT nextval('faq_seq'::regclass) PRIMARY KEY,
    question VARCHAR(200) NOT NULL,
    answer TEXT,
    order_seq INTEGER,
    visible BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);

INSERT INTO faq(question, order_seq, visible, created_at, updated_at, answer)
    VALUES('Como s�o calculados os <b>Pontos</b> do ranking?', 1, true, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, 'A coluna <b>Pontos</b> exibida no ranking, e que pode ser um dos crit�rios de classifica��o � composta pela seguinte f�rmula:<br/><br/>
				<b style="font-size: 10pt">(M�dia*Eventos*10)+(Eventos*10)</b><br/><br/>
                Ou seja, quanto maior o a rela��o Ganhos/Gastos e quanto maior a quantidade de eventos que o jogador participa, maior ser� sua pontua��o.');