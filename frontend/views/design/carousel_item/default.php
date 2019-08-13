<?php
/**
 * User: zura
 * Date: 11/29/18
 * Time: 7:40 PM
 */
/** @var $this \yii\web\View */
/** @var $contentTreeItem \frontend\models\ContentTree */
/** @var $index integer */
/** @var $model \intermundia\yiicms\models\CarouselItem */

?>
<div id="content_<?php echo $contentTreeItem->id ?>"
     class="<?php echo $contentTreeItem->getCssClass() ?> carousel-item <?php echo $index > 0 ? '' : 'active'; ?>">
    <?php if ($model->activeTranslation->image): ?>
        <img style="width: 100%" src="<?php echo $model->activeTranslation->image[0]->getUrl(); ?>" alt="">
    <?php endif; ?>
    <div class="carousel-caption d-none d-md-block">
        <div class="xmlblock">
            <?php echo $model->renderAttribute('caption') ?>
        </div>
    </div>
</div>
