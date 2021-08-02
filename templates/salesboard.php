<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sales Board - MoveAheadMedia</title>
	<?php wp_head(); ?>
</head>
<body>
<br />
<div class="col-md-12">
    <table class="table table-striped table-bordered" id="users" style="width: 100%">
        <thead>
        <tr>
            <th>Name</th>
            <th>Country</th>
            <th>Recurring Target</th>
            <th>Recurring Collected</th>
            <th>New Recurring</th>
            <th>Current %</th>
            <th>Singles</th>
            <th>TOTAL Collected</th>
        </tr>
        </thead>
    </table>
</div>
<div class="countries-data">
    <table class="table table-bordered" id="countries" style="width: 100%">
        <thead>
        <tr>
            <th>Team</th>
            <th>Record Month</th>
            <th>Current %</th>
            <th>Recurring   Target</th>
            <th>Current Recurring</th>
            <th>New Recurring</th>
            <th>Current %</th>
            <th>Current Total</th>
        </tr>
        </thead>
    </table>
</div>

<?php wp_footer(); ?>

</body>
</html>