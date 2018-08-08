<?php
if (!defined('IN_DISCUZ')) {
    exit('Aecsse Denied');
}

class table_mogu_lottery_goods extends discuz_table {
    public function __construct() {
        $this->_table = 'mogu_lottery_goods';
        $this->_pk = 'pid';
        $this->_pre_cache_key = 'mogu_lottery_goods_';
        //$this->_cache_ttl = 5;
        parent::__construct();
    }
	
	public function search_condition($conditions,$t='') {
		foreach ($conditions as $field => $val){
			$val[1] = !$val[1] ? '=' : $val[1] ;
			$wherearr[] = $t.DB::field($field, $val[0],$val[1]);
		}
		$wheresql = !empty($wherearr) && is_array($wherearr) ? ' WHERE '.implode(' AND ', $wherearr) : '';
		return $wheresql;	
	}
	
	public function fetch_all_by_actid($actid) {
		return DB::fetch_all("SELECT * FROM %t WHERE actid=%d ",array($this->_table,$actid));
	}
	

	public function delete_by_actid($actid) {
		if($actid){
		   return DB::query('DELETE FROM %t WHERE actid=%d ', array($this->_table,$actid));
		}
	}
	
	public function count_by_search($conditions=array()) {
		return DB::result_first("SELECT COUNT(*) FROM %t %i", array($this->_table, $this->search_condition($conditions)));
	}
			
	public function fetch_all_by_search($conditions=array(), $start = 0, $limit = 25, $order='', $sort = 'DESC') {
		$_order = !empty($order) ? 'ORDER BY '.DB::order($order, $sort) : '';
		$data = DB::fetch_all("SELECT * FROM %t %i ".$_order.DB::limit($start, $limit),array($this->_table, $this->search_condition($conditions)));
		return $data;
	}
	
	
}
?>