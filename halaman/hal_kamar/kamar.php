<?php
$db= new database();
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
  // Tampil kamar
  default:
    
    echo"<div class='row-fluid'>
      <div class='span12'>
      " ;
      //<a href='tambah-kamar' class='btn btn-primary'><i class=\"icon-plus\"></i> Add Data</a>
      echo "  <div class='widget-box'>
          <div class='widget-title'> <span class='icon'> <i class='icon-home'></i> </span>
            <h5>".strtoupper($_GET['page'])." VIEW</h5>
          </div>
          <div class='widget-content nopadding'>
            <table class='table table-bordered table-striped table table-bordered data-table-kamar'>
              <thead>
                <tr>
                  <th>Nomer kamar</th>
                  <th>Harga kamar</th>
                  <th>Penghuni/Konsumen</th>
                  <th>Tanggal Masuk</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>";
            
               $no=1;
               $arr=$kamar->tampil_data_kamar();
               foreach($arr ? $arr : [] as $d):
                echo"<tr class='odd gradeA'>
                  <td><center>$d[nama_kamar]</center></td>
                  <td><center>".$db->format_angka($d['harga_kamar'])."</center></td>";
                  $nama_penghuni1 = $konsumen->GetNamaKonsumen($d['konsumen_aktif']);
                  $nama_penghuni2 = $konsumen->GetNamaKonsumen($d['konsumen_aktif2']);
                  // hanya 1 penghuni
                  if($nama_penghuni1 !== '' && $d['konsumen_aktif2'] === '0'){
                    echo "<td>".$nama_penghuni1."</td>";
                  }
                  // 2 penghuni aktif
                  else if($d['konsumen_aktif'] !== '0' && $d['konsumen_aktif2'] !== '0') {
                    echo "<td>".$nama_penghuni1." - ".$nama_penghuni2."</td>";
                  }
                  
                  echo "<td><center>$d[tanggal_masuk]</center></td>
                  <td>
                  <center>
                    <a class='btn btn-info' href='edit-kamar-$d[kode_kamar]' title='Edit Task'><i class='icon-edit'></i></a>"; 
                    // &nbsp;
                    // <a class='btn btn-danger' href='hapus-kamar-$d[kode_kamar]' title='Delete'><i class='icon-remove'></i></a>
                   echo " 
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
          <div class='widget-title'> <span class='icon'> <i class='icon-home'></i> </span>
             <h5>FORM TAMBAH ".strtoupper($_GET['page'])."</h5>
          </div>
          <div class='widget-content nopadding'>

            <form class='form-horizontal' method='post' action='input-kamar/' name='add_kamar_validate' id='add_kamar_validate' novalidate='novalidate'>
              <div class='control-group'>
                <label class='control-label'>Kode kamar</label>
                <div class='controls'>
                  <input type='text' name='kode_kamar' id='kode_kamar' class='span5' maxlength='5' value='".$db->get_kode_oto('kode_kamar','kamar','K')."' readonly='yes'>
                </div>
              </div>

              <div class='control-group'>
                <label class='control-label'>Nomer kamar</label>
                <div class='controls'>
                  <input type='number' name='nama_kamar' id='nama_kamar' class='span5' value='".substr($db->get_kode_oto('kode_kamar','kamar','K'), 3,2)."' maxlength='2'>
                </div>
              </div>

              <div class='control-group'>
                <label class='control-label'>Harga Kamar</label>
                <div class='controls'>";
                echo '<select name="harga_kamar" id="harga_kamar" class="span5">'; 
                echo"<option value=0>--Pilih Harga--</option>";
                //Tampilkan combo 
                $ddd=$kamar->comboHargaKamar();
                foreach($ddd as $f){ 
                echo '<option value="' . $f['hargaKamar'] . '">' .$db->format_angka($f['hargaKamar']).' '.$f['lantaiKamar'].'</option>'; }    
                echo"</select>
                </div>
              </div>

              <div class='control-group'>
                <label class='control-label'>Konsumen 1</label>
                <div class='controls'>";
                $jsArray = "var prdName = new Array();\n";
                echo '<select name="konsumen_aktif" id="konsumen_aktif" class="span5">'; 
                echo"<option value=0>--Pilih Konsumen--</option>";
                //Tampilkan combo 
                $ddd=$konsumen->comboKonsumenTambah();
                $count=$konsumen->countKomsumenKosong();
                if ($count>0) {
                  foreach($ddd as $f){ 
                  echo '<option value="' . $f['id_konsumen'] . '">' .$f['nama_konsumen'].'</option>'; }
                }else{
                  echo '<option value="">Semua Konsumen sudah memiliki kamar</option>';
                }
                echo"</select>
                </div>
              </div>

              <div class='control-group'>
                <label class='control-label'>Konsumen 2 (optional)</label>
                <div class='controls'>";
                $jsArray = "var prdName = new Array();\n";
                echo '<select name="konsumen_aktif2" id="konsumen_aktif2" class="span5">'; 
                echo"<option value=0>--Pilih Konsumen--</option>";
                //Tampilkan combo 
                $ddd=$konsumen->comboKonsumenTambah();
                $count=$konsumen->countKomsumenKosong();
                if ($count>0) {
                  foreach($ddd as $f){ 
                  echo '<option value="' . $f['id_konsumen'] . '">' .$f['nama_konsumen'].'</option>'; }
                }else{
                  echo '<option value="">Semua Konsumen sudah memiliki kamar</option>';
                }
                echo"</select>
                </div>
              </div>
                
              <div class='control-group'>
                <label class='control-label'>Tanggal Masuk</label>
                <div class='controls'>
                  <input type='text' data-date='01-02-2013' data-date-format='yyyy-mm-dd' value='$tgl_sekarang' class='datepicker span5'  name='tanggal_masuk' autocomplete='off'>
                </div>  
              </div>";

              // <div class='control-group'>
              //   <label class='control-label'>Langsung Bayar ?</label>
              //   <div class='controls'>
              //     <input type='checkbox' name='langsungbayar' id='langsungbayar' value='1' checked>
              //   </div>  
              // </div>

              // <div class='control-group'>
              //   <label class='control-label'>Cara Bayar</label>
              //   <div class='controls'>
              //     <select name='carabayar' id='carabayar' class='span5'>
              //       <option value=0>--Pilih Cara bayar--</option>
              //       <option value='cash'>Cash / Tunai</option>
              //       <option value='transfer'>Transfer Bank</option>
              //     </select>  
              //   </div>  
              // </div>

              echo"<div class='form-actions'>
                <input type='submit' value='Validate' class='btn btn-success'>
              </div>
            </form>
          </div>
        </div>
      </div>
      </div>";
   break;

    case "edit":
   foreach($kamar->edit_kamar($_GET['id']) as $d){
    echo"<div class='row-fluid'>
      <div class='span12'>
        <div class='widget-box'>
          <div class='widget-title'> <span class='icon'> <i class='icon-home'></i> </span>
            <h5>FORM UBAH ".strtoupper($_GET['page'])."</h5>
          </div>
          <div class='widget-content nopadding'>

            <form class='form-horizontal' method='post' action='update-kamar/' name='add_kamar_validate' id='add_kamar_validate' novalidate='novalidate'>
                  <div class='control-group'>
                <label class='control-label'>kode_kamar</label>
                <div class='controls'>
                  <input type='text' name='kode_kamar' id='kode_kamar' class='span5' maxlength='5' value='$d[kode_kamar]' readonly='yes'>
                </div>
              </div>

              <div class='control-group'>
                <label class='control-label'>Nomer kamar</label>
                <div class='controls'>
                  <input type='text' name='nama_kamar' id='nama_kamar' value='$d[nama_kamar]' class='span5' maxlength='20' readonly>
                </div>
              </div>
              <div class='control-group'>
                <label class='control-label'>Harga kamar</label>
                <div class='controls'>";
                echo '<select name="harga_kamar" id="harga_kamar" class="span5">';
                if ($d['harga_kamar']=='0'){echo"<option value=0>--Pilih Harga--</option>"; } 
                  //Tampilkan combo 
                  $ddd=$kamar->comboHargaKamar();
                  foreach($ddd as $f){ 
                   if ($d['harga_kamar']==$f['hargaKamar']){
                  echo '<option value="' . $f['hargaKamar'] . '" selected>' .$db->format_angka($f['hargaKamar']).' '.$f['lantaiKamar'].'</option>'; }
                  else{
                  echo '<option value="' . $f['hargaKamar'] . '">' .$db->format_angka($f['hargaKamar']).' '.$f['lantaiKamar'].'</option>'; 
                  } 
                }
                echo"</select>
                </div>
              </div>
              
              <div class='control-group'>
                <label class='control-label'>Konsumen 1</label>
                <div class='controls'>";
                $jsArray = "var prdName = new Array();\n";
                echo '<select name="konsumen_aktif" id="konsumen_aktif" class="span5">';
                if ($d['konsumen_aktif']=='' || $d['konsumen_aktif']==0){echo"<option value=0>--Pilih Konsumen--</option>"; } 
                  //Tampilkan combo 
                  $ddd=$konsumen->comboKonsumen();
                  foreach($ddd as $f){ 
                    if ($d['konsumen_aktif']==$f['id_konsumen']){
                    echo '<option value="' . $f['id_konsumen'] . '" selected>' .$f['nama_konsumen'].'</option>'; }
                  }
                  $eee=$konsumen->comboKonsumenTambah();
                  foreach($eee as $e){ 
                    echo '<option value="' . $e['id_konsumen'] . '">' .$e['nama_konsumen'].'</option>'; 
                  }
                   
                echo"</select>
                </div>
              </div>

              <div class='control-group'>
                <label class='control-label'>Konsumen 2 (optional)</label>
                <div class='controls'>";
                $jsArray = "var prdName = new Array();\n";
                echo '<select name="konsumen_aktif2" id="konsumen_aktif2" class="span5">';
                if ($d['konsumen_aktif2']==''|| $d['konsumen_aktif']==0){echo"<option value=0>--Pilih Konsumen--</option>"; } 
                  //Tampilkan combo 
                  $ddd=$konsumen->comboKonsumen();
                  foreach($ddd as $f){ 
                    if ($d['konsumen_aktif2']==$f['id_konsumen']){
                    echo '<option value="' . $f['id_konsumen'] . '" selected>' .$f['nama_konsumen'].'</option>'; }
                  }
                  $eee=$konsumen->comboKonsumenTambah();
                  foreach($eee as $e){ 
                    echo '<option value="' . $e['id_konsumen'] . '">' .$e['nama_konsumen'].'</option>'; 
                  }
                   
                echo"</select>
                </div>
              </div>

              <div class='control-group'>
                <label class='control-label'>Tanggal Masuk</label>
                <div class='controls'>
                    <input type='text' data-date='01-02-2013' data-date-format='yyyy-mm-dd' value='$d[tanggal_masuk]' class='datepicker span5'  name='tanggal_masuk' autocomplete='off'>
                </div>
              </div>";

              // <div class='control-group'>
              //   <label class='control-label'>Langsung Bayar ?</label>
              //   <div class='controls'>
              //     <input type='checkbox' name='langsungbayar' id='langsungbayar' ";
              //     if ($d['langsungbayar'] == 1) {
              //         echo "value='$d[langsungbayar]' checked";
              //      }else{
              //         echo "value='1'";
              //      }
              //      echo ">
              //   </div>  
              // </div>

              // <div class='control-group'>
              //   <label class='control-label'>Cara Bayar</label>
              //   <div class='controls'>
              //     <select name='carabayar' id='carabayar' class='span5'>";
              //     if ($d['carabayar'] != '' && $d['carabayar'] == 'cash') {
              //       echo "<option value='$d[carabayar]'>$d[carabayar]</option>";
              //       echo"
              //       <option value='transfer'>Transfer Bank</option>
              //       ";
              //     }else if  ($d['carabayar'] != '' && $d['carabayar'] == 'transfer') {
              //       echo"<option value='cash'>Cash / Tunai</option>";
              //     }else{
              //       echo"
              //       <option value=0>--Pilih Cara bayar--</option>
              //       <option value='cash'>Cash / Tunai</option>
              //       <option value='transfer'>Transfer Bank</option>
              //       ";  
              //     }
              //     echo "
              //     </select>  
              //   </div>  
              // </div>
              echo "<div class='form-actions'>
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