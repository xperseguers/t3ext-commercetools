<?php
/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with TYPO3 source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

namespace Causal\Commercetools\Controller;

use Commercetools\Core\Request\Products\ProductProjectionSearchRequest;
use Commercetools\Core\Client;
use Commercetools\Core\Config;
use Commercetools\Core\Model\Common\Context;

class SdkController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * Initializes the controller before invoking an action method.
     */
    public function initializeAction()
    {
        if (!is_array($this->settings)) {
            // Most probably the static TypoScript was not included
            $this->settings = [];
        }

        $config = $GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['commercetools'];
        if (!empty($config)) {
            $this->settings = array_merge_recursive($this->settings, unserialize($config));
        }
    }

    /**
     * Index action.
     */
    public function indexAction()
    {
        $config = [
            'client_id' => $this->settings['client_id'],
            'client_secret' => $this->settings['client_secret'],
            'project' => $this->settings['project_id'],
        ];
        $context = Context::of()->setLanguages(['de'])->setLocale('de_CH')->setGraceful(true);
        $config = Config::fromArray($config)->setContext($context);

        /**
         * create a search request and a client,
         * execute the request and get the PHP Object
         * (the client can and should be re-used)
         */
        $search = ProductProjectionSearchRequest::of()->addParam('text.de', 'rot');

        $client = Client::ofConfig($config);
        $products = $client->execute($search)->toObject();

        $this->view->assignMultiple([
            'products' => $products,
        ]);
    }

}
