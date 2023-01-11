<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sales Board - MoveAheadMedia</title>
    <?php wp_head(); ?>
</head>
<body>
<br/>
<div class="col-md-12 active" id="users-new">
</div>
<div class="col-md-12 active" id="bde-new">
</div>
<div class="col-md-12" id="second-table">
</div>
<div class="countries-data">
    <table class="table table-bordered" id="countries-new" style="width: 100%">
        <thead>
        <tr>
            <th>Team</th>
            <th>New Recurring Target</th>
            <th>New Recurring Collected</th>
            <th>%</th>
            <th>Monthly Recurring Target</th>
            <th>Monthly Recurring Collected</th>
            <th>%</th>
            <th>Singles</th>
            <th>Total Money in</th>
        </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
    <table class="table table-bordered" id="countries-bde-new" style="width: 100%">
        <thead>
        <tr>
            <th>Team</th>
            <th>New Recurring Target</th>
            <th>New Recurring Collected</th>
            <th>%</th>
            <th>Monthly Recurring Target</th>
            <th>Monthly Recurring Collected</th>
            <th>%</th>
            <th>Singles</th>
            <th>Total Money in</th>
        </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
</div>
<style>
    td, th{
        text-align: center;
    }
</style>

<?php wp_footer(); ?>

</body>
</html>