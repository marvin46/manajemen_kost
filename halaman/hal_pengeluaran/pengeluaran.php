<?php
$db= new Database();
$pengeluaran= new pengeluaran();
?>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="home" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="<?php echo"$_GET[page]";?>" class="current"><?php echo"$_GET[page]";?></a> </div>
    
  </div>
  <div class="container-fluid">
  
  <?php
  $act = isset($_GET['act']) ? $_GET['act'] : ''; 
switch($act){
  // Tampil pengeluaran
  default:
    
    echo"<div class='row-fluid'>
      <div class='span12'>
      <a href='tambah-pengeluaran' class='btn btn-primary'><i class=\"icon-plus\"></i> Add Data</a>
        <div class='widget-box'>
          <div class='widget-title'> <span class='icon'> <i class='icon-cut'></i> </span>
            <h5>".strtoupper($_GET['page'])." VIEW</h5>
          </div>
          <div class='widget-content nopadding'>
            <table class='table table-bordered table-striped table table-bordered data-table'>
              <thead>
                <tr>
                  <th width='5%'>No</th>
                  <th>Nama pengeluaran</th>
                  <th>Jumlah</th>
                  <th>Tanggal</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>";
            
               $no=1;
               $arr=$pengeluaran->tampil_data_pengeluaran();
               foreach($arr ? $arr : [] as $d):
                echo"<tr class='odd gradeA'>
                  <td><center>$no</center></td>
                  <td>$d[nama_pengeluaran]</td>
                  <td><center>".$db->format_angka($d['jumlah'])."</center></td>
                  <td>$d[tanggal]</td>
                  <td>
                  <center>
                    <a class='btn btn-info' href='edit-pengeluaran-$d[id_pengeluaran]' title='Edit Task'><i class='icon-edit'></i></a> 
                    &nbsp;
                    <a class='btn btn-danger' href='hapus-pengeluaran-$d[id_pengeluaran]' title='Delete'><i class='icon-remove'></i></a>
                  </center>
                  </td>
                </tr>";
                $no++;
               endforeach;
              
                
              echo"</tbody>
            </table>
          </div>
        </div>
      </div>
      </div>";

  break;  

  
   case "tambah":

    echo"<div class='row-fluid'>
      <div class='span12'>
        <div class='widget-box'>
          <div class='widget-title'> <span class='icon'> <i class='icon-cut'></i> </span>
             <h5>FORM TAMBAH ".strtoupper($_GET['page'])."</h5>
          </div>
          <div class='widget-content nopadding'>

            <form class='form-horizontal' method='post' action='input-pengeluaran/' name='add_pengeluaran_validate' id='add_pengeluaran_validate' novalidate='novalidate'>
                <div class='control-group'>
                  <label class='control-label'>Kode pengeluaran</label>
                  <div class='controls'>
                    <input type='text' name='id_pengeluaran' id='id_pengeluaran' class='span5' maxlength='5' value='".$db->get_kode_oto('id_pengeluaran','pengeluaran','B')."' readonly='yes'>
                  </div>
                </div>

                <div class='control-group'>
                  <label class='control-label'>Nama pengeluaran</label>
                  <div class='controls'>
                    <textarea class='span5' name='nama_pengeluaran' id='nama_pengeluaran'></textarea>
                  </div>
                </div>

                <div class='control-group'>
                  <label class='control-label'>Jumlah pengeluaran</label>
                  <div class='controls'>
                    <input type='text' name='jumlah' id='jumlah' class='span5 money'>
                  </div>
                </div>

                <div class='control-group'>
                <label class='control-label'>Tanggal</label>
                  <div class='controls'>
                    <input type='text' data-date='01-02-2013' data-date-format='yyyy-mm-dd' value='$tgl_sekarang' class='datepicker span5'  name='tanggal' autocomplete='off'>
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
   foreach($pengeluaran->edit_pengeluaran($_GET['id']) as $d){
    echo"<div class='row-fluid'>
      <div class='span12'>
        <div class='widget-box'>
          <div class='widget-title'> <span class='icon'> <i class='icon-cut'></i> </span>
            <h5>FORM UBAH ".strtoupper($_GET['page'])."</h5>
          </div>
          <div class='widget-content nopadding'>

            <form class='form-horizontal' method='post' action='update-pengeluaran/' name='add_pengeluaran_validate' id='add_pengeluaran_validate' novalidate='novalidate'>
              <div class='control-group'>
                <label class='control-label'>id_pengeluaran</label>
                <div class='controls'>
                  <input type='text' name='id_pengeluaran' id='id_pengeluaran' class='span5' maxlength='5' value='$d[id_pengeluaran]' readonly='yes'>
                </div>
              </div>

              <div class='control-group'>
                <label class='control-label'>Nomer pengeluaran</label>
                <div class='controls'>
                  <textarea class='span5' name='nama_pengeluaran' id='nama_pengeluaran'>$d[nama_pengeluaran]</textarea>
                </div>
              </div>
              <div class='control-group'>
                <label class='control-label'>Jumlah</label>
                <div class='controls'>
                  <input type='text' name='jumlah' id='jumlah' value='$d[jumlah]' class='span5 money' maxlength='10'>
                </div>
              </div>

              <div class='control-group'>
                <label class='control-label'>Tanggal</label>
                  <div class='controls'>
                    <input type='text' data-date='01-02-2013' data-date-format='yyyy-mm-dd' value='$d[tanggal]' class='datepicker span5'  name='tanggal' autocomplete='off'>
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
    
      </div>   
  </div>
