<?php
$db= new database();
$transaksi= new Transaksi();
$kamar= new kamar();
$konsumen= new Konsumen();
?>


<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="home" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="<?php echo"$_GET[page]";?>" class="current"><?php echo"$_GET[page]";?></a> </div>
    
  </div>
  <div class="container-fluid">
  
  <?php
  $act = isset($_GET['act']) ? $_GET['act'] : ''; 
switch($act){
  // Tampil transaksi
  default:
    
   echo"<div class='row-fluid'>
      <div class='span6'>
        <div class='widget-box'>
          <div class='widget-title'> <span class='icon'> <i class='icon-time'></i> </span>
            <h5>".strtoupper($_GET['page'])." VIEW</h5>
          </div>
          <div class='widget-content nopadding'>
          <!-- FORM PILIH PERIODE -->
         <form class='form-horizontal' method='post' action='lihat-status' name='add_data_validate' target='_blank' id='add_data_validate' novalidate='novalidate'>
              <div class='control-group'>
                <label class='control-label'>Bulan</label>
                <div class='controls'>
                  <select name='bulan' class='span7'>
                  <option value='1'>Januari</option>
                  <option value='2'>Februari</option>
                  <option value='3'>Maret</option>
                  <option value='4'>April</option>
                  <option value='5'>Mei</option>
                  <option value='6'>Juni</option>
                  <option value='7'>Juli</option>
                  <option value='8'>Agustus</option>
                  <option value='9'>September</option>
                  <option value='10'>Oktober</option>
                  <option value='11'>November</option>
                  <option value='12'>Desember</option>
                </select>
                </div>
              </div>

              <div class='control-group'>
                <label class='control-label'>Tahun</label>
                <div class='controls'>
                  <select name='tahun' class='span7'>
                  <option value='2018'>2018</option>
                  <option value='2019'>2019</option>
                  <option value='2020'>2020</option>
                  <option value='2021'>2021</option>
                  <option value='2022'>2022</option>
                  <option value='2023'>2023</option>
                  <option value='2024'>2024</option>
                  <option value='2025'>2025</option>
                  <option value='2026'>2026</option>
                  <option value='2027'>2027</option>
                  <option value='2028'>2028</option>
                  <option value='2029'>2029</option>
                  <option value='2030'>2030</option>
                </select>
                </div>
              </div>
                
             
              <div class='form-actions'>
                <input type='submit' value='Tampilkan' class='btn btn-success'>
              </div>
            </form>
         <!-- FORM TAMBAH ABASEN -->



            
          </div>
        </div>
      </div>
      </div>";

  break;  

  
   case "lihat-status":
   echo"<div class='row-fluid'>
      <div class='span12'>
        <div class='widget-box'>
          <div class='widget-title'> <span class='icon'> <i class='icon-linkedin'></i> </span>
            <h5>".strtoupper($_GET['page'])." VIEW Bulan ".$transaksi->GetBulan($_POST['bulan'])." - ".$_POST['tahun']."</h5>
          </div>
          <div class='widget-content nopadding'>
            <table class='table table-bordered table-striped table table-bordered data-table'>
              <thead>
                <tr>
                  <th>Nomer Kamar</th>
                  <th>Konsumen/Penghuni Aktif</th>
                  <th>Tanggal Masuk</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>";
            
               $no=1;
               $arr=$kamar->tampil_data_kamar_bayar($_POST['bulan'],$_POST['tahun']);
               foreach($arr ? $arr : [] as $d):
                echo"<tr class='odd gradeA'>
                  <td><center>$d[nama_kamar]</center></td>";
                    if($transaksi->Get_status_bayar($d['kode_kamar'],$_POST['bulan'],$_POST['tahun'])>0){
                    echo"<td>".$konsumen->GetNamaKonsumenOnTransaksi($transaksi->Get_No_Bayar($d['kode_kamar'],$_POST['bulan'],$_POST['tahun']))."</td>";
                    } else {
                    echo"<td>".$konsumen->GetNamaKonsumen($d['konsumen_aktif']); 
                    if($d['konsumen_aktif2']) {
                      echo " dan ".$konsumen->GetNamaKonsumen($d['konsumen_aktif2']);
                    }
                    echo "</td>";
                    }
            echo"<td><center>$d[tanggal_masuk]</center></td> <td><center>";
          
                    if($transaksi->Get_status_bayar($d['kode_kamar'],$_POST['bulan'],$_POST['tahun'])>0){
                    echo"<div class='btn-group'>
                        <button data-toggle='dropdown' class='btn btn-mini btn-success dropdown-toggle'>Sudah Bayar <span class='caret'></span></button>
                        <ul class='dropdown-menu'>
                          <li><a href='hapus-transaksi-".base64_encode($transaksi->Get_No_Bayar($d['kode_kamar'],$_POST['bulan'],$_POST['tahun']))."'>Hapus</a></li>
                  <li><a href='detail-invoice-".base64_encode($transaksi->Get_No_Bayar($d['kode_kamar'],$_POST['bulan'],$_POST['tahun']))."' target='_blank'>Print</a></li>
                        </ul>
                      </div>";  
                    } else{

                    echo"<div class='btn-group'>
                        <button data-toggle='dropdown' class='btn btn-mini btn-danger dropdown-toggle'>Belum Bayar <span class='caret'></span></button>
                        <ul class='dropdown-menu'>
                          <li><a href='bayar-$d[kode_kamar]-$_POST[bulan]-$_POST[tahun]'>Bayar</a></li>
                        </ul>
                      </div>";
                    }
            echo"</center></td>
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
   break;
   case "bayar":
    if ($kamar->Get_Konsumen2_aktif_On_Data_Kamar($_GET['id'])) {
      $konsumen2 = $konsumen->GetNamaKonsumen($kamar->Get_Konsumen2_aktif_On_Data_Kamar($_GET['id']));
      $konsumen2 = " dan ".$konsumen2;
    }else{
      $konsumen2 = "";
    }
    echo"<div class='row-fluid span12'>
      <div class='span5'>
        <div class='widget-box'>
          <div class='widget-title'> <span class='icon'> <i class='icon-money'></i> </span>
             <h5>FORM TAMBAH ".strtoupper($_GET['page'])." 1 BULAN</h5>
          </div>
          <div class='widget-content nopadding'>

            <form class='form-horizontal' method='post' action='input-transaksi/' name='add_transaksi_validate' id='add_transaksi_validate' novalidate='novalidate'>
              <input type='hidden' name='kode_kamar' value='$_GET[id]'>
              <input type='hidden' name='bulan' value='$_GET[bl]'>
              <input type='hidden' name='tahun' value='$_GET[th]'>
              <input type='hidden' name='id_konsumen' value='".$kamar->Get_Konsumen_aktif_On_Data_Kamar($_GET['id'])."'>
              <input type='hidden' name='id_konsumen2' value='".$kamar->Get_Konsumen2_aktif_On_Data_Kamar($_GET['id'])."'>

              <div class='control-group'>
                <label class='control-label'>No Transaksi</label>
                  <div class='controls'>
                    <input type='text' name='id_transaksi' id='id_transaksi' class='span10' maxlength='6' value='".$db->get_kode_oto('id_transaksi','transaksi','TR')."' readonly='yes'>
                  </div>
              </div>

              <div class='control-group'>
                <label class='control-label'>Nama Konsumen</label>
                  <div class='controls'>
                    <input type='text' name='nama_konsumen' id='nama_konsumen' class='span10'  value='".$konsumen->GetNamaKonsumen($kamar->Get_Konsumen_aktif_On_Data_Kamar($_GET['id'])).$konsumen2."' readonly='yes'>
                  </div>
              </div>

              <div class='control-group'>
                <label class='control-label'>Tanggal Bayar</label>
                <div class='controls'>
                    <input type='text' data-date='01-02-2013' data-date-format='yyyy-mm-dd' value='$tgl_sekarang' class='datepicker span10'  name='tanggal' autocomplete='off'>
                </div>
              </div>

              <div class='control-group'>
                <label class='control-label'>Total Bayar</label>
                <div class='controls'>
                  <input type='text' name='total' id='subtotaltxt' class='span10 money' value='".$kamar->Get_Harga_Kamar($_GET['id'])."'>
                </div>
              </div>

              <div class='control-group'>
                <label class='control-label'>Tambahan</label>
                <div class='controls'>
                  <textarea name='tambahan' id='tambahan' class='span10' title='isi dengan keterangan tambahan seperti Pulsa Listrik'></textarea>
                </div>
              </div>
                
              <div class='form-actions'>
                <input type='submit' value='Validate' class='btn btn-success'>
              </div>
            </form>
          </div>
        </div>
      </div>";

    echo"<div class='span6'>
        <div class='widget-box'>
          <div class='widget-title'> <span class='icon'> <i class='icon-money'></i> </span>
             <h5>FORM TAMBAH ".strtoupper($_GET['page'])." LEBIH DARI 1 BULAN</h5>
          </div>
          <div class='widget-content nopadding'>

            <form class='form-horizontal' method='post' action='input-transaksi-2/' name='add_transaksi_validate_2' id='add_transaksi_validate_2' novalidate='novalidate'>
              <input type='hidden' name='kode_kamar' value='$_GET[id]'>
              <input type='hidden' name='tahun' value='$_GET[th]'>
              <input type='hidden' name='id_konsumen' value='".$kamar->Get_Konsumen_aktif_On_Data_Kamar($_GET['id'])."'>

              <div class='control-group'>
                <label class='control-label'>No Transaksi</label>
                  <div class='controls'>
                    <input type='text' name='id_transaksi' id='id_transaksi' class='span11' maxlength='6' value='".$db->get_kode_oto('id_transaksi','transaksi','TR')."' readonly='yes'>
                  </div>
              </div>

              <div class='control-group'>
                <label class='control-label'>Nama Konsumen</label>
                  <div class='controls'>
                    <input type='text' name='nama_konsumen' id='nama_konsumen' class='span11' maxlength='6' value='".$konsumen->GetNamaKonsumen($kamar->Get_Konsumen_aktif_On_Data_Kamar($_GET['id'])).$konsumen2."' readonly='yes'>
                  </div>
              </div>
              
              <div class='control-group'>
                <label class='control-label'>Tanggal Bayar</label>
                <div class='controls'>
                    <input type='text' data-date='01-02-2013' data-date-format='yyyy-mm-dd' value='$tgl_sekarang' class='datepicker span11'  name='tanggal' autocomplete='off'>
                </div>
              </div>

              <div class='control-group'>
                <label class='control-label'>Untuk Bulan</label>
                <div class='controls'>
                    <select name='bulan1' class='span5'>
                      <option value='$_GET[bl]' selected>".$transaksi->GetBulan($_GET['bl'])."</option>";
                        echo $db->listBulan($_GET['bl']);
                        echo "
                    </select>
                    <span class='span1'> to </span> 
                    <select name='bulan2' class='span5'>
                    <option value='"; echo $_GET['bl']+1; echo"' selected>".$transaksi->GetBulan($_GET['bl']+1)."</option>
                      <option value='1'>Januari</option>
                      <option value='2'>Februari</option>
                      <option value='3'>Maret</option>
                      <option value='4'>April</option>
                      <option value='5'>Mei</option>
                      <option value='6'>Juni</option>
                      <option value='7'>Juli</option>
                      <option value='8'>Agustus</option>
                      <option value='9'>September</option>
                      <option value='10'>Oktober</option>
                      <option value='11'>November</option>
                      <option value='12'>Desember</option>
                    </select>
                </div>
              </div>

              <div class='control-group'>
                <label class='control-label'>Total Bayar</label>
                <div class='controls'>
                  <input type='text' name='total2' id='subtotaltxt' class='span11 money' value='".$kamar->Get_Harga_Kamar($_GET['id'])."'>
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
   break; 
   } 
 ?>   
    
      </div>   
  </div>
