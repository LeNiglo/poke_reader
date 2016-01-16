(function($) {

	var reloadTable = function() {

		$('.blackground').show();

		$('table tbody').load('table-content.php', {
			sort: $('select#sort').val(),
			search: $('input#search').val()
		}, function() {
			$('.blackground').hide();
		});

	};

	$(document).ready(function() {

		reloadTable();

		$('select#sort').change(reloadTable);
		$('input#search').change(reloadTable);
		$('form#poke_reader').submit(function (e) {
			e.preventDefault();
			e.stopPropagation();
			return false;
		})
	});

})(jQuery)
