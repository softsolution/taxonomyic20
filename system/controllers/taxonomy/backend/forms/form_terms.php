<?php

class formTaxonomyTerms extends cmsForm {

    public function init($do) {

        return array(
            'basic' => array(
                'type' => 'fieldset',
                'title' => '',
                'childs' => array(

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

                    new fieldText('title', array(
                        'title' => LANG_TAXONOMY_TERMS_TITLES,
                        'hint' => LANG_TAXONOMY_TERMS_TITLES_HINT,
                        'rules' => array(
                            array('required'),
                        )
                    )),

                )
            ),
        );

    }

}