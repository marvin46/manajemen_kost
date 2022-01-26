<?php
$db= new database();
?>

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="home" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="<?php echo"$_GET[page]";?>" class="current"><?php echo"$_GET[page]";?></a> </div>
    
  </div>
  <div class="container-fluid">
  
  <?php
  $act = isset($_GET['act']) ? $_GET['act'] : ''; 
switch($act){
  // Tampil absensi
  default:
    
    echo"
    <div class='row-fluid'>
      <div class='span6'>
        <div class='widget-box'>
          <div class='widget-title'> <span class='icon'> <i class='icon-plus'></i> </span>
            <h5>".strtoupper($_GET['page'])." PEMBAYARAN VIEW</h5>
          </div>
          <div class='widget-content nopadding'>
          <!-- FORM PEMBAYARAN -->
          <form class='form-horizontal' method='post' action='tampil-laporan/' name='add_data_validate' id='add_data_validate' novalidate='novalidate' target='_blank'>

            <table class='table table-bordered table-striped'>
              <tr>
                <td align='center'><label><input type='radio' name='berdasar' value='Semua Data Transaksi' checked=''/>Semua Data Transaksi</label></td>
                <td> <select name='tahunan' class='span4'>
                  "; 
                  $tahun_ini = 2018;
                  for($a=1; $a<=10; $a++){
                    echo "<option value='$tahun_ini'>$tahun_ini</option>";
                    $tahun_ini++;
                  }
                  echo"
                </select></td>
              </tr>
              <tr>
                <td align='center'><label><input type='radio' name='berdasar' value='Bulan Transaksi'>Bulan Transaksi</label></td>
                <td>

                <select name='bulan' class='span4'>
                  <option value='1'>Jan</option>
                  <option value='2'>Feb</option>
                  <option value='3'>Mar</option>
                  <option value='4'>Apr</option>
                  <option value='5'>Mei</option>
                  <option value='6'>Jun</option>
                  <option value='7'>Jul</option>
                  <option value='8'>Aug</option>
                  <option value='9'>Sep</option>
                  <option value='10'>Okt</option>
                  <option value='11'>Nov</option>
                  <option value='12'>Des</option>
                </select>

                 <select name='tahun' class='span4'>
                  "; 
                  $tahun_ini = 2018;
                  for($a=1; $a<=10; $a++){
                    echo "<option value='$tahun_ini'>$tahun_ini</option>";
                    $tahun_ini++;
                  }
                  echo"
                </select>
                  </td>
              </tr>
              
            </table>
   
            <div class='form-actions'>
              <input type='submit' value='Tampilkan' class='btn btn-success'>
            </div>
          </form>
         <!-- FORM PEMBAYARAN -->    
        </div>
      </div>
    </div>

      <div class='span6'>
        <div class='widget-box'>
          <div class='widget-title'> <span class='icon'> <i class='icon-minus'></i> </span>
            <h5>".strtoupper($_GET['page'])." PENGELUARAN</h5>
          </div>
          <div class='widget-content nopadding'>

         <form class='form-horizontal' method='post' action='tampil-laporan/' name='add_data_validate' id='add_data_validate' novalidate='novalidate' target='_blank'>

         <table class='table table-bordered table-striped'>
              <tr>
                <td align='center'><label><input type='radio' name='berdasar' value='Semua Data Pengeluaran' checked=''/>Semua Data Pengeluaran</label></td>
                <td> <select name='tahun_pengeluaran' class='span4'>
                  "; 
                  $tahun_ini = 2018;
                  for($a=1; $a<=10; $a++){
                    echo "<option value='$tahun_ini'>$tahun_ini</option>";
                    $tahun_ini++;
                  }
                  echo"
                </select></td>
              </tr>
              <tr>
                <td align='center'><label><input type='radio' name='berdasar' value='Bulan Pengeluaran'>Bulan Pengeluaran</label></td>
                <td>

                <select name='bulan_pengeluaran' class='span4'>
                  <option value='1'>Jan</option>
                  <option value='2'>Feb</option>
                  <option value='3'>Mar</option>
                  <option value='4'>Apr</option>
                  <option value='5'>Mei</option>
                  <option value='6'>Jun</option>
                  <option value='7'>Jul</option>
                  <option value='8'>Aug</option>
                  <option value='9'>Sep</option>
                  <option value='10'>Okt</option>
                  <option value='11'>Nov</option>
                  <option value='12'>Des</option>
                </select>

                 <select name='tahun_pengeluaranbulanan' class='span4'>
                  "; 
                  $tahun_ini = 2018;
                  for($a=1; $a<=10; $a++){
                    echo "<option value='$tahun_ini'>$tahun_ini</option>";
                    $tahun_ini++;
                  }
                  echo"
                </select>
                  </td>
              </tr>
              
            </table>

                         
              
            <div class='form-actions'>
              <input type='submit' value='Tampilkan' class='btn btn-success'>
            </div>
          </form>     
        </div>
      </div>
    </div>

    <div class='row-fluid'>
      <div class='span6'>
        <div class='widget-box'>
          <div class='widget-title'> <span class='icon'> <i class='icon-copy'></i> </span>
            <h5>".strtoupper($_GET['page'])." GABUNGAN</h5>
          </div>
          <div class='widget-content nopadding'>

         <form class='form-horizontal' method='post' action='tampil-laporan/' name='add_data_validate' id='add_data_validate' novalidate='novalidate' target='_blank'>

         <table class='table table-bordered table-striped'>";
              /*<tr>
                <td align='center'><label><input type='radio' name='berdasar' value='Semua Data Gabungan' checked=''/>Semua Data Gabungan</label></td>
                <td> <select name='tahun_gabungan' class='span4'>
                  "; 
                  $tahun_ini = 2018;
                  for($a=1; $a<=10; $a++){
                    echo "<option value='$tahun_ini'>$tahun_ini</option>";
                    $tahun_ini++;
                  }
                  echo"
                </select></td>
              </tr>*/
              echo"<tr>
                <td align='center'><label><input type='radio' name='berdasar' value='Bulan Gabungan' checked=''>Bulan Gabungan</label></td>
                <td>

                <select name='bulan_gabungan' class='span4'>
                  <option value='1'>Jan</option>
                  <option value='2'>Feb</option>
                  <option value='3'>Mar</option>
                  <option value='4'>Apr</option>
                  <option value='5'>Mei</option>
                  <option value='6'>Jun</option>
                  <option value='7'>Jul</option>
                  <option value='8'>Aug</option>
                  <option value='9'>Sep</option>
                  <option value='10'>Okt</option>
                  <option value='11'>Nov</option>
                  <option value='12'>Des</option>
                </select>

                 <select name='tahun_gabunganbulanan' class='span4'>
                  "; 
                  $tahun_ini = 2018;
                  for($a=1; $a<=10; $a++){
                    echo "<option value='$tahun_ini'>$tahun_ini</option>";
                    $tahun_ini++;
                  }
                  echo"
                </select>
                  </td>
              </tr>
              
            </table>

                         
              
              <div class='form-actions'>
                <input type='submit' value='Tampilkan' class='btn btn-success'>
              </div>
            </form>     
          </div>
        </div>
      </div>

      <div class='span6'>
        <div class='widget-box'>
          <div class='widget-title'> <span class='icon'> <i class='icon-group'></i> </span>
            <h5>".strtoupper($_GET['page'])." WARGA</h5>
          </div>
          <div class='widget-content nopadding'>

         <form class='form-horizontal' method='post' action='tampil-laporan/' name='add_data_validate' id='add_data_validate' novalidate='novalidate' target='_blank'>

         <table class='table table-bordered table-striped'>
              
              <tr>
                <td align='center'><label><input type='radio' name='berdasar' value='Bulan Warga' checked=''>Bulan Warga</label></td>
                <td>

                <select name='bulan_warga' class='span4'>
                  <option value='1'>Jan</option>
                  <option value='2'>Feb</option>
                  <option value='3'>Mar</option>
                  <option value='4'>Apr</option>
                  <option value='5'>Mei</option>
                  <option value='6'>Jun</option>
                  <option value='7'>Jul</option>
                  <option value='8'>Aug</option>
                  <option value='9'>Sep</option>
                  <option value='10'>Okt</option>
                  <option value='11'>Nov</option>
                  <option value='12'>Des</option>
                </select>

                 <select name='tahun_wargabulanan' class='span4'>
                  "; 
                  $tahun_ini = 2018;
                  for($a=1; $a<=10; $a++){
                    echo "<option value='$tahun_ini'>$tahun_ini</option>";
                    $tahun_ini++;
                  }
                  echo"
                </select>
                  </td>
              </tr>
              
            </table>

                         
              
              <div class='form-actions'>
                <input type='submit' value='Tampilkan' class='btn btn-success'>
              </div>
            </form>     
          </div>
        </div>
      </div>

    </div>";

  break;  

   
   } 
 ?>   
    
      </div>   
  </div>
