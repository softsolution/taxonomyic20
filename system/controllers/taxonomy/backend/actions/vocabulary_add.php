<?php

class actionTaxonomyVocabularyAdd extends cmsAction {

    public function run() {

        $model = cmsCore::getModel('taxonomy');
		
        $form = $this->getForm('vocabulary', array('add'));

        $is_submitted = $this->request->has('submit');
		
		$vocabulary = array();

        if($is_submitted) {

            $vocabulary = $form->parse($this->request, $is_submitted);
            $errors = $form->validate($this,  $vocabulary);

            if(!$errors) {

                $id = $model->addVocabulary($vocabulary);

                if($id) {
					cmsUser::addSessionMessage(LANG_TAXONOMY_VOCABULARY_CREATED, 'success');
                }

                $this->redirectToAction('vocabularies');

            } else {
				cmsUser::addSessionMessage(LANG_TAXONOMY_VOCABULARY_ERROR, 'error');
                $this->redirectBack();
            }

        }

        return cmsTemplate::getInstance()->render('backend/vocabulary', array(
            'do' => 'add',
            'vocabulary' => $vocabulary,
            'form' => $form,
			'do' => 'add',
            'errors' => isset($errors) ? $errors : false
        ));

    }

}
