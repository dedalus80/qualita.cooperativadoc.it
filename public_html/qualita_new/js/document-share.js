(function ($) {
    'use strict';

    function getShareData($button) {
        return {
            url: $button.data('share-url') || $button.attr('href'),
            title: $button.data('share-title') || document.title,
            filename: $button.data('share-filename') || 'documento',
            emailSubject: $button.data('share-email-subject') || 'Documento condiviso',
            emailBody: $button.data('share-email-body') || ''
        };
    }

    function buildMailto(data) {
        var body = data.emailBody || ('Puoi scaricare il documento dal seguente link:\n' + data.url);

        return 'mailto:?subject=' + encodeURIComponent(data.emailSubject) + '&body=' + encodeURIComponent(body);
    }

    function copyLink(url) {
        if (navigator.clipboard && navigator.clipboard.writeText) {
            return navigator.clipboard.writeText(url);
        }

        return $.Deferred(function (deferred) {
            var input = $('<input type="text" readonly>');
            input.css({
                position: 'absolute',
                left: '-9999px'
            });
            $('body').append(input);
            input.val(url).select();

            try {
                if (document.execCommand('copy')) {
                    deferred.resolve();
                } else {
                    deferred.reject();
                }
            } catch (error) {
                deferred.reject(error);
            }

            input.remove();
        }).promise();
    }

    function showFallback(data) {
        var message = 'Condivisione nativa non disponibile.\n\n' +
            'Premi OK per preparare una email con il link al documento.\n' +
            'Premi Annulla per copiare il link negli appunti.';

        if (window.confirm(message)) {
            window.location.href = buildMailto(data);
            return;
        }

        copyLink(data.url).done(function () {
            window.alert('Link copiato negli appunti.');
        }).fail(function () {
            window.prompt('Copia manualmente il link al documento:', data.url);
        });
    }

    function canTryFileShare() {
        return navigator.canShare && navigator.share && window.fetch && window.File;
    }

    function shareFile(data) {
        if (!canTryFileShare()) {
            return $.Deferred().resolve(false).promise();
        }

        return fetch(data.url, {
                credentials: 'same-origin'
            })
            .then(function (response) {
                if (!response.ok) {
                    return false;
                }

                return response.blob();
            })
            .then(function (blob) {
                var file;

                if (blob === false) {
                    return false;
                }

                file = new File([blob], data.filename, {
                    type: blob.type || 'application/octet-stream'
                });

                if (!navigator.canShare({ files: [file] })) {
                    return false;
                }

                return navigator.share({
                    files: [file],
                    title: data.title,
                    text: 'Scarica il documento: ' + data.title
                }).then(function () {
                    return true;
                });
            })
            .catch(function (error) {
                if (error && error.name === 'AbortError') {
                    return true;
                }

                return false;
            });
    }

    function shareUrl(data) {
        if (!navigator.share) {
            return $.Deferred().resolve(false).promise();
        }

        return navigator.share({
                    title: data.title,
                    text: 'Scarica il documento: ' + data.title,
                    url: data.url
                })
                .then(function () {
                    return true;
                })
                .catch(function (error) {
                if (error && error.name === 'AbortError') {
                    return true;
                }

                    return false;
                });
    }

    function shareDocument(data) {
        shareFile(data).then(function (shared) {
            if (shared) {
                return true;
            }

            return shareUrl(data);
        }).then(function (shared) {
            if (!shared) {
                showFallback(data);
            }
        });
    }

    $(document).on('click', '.document-share-button', function (event) {
        event.preventDefault();
        event.stopPropagation();
        shareDocument(getShareData($(this)));
    });
})(jQuery);
