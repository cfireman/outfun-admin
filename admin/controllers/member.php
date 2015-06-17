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
		$this->load->model('member_mdl');
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
		$param = array();
		$param['size'] = 2;
		
		$list = $this->member_mdl->getList($param);
		$res = $list->body;
		$data['list'] = $res->list;
		$data['pagination'] = $res->pagination;
		//加载分页
		$this->load->library('pagination');
		$config['base_url'] = backend_url('member/view') . '?dilicms';
		$config['per_page'] = $data['pagination']->size;
		$config['page_query_string'] = TRUE;
		$config['query_string_segment'] = 'page';
		$config['total_rows'] = $data['pagination']->total;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$this->_template('member_list',$data);
	}
	
	//添加新用户
	public function add()
	{
		echo 1;die;
	}
	
	//修改用户
	public function edit(){
		echo 2;die;
	}
	
	//删除用户
	public function del()
	{
		echo 3;die;
	}
}