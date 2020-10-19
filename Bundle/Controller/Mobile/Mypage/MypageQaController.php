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

namespace Bundle\Controller\Mobile\Mypage;

use Component\Board\Board;
use Component\Board\BoardList;
use Component\Goods\GoodsCate;
use Component\Page\Page;
use Framework\Debug\Exception\AlertBackException;
use Framework\StaticProxy\Proxy\Session;
use Request;
use View\Template;
use Framework\Utility\Strings;
use Globals;


class MypageQaController extends \Controller\Mobile\Board\ListController
{
    public function index()
    {

        if (gd_is_login() === false) {
            throw new RedirectLoginException();
        }
        $this->redirect('../board/list.php?bdId='.Board::BASIC_QA_ID.'&mypageFl=y');
    }
}
