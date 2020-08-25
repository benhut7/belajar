
 <br>
 <br>
 <div class="card mt-5 mb-3">
        <div class="card-header bg-success text-white">
           Daftar User
        </div>
        <div class="card-body">
          <form method="post" action="">
          <div class="form-row">
              <div class="form-group col-md-9">
              <a href='index.php?page=frmadd'  class='btn btn-success'>Tambah</a>
               </div>  
              <div class="form-group col-md-3">
                  <input type="text" name="search" class="form-control" placeholder="Search..">
              </div>  
          </div>
            <table class="table table-bordered table-striped">
                <tr>
                  <th>No</th>
                  <th>Nip</th>
                  <th>Password</th>
                  <th>Nama</th>
                  <th>No Hp</th>
                  <th>Group</th>
                  <th>Action</th>           
                </tr>
                <?php
                include "config.php";
                $perpage = 10;
                $search = isset($_POST['search']) ? $_POST['search'] : '';
                $sql = "SELECT * FROM tbl_user where nama like '%$search%'";
                $perpage = 10;
                $query = mysqli_query($db, $sql);
                $totalrow = mysqli_num_rows($query);
                $pagesum = ceil($totalrow/$perpage);
                $pagehal = isset($_GET['pagehal']) ? $_GET['pagehal'] : 1;
                $start = ($pagehal-1) * $perpage;
                $sqlfetch = "SELECT * FROM tbl_user where nama like '%$search%' limit $start, $perpage";
                $queryfetch =  mysqli_query($db, $sqlfetch);
                $pre = $pagehal-1 < 1 ? 1 : $pagehal-1;
                $next = $pagehal+1 > $pagesum ? $pagesum : $pagehal+1;
                $no = 0;
                while ($row = mysqli_fetch_array($queryfetch)) {
                    $no++;
                    echo "<tr>
                          <td>" . $no . "</td>
                          <td>" . $row['nip'] . "</td>
                          <td>" . $row['password_'] . "</td>
                          <td>" . $row['nama'] . "</td>
                          <td>" . $row['hp'] . "</td>
                          <td>" . $row['group_id'] . "</td>                   
                          <td>           
                                <a href='prcedit.php?id=" . $row['id'] . "'>Edit</a>
                                <a href='prcdel.php?id=" . $row['id'] . "' >Hapus</a>
                          </td>
                        </tr>";
                         }
                        ?>
            </table>
            </form>
        </div>
            <nav aria-label="Page navigation example">
              <ul class="pagination">
                <li class="page-item">
                  <a class="page-link" href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                  </a>
                </li>
                <?php  for ($i = 1;$i<=$pagesum;$i++) { ;?>

                <li class="page-item"><a class="page-link" href="index.php?page=lstuser&pagehal=<?php echo $i;?>"><?php echo $i;?></a></li>

                <?php } ?>
               
                <li class="page-item">
                  <a class="page-link" href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                  </a>
                </li>
              </ul>
            </nav>                
    </div>
    <script>
        $(document).ready(function() {
        $('#tbluser').DataTable();
        });
    </script>