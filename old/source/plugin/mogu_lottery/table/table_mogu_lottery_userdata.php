<?php

if (!defined('IN_DISCUZ')) {
    exit('Aecsse Denied');
}

class table_mogu_lottery_userdata extends discuz_table {
    public function __construct() {
        $this->_table = 'mogu_lottery_userdata';
        $this->_pk = 'yid';
        $this->_pre_cache_key = 'mogu_lottery_userdata_';
        //$this->_cache_ttl = 10;
        parent::__construct();
    }
			


	
	
}
?>
