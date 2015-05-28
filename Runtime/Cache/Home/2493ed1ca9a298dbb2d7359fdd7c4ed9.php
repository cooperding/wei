<?php if (!defined('THINK_PATH')) exit();?>
<div class="blank"></div>
<div class="box wp">
    <div class="place placebd">
        <h3>当前位置：<a href="/">首页</a>&gt;&gt;</h3>
    </div><!--place-->
</div><!--box-->
<div class="blank"></div>
<div class="block wp">
    <div class="blockL f_right">


    </div><!--blockL-->

    <div class="blockLA f_left">
        <div class="box">
            <div class="common listbd list">
                <div class="common_top commontopbd">
                    <div class="ctop_l f_left"><span><?php echo ($words); ?></span>搜索结果</div>
                    <div class="ctop_m f_left"></div>
                    <div class="ctop_r f_right"><a href="#"></a></div>
                    <div class="clear"></div>
                </div><!--common_top-->
                <div class="common_cont listnews">
                <?php if(is_array($dogocms)): foreach($dogocms as $key=>$dogocms): ?><dl>
                        <dt>
                        <a href="/Content/?id=<?php echo ($dogocms["id"]); ?>"><?php echo ($dogocms["title"]); ?></a>
                        </dt>
                        <dd><?php echo ($dogocms["dwend1"]); ?></dd>
                        <dd>分类: <a href="/List/?id=<?php echo ($dogocms["sort_id"]); ?>"><?php echo ($dogocms["sortname"]); ?></a>   [<?php echo (date("Y-m-d H:i:s",$dogocms["addtime"])); ?>]</dd>
                    </dl><?php endforeach; endif; ?>

                    <div class="pagelist"><?php echo ($page); ?></div><!--pagelist-->
                </div><!--common_cont-->
            </div><!--common-->

        </div><!--box-->
    </div><!--blockFL-->
    <div class="clear"></div>
</div><!--block-->






</body>
</html>