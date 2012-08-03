CREATE SEQUENCE discount_coupon_seq;
CREATE TABLE discount_coupon (
    id INTEGER NOT NULL DEFAULT nextval('discount_coupon_seq'::regclass) PRIMARY KEY,
    coupon_code VARCHAR(16) UNIQUE,
    discount_rule VARCHAR(500),
    is_active BOOLEAN DEFAULT FALSE,
    has_used BOOLEAN DEFAULT FALSE,
	enabled BOOLEAN DEFAULT FALSE,
	visible BOOLEAN DEFAULT TRUE,
	locked BOOLEAN DEFAULT FALSE,
	deleted BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);

DELETE FROM discount_coupon;
INSERT INTO discount_coupon(coupon_code, discount_rule, is_active, enabled, visible, created_at, updated_at) VALUES
    ('ABC123', 'O:8:"stdClass":1:{s:15:"shippingPercent";i:50;}', true, true, true, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    ('AAA111', 'O:8:"stdClass":1:{s:13:"shippingValue";i:8;}', true, true, true, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    ('AAA222', 'O:8:"stdClass":1:{s:12:"orderPercent";i:10;}', true, true, true, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    ('AAA333', 'O:8:"stdClass":1:{s:10:"orderValue";i:10;}', true, true, true, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    ('AAA444', 'O:8:"stdClass":1:{s:10:"totalValue";i:20;}', true, true, true, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    ('AAA555', 'O:8:"stdClass":1:{s:12:"totalPercent";i:30;}', true, true, true, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP),
    ('AAA666', 'O:8:"stdClass":1:{s:18:"cheaperItemPercent";i:90;}', true, true, true, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
