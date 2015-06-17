<?php

class Member_mdl extends CI_Model
{
	private $curl = '';
	
	/**
	 * 构造函数
	 *
	 * @access  public
	 * @return  void
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('curl');
	}
	
	/**
	 * 返回会员列表信息
	 * @param unknown $data
	 */
	public function getList($data = array()){
		$url = '/member/getList?sign=debugSign';
		$result = postData($url, $data);
		return json_decode($result);
	}
	
	
	/**
	 * 得到一条用户信息
	 * @param unknown $data
	 */
	public function getOne($data = array()){
		if(!isset($data['username']))
		{
			return 'username_empty';
		}
		
		$this->db->where($data);
		return $this->db->from($this->table_member)->get()->result();
	}
}