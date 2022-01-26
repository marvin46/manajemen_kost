<?php
$db= new database();
$harga= new Harga();
?>
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> 
            <a href="home" title="Go to Home" class="tip-bottom">
                <i class="icon-home"></i> Home
            </a>
            <a href="<?php echo"$_GET[page]";?>" class="current">
                <?php echo"$_GET[page]"; ?>
            </a> 
        </div>
    </div>

    <div class="container-fluid">

<?php
    $act = isset($_GET['act']) ? $_GET['act'] : ''; 
    switch($act){
        default:
            echo"
            <div class='row-fluid'>
                <div class='span12'>
                    ";//<a href='tambah-harga' class='btn btn-primary'><i class=\"icon-plus\"></i> Add Data</a>
                    echo"<div class='widget-box'>
                        <div class='widget-title'> <span class='icon'> <i class='icon-money'></i> </span>
                        <h5>".strtoupper($_GET['page'])." VIEW</h5>
                    </div>
                    <div class='widget-content nopadding'>
                        <table class='table table-bordered table-striped table table-bordered data-table'>
                            <thead>
                                <tr>
                                    <th width='5%'>No</th>
                                    <th>Nama Kamar</th>
                                    <th>Harga Kamar</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>";
                    
                    $no=1;
                    $arr=$harga->tampil_data_harga();
                    foreach($arr ? $arr : [] as $d){
                        echo"
                                <tr class='odd gradeA'>
                                    <td><center>$no</center></td>
                                    <td>$d[lantaiKamar]</td>
                                    <td><center>".$db->format_angka($d['hargaKamar'])."</center></td>
                                    <td> 
                                        <center>
                                            <a class='btn btn-info' href='edit-harga-$d[idHargakamar]' title='Edit Harga'><i class='icon-edit'></i></a>
                                        </center>
                                    </td>
                                </tr>";
                        $no++;
                    }
                        echo" </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>";
        break;  
        case "tambah":
            echo"
            <div class='row-fluid'>
                <div class='span12'>
                    <div class='widget-box'>
                        <div class='widget-title'> <span class='icon'> <i class='icon-money'></i> </span>
                            <h5>FORM TAMBAH ".strtoupper($_GET['page'])."</h5>
                        </div>
                        <div class='widget-content nopadding'>
                            <form class='form-horizontal' method='post' action='input-harga/' name='add_harga_validate' id='add_harga_validate' novalidate='novalidate'>
                                <div class='control-group'>
                                    <label class='control-label'>Nama Kamar</label>
                                    <div class='controls'>
                                        <input type='text' name='nama_kamar' id='nama_kamar' class='span5'>
                                    </div>
                                </div>

                                <div class='control-group'>
                                    <label class='control-label'>Harga Kamar</label>
                                    <div class='controls'>
                                        <input type='text' name='harga_kamar' id='harga_kamar' class='span5 money'>
                                    </div>
                                </div>

                                <div class='form-actions'>
                                    <input type='submit' value='Validate' class='btn btn-success'>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>";
        break;
        case "edit":
            foreach($harga->edit_harga($_GET['id']) as $d){
                echo"
                <div class='row-fluid'>
                    <div class='span12'>
                        <div class='widget-box'>
                            <div class='widget-title'> <span class='icon'> <i class='icon-money'></i> </span>
                                <h5>FORM UBAH ".strtoupper($_GET['page'])."</h5>
                            </div>
                            <div class='widget-content nopadding'>
                                <form class='form-horizontal' method='post' action='update-harga/' name='add_harga_validate' id='add_harga_validate' novalidate='novalidate'>
                                    <input type='hidden' name='id_harga' id='id_harga' value='$d[idHargakamar]'>
                                    <div class='control-group'>
                                        <label class='control-label'>Nama Kamar</label>
                                        <div class='controls'>
                                            <input type='text' name='nama_kamar' id='nama_kamar' class='span5' value='$d[lantaiKamar]'>
                                        </div>
                                    </div>

                                    <div class='control-group'>
                                        <label class='control-label'>Harga Kamar</label>
                                        <div class='controls'>
                                            <input type='text' name='harga_kamar' id='harga_kamar' value='$d[hargaKamar]' class='span5 money'>
                                        </div>
                                    </div>
                                    
                                    <div class='form-actions'>
                                        <input type='submit' value='Validate' class='btn btn-success'>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>";
            }
        break; 
    } 
 ?>   
    
    </div>   <!-- end container fluid -->
</div> <!-- end content -->
