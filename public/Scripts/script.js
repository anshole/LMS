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

	//console.log(response);
	$('#dNew').after(response);
	var table = $('#sheet').DataTable( {
	        dom: 'T<"clear">lfrtip',
	        tableTools: {
	            "sSwfPath": "http://cdn.datatables.net/tabletools/2.2.2/swf/copy_csv_xls_pdf.swf"
	        }
	   });

	var table = $('#sheet').dataTable();
	console.log(table.fnGetData());
}

function createNewSheet() {

	createNewDatatable();
}

/*
* Temporary way. There is no decent way to dynamically create datatables on the fly. Eventually I'll move to
* using just basic html tables when creating new tables, and once it's data has been stored I'll then pull it
* and display as datatable.
*/
function createNewDatatable() {

	var oldData = [['null', 'null ', 'null ', 'null ', 'null '], ['null ', 'null ', 'null ', 'null ', 'null ']];

	$('#addRow').show();
	$('#example').show();
	var t = $('#example').DataTable({
			data: oldData,
	        dom: 'T<"clear">lfrtip',
	        "bProcessing": true,
	        "bDestroy" : true,
	        "bDeferRender": true,
        	"bInfo" : false,
       		"bSort" : false,
       		"bFilter": false,
       		"bPagination": false,
	        tableTools: {
	            "sSwfPath": "http://cdn.datatables.net/tabletools/2.2.2/swf/copy_csv_xls_pdf.swf"
	        }
	});

    var counter = 1;


 
    $('#addRow').on('click', function () {
    	var table = $('#example').dataTable();
    	var data = table.fnGetData();
    	var col_num = table.fnSettings().aoColumns.length;
    	var row_num = table.fnSettings().fnRecordsTotal();

    	var newRowData = new Array(col_num);
    	for (var i = 0; i < col_num; i++) {
    		newRowData[i] = data[1][i];
    	}

    	t.row.add(newRowData).draw();

    });

    $('#addColumn').on('click', function () {
    	var table = $('#example').dataTable();
    	var data = table.fnGetData();
    	var col_num = table.fnSettings().aoColumns.length;
    	var row_num = table.fnSettings().fnRecordsTotal();

    	// console.log(table.fnGetData());

    	var newData = new Array(row_num);

    	for (var i = 0; i < row_num; i++) {

    		newData[i] = new Array(col_num+1);

    		for (var j = 0; j < col_num; j++) {
    			newData[i][j] = data[i][j];
    		}

    		newData[i][col_num] = ("NewColumn");
    	}

    	//t.clear();
    	t.destroy();

    	//table.fnClearTable();

    	table.fnDestroy();

    	$('#examplethead').append("<th>Column</th>");
    	$('#exampletfoot').append("<th>Column</th>");


    	var insert = $('#example').DataTable({
    		data: newData,
	        dom: 'T<"clear">lfrtip',
	        "paging": false,
	        "bProcessing": true,
	        "bDestroy" : true,
	        "bDeferRender": true,
        	"bInfo" : false,
       		"bSort" : false,
       		"bFilter": false,
       		"bPagination": false,
	        tableTools: {
	            "sSwfPath": "http://cdn.datatables.net/tabletools/2.2.2/swf/copy_csv_xls_pdf.swf"
	        }
		});

		//insert.draw();

    } );

    $('#addRow').click();
}