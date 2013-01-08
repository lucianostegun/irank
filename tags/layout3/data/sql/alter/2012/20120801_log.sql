ALTER TABLE purchase_status_log ADD COLUMN order_status VARCHAR(20);

SELECT DISTINCT transaction_status FROM purchase_status_log where order_status is null;
UPDATE purchase_status_log SET order_status = 'complete' WHERE transaction_status = 'complete'