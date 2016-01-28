<?php
//ajax load terms
class actionTaxonomyTermsList extends cmsAction {

    public function run($vocabulary_id = false) {

        if (!$this->request->isAjax()) { cmsCore::error404(); }
        if(!$vocabulary_id){
            $this->halt();
        }

        $grid = $this->loadDataGrid('terms');

        $model = cmsCore::getModel('taxonomy');

        if($vocabulary_id){
            $model->setVocabularyId($vocabulary_id);
        }

        $terms = $model->getTerms();

        cmsTemplate::getInstance()->renderGridRowsJSON($grid, $terms);

        $this->halt();

    }

}
