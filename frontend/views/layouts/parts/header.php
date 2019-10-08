<?php

use intermundia\yiicms\helpers\LanguageHelper;
use intermundia\yiicms\models\Language;
use intermundia\yiicms\widgets\FrontendLanguageSelector;
use intermundia\yiicms\widgets\NestedMenu;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use yii\helpers\Html;
use yii\helpers\Url;

$metaNavItems = \frontend\models\ContentTree::getItemsForMenu('header-meta-nav');
$menuItems = \frontend\models\ContentTree::getItemsForMenu('header');

//$cartContentTree = ContentTree::find()->byView('cart')->notDeleted()->notHidden()->one();
//$cartUrl = $cartContentTree ? $cartContentTree->getUrl() : Url::to('#');

?>

<header>
    <nav id="headerTop" class="navbar navbar-inverse">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <a class="navbar-brand" href="<?php echo Yii::$app->homeUrl; ?>">
                    <?php echo Yii::$app->websiteContentTree->getModel()->renderImage('logo_image'); ?>
                </a>
            </div>


            <form class="navbar-form form-search navbar-right" method="get" action="<?php echo \yii\helpers\Url::to(['/site/search'])?>">
                <!--                    <div class="form-group">-->
                <!--                        <input type="text" class="form-control" placeholder="Search">-->
                <!--                    </div>-->

                <input class="form-control" name="content" value="<?php echo Yii::$app->request->get('content') ?>">
                <button id="searchBtn" type="button" class="btn btn-default">
                    <i class="fa fa-search fa-rotate-90"></i>
                </button>
            </form>
            <?php echo \yii\bootstrap\Nav::widget([
                'options' => [
                    'class' => 'nav navbar-nav nav-meta navbar-right'
                ],
                'encodeLabels' => false,
                'items' => \intermundia\yiicms\helpers\Html::convertToNavData($metaNavItems)
            ]) ?>
        </div><!-- /.container-fluid -->
    </nav>
    <nav id="headerBottom" class="navbar navbar-default">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button id="mobile-menu-toggle" type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span>
                        <span class="icon-bar top-bar"></span>
                        <span class="icon-bar middle-bar"></span>
                        <span class="icon-bar bottom-bar"></span>
                    </span>
                    <!--                    <img  src="/icon/icon-accordion-close.svg">-->
                </button>
                <a class="navbar-brand visible-sm visible-xs" href="<?php echo Yii::$app->homeUrl; ?>">
                    <?php echo Yii::$app->websiteContentTree->getModel()->renderImage('logo_image'); ?>
                </a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <?php echo \intermundia\yiicms\widgets\NestedMenu::widget([
                    'dropDownCaret' => false,
                    'options' => [
                        'class' => 'nav navbar-nav navbar-menu'
                    ],
                ]) ?>
                <div class="visible-sm visible-xs">
                    <form class="navbar-form form-search">
                        <div class="input-group">
                            <input type="text" class="form-control" name="content"
                                   value="<?php echo Yii::$app->request->get('content') ?>">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search fa-rotate-90 search-icon"></i>
                                </button>
                            </span>
                        </div>
                    </form>
                    <?php echo \yii\bootstrap\Nav::widget([
                        'options' => [
                            'class' => 'nav navbar-nav nav-meta navbar-right'
                        ],
                        'items' => \intermundia\yiicms\helpers\Html::convertToNavData($metaNavItems)
                    ]) ?>
                </div>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
</header>
