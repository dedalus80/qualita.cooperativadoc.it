<div class="modal fade" id="visibility-rules-modal" tabindex="-1" role="dialog" aria-labelledby="visibility-rules-modal-label">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Chiudi">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="visibility-rules-modal-label">
                    <i class="fa fa-filter"></i> Condizioni di visualizzazione
                </h4>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger visibility-rules-modal-error" style="display:none;"></div>

                <p class="text-muted small visibility-rules-linear-hint">
                    <i class="fa fa-info-circle"></i>
                    Per coerenza con l'ordine di compilazione, come condizione è possibile selezionare solo domande già mostrate prima di questa sezione/domanda.
                </p>

                <div class="form-group">
                    <label>Combina le regole con</label>
                    <div>
                        <label class="radio-inline">
                            <input type="radio" name="visibility-rules-combine" value="or" checked> OR (almeno una)
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="visibility-rules-combine" value="and"> AND (tutte)
                        </label>
                    </div>
                </div>

                <div class="visibility-rules-list"></div>

                <button type="button" class="btn btn-default btn-sm visibility-rules-add-btn">
                    <i class="fa fa-plus"></i> Aggiungi regola
                </button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Annulla</button>
                <button type="button" class="btn btn-primary visibility-rules-confirm-btn">
                    <i class="fa fa-check"></i> Conferma condizioni
                </button>
            </div>
        </div>
    </div>
</div>
