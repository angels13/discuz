<?php
if (!defined('IN_DISCUZ')) {
    exit('Aecsse Denied');
}

class table_mogu_lottery_hasuse extends discuz_table {
    public function __construct() {
        $this->_table = 'mogu_lottery_hasuse';
        $this->_pk = 'hid';
        $this->_pre_cache_key = 'mogu_lottery_hasuse_';
        //$this->_cache_ttl = 10;
        parent::__construct();
    }
			
	public function fetch_by_yid($yid, $actid) {
		return DB::fetch_first("SELECT * FROM %t WHERE yid=%d AND actid=%d ",array($this->_table, $yid, $actid));
	}
	
	public function delete_by_actid($actid) {
	if($actid){
	   return DB::query('DELETE FROM %t WHERE actid=%d ', array($this->_table,$actid));
	}
}
	
}
?>
