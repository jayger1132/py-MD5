<?
$ppid_id = $_GET['ppid_id'];
?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="./css/bootstrap.min.css">
  <title>PPID System</title>
</head>

<body>
  <?php
  include("./header.php");
  include("./methods/getdata.php")
  ?>
  <style type="text/css">
    .out_border {
      border: 1px solid gray;
      padding: 15px 15px 25px 15px;
      border-radius: 6px;
    }

    .input_custom {
      border: 1px solid #AAAAAA;
      border-radius: 2px;
      margin: 5px;
      width: 150px;
      padding: 1px 5px 1px 5px;
    }

    @media only screen and (max-width: 1000px) {
      .input_custom {
        width: 100px;
      }
    }

    @media only screen and (max-width: 800px) {
      .input_custom {
        width: 75px;
      }
    }
  </style>
  <br>
  <div class="container">
    <form id="form1" name="form1" action="./methods/update.php" method="POST" enctype="multipart/form-data">
      <div class="out_border" id="add_keyin">
        <div class="form-row">
          <div class="col-2">
            <label>PPID流水號</label>
            <br>
            <table class="table table-sm table-bordered">
              <thead class="text-center table-dark">
                <tr>
                  <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                  <th></th>
                  <th>DNS</th>
                  <th>EXP</th>
                  <th>YTS</th>
                </tr>
              </thead>
              <tbody>
                <input type="hidden" value="<?php echo $ppid_id ?>" name="ppid">
                <?
                $connection = new PDO('mysql:host=localhost;dbname=mainsystem3;charset=utf8', 'root', 'tokio328');
                $sql = "SELECT * FROM `ppid_system` LEFT JOIN `ppid_system_group` ON ppid_system_group.ppid_id = ppid_system.ppid_id WHERE ppid_system.ppid_id = $ppid_id";
                $statement = $connection->prepare($sql);
                $statement->execute();
                $i = 0;
                foreach ($statement as $rows) {
                  $i++;
                  echo "<tr>";
                  if ($i == 1) {
                    echo "<th style=\"vertical-align:middle;text-align:center;\" rowspan=\"5\">" . $ppid_id . "</th>";
                  }
                  if ($rows['ppid_id'] == $ppid_id) {
                    echo "<th>" . ($i + 5 * ($ppid_id - 1) + 100) . "</th>";
                  }

                ?>
                  <input type="hidden" value="<?php echo ($i + 5 * ($ppid_id - 1) + 100) ?>" name="group_id[<?php echo $i ?>]">
                  <td>
                    <input type="text" class="input_custom" value="<? echo $rows['DNS'] ?>" name="dns[<?php echo $i ?>]">
                  </td>
                  <td>
                    <input type="text" class="input_custom" value="<? echo $rows['EXP'] ?>" name="exp[<?php echo $i ?>]">
                  </td>
                  <td>
                    <input type="text" class="input_custom" value="<? echo $rows['YTS'] ?>" name="yts[<?php echo $i ?>]">
                  </td>
                  </tr>

                <?
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <center><button type="submit" class="btn btn-outline-dark" form="form1">送出 Submit</button></center>
    </form>

  </div>




  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="./js/jquery.min.js"></script>
  <script src="./js/popper.min.js"></script>
  <script src="./js/bootstrap.min.js"></script>
  <script type="text/javascript">
    $("#index").attr("class", "nav-link active");
  </script>
</body>

</html>