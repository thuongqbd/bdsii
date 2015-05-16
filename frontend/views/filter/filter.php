<?php
use yii\widgets\ListView;
?>
<div class="productlist">
	<div class="box news">
		<div class="font-roboto" style="border-top: 1px solid #dff2f6">
			<div class="bg_white clearfix bor-bot " style="border-top: 1px solid #0098bb">
				<div class="fl">
					<h1 class="font15 lblcate">
						Nhà đất bán tại Chung cư 10A Trần Nhật Duật
					</h1>
				</div>
				<div class="fr wr_order">
<!--					<div class="lblorder">Sắp xếp theo:</div>
					<select name="ctl00$PH_Container$ProductSearchResult$ddlOrder" onchange="sortchange();setTimeout(&#39;__doPostBack(\&#39;ctl00$PH_Container$ProductSearchResult$ddlOrder\&#39;,\&#39;\&#39;)&#39;, 0)" id="ddlOrder" sb="17904159" style="display: none;">
						<option selected="selected" value="0">Thông thường</option>
						<option value="2">Giá thấp nhất</option>
						<option value="3">Giá cao nhất</option>
						<option value="4">Diện tích nhỏ nhất</option>
						<option value="5">Diện tích lớn nhất</option>
					</select>
					<div id="sbHolder_17904159" class="sbHolder" tabindex="0">
						<a id="sbToggle_17904159" href="http://dothidiaoc.com/nha-dat-ban-chung-cu-10a-tran-nhat-duat.htm#" class="sbToggle"></a><a id="sbSelector_17904159" href="http://dothidiaoc.com/nha-dat-ban-chung-cu-10a-tran-nhat-duat.htm#" class="sbSelector">Thông thường</a>
						<ul id="sbOptions_17904159" class="sbOptions" style="display: none;">
							<li><a href="http://dothidiaoc.com/nha-dat-ban-chung-cu-10a-tran-nhat-duat.htm#0" rel="0" class="sbFocus">Thông thường</a></li>
							<li><a href="http://dothidiaoc.com/nha-dat-ban-chung-cu-10a-tran-nhat-duat.htm#2" rel="2">Giá thấp nhất</a></li>
							<li><a href="http://dothidiaoc.com/nha-dat-ban-chung-cu-10a-tran-nhat-duat.htm#3" rel="3">Giá cao nhất</a></li>
							<li><a href="http://dothidiaoc.com/nha-dat-ban-chung-cu-10a-tran-nhat-duat.htm#4" rel="4">Diện tích nhỏ nhất</a></li>
							<li><a href="http://dothidiaoc.com/nha-dat-ban-chung-cu-10a-tran-nhat-duat.htm#5" rel="5">Diện tích lớn nhất</a></li>
						</ul>
					</div>-->
				</div>
			</div>
		</div>
		<h3 class="box-result">
			Tìm kiếm theo các tiêu chí: Tỉnh/Tp:  <span class="label">Hồ Chí Minh</span>. Quận/Huyện:  <span class="label">Quận 1</span>. Dự án:  <span class="label">Chung cư 10A Trần Nhật Duật</span>. 
			<span class="spancount">Có <b>
			16</b> bất động sản.</span>
		</h3>
		<div class="box-cont">
			<ul class="clearfix">
				<?php 
				echo ListView::widget([
					'dataProvider' => $dataProvider,
					'itemView' => '_item',
				]);?>
			</ul>
		</div>
	</div>
	<div class="box page page_controll nobor position tc">
		<span id="PH_Container_ProductSearchResult_ProductsPager"></span>
	</div>
</div>
							

