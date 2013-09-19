ALTER TABLE  `products` ADD  `supplierId` INT NOT NULL AFTER  `IsApprove`;

ALTER TABLE  `products` ADD  `Is_Obsolete` INT(2) NULL DEFAULT 0 AFTER  `supplierId`;
