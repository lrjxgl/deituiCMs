<!DOCTYPE html>
<html>
	<?php echo $this->fetch('head.html'); ?>
	<body>
		<div class="header">
			<div class="header-back"></div>
			<div class="header-title">我的优惠券</div>
		</div>
		<div class="header-row"></div>
		<div class="main-body" id="App">
			<div class="list">
				
				<div v-if="listNum==0" class="emptyData">暂无优惠券</div>
				 
				<div class="row-box mgb-5" v-for="(item,index) in pageData.list" :key="index">
					<div class="flex mgb-5">
						<div class=" mgb-5">
							{{item.title}}
						</div>
						<div class="flex-1"></div>
						<div class="cl-primary" v-if="item.status==1">已使用</div>
						<div class="cl-primary"  v-else>未使用</div>
					</div>
					<div class="flex">					 
						<div class="cl2 f12">截止时间：{{item.end_time}}</div>
						<div class="flex-1"></div>
						<div class="cl2 f12 mgb-5">
							金额 {{item.money}}元						
						</div>
					</div>
					 
				</div>
			</div>
		</div>	
		<?php echo $this->fetch('footer.html'); ?>
		<script src="<?php echo $this->_var['skins']; ?>coupon_user/index.js"></script>
	</body>
</html>
