ALTER TABLE  `farmer_bills` ADD  `payed_to` VARCHAR( 255 ) NULL DEFAULT NULL COMMENT 'stores whom the amount is paid to' AFTER  `payed_on`