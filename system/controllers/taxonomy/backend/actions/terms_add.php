<?php

class actionTaxonomyTermsAdd extends cmsAction {

    public function run($vocabulary_id = false) {

        $model = cmsCore::getModel('taxonomy');
		
        $form = $this->getForm('terms', array('add'));

        $is_submitted = $this->request->has('submit');

		$term = array();

        if($vocabulary_id){
            $term['vocabulary_id'] = $vocabulary_id;
        }

        if($is_submitted) {

            $term = $form->parse($this->request, $is_submitted);
            $errors = $form->validate($this,  $term);

            if(!$errors) {

                $this->createTerms($model, $term);
                cmsUser::addSessionMessage(LANG_TAXONOMY_TERMS_ADD_SUCCESS, 'success');

                $this->redirectToAction('vocabularies');

            } else {

				cmsUser::addSessionMessage(LANG_TAXONOMY_TERMS_ADD_ERROR, 'error');
                $this->redirectBack();

            }

        }

        return cmsTemplate::getInstance()->render('backend/term', array(
            'do' => 'add',
            'term' => $term,
            'form' => $form,
			'do' => 'add',
            'errors' => isset($errors) ? $errors : false
        ));

    }

    private function createTerms($model, $data){

        $list = explode("\n", $data['title']);

        foreach($list as $term_title){
            $term_title = trim($term_title);
            if (!$term_title) { continue; }
            $model->addTerm(
                array(
                    'vocabulary_id' => $data['vocabulary_id'],
                    'title' => $term_title
                )
            );
        }

    }

}
