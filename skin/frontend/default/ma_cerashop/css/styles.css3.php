<?php
    header('Content-type: text/css; charset: UTF-8');
    header('Cache-Control: must-revalidate');
    header('Expires: ' . gmdate('D, d M Y H:i:s', time() + 3600) . ' GMT');
    $url = $_REQUEST['url'];
?>
.product-view .product-img-box .more-views,
.banner-box-inner,
.block-ads-left,
.products-list .product-image,
.product-view .product-img-box .product-image,
.cart .crosssell,
.cart .discount, .cart .shipping,
.cart .totals
{
	-moz-box-shadow: 0 0 3px 0 #ccc;
	-webkit-box-shadow: 0 0 3px 0 #ccc;
	box-shadow: 0 0 3px 0 #ccc;
}

.pager .view-mode a.grid,
.pager .view-mode strong.grid,
.pager .view-mode a.grid:hover,
.pager .view-mode a.list,
.pager .view-mode strong.list,
.pager .view-mode a.list:hover,
.pager .sort-by select,
.pager .limiter select
{
 -moz-box-shadow: 0 0 3px #DDDDDD;
 -webkit-box-shadow: 0 0 3px #DDDDDD;
 box-shadow: 0 0 3px #DDDDDD;
}
.ma-featuredproductslider-container .flexslider .slides > li
{
	-moz-box-shadow: 0 5px 5px 0 #bbb;
	-webkit-box-shadow: 0 5px 5px 0 #bbb;
	box-shadow: 0 5px 5px 0 #bbb;
}
.ma-featuredproductslider-container .flexslider .slides > li:hover,
.products-grid .item:hover
{
	-moz-box-shadow: 0 0 5px 0 #bbb;
	-webkit-box-shadow: 0 0 5px 0 #bbb;
	box-shadow: 0 0 5px 0 #bbb;
}


.products-grid .actions .link-wishlist,
.products-grid .actions .link-compare,
.products-grid .actions .product-detail a,
.products-grid .item-inner:hover .actions,
.ma-newproductslider-container .flex-direction-nav a,
.ma-featured-vertscroller-wrap .jcarousel-next-vertical, 
.ma-featured-vertscroller-wrap  .jcarousel-prev-vertical,
.ma-thumbnail-container .flex-direction-nav a,
.ma-banner7-container .flex-control-paging li a,
#back-top,
.product-prev,
.product-next
{
	-webkit-transition: 0.5s;
	-moz-transition: 0.5s;
	transition: 0.5s;
}

button.button span
{
	-webkit-border-radius: 3px;
	-moz-border-radius: 3px;
	border-radius: 3px;
	behavior: url(<?php //echo $url; ?>css/css3.htc);
}
.products-list button.btn-cart span span,
.product-view button.btn-cart span span
{
	-webkit-border-radius: 0 3px 3px 0;
	-moz-border-radius: 0 3px 3px 0;
	border-radius: 0 3px 3px 0;
	behavior: url(<?php echo $url; ?>css/css3.htc);
}
.products-grid button.btn-cart span
{
	-webkit-border-radius: 0;
	-moz-border-radius: 0;
	border-radius: 0;
	behavior: url(<?php echo $url; ?>css/css3.htc);
}
.footer-social li,
.product-prev, .product-next,
{
	-webkit-border-radius: 15px;
	-moz-border-radius: 15px;
	border-radius: 15px;
	behavior: url(<?php echo $url; ?>css/css3.htc);
}
.header .form-search,
.header .form-search input.input-text,
.ma-footer-static1 .f-address-icon,
.ma-footer-static1 .f-email-icon,
.ma-footer-static1 .f-phone-icon
{
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	border-radius: 5px;
	behavior: url(<?php echo $url; ?>css/css3.htc);
}
.ma-featuredproductslider-container .flexslider .slides > li:hover,
.products-grid .item:hover,
.product-item-info {
	-webkit-border-radius: 0  0 5px 5px;
	-moz-border-radius: 0 0 5px 5px;
	border-radius: 0 0 5px 5px;
	behavior: url(<?php echo $url; ?>css/css3.htc);
}
.top-cart-inner {
    -webkit-border-radius: 5px 0  0 5px;
    -moz-border-radius: 5px 0 0 5px ;
    border-radius: 5px 0 0 5px ;
    behavior: url(<?php echo $url; ?>css/css3.htc);
}