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

namespace Bundle\Controller\Mobile\Member;

use App;
use Component\Member\Member;
use Component\Member\MemberSleep;
use Component\Validator\Validator;
use Exception;
use Framework\Debug\Exception\AlertBackException;
use Framework\Debug\Exception\AlertOnlyException;
use Framework\Debug\Exception\AlertRedirectException;
use Request;
use Session;

/**
 * Class PasswordChangePsController
 * @package Bundle\Controller\Front\Member
 */
class PasswordChangePsController extends \Controller\Mobile\Controller
{

    /**
     * @inheritdoc
     */
    public function index()
    {
        /** @var \Bundle\Controller\Front\Member\PasswordChangePsController $front */
        $front = \App::load('\\Controller\\Front\\Member\\PasswordChangePsController');
        $front->index();
    }
}
