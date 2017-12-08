<?php 
    $cek    = $mysqli->query("SELECT * from admin where username='$_SESSION[username]' and password='$_SESSION[password]'");
    $data   = $cek->fetch_array();
    //$jumlah = $cek->num_rows;
 ?>       
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Slider <small>Posters</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="admin.php">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-edit"></i> Slider
                            </li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                         <p><a href="?tampil=tambah-slider" class="btn btn-primary btn-md" role="button">Tambah</a>
                         </p>
                    </div>
                    <div class="col-lg-6">
                            <form method="post" action="">
                                <div class="form-group input-group">
                                <input name="input_cari" placeholder="Cari disini .." type="text" class="form-control">
                                <span class="input-group-btn"><input class="btn btn-default" name="cari" value="Cari" type="submit"><i class="fa fa-search"></i></span>
                            </div>
                            </form>
                            
                    </div>
                </div>
                <?php
                                   $input_cari = @$_POST['input_cari']; 
                                   $cari = @$_POST['cari']; 
                                    if($cari){
                                        if($input_cari!=""){
                                            echo "Pencarian : "."$input_cari";
                                        }else{
                                            echo "Pencarian : All";
                                        }
                                         
                                    }
                                ?>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Slider Panel</h3>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped">
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                                <th>Deskripsi</th>
                                                <th>Aksi</th>
                                            </tr>
                                        
    <?php 

   // jika tombol cari di klik
   $no=1;
   if($cari) {
        // jika kotak pencarian tidak sama dengan kosong
            if($input_cari != "") {
                $sql =$mysqli->query("SELECT * FROM slider where 
                nama like '%$input_cari%' OR 
                isi like '%$input_cari%'
                ORDER BY nama ASC")or die($mysqli->error);
                } 
            else{
                    $sql =$mysqli->query("SELECT * FROM slider ORDER BY nama ASC")or die($mysqli->error);
            }
        }
        else{
            $sql =$mysqli->query("SELECT * FROM slider ORDER BY nama ASC")or die($mysqli->error);
        }
    $cek = $sql->num_rows;
     // jika data kurang dari 1
   if($cek < 1) {
    ?>
     <tr> <!--muncul peringata bahwa data tidak di temukan-->
      <td colspan="12" align="center" style="padding:12px;"> Data Tidak Ditemukan</td>
     </tr>
    <?php
   } else {
        
        while($data=$sql->fetch_array()){
            $data_slider = substr($data['isi'], 0,80);
    ?>
                                            
                                            <tr><td><?php echo $no; ?></td>
                                                <td><?php echo $data['nama']; ?></td>
                                                <td><?php echo $data_slider."..."; ?></td>

                                                <td>

             <a style="background-color: green;border-color: green; " href="?tampil=lihat-slider&id=<?php echo $data['id']; ?>" class="btn btn-danger btn-sm"> Lihat </a>
            <a style="background-color: #f84552 " href="?tampil=hapus-slider&id=<?php echo $data['id']; ?>" class="btn btn-danger btn-sm"> Hapus </a>
                                                </td>
                                            </tr>
                                           <?php 
                                           $no++;
                                           }} ?>
                                    </table>
                                    <div style="padding-bottom: 200px"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->