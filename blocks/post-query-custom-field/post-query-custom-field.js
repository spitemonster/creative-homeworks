
window.addEventListener('DOMContentLoaded', () => {
	const isEditor =
		typeof wp !== "undefined" && typeof wp.blocks !== "undefined";

	if (document.readyState == 'interactive' || document.readystate == 'complete') {
			initPostQueryCustomField(isEditor);
	}
})

function initPostQueryCustomField(isEditor) {
	// add block code here
	if (isEditor) {
		console.log("new-block block ready in editor");
	} else {
		console.log("new-block block ready in front end");
	}
}