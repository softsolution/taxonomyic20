<?php

class actionTaxonomyTermsDelete extends cmsAction {

    public function run($id) {

        if(!$id) { cmsCore::error404(); }

        $model = cmsCore::getModel('taxonomy');
		
		$res = $model->deleteTerm($id);
		
		if($res) {
		
			cmsUser::addSessionMessage(LANG_TAXONOMY_TERMS_DELETED, 'success');

		} else {
		
			cmsUser::addSessionMessage(LANG_TAXONOMY_TERMS_DELETED_ERROR, 'error');
		
		}

        $this->redirectBack();

    }

}
