<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">S2K Hotel</a>
    </div>
    <div id="navbar" class="navbar-collapse collapse">
      <ul class="nav navbar-nav">
        <?php
          for ($i = 1; $i <= $max; $i++) {
            if ($i == $_SESSION['current']) {
              if (isset($_SESSION['kamar'][$i]) && isset($_SESSION['fasilitas'][$i])){
                echo "<li class='active'><a href='available.php?room=".$i."' style='color: green;'>Room ".$i."</a></li>";
              } else {
                echo "<li class='active'><a href='available.php?room=".$i."' style='color: red;'>Room ".$i."</a></li>";
              }
            } else {
              if (isset($_SESSION['kamar'][$i]) && isset($_SESSION['fasilitas'][$i])){
                echo "<li><a href='available.php?room=".$i."' style='color: green;'>Room ".$i."</a></li>";
              } else {
                echo "<li><a href='available.php?room=".$i."' style='color: red;'>Room ".$i."</a></li>";
              }
            }
          }
        ?>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <a href="index.php" type="button" class="btn btn-danger navbar-btn">Cancel</a> 
        <button type="button" class="btn btn-info navbar-btn" data-toggle="modal" data-target="#myModal">Detail</button>
        <?php
          $checkroom = True;
          for ($i = 1; $i <= $max; $i++) {
            if (!isset($_SESSION['kamar'][$i])){
              $checkroom = False;
              break;
            }
            if (!isset($_SESSION['fasilitas'][$i])){
              $checkroom = False;
              break;
            }
          }
          if ($checkroom == False) {
        ?>
            <button type="button" class="btn btn-primary navbar-btn" disabled>Submit</button>
        <?php
          } else {
        ?>
            <button type="button" class="btn btn-primary navbar-btn" data-toggle="modal" data-target="#myModal2">Submit</button>
        <?php
          }
        ?>
      </ul>
    </div><!--/.nav-collapse -->
  </div>
</nav>
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Detail Room and Facilities</h4>
      </div>
      <div class="modal-body">
        <div class="container" style="font-size: 14px;">
          <?php
            for ($i=1; $i<=$max; $i++) {
              if (isset($_SESSION['kamar'][$i])){
                $fetchtype = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM tipe WHERE id_tipe = ".$_SESSION['kamar'][$i]));
                echo "<p>Room ".$i.": ".$fetchtype['nama']."<br/>";  
              } else {
                echo "<p>Room ".$i.": None<br/>";
              }
              if (isset($_SESSION['fasilitas'][$i])){
                $fetchfas = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM fasilitas WHERE id_fasilitas = ".$_SESSION['fasilitas'][$i]));
                echo "Facilities ".$i.": ".$fetchfas['nama']."</p>";
              } else {
                echo "Facilities ".$i.": None</p>";
              }
            }
          ?>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<div id="myModal2" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Are you sure?</h4>
      </div>
      <div class="modal-body">
        <div class="container" style="font-size: 14px;">
          <?php
            for ($i=1; $i<=$max; $i++) {
              if (isset($_SESSION['kamar'][$i])){
                $fetchtype = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM tipe WHERE id_tipe = ".$_SESSION['kamar'][$i]));
                echo "<p>Room ".$i.": ".$fetchtype['nama']."<br/>";  
              } else {
                echo "<p>Room ".$i.": None<br/>";
              }
              if (isset($_SESSION['fasilitas'][$i])){
                $fetchfas = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM fasilitas WHERE id_fasilitas = ".$_SESSION['fasilitas'][$i]));
                echo "Facilities ".$i.": ".$fetchfas['nama']."</p>";
              } else {
                echo "Facilities ".$i.": None</p>";
              }
            }
          ?>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <a href="confirm.php" type="button" class="btn btn-primary">Submit</a>
      </div>
    </div>
  </div>
</div>