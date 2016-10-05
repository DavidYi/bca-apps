<html>
<head>
    <link rel="stylesheet" href="/../../../bca-apps/shared/ss/main.css">
    <link rel="stylesheet" href="styles.css">
    <script type="text/javascript">function post(path, params, method) { //sends a post request; used to avoid having to use get to change the url since that looks sloppy and i don't want to bother with an inline form, especially if i want the confirmation prompt
            method = method || "post"; //also ripped straight off stackoverflow
            var form = document.createElement("form");
            form.setAttribute("method", method);
            form.setAttribute("action", path);

            for (var key in params) {
                if (params.hasOwnProperty(key)) {
                    var hiddenField = document.createElement("input");
                    hiddenField.setAttribute("type", "hidden");
                    hiddenField.setAttribute("name", key);
                    hiddenField.setAttribute("value", params[key]);

                    form.appendChild(hiddenField);
                }
            }
            document.body.appendChild(form);
            form.submit();
        }</script>
</head>
<body>
<div class="downloads">
    <a href="../index.php"><button>Return to Admin Panel</button></a>
    <center>
        <h1>Download Reports</h1>
        <a href="index.php?action=electives_list_download"><button>Electives List</button></a><br>
        <a href="index.php?action=availability_matrix_download"><button>Availability List</button></a><br>
        <a href="index.php?action=availability_list_download"><button>Teacher Availability List</button></a><br>
        <a href="index.php?action=course_interest_download"><button>Course Interest List</button></a>
    </center>
</div>
</body>