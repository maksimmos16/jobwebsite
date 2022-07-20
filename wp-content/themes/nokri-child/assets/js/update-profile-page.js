jQuery(".btn").click(function () {
	function offBeforeUnload(event) {
		jQuery(window).off('beforeunload');
	}
}
	function windowBeforeUnload() {
		 return "some message";
	}
	jQuery(window).on('beforeunload', windowBeforeUnload);