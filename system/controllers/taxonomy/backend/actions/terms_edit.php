<?php

class actionTaxonomyTermsEdit extends cmsAction {

    public function run($id) {

        $model = cmsCore::getModel('taxonomy');

        $form = $this->getForm('term', array('edit'));

        $is_submitted = $this->request->has('submit');

        $term = $model->getTerm($id);

        if($is_submitted){

            $term = $form->parse($this->request, $is_submitted);

            $errors = $form->validate($this,  $term);

            if(!$errors){

                $res = $model->updateTerm($term, $id);

                if($res){
					cmsUser::addSessionMessage(LANG_TAXONOMY_TERMS_UPDATED, 'success');
				}

            } else {

				cmsUser::addSessionMessage(LANG_TAXONOMY_TERMS_UPDATE_ERROR, 'error');

            }

            $this->redirectToAction('vocabularies');

        }

        return cmsTemplate::getInstance()->render('backend/term', array(
            'term' => $term,
            'form' => $form,
			'do' => 'edit',
            'errors' => isset($errors) ? $errors : false
        ));

    }

}
