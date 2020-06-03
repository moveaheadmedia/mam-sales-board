<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sales Board - MoveAheadMedia</title>
	<?php wp_head(); ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.20/css/jquery.dataTables.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="<?php echo ALI_TASK_BASEDIR; ?>assets/css/ali-task.css"/>
</head>
<body>
<br />
<div class="header-section">
    <div class="container">
        <div class="text text-center">
            <div class="logo"><img class="mx-auto d-block" src="https://www.moveaheadmedia.co.uk/wp-content/uploads/2019/12/logo.png" width="334" height="auto" alt="Moveaheadmedia"/></div>
        </div>
    </div>
</div>

<br />
<br />
<div class="col-md-12">
    <table class="table table-striped table-bordered" id="users" style="width: 100%">
        <thead>
        <tr>
            <th>Name</th>
            <th>Country</th>
            <th>Recurring Target</th>
            <th>Recurring Collected</th>
            <th>Current %</th>
            <th>Singles</th>
            <th>TOTAl Collected</th>
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
            <th>Current %</th>
            <th>Current Total</th>
        </tr>
        </thead>
    </table>
</div>

<?php wp_footer(); ?>
</body>
</html>