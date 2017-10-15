<table width="100%">
  <tr>
    <td> Welcome, <b><?php echo $_SESSION["username"] ?></b> </td>
    <td align="right">
      <form action='/1172/IWP/Shopping/logout.php' method="post">
        <input type="submit" value="Logout!">
      </form>
    </td>
  </tr>
</table>
<br/>
<h3>Select items to continue...</h3>
<table width="100%">
  <tr>
    <td><b>name</b></td>
    <td><b>price (INR)</b></td>
    <td><b>quantity</b></td>
  </tr>
  <?php
    include "db.php";
    $query = "SELECT * FROM items";
    $res = mysqli_query($conn, $query);
    while($row=mysqli_fetch_assoc($res)){
      echo "<tr>";
        echo "<td>".$row["name"]."</td>";
        echo "<td>".$row["price"]."</td>";
        echo "<td>";
          echo "<select name=".$row["id"]." form='cartform'>";
            for($i=0;$i<=$row["quantity"];$i++){
              echo "<option value=$i>$i</option>";
            }
          echo "</select>";
        echo "</td>";
      echo "</tr>";
    }
   ?>
</table>
<form action='/1172/IWP/Shopping/cart.php' method="post" id="cartform">
  <input type="submit" value="Check out!">
</form>
