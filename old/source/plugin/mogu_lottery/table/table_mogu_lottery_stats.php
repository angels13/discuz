<?php
if (!defined('IN_DISCUZ')) {
    exit('Aecsse Denied');
}

class table_mogu_lottery_stats extends discuz_table {
    public function __construct() {
        $this->_table = 'mogu_lottery_stats';
        $this->_pk = 'sid';
        $this->_pre_cache_key = 'mogu_lottery_stats_';
        //$this->_cache_ttl = 10;
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
		
	public function count_by_search($conditions=array()) {
		$joinarr = " `".DB::table('mogu_lottery_stats')."` t ";
		$joinarr .= " LEFT JOIN `".DB::table('mogu_lottery_user')."` t1 ON t1.yid=t.yid ";
		return DB::result_first("SELECT COUNT(*) FROM $joinarr %i", array($this->search_condition($conditions,'t.')));
	}
			
	public function fetch_all_by_search($conditions=array(), $start = 0, $limit = 25, $order='', $sort = 'DESC') {
		$_order = !empty($order) ? 'ORDER BY '.$order.' '.$sort : '';
		$data = array();
		$joinarr = " `".DB::table('mogu_lottery_stats')."` t ";
		$joinarr .= " LEFT JOIN `".DB::table('mogu_lottery_user')."` t1 ON t1.yid=t.yid ";
		$joinarr .= " LEFT JOIN `".DB::table('common_member')."` t2 ON t2.uid=t1.uid ";
		$joinarr .= " LEFT JOIN `".DB::table('mogu_lottery_goods')."` t3 ON t3.pid=t.pid ";
		$data = DB::fetch_all("SELECT t.*,t1.ip,t1.nickname,t2.username,t3.name,t3.type,t3.pic,t3.introduce FROM $joinarr %i ".$_order.DB::limit($start, $limit),array($this->search_condition($conditions,'t.')));
		return $data;
	}
	
	public function delete_by_actid($actid) {
		if($actid){
		   return DB::query('DELETE FROM %t WHERE actid=%d ', array($this->_table,$actid));
		}
	}
	
}
?>