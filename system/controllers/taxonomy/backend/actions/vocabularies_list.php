<?php

class actionTaxonomyVocabulariesList extends cmsAction {

    public function run() {

        if(!$this->request->isAjax()) { cmsCore::error404(); }

        $grid = $this->loadDataGrid('vocabularies');

        $vocabularies = cmsCore::getModel('taxonomy')->getVocabularies();

        cmsTemplate::getInstance()->renderGridRowsJSON($grid, $vocabularies);

        $this->halt();

    }

}
