<?php

	$this->addBreadcrumb(LANG_TAXONOMY_VOCABULARIES, $this->href_to('vocabulary'));

    if ($do=='add'){
		$this->addBreadcrumb(LANG_TAXONOMY_VOCABULARY_ADD);
    }

    if ($do=='edit'){
		$this->addBreadcrumb(LANG_TAXONOMY_VOCABULARY_EDIT);
    }

    $this->addToolButton(array(
        'class' => 'save',
        'title' => LANG_SAVE,
        'href'  => "javascript:icms.forms.submit()"
    ));

    $this->addToolButton(array(
        'class' => 'cancel',
        'title' => LANG_CANCEL,
        'href'  => $this->href_to('vocabularies')
    ));

?>

<?php
    $this->renderForm($form, $vocabulary, array(
        'action' => '',
        'method' => 'post'
    ), $errors);
?>