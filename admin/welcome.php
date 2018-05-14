<?php
   include('session.php');
?>
<html>
   <head>
      <title>Admin panel</title>
      <link rel="stylesheet" href="css/adminstyle.css">
   </head>
   <body>
      <h3><a href = "logout.php">Sign Out</a></h3>
      <h1>Admin panel</h1>
      <h2>User logged in: <?php echo " " .$_SESSION['login_user'] ." "; ?> </h2>


<div class="bk">

<!--

<form id="sort" action="updatesort.php" method="post">
      <table id="sorting">
        <tr><th>All users</th><th>Month</th><th>Year</th><th>Lifetime</th></tr>
        <tr>
            <th><input type="radio" name="rdb" value="0"></th>
            <th><input  type="radio" name="rdb" value="1"></th>
            <th><input  type="radio" name="rdb" value="2"></th>
            <th><input  type="radio" name="rdb" value="3"></th>
         </tr>
      </table>
  <input id="sortbtn" type="submit" name="sub" value="Filter by">
</form>
-->

<table id="sorting">
  <tr><th>All users</th><th>Month</th><th>Year</th><th>Lifetime</th></tr>
  <tr>
      <th><button  id="myInput" name="rdb"  onclick="myFunction('0')">x</button></th>
      <th><button  id="myInput" name="rdb"  onclick="myFunction('1')">x</button></th>
      <th><button  id="myInput" name="rdb"  onclick="myFunction('2')">x</button></th>
      <th><button  id="myInput" name="rdb"  onclick="myFunction('3')">x</button></th>
   </tr>
</table>



<script>

function myFunction(a) {

  var filter, table, tr, td, i;
  filter = a;
  table = document.getElementById("lol");
  tr = table.getElementsByTagName("tr");

  for (i = 1; i < tr.length; i++) {
    tr[i].style.display = "";
  }

  if(a != 0) {
  for (i = 1; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[2].textContent.trim();
    console.log(td + " " + filter);
    if(td != filter) {
      tr[i].style.display = "none";
    }
   }
  }
}

</script>


      <?php
      require "../db/db_connection.php";
      $conn    = Connect();
      if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
      }



if($_SESSION['usersorting'] == 0){
  $sql = "SELECT * FROM userlist";
} else {
  $sql = "SELECT * FROM userlist WHERE planType='{$_SESSION['usersorting']}'";
}

    //  $sql = "SELECT transactionID , email, planType , isPayed , datecur , datesubscribed FROM userlist";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
          echo "<table id='lol'>";
          echo "<tr><th>Transaction ID</th><th>Email</th><th>Plan Type</th><th>Is it payed?</th><th>Starts</th><th>Ends</th><th>Payed?</th></tr>";
          // output data of each row
          while($row = $result->fetch_assoc()):
              $theID = $row["transactionID"];
              echo "<tr><td>" . $row["transactionID"]. "</td><td>" . $row["email"]. " </td><td> " . $row["planType"]. " </td> <td>  " . $row["isPayed"]. "  </td> <td>  " . $row["datecur"]. " </td> <td>" . $row["datesubscribed"]. "</td>";

      ?>

      <td>
      <form action="updatebutton.php" method="post">
         <input type="hidden" name="id" value="<?php echo $theID; ?>">
         <input type="hidden" name="sessionuser" value="<?php echo "".$_SESSION['login_user'].""?>">
         <input type="submit" value="Change payed status">
      </form>
      </td>

      <?php
          echo "</tr>";
          endwhile;
          echo "</table>";
      } else {
          echo "0 results";
      }


      $conn->close();
      ?>
</div>


   </body>
</html>
