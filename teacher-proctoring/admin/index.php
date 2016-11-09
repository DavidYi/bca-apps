<?php
include('../util/main.php');

$action = strtolower(filter_input(INPUT_POST, 'action'));
if ($action == NULL) {
    $action = strtolower(filter_input(INPUT_GET, 'action'));
    if ($action == NULL) {
        $action = 'list_options';
    }
}

verify_test_admin();

switch ($action) {
    case 'list_options':
        break;
    default:
        display_error('Unknown account action: ' . $action);
        exit();
        break;
}
?>

<html>
<head>
    <title>Admin Tools</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">

    <!-- Styles -->
    <link href="../../shared/ss/main.css" rel="stylesheet">
    <link href="../admin/ss/main.css" rel="stylesheet">
</head>
<body id="admin-tools">
<main>
    <header>
        <h1 class="title"><h2>Admin Tools</h2></h1>
        <div id="logout"><a href="../index.php?action=logout">Log Out</a></div>
    </header>
    <br>
    <div id="wrapper">
        <table>
            <tr>
                <td>
                    <a href="test_status">
                        <div class="feature">
                            <h2>Test List</h2>
                            <h4>Create and modify tests and check their sign-up status.</h4>
                        </div>
                    </a>
                </td>
                <td>
                    <a href="status">
                        <div class="feature">
                            <h2>Teacher Status</h2>
                            <h4>Check tests that an individual teacher signed up for.</h4>
                        </div>
                    </a>
                </td>
                <?php if ($user->getRole('TPOR') == 'ADM') { ?>
                    <td>
                        <a href="roles">
                            <div class="feature">
                                <h2>Roles</h2>
                                <h4>Set user roles for proctoring.</h4>
                            </div>
                        </a>
                    </td>
                    <td>
                        <a href="room">
                            <div class="feature">
                                <h2>Edit Rooms</h2>
                                <h4>Manage rooms.</h4>
                            </div>
                        </a>
                    </td>
                    <td>
                        <a href="email">
                            <div class="feature">
                                <h2>Email Proctors</h2>
                                <h4>Notify proctors of an upcoming test.</h4>
                            </div>
                        </a>
                    </td>
                    <td>
                        <a href="mimic_user">
                            <div class="feature">
                                <h2>Mimic User</h2>
                                <h4>Log in as any user in the database and use the app as if you were them.</h4>
                            </div>
                        </a>
                    </td>
                    <td>
                        <a href="log_viewer">
                            <div class="feature">
                                <h2>Log Viewer</h2>
                                <h4>View the application log.</h4>
                            </div>
                        </a>
                    </td>
                    <td>
                        <a href="downloads">
                            <div class="feature">
                                <h2>Downloads</h2>
                                <h4>Generate and download CSV sheets.</h4>
                            </div>
                        </a>
                    </td>
                <?php } ?>
            </tr>
        </table>
    </div>
    <!-- should probably be /index.php?action=logout in the final, but that won't work right on localhost since everything's in bca-apps rn -->
</main>
</body>
</html>