<?php 


//$arrow_color=$arrow_color['arrow_color'];
echo
"<style> #parent {
	
	float: right;
height: 15px;
width: 10px;
cursor: pointer;
position: relative;
top: 2px;
}

#parent:before, #parent:after{content: '';
height: 2px;
width: 10px;
display: block;
background:";

$expand_color = get_option( 'widget_wc_category_accordion' );

foreach ( $expand_color as $expand_color ) {
   
   echo $expand_color['expand_color'];
}
echo ";
/* border-radius: 5px; */
/* -webkit-border-radius: 2px; */
-moz-border-radius: 5px;
position: absolute;
top: 8px;
left: 0px;}

#parent:after{height: 10px;
width: 2px;
top: 4px;
left: 4px; }
#outer_ul {
	padding-left:6px;
	width: auto;
}
#outer_ul li {
	margin: 0 0 0 3px;
	padding: 2px 2px 2px 12px;
	line-height: 25px;
		transition: all 200ms ease-in 0s;
	list-style-type:none;
	
	background:";
	$accordion_bg = get_option( 'widget_wc_category_accordion' );

foreach ( $accordion_bg as $accordion_bg ) {
   
   echo $accordion_bg['accordion_bg'];
}
echo "
}

#outer_ul li:before{content: '';
height: 0;
width: 0;
display: block;
border: 5px transparent solid;
border-right-width: 0;
border-left-color: ";

$arrow_color = get_option( 'widget_wc_category_accordion' );

foreach ( $arrow_color as $arrow_color ) {
   
   echo $arrow_color['arrow_color'];
}
echo "
;position: relative;
top: 7px;
left: -6px;
float: left;}



ul#outer_ul > li ul{margin-left:10px;}
#outer_ul li a {
	color:";
	
	$font_color = get_option( 'widget_wc_category_accordion' );

foreach ( $font_color as $font_color ) {
   
   echo $font_color['font_color'];
}
echo"
	;text-decoration:none;
	text-transform:capitalize;
	display:inline !important;
	
	font-size:";
	
	$font_size = get_option( 'widget_wc_category_accordion' );

foreach ( $font_size as $font_size ) {
   
   echo $font_size['font_size']."px;}";
}
	

echo "
#outer_ul li a :after{content: '';
height: 0;
width: 0;
display: block;
border: 4px transparent solid;
border-right-width: 0;
border-left-color: #333;
position: relative;
float: left;
top: 9px;
left: -5px;


}
#outer_ul li > ul > li {
	border-bottom: 1px solid #EEEEEE;
	
}
#outer_ul li > ul:lastchild > li {
border:none;
}
ul#outer_ul > li {
	border-bottom:";
	
	$border_size = get_option( 'widget_wc_category_accordion' );

foreach ( $border_size as $border_size ) {
   
   echo $border_size['border_size'];
}
	
	
	echo "px solid";
	
	$border_color = get_option( 'widget_wc_category_accordion' );

foreach ( $border_color as $border_color ) {
   
   echo $border_color['border_color'];
}
echo ";
}
ul#outer_ul li.current-cat > a {
	font-weight:bold;
}
ul#outer_ul li:first-child > a:first {
background:#F9F9F9;
font-weight: bold;
}
ul#outer_ul li.current-cat-parent a {
	color:#737373;
}
ul#outer_ul li > ul > li:last-child {
	border:none;
}
#parent.expanded:after{content:'';height: 2px;
position:relative;
width: 10px; display:block; background:#333; position:absolute; top:16px; left:0px; border-radius:10px;-webkit-border-radius:10px;-moz-border-radius:10px;
background: none;

}
</style>";
?>