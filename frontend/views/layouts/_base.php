<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;

/* @var $this \yii\web\View */
/* @var $content string */

\frontend\assets\FrontendAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
	<meta http-equiv="Content-Type" content="text/html; charset=<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <?= Html::csrfMetaTags() ?>
</head>
<body>

<?php $this->beginBody() ?>
	<div id="contentPanel">
		<div id="top_bar" class="bg_white">
			<div class="main">
				<div class="box-tagein cl5">
					<ul class="clearfix">
						<li><a href="http://dothidiaoc.com/dang-tin-ban-cho-thue-nha-dat.htm" class="bold white"><s class="ic-newsup fl mt3 mr5"></s>Đăng tin</a></li>
						<li><a class="dangnhap " href="http://dothidiaoc.com/dang-nhap.htm" rel="nofollow"><s class="ic-login fl mt3 mr5"></s>Đăng nhập</a></li>
						<li><a class="dangky " href="http://dothidiaoc.com/dang-ky.htm" rel="nofollow"><s class="ic-register fl mt3 mr5"></s>Đăng ký</a></li>
					</ul>
				</div>
			</div>
		</div>		
		<div id="header" class="bg_white">
			<div class="main pt10 pb10 clearfix">
				<h1 class="logo">
					<a href="./dothidiaoc.com_files/dothidiaoc.com.html">
					<img src="images/logo.png" alt="dothidiaoc.com"></a>
				</h1>
				<div id="banner_top" class="banner w-650 fr"><a href="http://vpbank.com.vn/" rel="nofollow" target="_blank"><img src="images/vpbank.png"></a></div>
			</div>
		</div>
		<div id="menu">
			<div class="main clearfix">
				<ul class="clearfix font-roboto navigation">
					<li class="home bg-orange"><a href="./dothidiaoc.com_files/dothidiaoc.com.html" title="Trang chủ"><s class="ic-homes"></s></a></li>
					<li>
						<a href="http://dothidiaoc.com/nha-dat-ban.htm" title="BĐS bán">BĐS bán</a>
						<ul class="sub clearfix">
							<li><a href="http://dothidiaoc.com/ban-can-ho-chung-cu.htm" title="Bán căn hộ chung cư">Bán căn hộ chung cư</a></li>
							<li><a href="http://dothidiaoc.com/ban-nha-dat.htm" title="Tất cả các loại nhà bán"><b>Tất cả các loại nhà bán</b></a></li>
							<li><a class="sub2" href="http://dothidiaoc.com/ban-nha-rieng.htm" title="Bán nhà riêng">Bán nhà riêng</a></li>
							<li><a class="sub2" href="http://dothidiaoc.com/ban-nha-biet-thu-lien-ke.htm" title="Bán nhà biệt thự, liền kề">Bán nhà biệt thự, liền kề</a></li>
							<li><a class="sub2" href="http://dothidiaoc.com/ban-nha-mat-pho.htm" title="Bán nhà mặt phố">Bán nhà mặt phố</a></li>
							<li><a href="http://dothidiaoc.com/ban-dat-dat-nen.htm" title="Tất cả các loại đất bán"><b>Tất cả các loại đất bán</b></a></li>
							<li><a class="sub2" href="http://dothidiaoc.com/ban-dat-nen-du-an.htm" title="Bán đất nền dự án">Bán đất nền dự án</a></li>
							<li><a class="sub2" href="http://dothidiaoc.com/ban-dat.htm" title="Bán đất">Bán đất</a></li>
							<li><a href="http://dothidiaoc.com/ban-trang-trai-khu-nghi-duong.htm" title="Bán trang trại, khu nghỉ dưỡng">Bán trang trại, khu nghỉ dưỡng</a></li>
							<li><a href="http://dothidiaoc.com/ban-kho-nha-xuong.htm" title="Bán kho, nhà xưởng">Bán kho, nhà xưởng</a></li>
							<li class="last"><a href="http://dothidiaoc.com/ban-loai-bat-dong-san-khac.htm" title="Bán loại bất động sản khác">Bán loại bất động sản khác</a></li>
						</ul>
					</li>
					<li>
						<a href="http://dothidiaoc.com/nha-dat-cho-thue.htm" title="BĐS cho thuê">BĐS cho thuê</a>
						<ul class="sub clearfix">
							<li><a href="http://dothidiaoc.com/cho-thue-can-ho-chung-cu.htm" title="Cho thuê căn hộ chung cư">Cho thuê căn hộ chung cư</a></li>
							<li><a href="http://dothidiaoc.com/cho-thue-nha-rieng.htm" title="Cho thuê nhà riêng">Cho thuê nhà riêng</a></li>
							<li><a href="http://dothidiaoc.com/cho-thue-nha-mat-pho.htm" title="Cho thuê nhà mặt phố">Cho thuê nhà mặt phố</a></li>
							<li><a href="http://dothidiaoc.com/cho-thue-nha-tro-phong-tro.htm" title="Cho thuê nhà trọ, phòng trọ">Cho thuê nhà trọ, phòng trọ</a></li>
							<li><a href="http://dothidiaoc.com/cho-thue-van-phong.htm" title="Cho thuê văn phòng">Cho thuê văn phòng</a></li>
							<li><a href="http://dothidiaoc.com/cho-thue-cua-hang-ki-ot.htm" title="Cho thuê cửa hàng, ki ốt">Cho thuê cửa hàng, ki ốt</a></li>
							<li><a href="http://dothidiaoc.com/cho-thue-kho-nha-xuong-dat.htm" title="Cho thuê kho, nhà xưởng, đất">Cho thuê kho, nhà xưởng, đất</a></li>
							<li class="last"><a href="http://dothidiaoc.com/cho-thue-loai-bat-dong-san-khac.htm" title="Cho thuê loại bất động sản khác">Cho thuê loại bất động sản khác</a></li>
						</ul>
					</li>
					<li style="display: none;"><a href="http://dothidiaoc.com/#">Cần mua - cần thuê</a></li>
					<li>
						<a href="http://dothidiaoc.com/tin-tuc-su-kien.htm" title="Tin tức - Sự kiện">Tin tức - Sự kiện</a>
						<ul class="sub clearfix">
							<li><a href="http://dothidiaoc.com/thi-truong-du-an.htm" title="Thị trường - Dự án
								">Thị trường - Dự án
								</a>
							</li>
							<li><a href="http://dothidiaoc.com/chinh-sach-quy-hoach.htm" title="Chính sách - Quy hoạch
								">Chính sách - Quy hoạch
								</a>
							</li>
							<li><a href="http://dothidiaoc.com/tai-chinh-bds.htm" title="Tài chính BĐS
								">Tài chính BĐS
								</a>
							</li>
							<li><a href="http://dothidiaoc.com/tin-the-gioi.htm" title="Tin thế giới
								">Tin thế giới
								</a>
							</li>
						</ul>
					</li>
					<li>
						<a href="http://dothidiaoc.com/goc-kien-truc.htm" title="Góc kiến trúc">Góc kiến trúc</a>
						<ul class="sub clearfix">
							<li><a href="http://dothidiaoc.com/thiet-ke-xay-dung.htm" title="Thiết kế - Xây dựng
								">Thiết kế - Xây dựng
								</a>
							</li>
							<li><a href="http://dothidiaoc.com/kham-pha-kien-truc.htm" title="Khám phá kiến trúc
								">Khám phá kiến trúc
								</a>
							</li>
						</ul>
					</li>
					<li>
						<a href="http://dothidiaoc.com/nha-dep.htm" title="Nhà đẹp
							">Nhà đẹp
						</a>
						<ul class="sub clearfix">
							<li><a href="http://dothidiaoc.com/bai-tri-nha-cua.htm" title="Bài trí nhà cửa
								">Bài trí nhà cửa
								</a>
							</li>
							<li><a href="http://dothidiaoc.com/khong-gian-nha-dep.htm" title="Không gian nhà đẹp
								">Không gian nhà đẹp
								</a>
							</li>
						</ul>
					</li>
					<li><a href="http://dothidiaoc.com/phong-thuy-nha-o.htm" title="Phong thủy nhà ở
						">Phong thủy nhà ở
						</a>
					</li>
					<li>
						<a href="http://dothidiaoc.com/tu-van.htm" title="Tư vấn
							">Tư vấn
						</a>
						<ul class="sub clearfix">
							<li><a href="http://dothidiaoc.com/phap-ly-nha-dat.htm" title="Pháp lý nhà đất
								">Pháp lý nhà đất
								</a>
							</li>
							<li><a href="http://dothidiaoc.com/kinh-nghiem-mua-ban-bds.htm" title="Kinh nghiệm mua bán BĐS
								">Kinh nghiệm mua bán BĐS
								</a>
							</li>
						</ul>
					</li>
					<li>
						<a href="http://dothidiaoc.com/du-an.htm" title="Dự án">Dự án</a>
						<ul class="sub clearfix">
							<li><a href="http://dothidiaoc.com/khu-dan-cu-do-thi-moi.htm" title="Khu dân cư - Đô thị mới
								">Khu dân cư - Đô thị mới
								</a>
							</li>
							<li><a href="http://dothidiaoc.com/khu-phuc-hop.htm" title="Khu phức hợp
								">Khu phức hợp
								</a>
							</li>
							<li><a href="http://dothidiaoc.com/khu-du-lich-nghi-duong.htm" title="Khu du lịch - Nghỉ dưỡng">Khu du lịch - Nghỉ dưỡng</a></li>
							<li><a href="http://dothidiaoc.com/khu-cong-nghiep.htm" title="Khu công nghiệp">Khu công nghiệp</a></li>
							<li><a href="http://dothidiaoc.com/du-an-khac.htm" title="Dự án khác">Dự án khác</a></li>
						</ul>
					</li>
					<li><a href="http://dothidiaoc.com/san-giao-dich.htm" title="Sàn giao dịch">Sàn giao dịch</a></li>
				</ul>
			</div>
		</div>
		
		 <?= $content ?>
		<div id="menu-footer">
			<div class="main bg_white pl20 pr20 pt10 pb10">
				<ul class="navi-footer clearfix font-roboto">
					<li><a href="http://dothidiaoc.com/gioi-thieu.htm" rel="nofollow">Giới thiệu</a></li>
					<li><a href="http://dothidiaoc.com/quy-dinh.htm" rel="nofollow">Quy định</a></li>
					<li><a href="http://dothidiaoc.com/huong-dan.htm" rel="nofollow">Hướng dẫn sử dụng</a></li>
					<li class="last"><a href="http://dothidiaoc.com/lien-he.htm" rel="nofollow">Liên hệ</a></li>
				</ul>
			</div>
		</div>
			
		<div id="footer">
			<div class="main pt20 pb20 clearfix">
				<div class="w-40-100 fl">
					<label class="logo-footer mb10">
					<a href="./dothidiaoc.com_files/dothidiaoc.com.html" title="Đô thị địa ốc">
					<img src="images/logo-footer.png" alt="dothidiaoc.com"></a>
					</label>
					<h5 class="white font14 pt5">CÔNG TY CỔ PHẦN NHÀ ĐẤT TRƯỜNG PHÚC</h5>
					<label class="adress mt10 pt10 font13 bold">
					Địa chỉ: Phòng 101, Tầng 10, tòa nhà Viglacera, Mễ trì, 
					Từ liêm, Hà Nội - Hotline: 090-626-5502
					</label>
				</div>
				<div class="copyright w-60-100 fl pl20 mt40 pt20">
					<label class="mb5">
					Email: <a rel="nofollow" href="mailto:cskh@dothidiaoc.com?Subject=contact-dothidiaoc.com" target="_top">cskh@dothidiaoc.com
					</a>| Skype: <a rel="nofollow" href="skype:dothidiaoc.cskh?chat">dothidiaoc.cskh
					</a>| Yahoo: <a rel="nofollow" href="ymsgr:sendim?cskh_dothidiaoc">cskh_dothidiaoc
					</a>
					</label>
					<label class="mb5">Bản quyền ©2010 dothidiaoc.com. Website được vận hành bởi VCD Team</label>
					<label class="mb5">Website Dothidiaoc.com đã được bảo hộ độc quyền nhãn hiệu số 171/2011/QTG.</label>
					<label class="mb5">Giấy phép thiết lập Trang tin điện tử tổng hợp số 77/GP-ICP-STTT Cấp ngày 4 tháng 10 năm 2012.</label>
					<label class="mb5">
					<a target="_blank" href="http://infotivi.net/" title="Mua bán nhà đât">Mua bán nhà đất</a>
					<a href="http://dothidiaoc.com/cho-thue-nha-rieng.htm" title="Cho thuê nhà nguyên căn">Cho thuê nhà nguyên căn</a>
					<a target="_blank" href="http://banxehoi.com/ban-xe" title="Mua bán ô tô">Mua bán ô tô</a>
					<a target="_blank" href="http://banxehoi.com/danh-gia-xe" title="Đánh giá xe">Đánh giá xe</a>
					<a target="_blank" href="http://banxehoi.com/" title="Xe ô tô cũ">Xe ô tô cũ</a></label>
				</div>
			</div>
		</div>	
	</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
