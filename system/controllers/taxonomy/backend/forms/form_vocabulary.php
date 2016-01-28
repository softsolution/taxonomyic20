<?php

class formTaxonomyVocabulary extends cmsForm {

    public function init($do) {

        return array(
            'basic' => array(
                'type' => 'fieldset',
                'title' => '',
                'childs' => array(
                    new fieldString('title', array(
                        'title' => LANG_TAXONOMY_VOCABULARY_TITLE,
                        'rules' => array(
                            array('max_length', 255),
                            array('required')
                        )
                    )),
                    new fieldString('name', array(
                        'title' => LANG_TAXONOMY_VOCABULARY_NAME,
                        'hint' => LANG_TAXONOMY_VOCABULARY_NAME_HINT,
                        'rules' => array(
                            array('max_length', 255),
                            array('required'),
                            array('sysname'),
                            $do == 'add' ? array('unique', 'menu', 'name') : false
                        )
                    )),
                )
            ),
            array(
                'type' => 'fieldset',
                'title' => LANG_TAXONOMY_VOCABULARY_IN_CTYPES,
                'childs' => array(
                    new fieldList('ctypes', array(
                        'is_multiple' => true,
                        'generator' => function(){
                            $content_model = cmsCore::getModel('content');
                            $ctypes = $content_model->getContentTypes();
                            $items = array_collection_to_list($ctypes, 'name', 'title');
                            return $items;
                        }
                    )),
                )
            ),
        );

    }

}