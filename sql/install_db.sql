CREATE TABLE IF NOT EXISTS `vnt_sessions` (
	`session_id` VARCHAR(40) NOT NULL DEFAULT '0',
	`ip_address` VARCHAR(16) NOT NULL DEFAULT '0',
	`user_agent` VARCHAR(150) NOT NULL,
	`last_activity` INT(10) UNSIGNED NOT NULL DEFAULT '0',
	`user_data` TEXT NOT NULL,
	PRIMARY KEY (`session_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;





CREATE TABLE IF NOT EXISTS `vnt_users` (
	`id` BIGINT(20) NOT NULL AUTO_INCREMENT,
	`email` VARBINARY(255) NOT NULL,
	`password` VARBINARY(255) NOT NULL,
	`name` TEXT NOT NULL,
	`bio` LONGTEXT NOT NULL,
	`photo` TEXT NOT NULL,
	`photo_ext` TEXT NOT NULL,
	`role` ENUM('super','director','executive','manager','employee') NOT NULL DEFAULT 'super',
	`last_ip` VARCHAR(40) NOT NULL DEFAULT '0',
	`last_activity` INT(10) UNSIGNED NOT NULL DEFAULT '0',
	`last_login` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
	`last_logout` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
	`created` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
	`modified` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	`active` ENUM('true','false') NOT NULL DEFAULT 'false',
	PRIMARY KEY (`id`),
	UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;





CREATE TABLE IF NOT EXISTS `vnt_activities` (
	`activity_id` VARCHAR(40) NOT NULL DEFAULT '0',
	`user_id` BIGINT(20) NOT NULL,
	`type` VARCHAR(20) DEFAULT NULL,
	`time` INT(10) UNSIGNED NOT NULL DEFAULT '0',
	`data` TEXT NULL,
	PRIMARY KEY (`activity_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;





CREATE TABLE IF NOT EXISTS `vnt_projects` (
	`project_id` VARCHAR(40) NOT NULL DEFAULT '0',
	`name` TEXT NOT NULL,
	`code` VARCHAR(255) NOT NULL,
	`budget` VARCHAR(255) NOT NULL,
	
	`department_id` VARCHAR(10) NOT NULL,
	`client_id` VARCHAR(40) NOT NULL,
	`agency_id` VARCHAR(40) NOT NULL,
	`account_manager_id` VARCHAR(40) NOT NULL,
	
	`campaign_start` DATE NOT NULL DEFAULT '0000-00-00',
	`campaign_end` DATE NOT NULL DEFAULT '0000-00-00',
	
	`date_filed` DATE NOT NULL DEFAULT '0000-00-00',
	`date_closed` DATE NOT NULL DEFAULT '0000-00-00',
	
	`status` ENUM('Opportunity','Sent','For Revision','Positive Feedback','Waiting For Signed CE','Closed','Lost') NOT NULL DEFAULT 'Opportunity',
	
	`created` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
	`modified` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	PRIMARY KEY (`project_id`),
	UNIQUE KEY `code` (`code`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;




CREATE TABLE IF NOT EXISTS `vnt_cost_of_sales` (
	`cost_of_sale_id` VARCHAR(40) NOT NULL DEFAULT '0',
	`project_id` VARCHAR(40) NOT NULL DEFAULT '0',
	
	`type` ENUM('Display Media','Social Media','Production','Mobile','Digital OOH','Search','Manhours','Tools','Reserved') NOT NULL DEFAULT 'Display Media',
	`budget` VARCHAR(255) NOT NULL,
	
	`created` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
	`modified` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	PRIMARY KEY (`cost_of_sale_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;





CREATE TABLE IF NOT EXISTS `vnt_cost_of_sales_list` (
	`cost_of_sale_list_id` VARCHAR(40) NOT NULL DEFAULT '0',
	`cost_of_sale_id` VARCHAR(40) NOT NULL DEFAULT '0',
	`project_id` VARCHAR(40) NOT NULL DEFAULT '0',
	
	`name` TEXT NOT NULL,
	`budget` VARCHAR(255) NOT NULL,
	
	`created` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
	`modified` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	PRIMARY KEY (`cost_of_sale_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;





CREATE TABLE IF NOT EXISTS `vnt_agencies` (
	`agency_id` VARCHAR(40) NOT NULL DEFAULT '0',
	`name` TEXT NOT NULL,
	`created` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
	`modified` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	`active` ENUM('true','false') NOT NULL DEFAULT 'true',
	PRIMARY KEY (`agency_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;





CREATE TABLE IF NOT EXISTS `vnt_account_managers` (
	`account_manager_id` VARCHAR(40) NOT NULL DEFAULT '0',
	`name` TEXT NOT NULL,
	`department_id` VARCHAR(10) NOT NULL,
	`created` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
	`modified` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	`active` ENUM('true','false') NOT NULL DEFAULT 'true',
	PRIMARY KEY (`account_manager_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;