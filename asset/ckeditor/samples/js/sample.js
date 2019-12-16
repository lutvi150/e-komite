/**
 * Copyright (c) 2003-2019, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or https://ckeditor.com/legal/ckeditor-oss-license
 */

/* exported initSample */

if (CKEDITOR.env.ie && CKEDITOR.env.version < 9)
	CKEDITOR.tools.enableHtml5Elements(document);

// The trick to keep the editor in the sample quite small
// unless user specified own height.
CKEDITOR.config.height = 150;
CKEDITOR.config.width = 'auto';

var initSample = (function () {
	var wysiwygareaAvailable = isWysiwygareaAvailable(),
		isBBCodeBuiltIn = !!CKEDITOR.plugins.get('bbcode');

	return function () {
		var soal = CKEDITOR.document.getById('soal');
		var jawaban_a = CKEDITOR.document.getById('jawaban_a');
		var jawaban_b = CKEDITOR.document.getById('jawaban_b');
		var jawaban_c = CKEDITOR.document.getById('jawaban_c');
		var jawaban_d = CKEDITOR.document.getById('jawaban_d');

		
		// Depending on the wysiwygarea plugin availability initialize classic or inline editor.
			CKEDITOR.replace('soal');
			CKEDITOR.replace('jawaban_a');
			CKEDITOR.replace('jawaban_b');
			CKEDITOR.replace('jawaban_c');
			CKEDITOR.replace('jawaban_d');
		
	};

	function isWysiwygareaAvailable() {
		// If in development mode, then the wysiwygarea must be available.
		// Split REV into two strings so builder does not replace it :D.
		if (CKEDITOR.revision == ('%RE' + 'V%')) {
			return true;
		}

		return !!CKEDITOR.plugins.get('wysiwygarea');
	}
})();
