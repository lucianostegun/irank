ALTER TABLE people DROP COLUMN phone_number;

ALTER TABLE people ADD COLUMN phone_ddd INTEGER;
ALTER TABLE people ADD COLUMN phone_number VARCHAR(10);

ALTER TABLE user_site ADD COLUMN sms_credit INTEGER DEFAULT 0;


CREATE SEQUENCE sms_template_seq;
CREATE TABLE sms_template ( 
    id INTEGER NOT NULL DEFAULT nextval('sms_template_seq'::regclass) PRIMARY KEY,
    template_name VARCHAR(50) NOT NULL,
    description VARCHAR(100),
    content VARCHAR(140) NOT NULL,
    tag_name VARCHAR(32) NOT NULL,
    order_seq INTEGER,
    enabled BOOLEAN DEFAULT TRUE,
    visible BOOLEAN DEFAULT TRUE,
    deleted BOOLEAN DEFAULT FALSE,
    locked BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);


DELETE FROM sms_template;
INSERT INTO sms_template(template_name, tag_name, description, content, order_seq, created_at, updated_at) VALUES
    ('Criação de evento', 'eventCreateNotify', 'Criação de novo evento', 'Evento criado: [eventName] - [eventDateTime] @rankingPlace
Buyin: [buyinValue] #[rankingName]', 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    ('Alteração de evento', 'eventChangeNotify', 'Alteração de evento agendado', 'Evento alterado: [eventName] - [eventDateTime] @rankingPlace
Buyin: [buyinValue] #[rankingName]', 2, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    ('Exclusão de evento', 'eventDeleteNotify', 'Cancelamento de evento agendado', 'Evento cancelado: [eventName] - [eventDateTime] @rankingPlace
Buyin: [buyinValue] #[rankingName]', 3, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);


CREATE TABLE sms_option ( 
    people_id INTEGER NOT NULL,
    sms_template_id INTEGER NOT NULL,
    lock_send BOOLEAN,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    PRIMARY KEY(people_id, sms_template_id),
    CONSTRAINT sms_option_FK_1 FOREIGN KEY (people_id) REFERENCES people (id),
    CONSTRAINT sms_option_FK_2 FOREIGN KEY (sms_template_id) REFERENCES sms_template (id)
);

SELECT setval('product_category_seq', (SELECT MAX(id) FROM product_category));

ALTER TABLE purchase ADD COLUMN total_weight DECIMAL(10, 2) DEFAULT 0;