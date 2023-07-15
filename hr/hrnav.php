<ul class="nav flex-column">

<?
$pr="H";
$rp="B";

 $sql="SELECT * FROM `permissions` WHERE user=? OR user=?";
    $stmt=$conn->prepare($sql);
    $stmt->bind_param("ss",$pr,$rp);
    $stmt->execute();
    $result = $stmt->get_result();
     if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {?>
  <hr>
<li class="nav-item">
    <a class="nav-link" href="<?echo $row['permlink'] ;?>"><?echo $row['icon'] ;?>  <?echo $row['permname'] ;?></a>
  </li>



        	 <?php
        }}







?>
  <hr>

  <li class="nav-item">

    <a class="nav-link" href="logout.php?logout" tabindex="-1"><i class="bi bi-box-arrow-right"></i> Logout</a>

  </li>
</ul>