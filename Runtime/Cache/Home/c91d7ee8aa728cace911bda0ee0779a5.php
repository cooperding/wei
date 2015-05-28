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
        <link rel="stylesheet" type="text/css" href="<?php echo ($style); ?>/css/jquery.bxslider.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo ($style); ?>/css/common.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo ($style); ?>/css/style.css"/>
        <!--[if lte IE 9]>
<script type="text/javascript" src="/Public<?php echo ($style_common); ?>/js/html5shiv.js"></script>
<![endif]-->
    </head>
    <body>
        <div class="dogo-page ">
            <div class="dogo-top">
                <div class="container dogo-wp">
                    <div class="dogo-top-nav">
                        <ul class="nav navbar-nav">
                            <li><a href="/">首页</a></li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <?php if(session('LOGIN_M_STATUS')=='TRUE'){ ?>
                            <li><a href="<?php echo U('User/index');?>">我的主页</a></li>
                            <li><a href="<?php echo U('User/changePwd');?>">修改密码</a></li>
                            <li><a href="javascript:void(0)" class="dogo-click-logout">退出登录</a></li>
                            <?php }else{ ?>
                            <li><a href="<?php echo U('Passport/login');?>" title="登录">登录</a></li>
                            <li><a href="<?php echo U('Passport/signup');?>" title="注册">注册</a></li>
                            <li><a href="<?php echo U('Passport/resetPassword');?>">忘记密码</a></li>
                            <?php } ?>
                        </ul>
                    </div><!--dogo-top-nav-->
                </div>
            </div><!--dogo-top-->
            
            <header class="dogo-header">
                <div class="container dogo-wp">
                    <div class="dogo-header-top">
                        <h2>悠悠美食，悠哉食足</h2>
                    </div>
                </div>
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
                            <form class="navbar-form navbar-right dogo-nav-form" role="search" action="<?php echo U('Search/index');?>" method="get">
                                <div class="form-group">
                                    <input type="text" name="words" class="form-control" placeholder="搜索">
                                </div>
                                <button type="submit" class="btn btn-default">搜索</button>
                            </form>
                        </div><!-- /.nav-collapse -->
                    </nav>
                </div>
            </header>

<div class="container dogo-wp">
    <div class="row dogo-notice">
        <?php $_result=M('BlockList')->order("myorder asc")->limit(4)->where(" (`status`='20')  and (`sort_id` =4) ")->select(); if ($_result): $i=0;foreach($_result as $key=>$block):++$i;$mod = ($i % 2 );?><div class="col-md-3">
                <ul>
                    <li>
                    <?php if($i == 1): ?><span class="glyphicon glyphicon-volume-up"></span><?php endif; ?>
                    <a href="<?php echo ($block["url"]); ?>" target="_blank" title="<?php echo ($block["title"]); ?>"><?php echo ($block["title"]); ?></a>
                    </li>
                </ul>
            </div><!--col-md--><?php endforeach; endif;?>
    </div><!--row-->
    <div class="row ">
        
        <div class="col-md-9">



            <div class="dogo-box dogo-view-info dogo-border-all dogo-pd1015">
                <div class="dogo-box-header">
                    <h1><?php echo ($data["title"]); ?></h1>
                    <p><span class="glyphicon glyphicon-refresh"></span>  <?php echo (date("Y-m-d H:i:s",$data["addtime"])); ?>
                        <span class="glyphicon glyphicon-eye-open"></span> <?php echo ($data["views"]); ?></p>
                </div>
                <div class="dogo-box-content">
                    <p><?php echo ($data["content"]); ?></p>
                </div>
                <div class="dogo-box-footer">
                </div>
            </div><!--dogo-box-->

        </div><!--col-md-->
		<div class="col-md-3">
            <aside>
                <div class="dogo-box">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><a href="#">全部分类</a></h3>
                        </div>
                        <div class="panel-body dogo-text">
                            <ul>
                                <?php $_result=M('Title')->table('ding_title t')->join(' ding_news_sort ns on ns.id=t.sort_id ')->join(' ding_content c on c.title_id=t.id ')->field( 't.*,c.content,ns.text as sortname' )->order('t.id desc')->where(" (t.`status`='12')  and (t.`is_recycle`='10') ")->limit(8)->select(); if ($_result): $i=0;foreach($_result as $key=>$article):++$i;$mod = ($i % 2 );?><li>·<a href="<?php echo U('Home/Content/index',array('id'=>$article['id']));?>" title="<?php echo ($article["title"]); ?>"><?php echo ($article["title"]); ?></a></li><?php endforeach; endif;?>
                            </ul>
                        </div>
                    </div>
                </div><!--dogo-box-->
            </aside>
            <aside>
                <div class="dogo-box">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><a href="#">全部分类</a></h3>
                        </div>
                        <div class="panel-body dogo-text">
                            <ul>
                                <?php $_result=M('Title')->table('ding_title t')->join(' ding_news_sort ns on ns.id=t.sort_id ')->join(' ding_content c on c.title_id=t.id ')->field( 't.*,c.content,ns.text as sortname' )->order('t.id desc')->where(" (t.`status`='12')  and (t.`is_recycle`='10') ")->limit(8)->select(); if ($_result): $i=0;foreach($_result as $key=>$article):++$i;$mod = ($i % 2 );?><li>·<a href="<?php echo U('Home/Content/index',array('id'=>$article['id']));?>" title="<?php echo ($article["title"]); ?>"><?php echo ($article["title"]); ?></a></li><?php endforeach; endif;?>
                            </ul>
                        </div>
                    </div>
                </div><!--dogo-box-->
            </aside>
        </div><!--col-md-3-->
    </div><!--row-->
</div><!--container-->

<footer class="dogo-footer">
    <div class="container dogo-wp">
        <div class="row">
            <div class="col-md-12">
                <p>Copyright ©2014 人人都是产品经理 - 深圳聚力创想信息科技有限公司 - 粤ICP备14037330号-1 - 网站统计</p>
            </div><!--col-md-->
        </div><!--row-->
    </div><!--container-->
</footer>



<script type="text/javascript" src="/Public<?php echo ($style_common); ?>/js/jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="/Public<?php echo ($style_common); ?>/v3.3.1/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/Public<?php echo ($style_common); ?>/js/jquery.bxslider.min.js"></script>
<!--[if lte IE 9]>
<script type="text/javascript" src="/Public<?php echo ($style_common); ?>/js/respond.js"></script>
<![endif]-->

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
</body>
</html>