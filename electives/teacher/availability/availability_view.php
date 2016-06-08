<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>Table Style</title>
	<meta name="viewport" content="initial-scale=1.0; maximum-scale=1.0; width=device-width;">
  <link rel="stylesheet" href="index.css">
</head>

<body>
<div class="table-title">
<h3 class="title">Schedule Preferences</h3>
</div>


<form action="." method="POST">
  <table class="table-fill">
    <thead>
      <tr>
        <th class="text-left">Monday</th>
        <th class="text-left">Tuesday</th>
        <th class="text-left">Wednesday</th>
        <th class="text-left">Thursday</th>
        <th class="text-left">Friday</th>
      </tr>
    </thead>
  <tbody class="table-hover">

    <?php
    $mods = array("1-3", "4-6", "7-9", "10-12", "13-15", "16-18", "19-21", "22-24");
    $days = array("Monday", "Tuesday", "Wednesday", "Thursday", "Friday");
    for ($i = 0; $i < 8; $i++) {
      echo "<tr>";
      for ($j = 0; $j < 5; $j++) {
        echo "<td class='text-left'><input type='checkbox' class='mods' name='time[]' value='$days[$j] $mods[$i]'>$mods[$i]</td>";
      }
      echo "</tr>";
    }
    ?>

  </tbody>
  </table>
<div class="wrapper">
  <button name="action" value="submit" class="s submit" type="submit">Submit</button>
  <button name="action" value="back" class="s back" type="submit">Back</button>
</div>
</form>
</body>
