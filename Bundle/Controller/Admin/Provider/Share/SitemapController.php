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

namespace Bundle\Controller\Admin\Provider\Share;

/**
 * 관리자 사이트 맵 - 메뉴순 (공급사 용)
 * @author Shin Donggyu <artherot@godo.co.kr>
 */
class SitemapController extends \Controller\Admin\Share\SitemapController
{

    /**
     * index
     *
     */
    public function index()
    {
        parent::index();

        // 페이지 설정
        $this->getView()->setDefine('layoutContent', str_replace('provider/', '', $this->getPageName()));
    }
}
