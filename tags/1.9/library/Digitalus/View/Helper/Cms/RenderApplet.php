<?php
/**
 * RenderApplet helper
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://digitalus-media.com/license/new-bsd
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to info@digitalus-media.com so we can send you a copy immediately.
 *
 * @author      Forrest Lyman
 * @category    Digitalus
 * @package     Digitalus_View
 * @subpackage  Helper
 * @copyright   Copyright (c) 2007 - 2009,  Digitalus Media USA (digitalus-media.com)
 * @license     http://digitalus-media.com/license/new-bsd     New BSD License
 * @version     $Id:$
 * @link        http://www.digitaluscms.com
 * @since       Release 1.5.0
 */

/**
 * @see Zend_View_Helper_Abstract
 */
require_once 'Zend/View/Helper/Abstract.php';

/**
 * RenderApplet helper
 *
 * @author      Forrest Lyman
 * @copyright   Copyright (c) 2007 - 2009,  Digitalus Media USA (digitalus-media.com)
 * @license     http://digitalus-media.com/license/new-bsd     New BSD License
 * @version     Release: @package_version@
 * @link        http://www.digitaluscms.com
 * @since       Release 1.5.0
 */
class Zend_View_Helper_RenderApplet extends Zend_View_Helper_Abstract
{
    /**
     * comments
     */
    public function renderApplet($applet)
    {
        $config = Zend_Registry::get('config');

        //create a new instance of view
        $appletView = new Zend_View();
        $appletView->setScriptPath($config->view->applet->path . '/' . $applet);
        $appletView->setHelperPath($config->view->applet->path . '/' . $applet, 'Digitalus_Applet');

        //tell the applet about where it is
        $appletView->page    = $this->view->page;
        $appletView->pageObj = $this->view->pageObj;

        //run the code behind
        if (file_exists($config->view->applet->path . '/' . $applet . '/' . $applet . '.php')) {
           $appletView->$applet();
        }
        return $appletView->render($applet . '.phtml');
    }
}