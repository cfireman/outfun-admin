<div class="headbar">
	<div class="position"><span>地图</span><span>></span><span>地图管理</span><span>></span><span>添加埋点</span></div>
</div>
<div class="content_box">
	<div class="content form_content">
		<form action="<?php echo backend_url('map/save_marker/1'); ?>"  method="post" onsubmit="return check_form()">
			<table class="form_table">
				<col width="150px" />
				<col />
				<tbody>
					<tr>
						<th>经度：</th>
						<td><input type="text" id="longitude" name="longitude" value="<?php echo $point['lng'];?>" readOnly="true"></td>
					</tr>
					<tr>
						<th>纬度：</th>
						<td><input type="text" id="latitude" name="latitude" value="<?php echo $point['lat'];?>" readOnly="true"></td>
					</tr>
					<tr>
						<th>物品种类：</th>
						<td><?php echo form_dropdown('packet_type', $packet_type, '0','onchange="select_type();"'); ?></td>
					</tr>
					
					<tr>
						<td></td><td><button class="submit" type="submit"><span>确 定</span></button></td>
					</tr>
				</tbody>
			</table>
		</form>
	</div>
</div>


<script>
var host = '<?php echo backend_url(); ?>';

	function select_type()
	{
	    var sel_val = $('select[name=packet_type]').val();
	    $('#packet_value').remove();
	    $.ajax({
            type: "POST",
            url: host+'map/packet_value_ajax',
            //data: token_hash+"&category_id="+sel_val,
            data: "id="+sel_val,
            success: function(data){
                var newData = eval('('+data+')');
                var str = '<span id="packet_value"><select name="packet_value"><option selected="0">请选择</option>';
                for (i in newData){
                    str += '<option value='+newData[i]['id']+'>'+newData[i]['name']+'</option>';
                }
                str += '</select></span>';
                $('select[name=packet_type]').after(str);
            }
        });
	}

	//提交表单前的检查
	function check_form()
	{
		var sel_val = $('select[name=packet_value]').val();
		if(isNaN(sel_val))
		{
			alert('请选择物品种类');return false;
		}
	}
</script>