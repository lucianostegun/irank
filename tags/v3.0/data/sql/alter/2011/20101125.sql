ALTER TABLE ranking_player RENAME COLUMN score TO total_score;
ALTER TABLE ranking_player RENAME COLUMN events TO total_events;
ALTER TABLE ranking_player RENAME COLUMN balance TO total_balance;
ALTER TABLE ranking_player RENAME COLUMN average TO total_average;


DROP TABLE IF EXISTS faq;
DROP SEQUENCE IF EXISTS faq_seq;

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
    VALUES('Como são calculados os <b>Pontos</b> do ranking?', 1, true, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, 'A coluna <b>Pontos</b> exibida no ranking, e que pode ser um dos critérios de classificação é composta pela seguinte fórmula:<br/><br/>
				<b style="font-size: 10pt">(Média*Eventos*10)+(Eventos*10)</b><br/><br/>

                <b>Exemplo:</b><br/>
<table style="margin-top: 5px" cellspacing="1" cellpadding="0" border="0">
    <tr><th>(A)</th><th align="right">Total B+R+A:</th><td>40,00</td></tr>
    <tr><th>(B)</th><th align="right">Total prêmios:</th><td>55,00</td></tr>
    <tr><th>(C)</th><th align="right">Balanço:</th><td>15,00 (B-A)</td></tr>
    <tr><th>(D)</th><th align="right">Média:</th><td>1,375 (B/A)</td></tr>
    <tr><th>(E)</th><th align="right">Eventos:</th><td>3</td></tr>
    <tr><th>(F)</th><th align="right">Pontos:</th><td>71,25 (D*E*10)+(E*10)</td></tr>
</table>
                <br/><br/>Ou seja, quanto maior o a relação Ganhos/Gastos e quanto maior a quantidade de eventos que o jogador participa, maior será sua pontuação.');