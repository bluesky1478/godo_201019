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
namespace Bundle\Controller\Admin\Policy;

use Exception;
use Request;

class GoodsDetailInfoRegisterController extends \Controller\Admin\Controller
{

    /**
     * 상품 배송/교환/반품안내 등록 / 수정 페이지
     * [관리자 모드] 상품 배송/교환/반품안내 등록 / 수정 페이지
     *
     * @author artherot
     * @version 1.0
     * @since 1.0
     * @copyright ⓒ 2016, NHN godo: Corp.
     * @param array $get
     * @param array $post
     * @param array $files
     * @throws Except
     */
    public function index()
    {
        // --- 메뉴 설정
        if (Request::get()->has('informCd')) {
            $this->callMenu('policy', 'goods', 'infoModify');
        } else {
            $this->callMenu('policy', 'goods', 'infoReg');
        }

        // --- 모듈 설정
        $inform = \App::load('\\Component\\Agreement\\BuyerInform');

        // --- 페이지 데이터
        try {

            $data = $inform->getGoodsInfo(Request::get()->get('informCd'));

        } catch (Exception $e) {
            throw $e;
        }

        // --- 관리자 디자인 템플릿
        $this->setData('data', gd_htmlspecialchars($data['data']));
        $this->setData('checked', $data['checked']);

        // 공급사와 동일한 페이지 사용
        $this->getView()->setPageName('policy/goods_detail_info_register.php');
    }
}
