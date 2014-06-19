<?php

/**
 * HouseAction.class.php前台首页
 * 房产
 * @author 正侠客 <lookcms@gmail.com>
 * @copyright 2012- http://www.dingcms.com http://www.dogocms.com All rights reserved.
 * @license http://www.apacheie.org/licenses/LICENSE-2.0
 * @version dogocms 1.0 2012-11-5 11:08
 * @package  Controller
 * @todo 完善更多方法
 */
namespace Wei\Action;
use Think\Action;
class HouseAction extends BaseweiAction {

    /*
     * index
     * 楼盘主页
     */
    public function index()
    {
        
        $skin = $this->getSkin(); //获取前台主题皮肤名称
        $this->assign('title', '青年居易');
        $this->theme($skin)->display(':house_index');
    }
    /*
     * huXingList
     * 户型列表--》单个户型详细信息页面--》360全景
     */
    public function huXingList()
    {
        
        $skin = $this->getSkin(); //获取前台主题皮肤名称
        $this->assign('title', '户型列表');
        $this->theme($skin)->display(':house_huxing');
    }
    /*
     * huXingView
     * 单个户型详细信息页面--》360全景
     */
    public function huXingView()
    {
        
        $skin = $this->getSkin(); //获取前台主题皮肤名称
        $this->assign('title', '户型列表');
        $this->theme($skin)->display(':house_huxing_view');
    }
    /*
     * huXingQuanJing
     * 户型360全景
     */
    public function huXingQuanJing()
    {
        
        $skin = $this->getSkin(); //获取前台主题皮肤名称
        $this->assign('title', '户型列表');
        $this->theme($skin)->display(':house_huxing_quanjing');
    }
    /*
     * jingGuan
     * 景观列表---》360
     */
    public function jingGuan()
    {
        
        $skin = $this->getSkin(); //获取前台主题皮肤名称
        $this->assign('title', '户型列表');
        $this->theme($skin)->display(':house_jingguan');
    }
    /*
     * xiangmuquanjing
     * 项目全景---》360
     */
    public function xiangmuquanjing()
    {
        
        $skin = $this->getSkin(); //获取前台主题皮肤名称
        $this->assign('title', '项目全景');
        $this->theme($skin)->display(':house_xiangmuquanjing');
    }
    /*
     * waiquanjing
     * 外景景观---》360
     */
    public function waiquanjing()
    {
        
        $skin = $this->getSkin(); //获取前台主题皮肤名称
        $this->assign('title', '外景景观');
        $this->theme($skin)->display(':house_waiquanjing');
    }
    /*
     * ququanjing
     * 小区全景---》360
     */
    public function ququanjing()
    {
        
        $skin = $this->getSkin(); //获取前台主题皮肤名称
        $this->assign('title', '小区全景');
        $this->theme($skin)->display(':house_ququanjing');
    }
    /*
     * yuYue
     * 预约看房
     */
    public function yuYue()
    {
        
        $skin = $this->getSkin(); //获取前台主题皮肤名称
        $this->assign('title', '户型列表');
        $this->theme($skin)->display(':house_yuyue');
    }
    

}