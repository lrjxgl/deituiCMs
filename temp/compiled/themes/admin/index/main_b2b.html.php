<!DOCTYPE html>
<html>
	<?php echo $this->fetch('head.html'); ?>
	<style>
		body{
			background-color: #efefef;
		}
		.w350{
			width: 350px;
		}
		.stBox{
			display: flex;
			flex-direction: row;
		 
			align-items: center;
			border: 1px solid #aaa;
			border-radius: 10px;
			margin-right: 5px;
			padding:5px 10px;
		}
		.stBox-label{
			font-size: 14px;
			color: #006699;
			margin-right: 10px;
		}
		.stBox-new{
			color: #F06060;
			text-align: center;
		}
		.stBox-all{
			color: #323232;
			text-align: center;
		}
	</style>
	<body>
		<div class="main-body ">
			<div class="flex" >
				<div class="flex-1 mgr-10">
					<div class="row-box mgb-5" id="stBoxApp">
						<div class="row-box-hd mgb-5">数据统计</div>
						<div class="flex">
							
							<div class="stBox">
								<div class="stBox-label">订单总额</div>
								<div class="flex-1">
								
									<div class="stBox-new">￥{{data.order_money}}</div>
								</div>
							</div>
							<div class="stBox">
								<div class="stBox-label">会员总数</div>
								<div class="flex-1">
									<div class="stBox-new">{{data.user_num}}</div>
									 
								</div>
							</div>
							<div class="stBox">
								<div class="stBox-label">店铺总数</div>
								<div class="flex-1">
									<div class="stBox-new">{{data.shop_num}}</div>
									 
								</div>
							</div>
							<div class="stBox">
								<div class="stBox-label">商品总数</div>
								<div class="flex-1">
									<div class="stBox-new">{{data.product_num}}</div>
									 
								</div>
							</div>
							 
							<div class="stBox">
								<div class="stBox-label">支付金额</div>
								<div class="flex-1">
									<div class="stBox-new">￥{{data.pay_money}}</div>
									 
								</div>
							</div> 
							 
						</div>
					</div>
					<div class="row-box">
						<div class="row-box-hd mgb-5">七天数据</div>
						<div class="flex">
							<div id="pv" style="flex:1;margin-right:5px;height:400px;"></div>
							<div id="userStat" style="flex:1;margin-right:5px;height:400px;"></div>
							<div id="moneyStat" style="flex:1;height:400px;"></div>
						</div>
					</div>
				</div>
				<div class="w350">
					<div class="row-box mgb-10">
						<div class="row-box-hd mgb-5">软件信息</div>
						<div>
							<div class="mgb-10">当前版本：<?php echo $this->_var['version']['version']; ?> V<?php echo $this->_var['version']['version_num']; ?> </div>
							<div class="mgb-5 flex">最新版本：<?php echo $this->_var['version']['version']; ?> 
								<div id="newVersion"></div> 
							</div>
							<div id="newVersion-desc" class="mgb-10 cl2"></div>
							<div class="mgb-10">
								<?php echo $this->_var['version']['description']; ?>
							</div>
							<div id="sqRes" class="cl2 mgb-5"></div>
							<div>
								
								<div class="btn" id="update-btn" style="display: none;">在线更新</div>
							</div>
						</div>
					</div>
					<div class="row-box">
						<div class="row-box-hd mgb-5">软件服务</div>
						<div>
							<div class="mgb-10">官网：<a href="http://www.deituicms.com" target="_blank">http://www.deituicms.com</a></div>
							<div class="mgb-10">QQ群：48353999</div>
							<div class="mgb-10">QQ：362606856</div>
							<div class="mgb-10">电话：15985840591</div>
							<div class="mgb-10">购买商业授权可以提供更多服务</div>
						</div>
					</div>
				</div>
			</div>
			
		</div>
		<?php echo $this->fetch('footer.html'); ?>
		<script src="/plugin/vue/vue.min.js"></script>
		<script src="/plugin/echarts/echarts.common.min.js"></script>
		<script src="<?php echo $this->_var['skins']; ?>index/version.js"></script>
		<script src="<?php echo $this->_var['skins']; ?>index/main.js"></script>
		
		<script>
			new Vue({
				el:"#stBoxApp",
				data:function(){
					return {
						data:{}
					}
				},
				created:function(){
					var that=this;
					$.ajax({
						url:"/moduleadmin.php?m=b2b_stat&a=adminIndexStat&ajax=1",
						dataType:"json",
						success:function(res){
							if(res.error){
								return false;
							}
							that.data=res.data;
							
						}
					})
				}
			})
			
		</script> 
	</body>
</html>