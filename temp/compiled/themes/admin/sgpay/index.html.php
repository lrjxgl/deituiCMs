<!DOCTYPE html>
<html>
	<?php echo $this->fetch('head.html'); ?>
	<body class="bg-ef">
		<div id="App">
			<div class="tabs-border">
				<div class="f16">线下充值::</div>
				<div @click="setType('all')" :class="type=='all'?'active':''" class="item">全部</div>
				<div @click="setType('pass')" :class="type=='pass'?'active':''"  class="item">已通过</div>
				<div @click="setType('forbid')" :class="type=='forbid'?'active':''"  class="item">未通过</div>
			</div>
			<div class="main-body" >
				<div class="pd-5">总计充值成功：<?php echo $this->_var['total_money']; ?>元</div>
				<form class="search-form" method="get" action="/admin.php">
					<input type="hidden" name="m" value="sgpay" />
				 	
					ID:<input class="w100" type="text" name="id" v-model="id" value="" />
					状态：<select class="w100" v-model="type" name="type">
						<option value="all">请选择</option>
						<option value="confirm" >待审核</option>
						<option value="pass">支付成功</option>
						<option value="forbid">支付失败</option>
					</select>
					时间：从
					<input  class="w100" type="text" id="stime" name="stime" v-model="stime" /> 
					到
					<input  class="w100" type="text" id="etime" name="etime" v-model="etime" /> 
					<button type="button" @click="search" class="btn">搜索</button>
				</form>
				<div class="list">
					<div class="row-box mgb-5" v-for="(item,index) in list" :key="index">
						<div class="flex flex-ai-center mgb-5">
							<div class="cl2 mgr-10">{{item.nickname}}</div>
							<div class="cl-money mgr-5">￥{{item.money}}</div>
							
							<div class="flex-1"></div>
							<div class="cl-num">{{item.status_name}}</div>
						</div>
						<div class="flex mgb-5">
							
							<div class="cl2 mgr-10">{{item.yhk_user}}</div>
							<div class="cl2">{{item.yhk_num}}</div>
							<div class="flex-1"></div>
							<div>{{item.yhk_name}}</div>
						</div> 
						<div class="flex flex-ai-center">
							<div class="flex-1 cl3 f12">{{item.createtime}}</div>
							<div class="flex"  v-if="item.status==0" >
								<div @click="pass(item)" class="btn mgr-20">通过</div>
								<div @click="forbid(item)" class="btn mgr-20">不通过</div>
								<div @click="del(item)" class="btn">删除</div>
							</div>
						</div>
					</div>
				</div>
				<div class="loadMore" v-if="per_page>0" @click="getList()">加载更多</div>
			</div>
		</div>
		<?php echo $this->fetch('footer.html'); ?>
		<script src="/plugin/vue/vue.min.js"></script>
		<script src="<?php echo $this->_var['skins']; ?>sgpay/index.js?v3"></script>
		<script src="/plugin/laydate/laydate.js"></script>
		<script>
			laydate.render({
				elem:"#stime",
				type: 'date'
			})
			laydate.render({
				elem:"#etime",
				type: 'date'
			})
		</script>
	</body>
</html>
