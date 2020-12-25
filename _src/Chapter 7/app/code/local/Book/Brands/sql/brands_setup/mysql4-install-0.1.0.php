<?php
$installer = $this;
$installer->startSetup();
$installer->run("
DROP TABLE IF EXISTS {$this->getTable('brands')};
CREATE TABLE {$this->getTable('brands')} (
`brands_id` int(11) unsigned NOT NULL auto_increment,
`brand_name` varchar(255) NOT NULL default '',
`brand_description` text NOT NULL default '',
`brand_location` varchar(255) NOT NULL default '',
`status` smallint(6) NOT NULL default '0',
`created_time` datetime NULL,
`update_time` datetime NULL,
PRIMARY KEY (`brands_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
");
$installer->endSetup();