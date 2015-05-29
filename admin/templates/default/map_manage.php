<?php if ( ! defined('IN_DILICMS')) exit('No direct script access allowed');?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
	<style type="text/css">
		body, html {width: 100%;height: 100%;margin:0;font-family:"微软雅黑";}
		#allmap{width:100%;height:500px;}
		p{margin-left:5px; font-size:14px;}
	</style>
	<script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=5mw9jkjaauO6wQPgGrYPwIZe"></script>
	<title>移动地图</title>
</head>
<body>
	<form action="<?php echo backend_url('map/save_marker'); ?>"  method="post" onsubmit = "return check_form();">
		<div id="allmap"></div>
		<div id="r-result">
			城市名: <input id="cityName" type="text" style="width:100px; margin-right:10px;" />
			<input type="button" value="查询" onclick="theLocation()" />
		</div>
		
		<div id="r-result">请输入:<input type="text" id="suggestId" size="20" value="百度" style="width:150px;" /></div>
		<div id="searchResultPanel" style="border:1px solid #C0C0C0;width:150px;height:auto; display:none;"></div>
		<div>
			经度：<input id="longitude" name="longitude"/>
			纬度：<input id="latitude" name="latitude"/>
			<input type="submit" value="确认" />
		</div>
	</form>
</body>
</html>
<script type="text/javascript">
	// 百度地图API功能
	var map = new BMap.Map("allmap");
	map.enableScrollWheelZoom(true);      //开启鼠标滚轮缩放
	map.addControl(new BMap.MapTypeControl());   //添加地图类型控件

	var point = new BMap.Point(116.331398,39.897445);
	map.centerAndZoom(point,12);            //初始化定位

/*---------------------------------根据城市定位---------------------------------------*/
 
	function theLocation(){
		var city = document.getElementById("cityName").value;
		if(city != ""){
			map.centerAndZoom(city,12);      // 用城市名设置地图中心点
		}
	}
	
/*--------------------------------根据关键字定位-------------------------------------------*/
	
	// 百度地图API功能
	function G(id) {
		return document.getElementById(id);
	}
	var ac = new BMap.Autocomplete(    //建立一个自动完成的对象
			{"input" : "suggestId"
			,"location" : map
		});

	ac.addEventListener("onhighlight", function(e) {  //鼠标放在下拉列表上的事件
	var str = "";
		var _value = e.fromitem.value;
		var value = "";
		if (e.fromitem.index > -1) {
			value = _value.province +  _value.city +  _value.district +  _value.street +  _value.business;
		}    
		str = "FromItem<br />index = " + e.fromitem.index + "<br />value = " + value;
		
		value = "";
		if (e.toitem.index > -1) {
			_value = e.toitem.value;
			value = _value.province +  _value.city +  _value.district +  _value.street +  _value.business;
		}    
		str += "<br />ToItem<br />index = " + e.toitem.index + "<br />value = " + value;
		G("searchResultPanel").innerHTML = str;
	});

	var myValue;
	ac.addEventListener("onconfirm", function(e) {    //鼠标点击下拉列表后的事件
	var _value = e.item.value;
		myValue = _value.province +  _value.city +  _value.district +  _value.street +  _value.business;
		G("searchResultPanel").innerHTML ="onconfirm<br />index = " + e.item.index + "<br />myValue = " + myValue;
		
		setPlace();
	});

	function setPlace(){
		map.clearOverlays();    //清除地图上所有覆盖物
		function myFun(){
			var pp = local.getResults().getPoi(0).point;    //获取第一个智能搜索的结果
			map.centerAndZoom(pp, 18);
			map.addOverlay(new BMap.Marker(pp));    //添加标注
		}
		var local = new BMap.LocalSearch(map, { //智能搜索
		  onSearchComplete: myFun
		});
		local.search(myValue);
	}
	
/*----------------------------------捕获地图上的坐标----------------------------------*/
	
	//单击获取点击的经纬度
	map.addEventListener("click",function(e){
		document.getElementById('longitude').value = e.point.lng;    //得到当前点击的经度
		document.getElementById('latitude').value  = e.point.lat;    //得到当前点击的纬度
		deletePoint();
		point = new BMap.Point(e.point.lng,e.point.lat);
		var label = new BMap.Label("投放位置",{offset:new BMap.Size(20,-10)});
		addMarker(point,label);
	});


	// 编写自定义函数,创建标注
	function addMarker(point,label){
		var marker = new BMap.Marker(point);
		map.addOverlay(marker);
		marker.setLabel(label);
	}

	function deletePoint(){
		map.clearOverlays();           //删除所有遮盖物
		/*
		var allOverlay = map.getOverlays();
		for (var i = 0; i < allOverlay.length -1; i++){
			if(allOverlay[i].getLabel().content == "投放位置"){
				map.removeOverlay(allOverlay[i]);
				return false;
			}
		}*/
	}

	//提交表单前检查
	function check_form(){
		var lng = document.getElementById('longitude').value.trim();
		var lat = document.getElementById('latitude').value.trim();
		if(!(lng.length > 0 && lat.length > 0))
		{
			alert("请先选择一个点！");return false;
		}
	}
	
</script>
