<?php


namespace common\models;

class PageTranslation extends \intermundia\yiicms\models\PageTranslation
{
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPage()
    {
        return $this->hasOne(Page::class, ['id' => 'page_id']);
    }

    public function getModelClass()
    {
        return Page::class;
    }
}