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
namespace Bundle\Controller\Admin\Statistics;

/**
 * 통계 메인 페이지
 * [관리자 모드] 통계 메인 페이지
 *
 * @author    su
 * @version   1.0
 * @since     1.0
 * @copyright ⓒ 2016, NHN godo: Corp.
 */
class IndexController extends \Controller\Admin\Controller
{
    /**
     * {@inheritDoc}
     */
    public function index()
    {
        // 관리자 접속 권한 체크
        $this->redirect('./visit_today.php');
    }
}
