<?php
defined('TYPO3_MODE') || die();

$boot = function ($_EXTKEY) {
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
        $_EXTKEY,
        'Commercetools',
        'commercetools - SDK (kickstart)'
    );
};

$boot($_EXTKEY);
unset($boot);
