

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"> 
<title>在线订单系统-小松云支付</title> 
</head>
<style>

input[type=text], select {
  width: 100%;
  padding: 12px 20px;
  margin: 30px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

input[type=submit] {
  width:100%;
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}
input[type=submit]:hover {
  background-color: #45a049;
}

div {
  margin:120px 50px;
  border-radius: 20px;
  background-color: #f2f2f2;
  padding: 20px;
}
</style>
<body>
<br>
<p align="center">在线支付订单系统</p>
<br>
<br>
<br>
<br>
<div>
  <form action="payapi.php" method="post">
    <label for="fname">商户ID</label>
    <input type="text" id="fname" name="user_id" value="">

    <label for="lname">商户秘钥</label>
    <input type="text" id="lname" name="user_key" value="">

    <label for="lname">订单编号</label>
    <input type="text" id="lname" name="iapp_trade_no" value="<?php echo date("YmdHis").mt_rand(100,999); ?>">


    <label for="lname">支付金额</label>
    <input type="text" id="lname" name="iapp_fee" value="">

     <label for="paytype">支付方式</label>
    <select id="pay" name="type">
      <option value="alipay">支付宝</option>
      <option value="qqpay">QQ</option>
      <option value="wxpay">微信</option>
    </select>


    <label for="shop">选择商品</label>
    <select id="shop" name="iapp_subject">
      <option value="商品1">商品1</option>
      <option value="商品2">商品2</option>
      <option value="商品3">商品3</option>
    </select>
  
    <input type="submit" value="确认支付">
  </form>
</div>

</body>
<footer>

<p align="center">更多详情欢迎访问:<a href="http://www.xskj.store">小松Blog</a>获取更多源码</p>
<p align="center">@2020小松云支付版权所有</p>

</footer>
</html>