/*!
 * Patch per rendere Bootstrap 3 compatibile con jQuery ≥ 3.5
 * https://github.com/twbs/bootstrap/issues/30557#issuecomment-613833278
 */

(function($){
    if ($.fn.modal && typeof $.fn.modal.Constructor === 'function') {
        var proto = $.fn.modal.Constructor.prototype;
        var _hideModal = proto.hideModal;

        proto.hideModal = function(){
            var that = this;
            if (this.$element && typeof this.$element.triggerHandler === 'function') {
                this.$element.one('hidden.bs.modal', function(){
                    that.$element.data('bs.modal', null);
                });
            }
            _hideModal.call(this);
        };
    }
})(jQuery);
