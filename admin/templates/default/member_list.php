<?php if ( ! defined('IN_DILICMS')) exit('No direct script access allowed');?>
<div class="headbar">
	<div class="position"><span>会员</span><span>></span><span>会员管理</span><span>></span><span>会员列表</span></div>
	<div class="operating">
		<a class="hack_ie" href="<?php echo backend_url('member/add'); ?>"><button class="operating_btn" type="button"><span class="addition">添加新用户</span></button></a>
        <div class="search f_r">
		<form name="serachuser" action="<?php echo backend_url('user/view'); ?>" method="get">
			<select class="normal" style="width:auto" name="role" onchange="location='<?php echo backend_url('user/view'); ?>/'+this.value;">
				<option value="">选择用户组</option>
				<?php foreach($roles as $k=>$r): ?>
                <option <?php echo $role == $k ? 'selected="selected"' : '' ?> value="<?php echo $k; ?>"><?php echo $r; ?></option>
                <?php endforeach; ?>
			</select>
		</form>
		</div>
	</div>
	<div class="field">
		<table class="list_table">
			<col width="40px" />
			<col />
			<thead>
				<tr>
                	<th></th>
					<th>id</th>
                    <th>用户名</th>
                    <th>邮箱</th>
                    <th>手机号码</th>
                    <th>注册省</th>
                    <th>注册市</th>
                    <th>注册来源</th>
                    <th>注册时间</th>
                    <th>是否删除</th>
                    <th>操作</th>
				</tr>
			</thead>
		</table>
	</div>
</div>

<div class="content">
		<table id="list_table" class="list_table">
			<col width="40px" />
			<col />
			<tbody>
            <?php foreach($list as $v) : ?>
            	<tr>
                	<td></td>
                	<td><?php echo $v->id; ?></td>
                	<td><?php echo $v->username; ?></td>
                    <td><?php echo $v->email; ?></td>
                    <td><?php echo $v->phone; ?></td>
                    <td><?php echo $v->reg_province; ?></td>
                    <td><?php echo $v->reg_city; ?></td>
                    <td><?php echo $v->source; ?></td>
                    <td><?php echo date('Y-m-d H:i:s',$v->add_time); ?></td>
                    <td><?php echo $v->is_delete == 1 ? '是' : '否'; ?></td>
                    <td>
                    	<a href="<?php echo backend_url('member/edit/'.$v->id); ?>"><img class="operator" src="images/icon_edit.gif" alt="修改" title="修改"></a>
                        <a class="confirm_delete" href="<?php echo backend_url('member/del/'.$v->id); ?>"><img class="operator" src="images/icon_del.gif" alt="删除" title="删除"></a>
                    </td>
                </tr>
            <?php endforeach; ?>
			</tbody>
		</table>
</div>
<div class="pages_bar pagination"><?php echo $pagination; ?></div>
<script language="javascript">
	$('a.confirm_delete').click(function(){
		return confirm('是否要删除所选用户？');	
	});
</script>