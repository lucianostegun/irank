CREATE SEQUENCE state_seq;
CREATE TABLE state ( 
    id INTEGER NOT NULL DEFAULT nextval('state_seq'::regclass) PRIMARY KEY,
    initial CHAR(2),
    description VARCHAR(50),
    order_seq INTEGER,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);


CREATE SEQUENCE city_seq;
CREATE TABLE city ( 
    id INTEGER NOT NULL DEFAULT nextval('city_seq'::regclass) PRIMARY KEY,
    state_id INTEGER,
    description VARCHAR(60),
    order_seq INTEGER,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    CONSTRAINT city_FK_1 FOREIGN KEY(state_id) REFERENCES state (id)
);


INSERT INTO state(id, initial, description, order_seq, created_at, updated_at) VALUES
(1, 'AC', 'Acre', 0, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
(2, 'AL', 'Alagoas', 0, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
(3, 'AP', 'Amapá', 0, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
(4, 'AM', 'Amazonas', 0, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
(5, 'BA', 'Bahia', 0, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
(6, 'CE', 'Ceará', 0, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
(7, 'DF', 'Distrito Federal', 0, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
(8, 'GO', 'Goiás', 4, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
(9, 'ES', 'Espírito Santo', 0, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
(10, 'MA', 'Maranhão', 0, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
(11, 'MT', 'Mato Grosso', 0, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
(12, 'MS', 'Mato Grosso do Sul', 0, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
(13, 'MG', 'Minas Gerais', 0, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
(14, 'PA', 'Pará', 0, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
(15, 'PB', 'Paraíba', 0, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
(16, 'PR', 'Paraná', 3, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
(17, 'PE', 'Pernambuco', 0, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
(18, 'PI', 'Piauí', 0, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
(19, 'RJ', 'Rio de Janeiro', 2, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
(20, 'RN', 'Rio Grande do Norte', 0, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
(21, 'RS', 'Rio Grande do Sul', 0, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
(22, 'RO', 'Rondônia', 0, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
(23, 'RR', 'Roraima', 0, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
(24, 'SP', 'São Paulo', 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
(25, 'SC', 'Santa Catarina', 0, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
(26, 'SE', 'Sergipe', 0, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
(27, 'TO', 'Tocantins', 0, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);



INSERT INTO city(state_id, description, order_seq, created_at, updated_at) VALUES
((SELECT id FROM state WHERE initial = 'SP'), 'São Paulo', 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
((SELECT id FROM state WHERE initial = 'SP'), 'São José do Rio Preto', 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
((SELECT id FROM state WHERE initial = 'RJ'), 'Rio de Janeiro', 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
((SELECT id FROM state WHERE initial = 'PR'), 'Curitiba', 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
((SELECT id FROM state WHERE initial = 'GO'), 'Goiânia', 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);



CREATE SEQUENCE club_seq;
CREATE TABLE club ( 
	id INTEGER NOT NULL DEFAULT nextval('club_seq'::regclass) PRIMARY KEY,
	club_name VARCHAR(60),
	file_name_logo VARCHAR(20),
	address_name VARCHAR(200),
	address_number VARCHAR(20),
	address_quarter VARCHAR(50),
    city_id INTEGER NOT NULL,
    maps_link VARCHAR(512),
    club_site VARCHAR(150),
    phone_number_1 VARCHAR(20),
    phone_number_2 VARCHAR(20),
    phone_number_3 VARCHAR(20),
	created_at TIMESTAMP,
	updated_at TIMESTAMP,
    CONSTRAINT club_FK_1 FOREIGN KEY(city_id) REFERENCES city (id)
);



INSERT INTO club(club_name, file_name_logo, address_name, address_number, address_quarter, city_id, maps_link, club_site, phone_number_1, created_at, updated_at) VALUES
    ('Black River Club', 'briver.jpg', 'Rua Manoel Joaquim Pires', 777, null, (SELECT id FROM city WHERE description ILIKE 'São José do Rio Preto'), 'http://maps.google.com/maps?q=Rua+Manoel+Joaquim+Pires,+777,+S%C3%A3o+Jos%C3%A9+do+Rio+Preto+-+S%C3%A3o+Paulo,+Brazil&hl=en&ie=UTF8&sll=-20.832698,-49.403443&sspn=0.008092,0.013937&hnear=R.+Joaquim+Manoel+Pires,+777+-+Jardim+Pinheiros,+S%C3%A3o+Jos%C3%A9+do+Rio+Preto+-+S%C3%A3o+Paulo,+15091-210,+Brazil&t=m&z=17', null, '(17) 7811-5002', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    ('Espaço Zahle Club', 'zahle.jpg', 'Rua Osório Duque Estrada', '40', null, (SELECT id FROM city WHERE description ILIKE 'São Paulo'), 'http://maps.google.com/maps?q=Rua+Os%C3%B3rio+Duque+Estrada,+40,+S%C3%A3o+Paulo,+Brasil&hl=en&ie=UTF8&sll=-20.832698,-49.403443&sspn=0.008092,0.013937&oq=Rua+Os%C3%B3rio+Duque+Estrada,+40,+sao+p&hnear=R.+Os%C3%B3rio+Duque+Estrada,+40+-+Moema,+S%C3%A3o+Paulo,+04001-120,+Brazil&t=m&z=17', null, '(11) 3057-3831', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    ('H2 Club', 'h2.jpg', 'Rua Iguatemi', '236', 'Itaim Bibi', (SELECT id FROM city WHERE description ILIKE 'São Paulo'), 'http://maps.google.com/maps?q=Rua+Iguatemi,+236,+S%C3%A3o+Paulo,+Brasil&hl=en&ie=UTF8&sll=-23.569368,-46.653297&sspn=0.015872,0.027874&oq=Rua+Iguatemi,+236,+sao&hnear=R.+Iguatemi,+236+-+Itaim+Bibi,+S%C3%A3o+Paulo,+01451-010,+Brazil&t=m&z=17&iwloc=A', 'www.h2club.com.br', '(11) 3078-5884', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    ('Vegas Holdem Club', 'vegas.jpg', 'Rua Bento de Andrade', '312', 'Ibirapuera', (SELECT id FROM city WHERE description ILIKE 'São Paulo'), 'http://maps.google.com/maps?q=Rua+Bento+de+Andrade+312,+S%C3%A3o+Paulo,+Brasil&hl=en&ie=UTF8&sll=-23.584174,-46.682294&sspn=0.007935,0.013937&hnear=R.+Bento+de+Andrade,+312+-+Moema,+S%C3%A3o+Paulo,+04503-000,+Brazil&t=m&z=17', null, '(11) 3439-0104', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);