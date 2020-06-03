<?php
$sales       = array();
$countries = array();

$country = array();
$country['country'] = 'GBP';
$country['team'] = 'Uk Sales';
$country['record'] = date('F');
$country['current'] = 0;
$country['recurring_target'] = 0;
$country['current_recurring'] = 0;
$country['current2'] = 0;
$country['current_total'] = 0;
$countries['GBP'] = $country;

$country = array();
$country['country'] = 'AUD';
$country['team'] = 'Aus Sales';
$country['record'] = date('F');
$country['current'] = 0;
$country['recurring_target'] = 0;
$country['current_recurring'] = 0;
$country['current2'] = 0;
$country['current_total'] = 0;
$countries['AUD'] = $country;

$country = array();
$country['country'] = 'THB';
$country['team'] = 'Thai Sales';
$country['record'] = date('F');
$country['current'] = 0;
$country['recurring_target'] = 0;
$country['current_recurring'] = 0;
$country['current2'] = 0;
$country['current_total'] = 0;
$countries['THB'] = $country;

$acf_repater = 'sales';
if ( have_rows( $acf_repater, 'option' ) ) {
	while ( have_rows( $acf_repater, 'option' ) ) {
		the_row();
		$sale                        = array();
		$sale['name']                = get_sub_field( 'name' );
		$sale['country']             = get_sub_field( 'country' );
		$sale['recurring_target']    = toMoney( get_sub_field( 'country' ), get_sub_field( 'recurring_target' ) );
		$sale['recurring_collected'] = toMoney( get_sub_field( 'country' ), get_sub_field( 'recurring_collected' ) );
		$sale['current']             = get_percentage( get_sub_field( 'recurring_target' ), get_sub_field( 'recurring_collected' ) ) . '%';
		$sale['singles']             = toMoney( get_sub_field( 'country' ), get_sub_field( 'singles' ) );
		$sale['total']               = toMoney( get_sub_field( 'country' ), get_sub_field( 'recurring_collected' ) + get_sub_field( 'singles' ) );;
		$sales[] = $sale;

		// set country data
		$countries[get_sub_field( 'country' )]['recurring_target'] = $countries[get_sub_field( 'country' )]['recurring_target'] + get_sub_field( 'recurring_target' );
		$countries[get_sub_field( 'country' )]['current_recurring'] = $countries[get_sub_field( 'country' )]['current_recurring'] + get_sub_field( 'recurring_collected' );
		$countries[get_sub_field( 'country' )]['current_total'] = $countries[get_sub_field( 'country' )]['current_total'] + get_sub_field( 'recurring_collected' ) + get_sub_field( 'singles' );
		$countries[get_sub_field( 'country' )]['current'] = get_percentage($countries[get_sub_field( 'country' )]['recurring_target'] ,  $countries[get_sub_field( 'country' )]['current_recurring']);
		$countries[get_sub_field( 'country' )]['current2'] = get_percentage($countries[get_sub_field( 'country' )]['recurring_target'], $countries[get_sub_field( 'country' )]['current_total']);
	}
}

function get_percentage( $total, $number ) {
	if ( $total > 0 ) {
		return round( $number / ( $total / 100 ), 2 );
	} else {
		return 0;
	}
}

function toMoney( $symbol, $val, $r = 2 ) {
	return $symbol . ' ' . number_format($val, $r);

}

function format_coutries_table($array){
	$countries = array();
	foreach ($array as $country){
		$country['recurring_target'] = toMoney($country['country'], $country['recurring_target']);
		$country['current_recurring'] = toMoney($country['country'], $country['current_recurring']);
		$country['current_total'] = toMoney($country['country'], $country['current_total']);
		$country['current'] = $country['current'] . '%';
		$country['current2'] = $country['current2'] . '%';
		$countries[] = $country;
	}
	return $countries;
}
header( 'Content-Type: application/json' );
global $wp_query;
if(isset($wp_query->query_vars['sales-board-data']) && $wp_query->query_vars['sales-board-data'] == 'country'){
	echo json_encode( format_coutries_table($countries ));
}else{
	echo json_encode( $sales );
}
