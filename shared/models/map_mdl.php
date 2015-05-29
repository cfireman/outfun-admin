<?php

class Map_mdl extends CI_Model
{
	
	/**
	 * 构造函数
	 *
	 * @access  public
	 * @return  void
	 */
	public function __construct()
	{
		parent::__construct();
        $this->table_packettype = $this->db->dbprefix('packet_type');
        $this->table_packet = $this->db->dbprefix('packet');
	}
	
	/**
	 * 获得所有道具类型
	 *
	 * @access  public
	 * @return  object
	 */
	public function GetPacketType($param = '', $limit = 0, $offset = 0, $group_by = '')
	{
		if($param)
			$this->db->where($param);
		if($limit)
			$this->db->limit($limit);
		if($offset)
			$this->db->offset($offset);
		if($group_by)
			$this->db->group_by($group_by);
		return $this->db->from($this->table_packettype)->get()->result();
	}
	
	/**
	 * 插入红包数据
	 */
	public function InsertPacket($data = array())
	{
		return $this->db->insert($this->table_packet, $data); 
	}
	
}