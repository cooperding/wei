<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
    <head>
        <title><?php echo ($title); ?></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1.0, user-scalable=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="keywords" content="<?php echo ($keywords); ?>" />
        <meta name="description" content="<?php echo ($description); ?>" />
        <link rel="stylesheet" type="text/css" href="/Public<?php echo ($style_common); ?>/v3.3.1/css/bootstrap.min.css"/>
        <link rel="stylesheet" type="text/css" href="/Public<?php echo ($style_common); ?>/css/alertify.css"/>
        <link rel="stylesheet" type="text/css" href="/Public<?php echo ($style_common); ?>/css/alertify.default.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo ($style); ?>/css/jquery.bxslider.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo ($style); ?>/css/common.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo ($style); ?>/css/style.css"/>
    </head>
    <body>
        <div class="dogo-page ">

            <header class="dogo-header">
                <div class="container dogo-wp">

                    <nav class="navbar dogo-navbar navbar-default" role="navigation">
                        <div class="navbar-header">
                            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-js-navbar-collapse">
                                <span class="sr-only"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand" href="<?php echo U('Home/Index/index');?>">唯爱记录</a>
                        </div>
                        <div class="collapse navbar-collapse bs-js-navbar-collapse">
                            <ul class="nav navbar-nav">
                                <?php if(is_array($navhead)): $i = 0; $__LIST__ = $navhead;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$navlist): $mod = ($i % 2 );++$i;?><li class="dropdown">
                                    <?php if($navlist["children"] == ''): ?><a id="" href="<?php echo ($navlist["url"]); ?>" role="button" class="dropdown-toggle" data-toggle=""><?php echo ($navlist["text"]); ?> </a>
                                        <?php else: ?>
                                        <a id="" href="<?php echo ($navlist["url"]); ?>" role="button" class="dropdown-toggle" data-toggle="dropdown"><?php echo ($navlist["text"]); ?> <b class="caret"></b></a><?php endif; ?>
                                    <ul class="dropdown-menu" role="menu" aria-labelledby="">
                                        <?php if(is_array($navlist["children"])): $i = 0; $__LIST__ = $navlist["children"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li role="presentation"><a role="menuitem" href="<?php echo ($vo["url"]); ?>"><?php echo ($vo["text"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
                                        <!--<li role="presentation" class="divider"></li>-->
                                    </ul>
                                    </li><?php endforeach; endif; else: echo "" ;endif; ?>
                            </ul>
                            <ul class="nav navbar-nav navbar-right">
                                <li id="fat-menu" class="dropdown">
                                    <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">会员中心<b class="caret"></b></a>
                                    <ul class="dropdown-menu" role="menu" aria-labelledby="drop3">
                                        <?php if(session('LOGIN_M_STATUS')=='TRUE'){ ?>
                                        <li><a role="menuitem" href="<?php echo U('User/Index/index');?>"> <span class="glyphicon glyphicon-home"></span> 我的主页</a></li>
                                        <li><a role="menuitem" href="<?php echo U('User/Index/changePwd');?>"> <span class="glyphicon glyphicon-edit"></span> 修改密码</a></li>
                                        <li class="divider"></li>
                                        <li><a role="menuitem" href="javascript:void(0)" class="dogo-click-logout"> <span class="glyphicon glyphicon-log-out"></span> 退出登录</a></li>
                                        <?php }else{ ?>
                                        <li><a role="menuitem" href="<?php echo U('User/Passport/login');?>" title="登录"> <span class="glyphicon glyphicon-log-in"></span> 登录</a></li>
                                        <li><a role="menuitem" href="<?php echo U('User/Passport/signup');?>" title="注册"><span class="glyphicon glyphicon-plus-sign"></span>注册</a></li>
                                        <li><a role="menuitem" href="<?php echo U('User/Passport/resetPassword');?>"> <span class="glyphicon glyphicon-question-sign"></span> 忘记密码</a></li>
                                        <?php } ?>
                                    </ul>
                                </li>
                            </ul>
                        </div><!-- /.nav-collapse -->
                    </nav>
                </div>
            </header>
<div class="container">
    <div class="dogo-blank"></div>
    <div class="row">
        <div class="col-md-12 ">
            <div class="dogo-box">
                <form class="form-horizontal" role="form" action="<?php echo U('User/Passport/getNewPwd');?>" method="post">
                    <div class="form-group">
                        <label for="emailRestpwd" class="col-sm-2 control-label input-lg">邮箱：</label>
                        <div class="col-sm-10">
                            <input type="email" name="email" id="emailRestpwd" class="form-control input-lg" placeholder="注册时使用的邮箱" required="required">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="v_codeRestpwd" class="col-sm-2 control-label input-lg">验证码：</label>
                        <div class="col-sm-7">
                            <input type="text" name="v_code" class="form-control input-lg" id="v_codeRestpwd" placeholder="输入右侧验证码" required="required">
                        </div>
                        <span class="dogo-click-yzmurl col-sm-3" style="cursor: pointer;">
                            <img src="<?php echo U('User/Passport/verify');?>" title="看不清？点击更换另一个验证码。" style="width: 150px;"/>
                        </span>
                    </div>
                    <div class="dogo-blank"></div>
                    <button type="submit" class="btn btn-gray col-lg-12 btn-lg">重置密码</button>
                </form>
            </div><!--dogo-box-->

            <div class="dogo-member dogo-border-shadow">

                <div class="dogo-blank"></div>
                <div class="dogo-box dogo-align-right dogo-mt50">
                    <a href="<?php echo U('User/Passport/login');?>">登录</a>
                    <a href="<?php echo U('User/Passport/signup');?>" class="dogo-ml10">注册</a>
                </div><!--dogo-align-right-->
            </div><!--dogo-member-->

        </div><!--col-md-->
    </div><!--row-->
    <div class="dogo-blank"></div>


</div><!--container-->
<footer class="dogo-footer">
    <div class="container dogo-wp">
        <div class="row">
            <div class="col-md-12">
                <nav>
                    <?php if(is_array($navfoot)): $i = 0; $__LIST__ = $navfoot;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$navlist): $mod = ($i % 2 );++$i;?><a href="<?php echo ($navlist["url"]); ?>"><?php echo ($navlist["text"]); ?></a><?php endforeach; endif; else: echo "" ;endif; ?>
                </nav>
                <p>Copyright ©2014 人人都是产品经理 - 深圳聚力创想信息科技有限公司 - 粤ICP备14037330号-1 - 网站统计
</br>
网站合作和广告投放联系QQ： 2606668171 （加好友请注明来意）</br>
特别鸣谢 阿里云 赞助服务器，又拍云 赞助图片加速，加速乐 安全支持</p>
            </div><!--col-md-->
        </div><!--row-->
    </div><!--container-->
</footer>


<script type="text/javascript" src="/Public<?php echo ($style_common); ?>/js/jquery-2.1.0.min.js"></script>
<script type="text/javascript" src="/Public<?php echo ($style_common); ?>/v3.3.1/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/Public<?php echo ($style_common); ?>/js/alertify.min.js"></script>
<script type="text/javascript" src="/Public<?php echo ($style_common); ?>/js/jquery.cookie.js"></script>
<script type="text/javascript" src="/Public<?php echo ($style_common); ?>/js/jquery.bxslider.min.js"></script>



<script>
    $(function() {
        $('img').addClass('img-responsive');
        $('.bxslider').bxSlider({
            mode: 'fade',
            captions: true,
            auto: true
        });
    });
</script>

</div><!--dogo-page-->
<script>
    $(function () {
        $('.dogo-click-yzmurl').click(function () {
            var url = "<?php echo U('User/Passport/verify');?>?tm=" + Math.random();
            $('.dogo-click-yzmurl img').attr('src', url);
        });
    });
</script>
</body>
</html>