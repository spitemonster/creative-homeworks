---
to: blocks/<%= title.toLowerCase().replaceAll(' ', '-') %>/<%= title.toLowerCase().replaceAll(' ', '-') %>.js
---
<% functionName = 'init' + title.replaceAll(/(?:^\w|[A-Z]|\b\w)/g, (ltr, idx) => ltr.toUpperCase()).replaceAll(/\s+/g, ''); %>
window.addEventListener('DOMContentLoaded', () => {
	const isEditor =
		typeof wp !== "undefined" && typeof wp.blocks !== "undefined";

	if (document.readyState == 'interactive' || document.readystate == 'complete') {
			<%= functionName %>(isEditor);
	}
})

function <%= functionName %>(isEditor) {
	// add block code here
	if (isEditor) {
		console.log("new-block block ready in editor");
	} else {
		console.log("new-block block ready in front end");
	}
}