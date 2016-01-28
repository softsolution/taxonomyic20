<?php

class actionTaxonomyVocabularyEdit extends cmsAction {

    public function run($id) {

        $model = cmsCore::getModel('taxonomy');
		
        $form = $this->getForm('vocabulary', array('add'));

        $is_submitted = $this->request->has('submit');

        $vocabulary = $model->getVocabulary($id);

        if($is_submitted){

            $vocabulary = $form->parse($this->request, $is_submitted);
            $errors = $form->validate($this,  $vocabulary);

            if(!$errors){

                $res = $model->updateVocabulary($vocabulary, $id);

                if($res){
					cmsUser::addSessionMessage(LANG_TAXONOMY_VOCABULARY_UPDATED, 'success');
				}

            } else {
				cmsUser::addSessionMessage(LANG_TAXONOMY_VOCABULARY_UPDATE_ERROR, 'error');
            }
			
            $this->redirectToAction('vocabularies');

        }

        return cmsTemplate::getInstance()->render('backend/vocabulary', array(
            'do' => 'add',
            'vocabulary' => $vocabulary,
            'form' => $form,
			'do' => 'edit',
            'errors' => isset($errors) ? $errors : false
        ));

    }

}
