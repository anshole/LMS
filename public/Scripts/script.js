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
