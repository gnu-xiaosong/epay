<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>正在为您跳转到支付页面，请稍候...</title>
</head>
<?php
/* *
 * 功能：iapp支付整合易支付，表单集成开发支付，单页订单开发支付配置
 * 作者:小松
 * 时间:2020616
 * qq:1829134124
 * myBlog:www.xskj.store
 文档说明:
2.POST表单
$_POST['user_id']
$_POST['user_key']
POST所要请求的参数变量:!!!!!!!!!!!!!,表单集成开发关键
商户id:user_id
商户秘钥:user_key
iapp秘钥:user_iappkey
商户订单号:iapp_trade_no
支付方式:type
商品名称:iapp_subject
付款金额:iapp_fee
用户成员表名:table_name
 */


 //这里利用三元运算符做一个弹性参数设置，当POST获取的参数为空时，可以在这里设置相应的参数，而不用去表单中填写
$user_id=empty($_POST['user_id'])           ?       '设置自己的user_id值'   :  $_POST['user_id'];       
$user_key=empty($_POST['user_key'])        ?      '设置成自己的key'        :  $_POST['user_key'];
$user_iappkey=empty($_POST['user_iappkey'])?      '设置自己对应的iappkey' :  $_POST['user_iappkey'];
$table_name=empty($_POST['table_name'])   ?      '设置表名'                :  $_POST['table_name'];
 //↑↑↑上面始终以POST获取的数据为优先等级  ？//这一列设置成自己的参数 : //这一列为POST获取的参数

//调用配置文件
require_once("set/epay_submit.class.php");
//调用数据库配置文件，同级目录调用，用于连接数据库时用
// require_once("config.php");
 
 
 //商户接口已集成↓↓↓↓↓
//商户ID
$alipay_config['partner']		=$user_id;

//商户KEY
$alipay_config['key']			=$user_key;
//商户接口已集成↑↑↑↑↑

//签名方式 不需修改
$alipay_config['sign_type']    = strtoupper('MD5');

//字符编码格式 目前支持 gbk 或 utf-8
$alipay_config['input_charset']= strtolower('utf-8');

//访问模式,根据自己的服务器是否支持ssl访问，若支持请选择https；若不支持请选择http
$alipay_config['transport']    = 'http';

//支付接口地址，这里可以修改成其他的接口↓↓↓-
$alipay_config['apiurl']   = "http://pay.xskj.store/";


 
/**************************请求参数设置**************************/
        $notify_url = ($_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://').$_SERVER['HTTP_HOST']."/iapppay/notify_url.php";
        //需http://格式的完整路径，不能加?id=123这类自定义参数

        //页面跳转同步通知页面路径
        $return_url = ($_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://').$_SERVER['HTTP_HOST']."/iapppay/return_url.php";
        //需http://格式的完整路径，不能加?id=123这类自定义参数，不能写成http://localhost/
        
        //商户订单号
        $out_trade_no = $_POST['iapp_trade_no'];
        //商户网站订单系统中唯一订单号，必填

//订单参数设置:

		//支付方式
        $type = $_POST['type'];
        //商品名称
        $name = $_POST['iapp_subject'];
		//付款金额
        $money = $_POST['iapp_fee'];
		//站点名称
        $sitename = '小松云支付系统';//这里设置成自己网站名称
      
/************************************************************/
//订单描述，构造要请求的参数数组，无需改动，关联数组
$parameter = array(
		"pid" => trim($alipay_config['partner']),
		"type" => $type,
		"notify_url"	=> $notify_url,
		"return_url"	=> $return_url,
		"out_trade_no"	=> $out_trade_no,
		"name"	=> $name,
		"money"	=> $money,
		"sitename"	=> $sitename
);



//建立支付请求
$alipaySubmit = new AlipaySubmit($alipay_config);
$html_text = $alipaySubmit->buildRequestForm($parameter);
echo $html_text;
//这里可以把订单信息写入数据库(根据自己的网站集成写入数据库，或者单独创建一个表用于存储订单信息，发送订单邮件，发送订单短信

?>
</body>
</html>