<?php
/**
 * User: zura
 * Date: 6/24/18
 * Time: 2:58 PM
 */

/** @var $this \yii\web\View */
/** @var $contentTreeItem  \frontend\models\ContentTree */
/** @var $index integer */
/** @var $model \intermundia\yiicms\models\Section */

$content = $this->render('@frontend/views/content-tree/list', [
    'viewFile' => null,
    'contentTreeItem' => $contentTreeItem
]);

$template = str_replace('{{content}}', $content, $model->activeTranslation->template);
?>
<div class="container">
    <h2><?php echo $model->renderAttribute('title'); ?></h2>
    <div class="row">
        <?php echo str_replace('{{alias}}', 'alias_' . $model->activeTranslation->alias, $template); ?>
    </div>
</div>
