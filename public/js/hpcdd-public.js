(function( $ ) {
	'use strict';

	function lvl2() {
		$('#lvl1').change(function () {
			var lvl1Val = $('#lvl1').val();

			//console.log(lvl1Val);

			$.ajax({
				url: "/wp-admin/admin-ajax.php",
				method: 'POST',
				data: {
					'action': 'getLvl2',
					'lvl1': document.getElementById('lvl1').value
				},
				dataType: 'json',
				success: function (data) {
					$('#lvl2').append(data);
					//console.log(data[0]);
				},
				error: function (errorThrown) {
					console.log(errorThrown);
				}
			});
		});
	}
	$(document).ready(lvl2);

	function lvl3() {
		$('#lvl2').change(function () {
			var lvl2Val = $('#lvl2').val();

			//console.log(lvl2Val);

			$.ajax({
				url: "/wp-admin/admin-ajax.php",
				method: 'POST',
				data: {
					'action': 'getLvl3',
					'lvl2': document.getElementById('lvl2').value
				},
				dataType: 'json',
				success: function (data) {
					$('#lvl3').append(data);
					//console.log(data[0]);
				},
				error: function (errorThrown) {
					console.log(errorThrown);
				}
			});
		});
	}
	$(document).ready(lvl3);

	function lvl4() {
		$('#lvl3').change(function () {
			var lvl3Val = $('#lvl3').val();

			//console.log(lvl3Val);

			$.ajax({
				url: "/wp-admin/admin-ajax.php",
				method: 'POST',
				data: {
					'action': 'getLvl4',
					'lvl3': document.getElementById('lvl3').value
				},
				dataType: 'json',
				success: function (data) {
					$('#lvl4').append(data);
					//console.log(data[0]);
				},
				error: function (errorThrown) {
					console.log(errorThrown);
				}
			});
		});
	}
	$(document).ready(lvl4);

})( jQuery );
