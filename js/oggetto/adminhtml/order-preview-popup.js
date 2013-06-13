Event.observe(window, 'load', function() {
    $$('.preview-items-link').each(function(el) {
        Event.observe($(el), 'mouseover', function() {
            $(this).onclick();
        });
    });
});
function showItemsPreviewWindow(url) {
    if ($('browser_window') && typeof(Windows) != 'undefined') {
        Windows.focus('browser_window');
        return;
    }
    var dialogWindow = Dialog.info(null, {
        closable:           true,
        resizable:          false,
        draggable:          false,
        className:          'magento',
        windowClassName:    'popup-window',
        title:              'Items Ordered',
        top:                50,
        width:              780,
        zIndex:             1000,
        minHeight:          100,
        recenterAuto:       true,
        hideEffect:         Element.hide,
        showEffect:         Element.show,
        id:                 'browser_window',
        url:                url,
        onload: function() {
            $(this).style.height = 'auto';
            $(this).style.height = $(this).getDimensions().height + 45 + 'px';
        }
    });
}
function closePopup() {
    Windows.close('browser_window');
}
