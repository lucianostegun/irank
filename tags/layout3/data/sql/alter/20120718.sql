ALTER TABLE content_cqs ADD COLUMN cd_material_id VARCHAR(15);
ALTER TABLE content_cqs ADD COLUMN ds_xml_content TEXT;
ALTER TABLE content_cqs ADD COLUMN is_pending_view BOOLEAN;

INSERT INTO virtual_table VALUES(null, 'homeItem', 'Conteúdos com nova versão no CQS', null, 'cqsPendingView', true, true, true, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);

INSERT INTO tab_perm(module_id, cd_tag_name, ds_description, nr_order_seq, dt_created_at)
    VALUES(10, 'dtvStatus', 'Status DTV', 31, CURRENT_TIMESTAMP);