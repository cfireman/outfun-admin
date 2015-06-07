<?php if ( ! defined('IN_DILICMS')) exit('No direct script access allowed');
/**
 * DiliCMS 会员管理控制器
 *
 * @package     DiliCMS
 * @subpackage  Controllers
 * @category    Controllers
 * @author      Jeongee
 * @link        http://www.dilicms.com
 */
class Member extends Admin_Controller
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
        $this->acl->filter_left_menus('member',4);
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
		$this->_template('member_list');
	}
	
	
	
}