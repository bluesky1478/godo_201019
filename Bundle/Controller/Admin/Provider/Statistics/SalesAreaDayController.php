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

namespace Bundle\Controller\Admin\Provider\Statistics;

use Component\Member\Manager;

/**
 * [관리자 모드] 매출분석 > 지역별 매출통계 페이지
 *
 * @author    Jong-tae Ahn <qnibus@godo.co.kr>
 */
class SalesAreaDayController extends \Controller\Admin\Statistics\SalesAreaDayController
{
    /**
     * @inheritdoc
     */
    public function index()
    {
        // 공급사 정보 설정
        $isProvider = Manager::isProvider();
        $this->setData('isProvider', $isProvider);

        parent::index();
    }
}
