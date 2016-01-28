<?php

class modelTaxonomy extends cmsModel {

//============================================================================//
//============================================================================//

    public function __call($name, $arguments){
        exit( "вызван несуществующий метод \"".$name."\"" );
    }

//============================================================================//
//============================================================================//

    public function getVocabularies() {
		return $this->get('taxonomy_vocabulary');
	}

	public function getVocabulary($id) {

		$item = $this->getItemById('taxonomy_vocabulary', $id);
        $item['ctypes'] = $this->getVocabularyCtypes($id);

		if (!$item) { return false; }

		return $item;

	}

    public function getVocabularyCtypes($id){

        $this->select('i.ctype', 'ctype')->
        filterEqual('i.vocabulary_id', $id);

        return $this->get('taxonomy_bind', function($item, $model){
            return $item['ctype'];
        });

    }

	public function addVocabulary($item) {

        $item['name']    = $item['name'] ? $item['name'] : $item['title'];
        $item['name']    = $this->getTaxonomySlug($item['name']);

        $ctypes = $item['ctypes'];
        unset($item['ctypes']);

        $id = $this->insert('taxonomy_vocabulary', $item);
        $this->addVocabularyCtypeBind($ctypes, $id);

		return $id;

	}

    public function updateVocabulary($item, $id) {

        $item['name']    = $item['name'] ? $item['name'] : $item['title'];
        $item['name']    = $this->getTaxonomySlug($item['name']);

        $ctypes = $item['ctypes'];
        unset($item['ctypes']);

        $this->update('taxonomy_vocabulary', $id, $item);
        $this->addVocabularyCtypeBind($ctypes, $id);

        return true;
    }

	public function deleteVocabulary($id) {

		$res = $this->delete('taxonomy_vocabulary', $id);
		if ($res) {
            $this->db->delete('taxonomy_bind', 'vocabulary_id = '.$id);
		}

		return $res;

	}

    public function addVocabularyCtypeBind($ctypes, $id) {

        $this->db->delete('taxonomy_bind', 'vocabulary_id = '.$id);
        if(count($ctypes)){
            foreach($ctypes as $ctype){
                $this->insert('taxonomy_bind', array('vocabulary_id' => $id, 'ctype' => $ctype));
            }
        }

        return true;

    }

//============================================================================//
//============================================================================//

    public function setVocabularyId($vocabulary_id){
        return $this->filterEqual('i.vocabulary_id', $vocabulary_id);
    }

    public function getTerms(){

        $this->orderBy('ordering', 'asc');

        $this->select("IFNULL(v.name, '')", 'vocabulary_name');
        $this->joinLeft('taxonomy_vocabulary', 'v', 'v.id = i.vocabulary_id');

        return $this->get('taxonomy_terms', function($term){
            return $term;
        });

    }

    public function getTerm($id) {

        $item = $this->getItemById('taxonomy_terms', $id);
        if (!$item) { return false; }
        return $item;

    }

    public function addTerm($item) {

        //$item['name']    = $item['name'] ? $item['name'] : $item['title'];
        //$item['name']    = $this->getVocabularySlug($item['name']);

        $this->filterEqual('vocabulary_id', $item['vocabulary_id']);

        $item['ordering'] = $this->getNextOrdering('taxonomy_terms');

        $id = $this->insert('taxonomy_terms', $item);

        return $id;

    }

    public function updateTerm($item, $id) {

        //$item['name']    = $item['name'] ? $item['name'] : $item['title'];
        //$item['name']    = $this->getVocabularySlug($item['name']);
        $this->update('taxonomy_terms', $id, $item);

        return true;
    }

    public function deleteTerm($id) {

        $res = $this->delete('taxonomy_terms', $id);
        if ($res) {
            //$this->db->delete('taxonomy_bind', 'vocabulary_id = '.$id);
        }

        return $res;

    }

    public function reorderTerms($items_ids_list){

        $this->reorderByList('taxonomy_terms', $items_ids_list);

        return true;

    }

//============================================================================//
//============================================================================//

    public function getTaxonomySlug($name){

        $name = trim($name);
        return lang_slug($name);

    }

} ?>