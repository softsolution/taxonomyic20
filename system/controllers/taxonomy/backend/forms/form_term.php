<?php

class formTaxonomyTerm extends cmsForm {

    public function init($do) {

        return array(
            'basic' => array(
                'type' => 'fieldset',
                'title' => '',
                'childs' => array(
                    new fieldString('title', array(
                        'title' => LANG_TAXONOMY_TERMS_TITLE,
                        'rules' => array(
                            array('required')
                        )
                    )),

                    new fieldList('vocabulary_id', array(
                        'title' => LANG_TAXONOMY_TERMS_VOCABULARY,
                        'generator' => function(){
                            $model = cmsCore::getModel('taxonomy');
                            $vocabularies = $model->getVocabularies();
                            return array_collection_to_list($vocabularies, 'id', 'title');
                        },
                        'rules' => array(
                            array('required')
                        )
                    )),

                )
            ),
        );

    }

}