jQuery(document).ready(function ($) {
	var usersTable;
	var countryTable;
	// From WP Localise Script ali-task/ali-task.js
    var user_details_endpoint = ali_task.user_details_endpoint;

	$.ajax({
		url: user_details_endpoint + 'country/',
		method: 'get',
		dataType: 'json',
		success: function (data) {
			init_country_table(data);
		}
	});
	$.ajax({
		url: user_details_endpoint,
		method: 'get',
		dataType: 'json',
		success: function (data) {
			init_users_table(data);
		}
	});
	setInterval(function(){
		$.ajax({
			url: user_details_endpoint,
			method: 'get',
			dataType: 'json',
			success: function (data) {
				init_users_table(data);
			}
		});
	}, 50000);
	setInterval(function(){
		$.ajax({
			url: user_details_endpoint + 'country/',
			method: 'get',
			dataType: 'json',
			success: function (data) {
				init_country_table(data);
			}
		});
	}, 50000);

	function init_users_table(data){
		if(usersTable){
			usersTable.destroy();
		}
		usersTable = $('#users').DataTable({
			"paging": false,
			"searching": false,
			data: data,
			'aaSorting': [[4, 'desc']],
			'columns': [
				{'data': 'name'},
				{'data': 'country'},
				{'data': 'recurring_target'},
				{'data': 'recurring_collected'},
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
			'aaSorting': [[4, 'desc']],
			'columns': [
				{'data': 'team'},
				{'data': 'record'},
				{'data': 'current'},
				{'data': 'recurring_target'},
				{'data': 'current_recurring'},
				{'data': 'current2'},
				{'data': 'current_total'}
			]
		});
	}
});