<script>
    //后端获取后进行cookie赋值
openid = getCookie('openid');

if (openid == null) {
    url = encodeURI(window.location.href);
    window.location.href =
    'https://open.weixin.qq.com/connect/oauth2/authorize?appid={$appid}&redirect_uri=' + url +
    '&response_type=code&scope=snsapi_userinfo&state={$state}&connect_redirect=1#wechat_redirect';
} else {
    //授权后可进行的代码
}

///获取cookie值
function getCookie(name) {
    var arr,
    reg = new RegExp('(^| )' + name + '=([^;]*)(;|$)');

    if (arr = document.cookie.match(reg)) {
    return unescape(arr[2]);
    } else {
    return null;
    }
}
</script>