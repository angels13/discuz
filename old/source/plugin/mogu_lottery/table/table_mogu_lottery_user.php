<?php

if (!defined('IN_DISCUZ')) {
    exit('Aecsse Denied');
}

class table_mogu_lottery_user extends discuz_table {
    public function __construct() {
        $this->_table = 'mogu_lottery_user';
        $this->_pk = 'yid';
        $this->_pre_cache_key = 'mogu_lottery_user_';
        //$this->_cache_ttl = 10;
        parent::__construct();
    }
			
	public function fetch_or_search($wherearr=array(), $fromarr=array(), $return=array()){
		if(!$wherearr) {
			$wherearr[] = '1';
		}
		if(!$return){
			$return[] = '*';
		}
		return DB::fetch_first("SELECT ".implode(',', $return)." FROM ".implode(' LEFT JOIN ', $fromarr)." WHERE ".implode(' OR ', $wherearr));
	}
	
	public function delete_by_actid($actid) {
	if($actid){
	   return DB::query('DELETE FROM %t WHERE actid=%d ', array($this->_table,$actid));
	}
}
	
}
?>
