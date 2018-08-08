<?php
if (!defined('IN_DISCUZ')) {
    exit('Aecsse Denied');
}

class table_mogu_lottery_activity extends discuz_table {
    public function __construct() {
        $this->_table = 'mogu_lottery_activity';
        $this->_pk = 'actid';
        $this->_pre_cache_key = 'mogu_lottery_activity_';
        //$this->_cache_ttl = 10;
        parent::__construct();
    }

	public function search_condition($conditions=array()) {
		foreach ($conditions as $field => $val){
			$val[1] = !$val[1] ? '=' : $val[1] ;
			$wherearr[] = DB::field($field, $val[0],$val[1]);
		}
		$wheresql = !empty($wherearr) && is_array($wherearr) ? ' WHERE '.implode(' AND ', $wherearr) : '';
		return $wheresql;	
	}
		
	public function count_by_search($conditions=array()) {
		return DB::result_first("SELECT COUNT(*) FROM %t %i", array($this->_table, $this->search_condition($conditions)));
	}
			
	public function fetch_all_by_search($conditions=array(), $start = 0, $limit = 25, $order='', $sort = 'DESC') {
		$_order = !empty($order) ? 'ORDER BY '.DB::order($order, $sort) : '';
		$data = array();
		$data = DB::fetch_all("SELECT * FROM %t %i ".$_order.DB::limit($start, $limit),array($this->_table,$this->search_condition($conditions)));
		return $data;
	}
	
	
}
?>
