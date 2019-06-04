<?php

#第一步 获取授权连接
$state = 'state';
$str = '';
$url = （'http://localhost/test/auth/login');
$callback = urlencode($url);

$forward = $oauth_account->getOauthUserInfoUrlNk($key,$callback, $state);
//进行页面授权跳转！获取code
//getOauthUserInfoUrlNk
//https://open.weixin.qq.com/connect/oauth2/authorize?appid={$key}&redirect_uri={$callback}&response_type=code&scope=snsapi_base&state={$state}#wechat_redirect
//var_dump($forward);
header('Location: ' . $forward);
#################
#
#第二步

//网页授权下的code才可以进行获取以下信息
//https://api.weixin.qq.com/sns/oauth2/access_token?appid={$this->account['key']}&secret={$this->account['secret']}&code={$code}&grant_type=authorization_code
//$oauth = $oauth_account->getOauthInfo($code);
if (!empty($_GET['code'])) {
	$code = $_GET['code'];
}
$url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid={$key}&secret={$secret}&code={$code}&grant_type=authorization_code";
$response = ihttp_request($url, $post);
$result = @json_decode($response['content'], true);
if(is_error($response)) {
	return error($result['errcode'], "访问公众平台接口失败, 错误详情: {$this->errorCode($result['errcode'])}");
}
if(empty($result)) {
	return error(-1, "接口调用失败, 元数据: {$response['meta']}");
} elseif(!empty($result['errcode'])) {
	return error($result['errcode'], "访问公众平台接口失败, 错误: {$result['errmsg']},错误详情：{$this->errorCode($result['errcode'])}");
}
return $result;
//return $response;

?>