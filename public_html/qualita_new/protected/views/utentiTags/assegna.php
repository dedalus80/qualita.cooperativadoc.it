<?php
$this->breadcrumbs = array(
    'Tag utenti' => array('admin'),
    'Assegna tag',
);

$selectedUsers = !empty($utentiSelezionatiDettaglio) ? $utentiSelezionatiDettaglio : array();
?>

<div class="panel panel-default panel-margin panel-480">
    <div class="panel-heading">
        <h2><i class='fa fa-link'></i>&nbsp;Assegna tag agli utenti</h2>
    </div>
    <div class="panel-body">
        <?php $form = $this->beginWidget('CActiveForm', array('id' => 'utenti-tags-assegna-form', 'enableAjaxValidation' => false)); ?>

        <div class="row row-10 row-bottom">
            <div class="col-xs-12 col-md-6">
                <label for="UtentiTagAssoc_tag_id" class="control-label">Tag</label>
                <?php echo $form->dropDownList($model, 'tag_id', $tagOptions, array('empty' => 'Scegli tag', 'class' => 'form-control')); ?>
            </div>
        </div>

        <div class="row row-10 row-bottom">
            <div class="col-xs-12">
                <label for="utenti-search-input" class="control-label">Ricerca utenti (minimo 3 caratteri)</label>
                <input type="text" id="utenti-search-input" class="form-control" placeholder="Digita nome, cognome, username o email" />
                <small class="help-block">I risultati appaiono automaticamente dopo almeno 3 caratteri.</small>
            </div>
        </div>

        <div class="row row-10 row-bottom">
            <div class="col-xs-12">
                <div id="utenti-search-results" class="well tag-box-soft" style="max-height:260px;overflow:auto;display:none;"></div>
            </div>
        </div>

        <div class="row row-10 row-bottom">
            <div class="col-xs-12">
                <label class="control-label">Utenti selezionati</label>
                <div id="utenti-selected-box" class="well tag-box-soft" style="min-height:80px;"></div>
            </div>
        </div>

        <div id="utenti-selected-inputs"></div>

        <div class="panel-footer">
            <div class="pull-right">
                <?php echo CHtml::submitButton('Assegna tag', array('class' => 'btn btn-orange')); ?>
            </div>
            <div class="clearfix"></div>
        </div>

        <?php $this->endWidget(); ?>
    </div>
</div>

<script type="text/javascript">
    (function initTagAssegnaPage() {
        if (!window.jQuery) {
            setTimeout(initTagAssegnaPage, 50);
            return;
        }

        var $ = window.jQuery;
        var selectedMap = <?php echo CJSON::encode($selectedUsers); ?>;

        function renderSelected() {
            var box = $('#utenti-selected-box');
            var inputs = $('#utenti-selected-inputs');
            box.empty();
            inputs.empty();

            var keys = Object.keys(selectedMap);
            if (!keys.length) {
                box.html('<span class="text-muted">Nessun utente selezionato</span>');
                return;
            }

            for (var i = 0; i < keys.length; i++) {
                var id = keys[i];
                var user = selectedMap[id];
                box.append('<span class="label label-primary tag-label tag-label-primary">' + user.label + ' <a href="#" class="remove-selected-user tag-label-remove" data-id="' + id + '">×</a></span>');
                inputs.append('<input type="hidden" name="utenti_ids[]" value="' + id + '" />');
            }
        }

        function renderResults(results) {
            var box = $('#utenti-search-results');
            box.empty();

            if (!results.length) {
                box.show().html('<div class="text-muted">Nessun risultato</div>');
                return;
            }

            for (var i = 0; i < results.length; i++) {
                var row = results[i];
                var disabled = selectedMap[row.id] ? ' disabled="disabled" ' : '';
                box.append('<div class="checkbox" style="margin:6px 0;"><label><input type="checkbox" class="search-user-checkbox" data-id="' + row.id + '" data-label="' + row.label.replace(/"/g, '&quot;').replace(/'/g, '&#39;') + '"' + disabled + '> ' + row.label + ' - ' + row.email + '</label></div>');
            }

            box.show();
        }

        function searchUsers(term) {
            $.ajax({
                url: '<?php echo Yii::app()->createUrl('utentiTags/ajaxUserSearch'); ?>',
                type: 'POST',
                dataType: 'json',
                data: {term: term},
                success: function (response) {
                    var results = response && response.results ? response.results : [];
                    renderResults(results);
                }
            });
        }

        $('#utenti-search-input').on('keyup', function () {
            var term = $.trim($(this).val());
            if (term.length < 3) {
                $('#utenti-search-results').hide().empty();
                return;
            }
            searchUsers(term);
        });

        $(document).on('change', '.search-user-checkbox', function () {
            if (!this.checked) {
                return;
            }

            var id = $(this).data('id');
            selectedMap[id] = {
                id: id,
                label: $(this).data('label')
            };
            renderSelected();
            $(this).prop('checked', false);
            $(this).prop('disabled', true);
        });

        $(document).on('click', '.remove-selected-user', function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            delete selectedMap[id];
            renderSelected();
            $('.search-user-checkbox[data-id="' + id + '"]').prop('disabled', false);
        });

        renderSelected();
    })();
</script>
