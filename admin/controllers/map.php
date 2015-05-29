<?php if ( ! defined('IN_DILICMS')) exit('No direct script access allowed');
 /**
 * DiliCMS
 *
 * 一款基于并面向CodeIgniter开发者的开源轻型后端内容管理系统.
 *
 * @package     DiliCMS
 * @author      DiliCMS Team
 * @copyright   Copyright (c) 2011 - 2012, DiliCMS Team.
 * @license     http://www.dilicms.com/license
 * @link        http://www.dilicms.com
 * @since       Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * DiliCMS 地图管理控制器
 *
 * @package     DiliCMS
 * @subpackage  Controllers
 * @category    Controllers
 * @author      Jeongee
 * @link        http://www.dilicms.com
 */
class Map extends Admin_Controller
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
		$this->_check_permit();
		$this->load->model('map_mdl');
		$this->load->helper('form');
        $this->acl->filter_left_menus('map',3);
	}
	
	// ------------------------------------------------------------------------
	
	/**
     * 默认入口
     *
     * @access  public
     * @param   int
     * @return  void
     */
	public function view()
	{
		$this->_template('map_manage');
	}
	
	/**
	 * 设置埋点信息
	 */
	public function _save_marker_post($add = 0){
		if($add)
		{
			$data['longitude'] = $_POST['longitude'];
			$data['latitude']  = $_POST['latitude'];
			$data['type_id']   = $_POST['packet_value'];
			$data['add_time']  = time();
			$this->map_mdl->InsertPacket($data);
			$this->_message('添加成功!', 'map/view', TRUE);
		}
		else {
			$point['lng'] = $_POST['longitude'];
			$point['lat'] = $_POST['latitude'];
			$data['point'] = $point;
			$result = $this->map_mdl->GetPacketType(array('level'=>0));
			$packet_type = array();
			foreach($result as $key=>$item)
			{
				$packet_type[$item->id] = $item->name;
			}
			$data['packet_type'] = $packet_type;
			$this->_template('map_marker',$data);
		}
	}
	
	/**
	 * 联动菜单ajax返回结果
	 */
	public function _packet_value_ajax_post()
	{
		$id = $_POST['id'];
		$result = $this->map_mdl->GetPacketType(array('parent_id'=>$id));
		echo json_encode($result);
		exit;
	}
	
	/**
	 * 使用AJAX异步加载地图中的marker
	 */
	public function _load_marker_ajax_post()
	{
		$center['lng'] = $_POST['lng'];
		$center['lat'] = $_POST['lat'];
		
		$min['lng'] = $center['lng'] - 0.4;
		$min['lat'] = $center['lat'] - 0.2;
		$max['lng'] = $center['lng'] + 0.4;
		$max['lat'] = $center['lat'] + 0.2;
		$result = $this->map_mdl->GetPacket($min,$max);
		if($result != false)
		{
			echo json_encode($result);
			exit;
		}
		else
		{
			echo false;
			exit;
		}
	}
}

/* End of file user.php */
/* Location: ./admin/controllers/user.php */