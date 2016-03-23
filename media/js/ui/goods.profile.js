$(document).ready(function(){
	$(".gallery a[rel=lightbox]").lightBox({
		imageLoading: url_base + "media/js/libraries/lightbox/images/lightbox-ico-loading.gif",
		imageBtnPrev:url_base + "media/js/libraries/lightbox/images/lightbox-btn-prev.gif",
		imageBtnNext:url_base + "media/js/libraries/lightbox/images/lightbox-btn-next.gif",
		imageBtnClose:url_base + "media/js/libraries/lightbox/images/lightbox-btn-close.gif",
		imageBlank:url_base + "media/js/libraries/lightbox/images/lightbox-blank.gif"
	});
});