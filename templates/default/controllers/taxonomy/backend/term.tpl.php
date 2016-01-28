<?php

	$this->addBreadcrumb(LANG_TAXONOMY_VOCABULARIES_TERMS, $this->href_to('vocabularies'));

    if ($do=='add'){
		$this->addBreadcrumb(LANG_TAXONOMY_TERMS_ADD);
    }

    if ($do=='edit'){
		$this->addBreadcrumb(LANG_TAXONOMY_TERMS_EDIT);
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
    $this->renderForm($form, $term, array(
        'action' => '',
        'method' => 'post'
    ), $errors);
?>