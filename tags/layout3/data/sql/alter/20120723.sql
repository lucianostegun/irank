ALTER TABLE purchase ADD COLUMN pagseguro_url VARCHAR(200);

CREATE SEQUENCE purchase_transaction_seq;
CREATE TABLE purchase_transaction (
    id INTEGER NOT NULL DEFAULT nextval('purchase_transaction_seq'::regclass) PRIMARY KEY,
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