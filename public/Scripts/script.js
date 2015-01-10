$(function() {
	$("td").dblclick(function(e) {
		if ($(this).children().first().is(":focus")) {
			return false;
		} else {
			var prevVal = $(this).text();
			$(this).html("<input type='text' value='" + prevVal + "' />");
			$(this).children().first().focus();

			$(this).children().first().keyup(function(e) {
				if (e.keyCode == 27) { // Escape
					$(this).parent().text(prevVal);
				} else if (e.keyCode == 13) { // Enter
					var newVal = $(this).val();
					$(this).parent().text(newVal);
				}
			});
		}

		$(this).children().first().blur(function() {
			$(this).parent().text(prevVal);
		});
	});
});

function openStoredFile() {

	var ajax = new XMLHttpRequest();
	var formdata = new FormData();
	formdata.append('sheetid', 'sheetid');

	ajax.addEventListener("load", getTableFromData, false);

	ajax.open('POST', '/projects/laravel/authapp/public/faculty/zxczc');
	ajax.send(formdata);
}

function getTableFromData(e) {
	var response = this.responseText;
	console.log(response);
}
