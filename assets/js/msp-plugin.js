jQuery(document).ready(function ($) {
	var $countriesTable = $(".countries-data");
	if ($countriesTable.length) {
		// new tables
		function ajax_country_table_new(){
			d = new Date();
			$.ajax({
				url: 'https://mamdevsite.com/mam/sales-board-data-new-2/?action=country&rand=' + d.getTime(),
				method: 'get',
				success: function (data) {
					$('#countries-new tbody').html(data);
				}
			});
		}
		ajax_country_table_new();
		function ajax_users_table_new(){
			d = new Date();
			$.ajax({
				url: 'https://mamdevsite.com/mam/sales-board-data-new-2/?action=users&rand=' + d.getTime(),
				method: 'get',
				success: function (data) {
					$('#users-new').html(data);
				}
			});
		}
		ajax_users_table_new();

		function ajax_country_bde_table_new(){
			d = new Date();
			$.ajax({
				url: 'https://mamdevsite.com/mam/sales-board-data-new-3/?action=country&rand=' + d.getTime(),
				method: 'get',
				success: function (data) {
					$('#countries-bde-new tbody').html(data);
				}
			});
		}
		ajax_country_bde_table_new();
		function ajax_bde_table_new(){
			d = new Date();
			$.ajax({
				url: 'https://mamdevsite.com/mam/sales-board-data-new-3/?action=users&rand=' + d.getTime(),
				method: 'get',
				success: function (data) {
					$('#bde-new').html(data);
				}
			});
		}
		ajax_bde_table_new();
		function ajax_second_table_new(){
			d = new Date();
			$.ajax({
				url: 'https://mamdevsite.com/mam/sales-board-data-new-2/?action=second&rand=' + d.getTime(),
				method: 'get',
				success: function (data) {
					$('#second-table').html(data);
				}
			});
		}
		ajax_second_table_new();

		setInterval(function(){
			ajax_country_table_new();
			ajax_users_table_new();
			ajax_second_table_new();
			ajax_country_bde_table_new();
			ajax_bde_table_new();
		}, 30000);

		// table switcher
		var activeTable = 0;
		$('#users-new').addClass('active');
		$('#countries-new').addClass('active');

		$('#bde-new').removeClass('active');
		$('#countries-bde-new').removeClass('active');

		$('#second-table').removeClass('active');

		setInterval(function(){
			if(activeTable === 0){
				activeTable = 1;
				$('#users-new').removeClass('active');
				$('#countries-new').removeClass('active');

				$('#bde-new').addClass('active');
				$('#countries-bde-new').addClass('active');

				$('#second-table').removeClass('active');
			}else if(activeTable === 1){
				activeTable = 2;
				$('#users-new').removeClass('active');
				$('#countries-new').removeClass('active');

				$('#bde-new').removeClass('active');
				$('#countries-bde-new').removeClass('active');

				$('#second-table').addClass('active');
			}else if(activeTable === 2){
				activeTable = 0;
				$('#users-new').addClass('active');
				$('#countries-new').addClass('active');

				$('#bde-new').removeClass('active');
				$('#countries-bde-new').removeClass('active');

				$('#second-table').removeClass('active');
			}
		}, 30000);

/**
		var usersTable;
		var countryTable;
		// From WP Localise Script ali-task/ali-task.js
		var sales_endpoint = msp_plugin.sales_endpoint;

		var d = new Date();
		function ajax_country_table(){
			d = new Date();
			$.ajax({
				url: sales_endpoint + 'country/?rand=' + d.getTime(),
				method: 'get',
				dataType: 'json',
				success: function (data) {
					init_country_table(data);
				}
			});
		}
		ajax_country_table();
		function ajax_users_table(){
			d = new Date();
			$.ajax({
				url: sales_endpoint + '?rand=' + d.getTime(),
				method: 'get',
				dataType: 'json',
				success: function (data) {
					init_users_table(data);
				}
			});
		}
		ajax_users_table();

		setInterval(function(){
			ajax_users_table();
			ajax_country_table();
		}, 30000);

		function init_users_table(data){
			if(usersTable){
				usersTable.destroy();
			}
			usersTable = $('#users').DataTable({
				"paging": false,
				"searching": false,
				data: data,
				'aaSorting': [[5, 'desc']],
				'columns': [
					{'data': 'name'},
					{'data': 'country'},
					{'data': 'recurring_target'},
					{'data': 'recurring_collected'},
					{'data': 'new_recurring'},
					{'data': 'current'},
					{'data': 'singles'},
					{'data': 'total'}
				]
			});
		}

		function init_country_table(data){
			console.log(data);
			if(countryTable){
				countryTable.destroy();
			}
			countryTable = $('#countries').DataTable({
				"paging": false,
				"searching": false,
				data: data,
				'aaSorting': [[6, 'desc']],
				'columns': [
					{'data': 'team'},
					{'data': 'record'},
					{'data': 'current'},
					{'data': 'recurring_target'},
					{'data': 'current_recurring'},
					{'data': 'new_recurring'},
					{'data': 'current2'},
					{'data': 'current_total'}
				]
			});
		}
 */
	}
});