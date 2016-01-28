<?php

$this->addJS('templates/default/js/jquery-ui.js');
$this->addJS('templates/default/js/jquery-cookie.js');
$this->addJS('templates/default/js/datatree.js');
$this->addCSS('templates/default/css/datatree.css');
$this->addJS('templates/default/js/admin-content.js');

$this->setPageTitle(LANG_TAXONOMY_VOCABULARIES_TERMS);
$this->addBreadcrumb(LANG_TAXONOMY_VOCABULARIES_TERMS);

if($vocabularies){
    $this->addToolButton(array(
        'class' => 'add',
        'title' => LANG_TAXONOMY_TERMS_ADD,
        'href'  => $this->href_to('term_add')
    ));
}

$this->addToolButton(array(
    'class' => 'add_folder',
    'title' => LANG_TAXONOMY_VOCABULARY_ADD,
    'href'  => $this->href_to('vocabulary_add')
));

$this->addToolButton(array(
    'class' => 'edit',
    'title' => LANG_TAXONOMY_VOCABULARY_EDIT,
    'href'  => $this->href_to('vocabulary_edit')
));

$this->addToolButton(array(
    'class' => 'delete',
    'title' => LANG_TAXONOMY_VOCABULARY_DEL,
    'href'  => $this->href_to('vocabulary_delete'),
    'onclick' => "return confirm('".LANG_TAXONOMY_VOCABULARY_DEL_CONFIRM."')"
));

?>

<table class="layout">
    <tr>
        <td class="sidebar" valign="top">

            <script type="text/javascript">
                $(function(){
                    $('.cp_toolbar .edit a').hide();
                    $('.cp_toolbar .delete a').hide();
                });
            </script>

            <div id="datatree">
                <?php if($vocabularies){ ?>
                <ul id="treeData" style="display: none">
                    <?php foreach($vocabularies as $id=>$vocabulary){ ?>
                        <li id="<?php echo $vocabulary['id'];?>" class="folder"><?php echo $vocabulary['title']; ?></li>
                    <?php } ?>
                </ul>

                <script type="text/javascript">
                    $(function(){
                        $("#datatree").dynatree({
                            onPostInit: function(isReloading, isError){
                                var path = $.cookie('icms[taxonomy_tree_path]');
                                if (!path) { path = '/0'; }
                                $("#datatree").dynatree("getTree").loadKeyPath(path, function(node, status){
                                    if(status == "loaded") {
                                        node.expand();
                                    }else if(status == "ok") {
                                        node.activate();
                                        node.expand();
                                        icms.datagrid.init();
                                    }
                                });
                            },
                            onActivate: function(node){
                                node.expand();
                                $.cookie('icms[taxonomy_tree_path]', node.getKeyPath(), {expires: 7, path: '/'});
                                var key = node.data.key;
                                icms.datagrid.setURL("<?php echo $this->href_to('terms_list'); ?>/" + key);
                                $('.cp_toolbar .add a').attr('href', "<?php echo $this->href_to('terms_add'); ?>/" + key);
                                if (key == 0){
                                    $('.cp_toolbar .edit a').hide();
                                    $('.cp_toolbar .delete a').hide();
                                } else {
                                    $('.cp_toolbar .edit a').show().attr('href', "<?php echo $this->href_to('vocabulary_edit'); ?>/" + key);
                                    $('.cp_toolbar .delete a').show().attr('href', "<?php echo $this->href_to('vocabulary_delete'); ?>/" + key);

                                }
                                icms.datagrid.loadRows();
                            }
                        });
                    });
                </script>

                <?php } else { ?>
                    <p><?php echo LANG_TAXONOMY_VOCABULARIES_NO; ?></p>
                <?php } ?>
            </div>

        </td>
        <td class="main" valign="top">
            <?php $this->renderGrid($this->href_to('terms_list'), $grid); ?>
            <div class="buttons">
                <?php echo html_button(LANG_SAVE_ORDER, 'save_button', "icms.datagrid.submit('{$this->href_to('terms_reorder')}')"); ?>
            </div>
        </td>
    </tr>
</table>