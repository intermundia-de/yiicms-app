<?php

use intermundia\yiicms\helpers\LanguageHelper;
use intermundia\yiicms\models\Language;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\helpers\Html;

echo \intermundia\yiicms\widgets\ContentEditingToolbar::widget();

$metaNavItems = \frontend\models\ContentTree::getItemsForMenu('header-meta-nav');
/** @var  $logoImages intermundia\yiicms\models\FileManagerItem[] */
$logoImages = Yii::$app->websiteContentTree->getModel()->activeTranslation->logo_image;

$languageDomains = array_unique(\Yii::$app->multiSiteCore->websites[Yii::$app->websiteContentTree->key]['domains']);
$activeLanguageIndex = 0;
$currentLanguage = null;
$protocol = Yii::$app->request->getIsSecureConnection() ? 'https' : 'http';
foreach ($languageDomains as $languageDomain => $langCode) {
    if (substr($langCode, 0, 2) == 'en') {
        unset($languageDomains[$languageDomain]);
    } else {

        $language = Language::find()->byCode($langCode)->one();
        $languageDomains[$languageDomain] = $language;
        if ($langCode == Yii::$app->language) {
            $currentLanguage = $language;
        }
    }
}
?>

<?php Navbar::begin([
    'brandLabel' => 'YiiCMS',
    'options' => [
        'class' => ['navbar-dark', 'bg-dark', 'navbar-expand-md']
    ]
]); ?>

<?php echo Nav::widget([
    'items' => [
        [
            'label' => 'Home',
            'url' => ['site/index'],
            'linkOptions' => [],
        ],
        [
            'label' => 'Dropdown',
            'items' => [
                ['label' => 'Level 1 - Dropdown A', 'url' => '#'],
                '<div class="dropdown-divider"></div>',
                '<div class="dropdown-header">Dropdown Header</div>',
                ['label' => 'Level 1 - Dropdown B', 'url' => '#'],
            ],
        ],
        [
            'label' => 'Login',
            'url' => ['site/login'],
            'visible' => Yii::$app->user->isGuest
        ],
    ],
    'options' => ['class' => 'navbar-nav mr-auto'], // set this to nav-tab to get tab-styled navigation
]);
?>
<form class="form-inline">
    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
</form>

<?php Navbar::end(); ?>
