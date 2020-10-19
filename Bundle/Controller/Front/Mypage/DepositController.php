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
 * @link      http://www.godo.co.kr
 */

namespace Bundle\Controller\Front\Mypage;

use Bundle\Component\Deposit\Deposit;
use Component\Page\Page;
use Framework\Debug\Exception\AlertBackException;
use Framework\Utility\DateTimeUtils;

/**
 * 예치금
 * @package Bundle\Controller\Front\Mypage
 * @author  yjwee
 */
class DepositController extends \Controller\Front\Controller
{
    /**
     * @inheritdoc
     */
    public function index()
    {
        $request = \App::getInstance('request');
        $session = \App::getInstance('session');
        if ($session->has(SESSION_GLOBAL_MALL)) {
            throw new AlertBackException(__('잘못된 접근입니다.'));
        }

        if (is_numeric($request->get()->get('searchPeriod')) === true && $request->get()->get('searchPeriod') >= 0) {
            $selectDate = $request->get()->get('searchPeriod');
        } else {
            $selectDate = 7;
        }
        $regDt = DateTimeUtils::getBetweenDateString('-' . ($selectDate) . 'days');

        // 기간 조회
        if ($request->isMobile() === true) {
            $searchDate = [
                '1'   => __('오늘'),
                '7'   => __('최근 %d일', 7),
                '15'  => __('최근 %d일', 15),
                '30'  => __('최근 %d개월', 1),
                '90'  => __('최근 %d개월', 3),
                '180' => __('최근 %d개월', 6),
                '365' => __('최근 %d년', 1),
            ];
            $this->setData('searchDate', $searchDate);
            $this->setData('selectDate', $selectDate);
        }

        $regTerm = $request->get()->get('regTerm', 7);
        $regDt = $request->get()->get('regDt', $regDt);

        $active['regTerm'][$regTerm] = 'active';

        /**
         * 페이지 데이터 설정
         */
        $page = $request->get()->get('page', 1);
        $pageNum = $request->get()->get('pageNum', 10);

        /**
         * 요청처리
         * @var \Bundle\Component\Deposit\Deposit $deposit
         */
        $deposit = \App::load('\\Component\\Deposit\\Deposit');
        $list = $deposit->listBySession($regDt, $page, $pageNum);

        // 괄호 내용 제거 (특정 사유 제외)
        $exceptType = [
            Deposit::REASON_CODE_GROUP . Deposit::REASON_CODE_GOODS_BUY,
        ];
        foreach($list as &$val){
            if (in_array($val['reasonCd'], $exceptType) === false) {
                if (in_array($val['reasonCd'], $exceptType) === false) {
                    $bracketFl = strpos($val['contents'], '(');
                    if ($bracketFl > 0) {
                        $val['contents'] = substr_replace($val['contents'], '', strpos($val['contents'], '('));
                    }
                }
            }
        }

        /**
         * 페이징 처리
         */
        $p = new Page($page, $deposit->foundRowsByListSession(), null, $pageNum);
        $p->setPage();
        $p->setUrl($request->getQueryString());

        /**
         * View 데이터
         */
        $this->setData('list', $list);
        $this->setData('regTerm', $regTerm);
        $this->setData('regDt', $regDt);
        $this->setData('active', $active);
        $this->setData('page', $p);

        /**
         * css 추가
         */
        $this->addCss(
            [
                'plugins/bootstrap-datetimepicker.min.css',
                'plugins/bootstrap-datetimepicker-standalone.css',
            ]
        );

        /**
         * js 추가
         */
        $locale = \Globals::get('gGlobal.locale');
        $this->addScript(
            [
                'gd_board_list.js',
                'moment/moment.js',
                'moment/locale/' . $locale . '.js',
                'jquery/datetimepicker/bootstrap-datetimepicker.min.js',
            ]
        );
    }
}
