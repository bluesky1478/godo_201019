<?php
/**
 * This is commercial software, only users who have purchased a valid license
 * and accept to the terms of the License Agreement can install and use this
 * program.
 *
 * Do not edit or add to this file if you wish to upgrade Godomall5 to newer
 * versions in the future.
 *
 * @copyright ⓒ 2016, NHN godo: Corp.
 * @link http://www.godo.co.kr
 */
namespace Bundle\Widget\Mobile\Goods;

/**
 * Class MypageQnaController
 *
 * @package Bundle\Controller\Front\Outline
 * @author  Young Eun Jung <atomyang@godo.co.kr>
 */
use Request;
use Framework\Utility\ArrayUtils;
use UserFilePath;

class GoodsDisplayGroupMainWidget extends \Widget\Mobile\Widget
{

    public function index()
    {

        $eventGroup = \App::load('\\Component\\Promotion\\EventGroupTheme');
        $groupData = $eventGroup->getSimpleData($this->getData('sno'));

        $this->setData('groupData', $groupData);
    }
}

