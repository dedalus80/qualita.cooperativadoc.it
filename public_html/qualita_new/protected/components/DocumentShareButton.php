<?php

class DocumentShareButton extends CWidget
{
    public $url;
    public $title;
    public $filename;
    public $linkOptions = array();
    public $emailSubject;
    public $emailBody;

    public function init()
    {
        parent::init();
        $this->registerClientScript();
    }

    public function run()
    {
        if(!$this->url) {
            return;
        }

        $absoluteUrl = $this->getAbsoluteUrl($this->url);
        $title = $this->title ? $this->title : Yii::t('app', 'Documento');
        $filename = $this->filename ? $this->filename : $title;
        $emailSubject = $this->emailSubject ? $this->emailSubject : Yii::t('app', 'Documento condiviso: {title}', array('{title}' => $title));
        $emailBody = $this->emailBody ? $this->emailBody : Yii::t('app', "Puoi scaricare il documento dal seguente link:\n{url}", array('{url}' => $absoluteUrl));

        $options = CMap::mergeArray(array(
            'href' => $absoluteUrl,
            'class' => 'document-share-button mycbv dark',
            'rel' => 'tooltip',
            'data-toggle' => 'tooltip',
            'title' => Yii::t('app', 'Condividi'),
            'aria-label' => Yii::t('app', 'Condividi documento'),
            'data-share-url' => $absoluteUrl,
            'data-share-title' => $title,
            'data-share-filename' => $filename,
            'data-share-email-subject' => $emailSubject,
            'data-share-email-body' => $emailBody,
        ), $this->linkOptions);

        echo CHtml::link('<i class="ace-icon fa fa-share-alt bigger-110 icon-only btn btn-circle circle-blue"></i>', $absoluteUrl, $options);
    }

    protected function registerClientScript()
    {
        Yii::app()->clientScript->registerScriptFile(
            Yii::app()->baseUrl . '/js/document-share.js',
            CClientScript::POS_END
        );
    }

    protected function getAbsoluteUrl($url)
    {
        if(strpos($url, 'http://') === 0 || strpos($url, 'https://') === 0) {
            return $url;
        }

        if(strpos($url, '/') === 0) {
            return Yii::app()->request->hostInfo . $url;
        }

        return Yii::app()->createAbsoluteUrl($url);
    }
}
