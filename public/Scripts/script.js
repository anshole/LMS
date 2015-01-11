$(document).on("dblclick", "td", function() {
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
	$('#openStoredSheet').after(response);
		$('#sheet').DataTable( {
	        dom: 'T<"clear">lfrtip',
	        tableTools: {
	            "sSwfPath": "http://cdn.datatables.net/tabletools/2.2.2/swf/copy_csv_xls_pdf.swf"
	        }
	   } );
}

function createNewSheet() {

	createNewDatatable();
}

function createNewDatatable() {
	$('#addRow').show();
	$('#example').show();
	var t = $('#example').DataTable({
	        dom: 'T<"clear">lfrtip',
	        tableTools: {
	            "sSwfPath": "http://cdn.datatables.net/tabletools/2.2.2/swf/copy_csv_xls_pdf.swf"
	        }
	   });

    var counter = 1;
 
    $('#addRow').on('click', function () {
        t.row.add( [
            counter +'.1',
            counter +'.2',
            counter +'.3',
            counter +'.4',
            counter +'.5'
        ] ).draw();
 
        counter++;
    } );

    // Automatically add a first row of data
    $('#addRow').click();
}