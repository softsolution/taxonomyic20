<?php

class actionTaxonomyTermsReorder extends cmsAction {

    public function run(){

        $items = $this->request->get('items');

        if (!$items){ cmsCore::error404(); }

        $taxonomy_model = cmsCore::getModel('taxonomy');

        $taxonomy_model->reorderTerms($items);

        $this->redirectBack();

    }

}
