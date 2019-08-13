<?php
/**
 * Created by PhpStorm.
 * User: sai
 * Date: 7/25/18
 * Time: 6:12 PM
 * @author Saiat Kalbiev <kalbievich11@gmail.com>
 */
/** @var $this \yii\web\View */
/** @var $contentTreeItem \frontend\models\ContentTree */
/** @var $index integer */
/** @var $model \intermundia\yiicms\models\Carousel */
$directChildren = $contentTreeItem->getItemsQuery()->all();

?>
<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <?php if (count($directChildren) > 0): ?>
        <ol class="carousel-indicators">
            <?php foreach ($directChildren as $key => $child): ?>
                <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $key; ?>"
                    class="<?php $key > 0 ? '' : 'active'; ?>"></li>
            <?php endforeach; ?>
        </ol>
    <?php endif; ?>
    <div class="carousel-inner">
        <?php echo $this->render('@frontend/views/content-tree/list', [
            'viewFile' => null,
            'contentTreeItem' => $contentTreeItem
        ]); ?>
    </div>
    <?php if (count($directChildren) > 0): ?>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    <?php endif; ?>
</div>
