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
namespace Bundle\Controller\Admin\Scm;

use Exception;
use Globals;
use Request;

class LayerGoodsApplyInfoController extends \Controller\Admin\Controller
{

    /**
     * 레이어 상품 리스트 페이지
     * [관리자 모드] 레이어 상품 리스트 페이지
     * 설명 : 상품 정보 수정 페이지에서 상단에 상품 리스트로 나오는 부분
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

        // --- 모듈 호출
        $goods = \App::load('\\Component\\Goods\\GoodsAdmin');

        $applyFlList = [
            'a'    => __('승인요청'),
            'y'   => __('승인완료'),
            'r'  => __('반려'),
            'n'  => __('철회'),
        ];


        $modeList = [
            'category'    => __('카테고리'),
            'addInfo'   => __('추가정보'),
            'option'  => __('옵션'),
            'optionText'  => __('텍스트옵션'),
            'goods'  => __('상품정보'),
            'image'  => __('이미지'),
        ];


        // --- 상품 데이터
        try {

            $getData = $goods->getAdminListGoodsLog(Request::post()->get('goodsNo'));

        } catch (Exception $e) {
            throw $e;
        }


        // --- 관리자 디자인 템플릿

        $this->getView()->setDefine('layout', 'layout_layer.php');
        $this->getView()->setDefine('layoutContent', Request::getDirectoryUri() . '/' . Request::getFileUri());

        $this->setData('data', $getData);
        $this->setData('applyFlList', $applyFlList);
        $this->setData('modeList', $modeList);

    }
}
