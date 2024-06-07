---
to: blocks/<%= title.toLowerCase().replaceAll(' ', '-') %>/block.json
---
{
	"apiVersion": 2,
	"name": "<%= title.toLowerCase().replaceAll(' ', '-') %>",
	"title": "<%= title %>",
	"description": "<%= description %>",
	"category": "",
	"icon": "",
	"acf": {
			"mode": "preview",
			"renderTemplate": "<%= title.toLowerCase().replaceAll(' ', '-') %>.php"
	},
	"supports": {
		"color" : {
			"text" : true,
			"background" : true,
			"gradients" : true
		},
		"background" : true,
		"anchor": true
	},
	"script": "<%= title.toLowerCase().replaceAll(' ', '-') %>",
	"style": "<%= title.toLowerCase().replaceAll(' ', '-') %>"
}
