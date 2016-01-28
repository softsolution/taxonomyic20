<?php

class actionTaxonomyVocabularyDelete extends cmsAction {

    public function run($id) {

        if(!$id) { cmsCore::error404(); }

        $model = cmsCore::getModel('taxonomy');

		$res = $model->deleteVocabulary($id);

		if($res) {

			cmsUser::addSessionMessage(LANG_TAXONOMY_VOCABULARY_DELETED, 'success');

		} else {

			cmsUser::addSessionMessage(LANG_TAXONOMY_VOCABULARY_DELETED_ERROR, 'error');

		}

        $this->redirectBack();

    }

}
