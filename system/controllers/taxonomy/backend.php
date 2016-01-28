<?php

class backendTaxonomy extends cmsBackend {

	public $useDefaultOptionsAction = true;
	
	public function actionIndex() {
		
		$this->redirectToAction('vocabularies');
		
	}
	
//    public function getBackendMenu() {
//
//		return array(
//			array(
//                'title' => LANG_TAXONOMY_VOCABULARIES_TERMS,
//                'url' => href_to($this->root_url, 'vocabularies')
//			),
//			array(
//				'title' => LANG_OPTIONS,
//				'url' => href_to($this->root_url, 'options')
//			),
//		);
//
//    }

}

