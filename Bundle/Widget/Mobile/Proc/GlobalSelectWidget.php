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
namespace Bundle\Widget\Mobile\Proc;

use App;

/**
 * Class GlobalSelectWidget
 *
 * @package Bundle\Controller\Mobile\Proc
 * @author
 */

class GlobalSelectWidget extends \Widget\Mobile\Widget
{

    public function index()
    {
        $mallIcon = gd_policy('design.mallIconType');
        gd_isset($mallIcon['mallIconMobile'][1], 'ico_kr.png');
        gd_isset($mallIcon['mallIconMobile'][2], 'ico_us.png');
        gd_isset($mallIcon['mallIconMobile'][3], 'ico_cn.png');
        gd_isset($mallIcon['mallIconMobile'][4], 'ico_jp.png');
        $mall = App::load('\\Component\\Mall\\Mall');

        $mallList = $mall->getListByUseMall();

        // 위젯 해외몰 별 대표 도메인 연결
        $mallList= $mall->globalShopDomainSetting($mallList);

        $this->setData('mallList', $mallList);
        $this->setData('mallCnt', count($mallList));
        $this->setData('nowMall', gd_isset(\Component\Mall\Mall::getSession('sno'), 1));
        $this->setData('iconType', gd_isset($mallIcon['iconTypeMobile'],'check'));
        $this->setData('mallIcon', $mallIcon['mallIconMobile']);
        $this->setData('uriHome', URI_MOBILE);
        $this->setData('uriCommon', \UserFilePath::data('commonimg')->www());

    }
}
