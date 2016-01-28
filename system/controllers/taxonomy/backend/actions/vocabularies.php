<?php

class actionTaxonomyVocabularies extends cmsAction {

    public function run() {

        $taxonomy_model = cmsCore::getModel('taxonomy');

        $vocabularies = $taxonomy_model->getVocabularies();

        $grid = $this->loadDataGrid('terms');

        return cmsTemplate::getInstance()->render('backend/vocabularies', array(
            'vocabularies' => $vocabularies,
            'grid' => $grid
        ));

    }

}
