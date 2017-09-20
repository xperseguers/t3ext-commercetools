<?php
defined('TYPO3_MODE') || die();

$boot = function ($_EXTKEY) {
    // Require 3rd-party libraries, in case TYPO3 does not run in composer mode
    $pharFileName = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('commercetools') . 'Libraries/commercetools-php-sdk.phar';
    if (is_file($pharFileName)) {
        @include 'phar://' . $pharFileName . '/vendor/autoload.php';
    }

    // TEMPORARY PLUGIN TO KICKSTART THE EXTENSION
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'Causal.' . $_EXTKEY,
        'Commercetools',
        array(
            'Sdk' => 'index',
        ),
        // non-cacheable actions
        array(
            'Sdk' => 'index',
        )
    );
};

$boot($_EXTKEY);
unset($boot);
