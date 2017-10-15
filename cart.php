<?php session_start(); ?>
<html>
  <head>
    <title> Cart | Checkout </title>
  </head>
  <body>
    <table width="100%">
      <tr>
        <td> <?php echo "<b>".$_SESSION['username']."</b>"; ?>, congratulations on your purchase! </td>
        <td align="right">
          <form action='/1172/IWP/Shopping/index.php' method="post">
            <input type="submit" value="Back!">
          </form>
        </td>
      </tr>
    </table>
    <?php
    include "db.php";
    //remove 0 quantity items
      foreach ($_POST as $key => $value) {
        if($value==0)
          unset($_POST[$key]);
      }
      $query = "SELECT * FROM items WHERE id IN (".implode(",", array_keys($_POST)).")";
      $res = mysqli_query($conn, $query);
      if(mysqli_num_rows($res)==0)
        echo "No items selected!";
      else{
        echo "<h3> Invoice: </h3>";
        ?>
        <table width="100%">
          <tr>
            <td><b>name</b></td>
            <td><b>price (INR)</b></td>
            <td><b>quantity</b></td>
            <td><b>total</b></td>
          </tr>
        <?php
        $total_cost = 0;
        while($row=mysqli_fetch_assoc($res)){
          echo "<tr>";
            echo "<td>".$row["name"]."</td>";
            echo "<td>".$row["price"]."</td>";
            echo "<td>".$_POST[$row["id"]]."</td>";
            echo "<td>".$row["price"]*$_POST[$row["id"]]."</td>";
          echo "</tr>";
          $total_cost+=$row["price"]*$_POST[$row["id"]];
          //update
          $subquery = "UPDATE items SET quantity = quantity-".$_POST[$row['id']]." WHERE id=".$row["id"];
          mysqli_query($conn, $subquery);
        }
        ?>
        </table>
        <?php
          echo "<br/>Total bill: <i>".$total_cost." INR<i/><br/>";
          echo "Thank you!";
      }
     ?>
  </body>
</html>
