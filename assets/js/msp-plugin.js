jQuery(document).ready(function ($) {
	// new tables
	function ajax_country_table_new(){
		d = new Date();
		$.ajax({
			url: 'https://mamdevsite.com/mam/sales-board-data-new/?action=country&rand=' + d.getTime(),
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
			url: 'https://mamdevsite.com/mam/sales-board-data-new/?action=users&rand=' + d.getTime(),
			method: 'get',
			success: function (data) {
				$('#users-new').html(data);
			}
		});
	}
	ajax_users_table_new();
	function ajax_second_table_new(){
		d = new Date();
		$.ajax({
			url: 'https://mamdevsite.com/mam/sales-board-data-new/?action=second&rand=' + d.getTime(),
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
	}, 5000);

	// table switcher
	var activeTable = true;
	setInterval(function(){
		if(activeTable){
			activeTable = false;
			$('#users-new').removeClass('active');
			$('#second-table').addClass('active');
		}else{
			activeTable = true;
			$('#second-table').removeClass('active');
			$('#users-new').addClass('active');
		}
	}, 30000);


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
	}, 5000);

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
});