<html>
<head>
    <script type="text/javascript">
        function post(path, params, method) { //sends a post request; used to avoid having to use get to change the url since that looks sloppy and i don't want to bother with an inline form, especially if i want the confirmation prompt
            method = method || "post"; //also ripped straight off stackoverflow
            var form = document.createElement("form");
            form.setAttribute("method", method);
            form.setAttribute("action", path);

            for(var key in params) {
                if(params.hasOwnProperty(key)) {
                    var hiddenField = document.createElement("input");
                    hiddenField.setAttribute("type", "hidden");
                    hiddenField.setAttribute("name", key);
                    hiddenField.setAttribute("value", params[key]);

                    form.appendChild(hiddenField);
                }
            }

            document.body.appendChild(form);
            form.submit();
        }
    </script>
</head>
<body>
    <h1>Create a New Class</h1>

    <form action="post('index.php', {action: 'add_course'}, 'post')" method="post">
        Class Name: <input name="class_name" type="text"> <br><br>
        Mods: <select name="mods">
            <option value="1-3">1-3</option>
            <option value="4-6">4-6</option>
            <option value="7-9">7-9</option>
            <option value="10-12">10-12</option>
            <option value="13-15">13-15</option>
            <option value="16-18">16-18</option>
            <option value="19-21">19-21</option>
            <option value="22-24">22-24</option>
            <option value="25-27">25-27</option>
        </select> <br><br>
        Day: <select name="day">
            <option value="Monday">Monday</option>
            <option value="Tuesday">Tuesday</option>
            <option value="Wednesday">Wednesday</option>
            <option value="Thursday">Thursday</option>
            <option value="Friday">Friday</option>
        </select> <br><br>
        Description: <br><br><textarea name="description"></textarea><br><br>
        <input type="submit" name="submit">
    </form>

</body>
</html>

