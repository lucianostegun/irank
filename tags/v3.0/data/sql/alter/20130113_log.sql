CREATE TABLE navigation_log (
    access_date TIMESTAMP,
    app_name VARCHAR(16),
    module_name VARCHAR(64),
    action_name VARCHAR(64),
    request_uri TEXT,
    ip_address INET,
    username VARCHAR(32),
    user_agent VARCHAR(250)
);

CREATE TABLE search_log (
    keywords VARCHAR(64),
    created_at TIMESTAMP
);