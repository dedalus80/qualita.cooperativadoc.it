<div class="page-header">
    <h1 class="no-margin">
        Anteprima Questionario
        <small>Versione <?php echo $model->version_number; ?></small>
    </h1>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        <strong>Dati Partecipante</strong>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="form-group col-md-6">
                <label>Nome</label>
                <input type="text" class="form-control" placeholder="Nome" disabled>
            </div>
            <div class="form-group col-md-6">
                <label>Cognome</label>
                <input type="text" class="form-control" placeholder="Cognome" disabled>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                <label>Email</label>
                <input type="email" class="form-control" placeholder="Email" disabled>
            </div>
            <div class="form-group col-md-6">
                <label>Cellulare</label>
                <input type="tel" class="form-control" placeholder="Cellulare" disabled>
            </div>
        </div>
    </div>
</div>
<?php foreach ($sections as $sectionIndex => $section): ?>
    <div class="panel panel-default section-block">
        <div class="panel-heading">
            <strong><?php echo CHtml::encode($section->title); ?></strong>
        </div>
        <div class="panel-body">
            <?php $questionNumber = 1; ?>
            <?php foreach ($section->questions as $question): ?>
                <div class="form-group">
                    <!-- Riga domanda con numerazione -->
                    <label><strong><?php echo $questionNumber++ . '. ' . CHtml::encode($question->text); ?></strong></label>

                    <!-- Riga risposte -->
                    <div>
                        <?php if ($question->type == 'text'): ?>
                            <textarea class="form-control" placeholder="Risposta libera" disabled></textarea>

                        <?php elseif ($question->type == 'option'): ?>
                            <?php
                            $options = ['Poco', 'Abbastanza', 'Molto'];
                            $selected = 'Abbastanza'; // Esempio statico
                            foreach ($options as $opt): ?>
                                <label class="radio-inline">
                                    <input type="radio" disabled <?php echo ($opt == $selected) ? 'checked' : ''; ?>>
                                    <?php echo $opt; ?>
                                </label>
                            <?php endforeach; ?>

                        <?php elseif ($question->type == 'range'): ?>
                            <?php
                            $rangeLabels = ['1','2','3','4','5'];
                            $selected = '3'; // Esempio statico
                            foreach ($rangeLabels as $val): ?>
                                <label class="radio-inline">
                                    <input type="radio" disabled <?php echo ($val == $selected) ? 'checked' : ''; ?>>
                                    <?php echo $val; ?>
                                </label>
                            <?php endforeach; ?>
                            <p class="help-block"><small>1 = Poco soddisfatto, 5 = Estremamente soddisfatto</small></p>

                        <?php elseif ($question->type == 'custom'): ?>
                            <?php
                            $customOptions = $question->options ? array_map(function($opt) { return $opt->option_text; }, $question->options) : [];
                            if ($question->is_multiple):
                                $selectedCustom = !empty($customOptions) ? array($customOptions[0]) : [];
                                foreach ($customOptions as $opt): ?>
                                    <label class="checkbox-inline">
                                        <input type="checkbox" disabled <?php echo in_array($opt, $selectedCustom) ? 'checked' : ''; ?>>
                                        <?php echo CHtml::encode($opt); ?>
                                    </label>
                                <?php endforeach;
                            else:
                                $selectedCustom = !empty($customOptions) ? $customOptions[0] : null;
                                foreach ($customOptions as $opt): ?>
                                    <label class="radio-inline">
                                        <input type="radio" disabled <?php echo ($opt == $selectedCustom) ? 'checked' : ''; ?>>
                                        <?php echo CHtml::encode($opt); ?>
                                    </label>
                                <?php endforeach;
                            endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php endforeach; ?>