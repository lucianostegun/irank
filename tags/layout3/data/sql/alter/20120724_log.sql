CREATE SEQUENCE purchase_status_log_seq;
CREATE TABLE purchase_status_log (
    id INTEGER NOT NULL DEFAULT nextval('purchase_status_log_seq'::regclass) PRIMARY KEY,
    purchase_id INTEGER NOT NULL,
    transaction_code VARCHAR(36),
    transaction_date TIMESTAMP NOT NULL,
    transaction_status VARCHAR(30) NOT NULL,
    paymethod_type VARCHAR(30),
    extra_amount DECIMAL(10, 2) DEFAULT 0,
    installment_count INTEGER,
    change_source VARCHAR(32) NOT NULL,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    CONSTRAINT purchase_status_log_FK_1 FOREIGN KEY (purchase_id) REFERENCES purchase (id)
);

CREATE SEQUENCE purchase_transaction_log_seq;
CREATE TABLE purchase_transaction_log (
    id INTEGER NOT NULL DEFAULT nextval('purchase_transaction_log_seq'::regclass) PRIMARY KEY,
    purchase_id INTEGER NOT NULL,
    transaction_code CHAR(36),
    transaction_type INTEGER,
    transaction_status INTEGER,
    paymethod_type INTEGER,
    paymethod_code INTEGER,
    gross_amount DECIMAL(10, 2),
    fee_amount DECIMAL(10, 2),
    net_amount DECIMAL(10, 2),
    escrow_end_date DATE,
    extra_amount DECIMAL(10, 2),
    installment_count INTEGER,
    created_at TIMESTAMP,
    updated_at TIMESTAMP,
    CONSTRAINT purchase_transaction_FK_1 FOREIGN KEY (purchase_id) REFERENCES purchase (id)
);

DROP TABLE purchase_transaction_log;
DROP SEQUENCE purchase_transaction_log_seq;