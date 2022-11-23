<?php include "db.php" ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>NEWS Table</h2>          
  <table class="table">
    <thead>
      <tr>
        <th>Title</th>
        <th>Image</th>
        <th>Description</th>
        <th>Time</th>
        <th>Created At</th>
        <th>Updated At</th>
      </tr>
    </thead>
    <tbody>
      <?php

        $list = getList("news","");

        foreach($list as $row):
       ?>


        <tr>
          <td><?php echo $row["title"];  ?></td>
          <td><?php echo $row["pic"];  ?></td>
          <td><?php echo $row["description"];  ?></td>
          <td><?php echo $row["date"];  ?></td>
          <td><?php echo $row["created_at"];  ?></td>
          <td><?php echo $row["updated_at"];  ?></td>
        </tr>

       <?php endforeach ?>
    </tbody>
  </table>
</div>

</body>
</html>
