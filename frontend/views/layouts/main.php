<?php
/* @var $this \yii\web\View */

use intermundia\yiicms\web\View;
use yii\bootstrap\Modal;
use apollo11\yii2GaOptOut\GaOpOut;
use yii\helpers\ArrayHelper;
use yii\widgets\Breadcrumbs;

/* @var $content string */

$this->registerJs(\intermundia\yiicms\widgets\DbText::widget([
    'key' => 'usersnap-code'
]), View::POS_END);

if (($gaCode = Yii::$app->websiteContentTree->model->activeTranslation->google_tag_manager_code)) {

    $this->registerJsFile("https://www.googletagmanager.com/gtag/js?id=$gaCode", [
        'async' => true
    ]);

    $this->registerJs("
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
    
        gtag('config', '$gaCode');
      ");

    GaOpOut::widget([
        'gaAppId' => $gaCode,
        'debug' => env('YII_DEBUG')
    ]);
}


$this->registerJs(\intermundia\yiicms\widgets\DbText::widget([
    'key' => 'other-third-party-code'
]), View::POS_END);

$modalVideo = \intermundia\yiicms\models\ContentTree::find()->byKey('modal-video')->notDeleted()->notHidden()->one();
/** @var $modalVideo  \common\models\ContentTree */
/** @var $modalVideoModal  \common\models\VideoSection */
$modalVideoModel = $modalVideo ? $modalVideo->getModel() : null;

$this->beginContent('@frontend/views/layouts/base.php')
?>

    <div class="container">
        <?php echo Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>

        <?php if (Yii::$app->session->hasFlash('alert')): ?>
            <br>
            <?php echo \yii\bootstrap\Alert::widget([
                'body' => ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'body'),
                'options' => ArrayHelper::getValue(Yii::$app->session->getFlash('alert'), 'options'),
            ]) ?>
        <?php endif; ?>
    </div>

<?php echo $content ?>
<?php

if ($modalVideoModel):
    Modal::begin([
        'options' => [
            'id' => 'educationalVideoModal',
        ],
        'size' => 'modal-lg modal-centered',
        'toggleButton' => false,
        'bodyOptions' => [
            'class ' => 'modal-body',
            'style' => 'padding:0; line-height:0;'
        ]
    ]); ?>
    <?php
    echo \common\helpers\Html::video($modalVideoModel, 'videoFile', [
        'autoplay' => false,
        'muted' => false,
        'loop' => false,
        'class' => 'educational-video',
        'controls' => true,
        'controlsList' => 'nodownload',
        'width' => '100%',
        'height' => '100%'
    ]) ?>
    <?php Modal::end(); ?>

<?php endif; ?>

<?php $this->endContent() ?>