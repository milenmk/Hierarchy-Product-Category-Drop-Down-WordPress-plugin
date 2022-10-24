(function( $ ) {
	'use strict';

	function lvl2() {
		$(".lvl1").change(function () {

			var lvl1Val = $(this).val();

			$(".lvl2").find("option:gt(0)").remove();
			$(".lvl3").find("option:gt(0)").remove();
			$(".lvl4").find("option:gt(0)").remove();

			//console.log(lvl1Val);

			$(".hpcdd-form").attr("style", "opacity:0.5; -moz-opacity:0.5; filter:alpha(opacity=50)");
			$(".hpcdd-loader").show();

			$.ajax({
				url: "/wp-admin/admin-ajax.php",
				method: 'POST',
				data: {
					'action': 'getLvl2',
					'lvl1': lvl1Val
				},
				dataType: 'json',
				success: function (data) {
					$(".lvl2").append(data);
					$(".hpcdd-loader").hide();
					$(".hpcdd-form").attr("style", "opacity:none; -moz-opacity: none;");
					$(".lvl2").prop("disabled", false);
					//console.log(data[0]);
				},
				error: function (errorThrown) {
					console.log(errorThrown);
				},
			});

			if (my_options.levels == 1) {
				$(".hpcdd-submit").prop("disabled", false);
				const button = document.querySelectorAll('.button');
				button.forEach(button => {
					// Remove class from each element
					button.classList.remove('hpcddsd');

					// Add class to each element
					// box.classList.add('small');
				});
			}
		});
	}
	$(document).ready(lvl2);

	function lvl3() {
		$(".lvl2").change(function () {
			var lvl2Val = $(this).val();
			//var levels='<?php echo get_option("hpcdd_levels_setting"); ?>';

			$(".lvl3").find("option:gt(0)").remove();
			$(".lvl4").find("option:gt(0)").remove();

			//console.log(lvl2Val);

			$(".hpcdd-form").attr("style", "opacity:0.5; -moz-opacity:0.5; filter:alpha(opacity=50)");
			$(".hpcdd-loader").show();

			$.ajax({
				url: "/wp-admin/admin-ajax.php",
				method: 'POST',
				data: {
					'action': 'getLvl3',
					'lvl2': lvl2Val
				},
				dataType: 'json',
				success: function (data) {
					$(".lvl3").append(data);
					$(".hpcdd-loader").hide();
					$(".hpcdd-form").attr("style", "opacity:none; -moz-opacity: none;");
					$(".lvl3").prop("disabled", false);
					//console.log(data[0]);
				},
				error: function (errorThrown) {
					console.log(errorThrown);
				}
			});

			if (my_options.levels == 2) {
				$(".hpcdd-submit").prop("disabled", false);
				const button = document.querySelectorAll('.button');
				button.forEach(button => {
					// Remove class from each element
					button.classList.remove('hpcddsd');

					// Add class to each element
					// box.classList.add('small');
				});
			}
		});
	}
	$(document).ready(lvl3);

	function lvl4() {
		$(".lvl3").change(function () {

			var lvl3Val = $(this).val();

			$(".lvl4").find("option:gt(0)").remove();

			//console.log(lvl3Val);

			$(".hpcdd-form").attr("style", "opacity:0.5; -moz-opacity:0.5; filter:alpha(opacity=50)");
			$(".hpcdd-loader").show();

			$.ajax({
				url: "/wp-admin/admin-ajax.php",
				method: 'POST',
				data: {
					'action': 'getLvl4',
					'lvl3': lvl3Val
				},
				dataType: 'json',
				success: function (data) {
					$(".lvl4").append(data);
					$(".hpcdd-loader").hide();
					$(".hpcdd-form").attr("style", "opacity:none; -moz-opacity: none;");
					$(".lvl4").prop("disabled", false);
					//console.log(data[0]);
				},
				error: function (errorThrown) {
					console.log(errorThrown);
				}
			});

			if (my_options.levels == 3) {
				$(".hpcdd-submit").prop("disabled", false);
				const button = document.querySelectorAll('.button');
				button.forEach(button => {
					// Remove class from each element
					button.classList.remove('hpcddsd');

					// Add class to each element
					// box.classList.add('small');
				});
			}
		});

		$(".lvl4").change(function () {
			if (my_options.levels == 4) {
				$(".hpcdd-submit").prop("disabled", false);
				const button = document.querySelectorAll('.button');
				button.forEach(button => {
					// Remove class from each element
					button.classList.remove('hpcddsd');

					// Add class to each element
					// box.classList.add('small');
				});
			}
		});
	}
	$(document).ready(lvl4);

})( jQuery );
