<?php
/**
 * This is commercial software, only users who have purchased a valid license
 * and accept to the terms of the License Agreement can install and use this
 * program.
 *
 * Do not edit or add to this file if you wish to upgrade Godomall5 to newer
 * versions in the future.
 *
 * @copyright ⓒ 2017, NHN godo: Corp.
 * @link http://www.godo.co.kr
 */

namespace Bundle\Controller\Mobile\Goods;

use App;
use Session;
use Request;
use Exception;
use Component\Goods\Populate;

/**
 *
 * @package
 * @author
 */
class PopulateController extends \Controller\Mobile\Controller
{
    /**
     * @inheritdoc
     */
    public function index()
    {
        $getValue = Request::get()->toArray();
        $goods = \App::load('\\Component\\Goods\\Goods');

        if(empty($getValue['sno'])){
            $getValue['$sno'] = 1;
        }
        $populate = new Populate($getValue['$sno']);
        $populateConfig = $populate->cfg;
        if($populateConfig['displayFl'] != 'y' || $populateConfig['mobileUseFl'] != 'y'){
            $populate->wrongParameter();
            exit;
        }
        $pageNum = gd_isset(Request::get()->get('pageNum'), 20);

        $goodsData = $populate->getGoodsInfo('list');
        $populateConfig = $populate->cfg;

        if($goodsData['listData']) $goodsList = array_chunk($goodsData['listData'],$populateConfig['lineCnt']);
        $total = count($goodsData['listData']);
        unset($goodsData['listData']);

        //품절상품 설정
        $soldoutDisplay = gd_policy('soldout.mobile');

        // 마일리지 정보
        $mileage = gd_mileage_give_info();

        // 카테고리 노출항목 중 상품할인가
        if (in_array('goodsDcPrice', $populateConfig['displayField'])) {
            foreach ($goodsList as $key => $val) {
                foreach ($val as $key2 => $val2) {
                    $goodsList[$key][$key2]['goodsDcPrice'] = $goods->getGoodsDcPrice($val2);
                }
            }
        }

        $this->setData('goodsList', gd_isset($goodsList));
        $this->setData('goodsData', gd_isset($goodsData));
        $this->setData('themeInfo', $populateConfig);
        $this->setData('soldoutDisplay', gd_isset($soldoutDisplay));
        $this->setData('mileageData', gd_isset($mileage['info']));
        $this->setData('gPageName', $populateConfig['populateName']);
        $this->getView()->setDefine('goodsTemplate', 'goods/list/list_' . $populateConfig['displayType'] . '.html');
    }
}
