<html>

<head>
<link rel="stylesheet" type="text/css" href="../add/semantic/dist/semantic.min.css<?php echo(getVersionString()); ?>">
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css<?php echo(getVersionString()); ?>">
<link rel="stylesheet" type="text/css" href="view.css<?php echo(getVersionString()); ?>">
<link href="../../../shared/ss/main.css<?php echo(getVersionString()); ?>" rel="stylesheet">
<link href='https://fonts.googleapis.com/css?family=Lato:400,300,700' rel='stylesheet' type='text/css'>
<script src="//code.jquery.com/jquery-1.10.2.js<?php echo(getVersionString()); ?>"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js<?php echo(getVersionString()); ?>"></script>
<script src="../add/functions.js<?php echo(getVersionString()); ?>"></script>
<script src="../add/semantic/dist/semantic.min.js<?php echo(getVersionString()); ?>"></script>
</head>


<body>

<style>

    body {
        background: #FFFFFF;
    }

    .downloads a {
        text-decoration: none;
    }

    button {
        height: 3em;
        width: 20em;
        color: #000000;
        background-color: #f0f0f0;
        font-size: 10pt;
        border: 0;
        border-radius: 1px;
        outline: none;
        margin: 0.4em;
        line-height: 2.25em;
        text-transform: uppercase;
        -webkit-transition: all 175ms ease;
        -moz-transition: all 175ms ease;
        transition: all 175ms ease;
        cursor: pointer;
        display: inline-block;
    }

    /*WHY IS THIS SO AMUSING OML*/
    button:hover {
        background-color: tomato;
    }


</style>

<a href="index.php?action=generate_teachers_csv"><button>Teacher Proctoring List</button></a>

</body>


</html>