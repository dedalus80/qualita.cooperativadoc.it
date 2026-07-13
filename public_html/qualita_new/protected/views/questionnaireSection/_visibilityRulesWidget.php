<?php
/**
 * Widget compatto per regole di visibilità.
 *
 * @var string $inputName
 * @var string $targetType question|section
 * @var string $entityKey
 * @var array $rulesetData
 * @var int|null $excludeQuestionId
 * @var array $catalog
 * @var string $checkboxLabel
 */
$rulesetData = isset($rulesetData) ? $rulesetData : VisibilityRulesHelper::emptyRuleset();
$isEnabled = !empty($rulesetData['enabled']) && !empty($rulesetData['rules']);
$summary = $isEnabled ? VisibilityRulesHelper::formatSummary($rulesetData, $catalog) : '';
$jsonValue = CJSON::encode($rulesetData);
?>
<div class="visibility-rules-widget"
     data-entity-key="<?php echo CHtml::encode($entityKey); ?>"
     data-target-type="<?php echo CHtml::encode($targetType); ?>"
     <?php if (!empty($excludeQuestionId)): ?>data-exclude-question-id="<?php echo (int) $excludeQuestionId; ?>"<?php endif; ?>>
    <div class="checkbox" style="margin-bottom: 5px;">
        <label>
            <input type="checkbox"
                   class="visibility-rules-enable-checkbox"
                   <?php echo $isEnabled ? 'checked' : ''; ?>>
            <?php echo CHtml::encode($checkboxLabel); ?>
        </label>
        <?php if ($isEnabled): ?>
            <button type="button" class="btn btn-xs btn-default visibility-rules-edit-btn" style="margin-left: 8px;">
                <i class="fa fa-pencil"></i> Modifica
            </button>
        <?php endif; ?>
    </div>
    <div class="visibility-rules-summary text-muted small" style="<?php echo $summary ? '' : 'display:none;'; ?>">
        <i class="fa fa-filter"></i>
        <span class="visibility-rules-summary-text"><?php echo CHtml::encode($summary); ?></span>
    </div>
    <input type="hidden"
           name="<?php echo CHtml::encode($inputName); ?>"
           class="visibility-rules-json-input"
           value="<?php echo CHtml::encode($jsonValue); ?>">
</div>
