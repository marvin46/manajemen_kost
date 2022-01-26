<?php
$db= new database();
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
  // Tampil konsumen
  default:
    
    echo"<div class='row-fluid'>
      <div class='span12'>
      <a href='tambah-konsumen' class='btn btn-primary'><i class=\"icon-plus\"></i> Add Data</a>
        <div class='widget-box'>
          <div class='widget-title'> <span class='icon'> <i class='icon-group'></i> </span>
            <h5>".strtoupper($_GET['page'])." VIEW</h5>
          </div>
          <div class='widget-content nopadding'>
            <table class='table table-bordered table-striped table table-bordered data-table'>
              <thead>
                <tr>
                  <th>Nama konsumen</th>
                  <th>Alamat</th>
                  <th>HP</th>
                  <th>Status</th>

                  <th>Action</th>
                </tr>
              </thead>
              <tbody>";
            
               $no=1;
               $arr=$konsumen->tampil_data();
               foreach($arr ? $arr : [] as $d):
                echo"<tr class='odd gradeA'>
                  <td>$d[nama_konsumen]</td>
                  <td>$d[alamat_konsumen]</td>
                  <td><center>$d[hp]</center></td>
                  <td><center>$d[status]</center></td>
                  <td>
                  <center>
                    <a class='btn btn-info' href='edit-konsumen-$d[id_konsumen]' title='Edit Task'><i class='icon-edit'></i></a> 
                    &nbsp;
                    <a class='btn btn-danger' href='hapus-konsumen-$d[id_konsumen]' title='Delete'><i class='icon-remove'></i></a>
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
          <div class='widget-title'> <span class='icon'> <i class='icon-group'></i> </span>
             <h5>FORM TAMBAH ".strtoupper($_GET['page'])."</h5>
          </div>
          <div class='widget-content nopadding'>

            <form class='form-horizontal' method='post' action='input-konsumen/' name='add_konsumen_validate' id='add_konsumen_validate' novalidate='novalidate'>
              <div class='control-group'>
                <label class='control-label'>Kode konsumen</label>
                <div class='controls'>
                  <input type='text' name='id_konsumen' id='id_konsumen' class='span5' maxlength='5' value='".$db->get_kode_oto('id_konsumen','konsumen','T')."' readonly='yes'>
                </div>
              </div>

              <div class='control-group'>
                <label class='control-label'>Nama *</label>
                <div class='controls'>
                  <input type='text' name='nama_konsumen' id='nama_konsumen' placeholder='Nama Konsumen' class='span5' maxlength='50'>
                </div>
              </div>

              <div class='control-group'>
                <label class='control-label'>NIK *</label>
                <div class='controls'>
                  <input type='text' name='nik' id='nik' placeholder='NIK / NO KTP / SIM / PASSPORT' class='span5' maxlength='50'>
                </div>
              </div>

              <div class='control-group'>
                <label class='control-label'>Tempat / Tanggal Lahir *</label>
                <div class='controls'>
                  <input type='text' name='tempatlahir' id='tempatlahir' placeholder='Tempat Lahir ex: Jakarta' class='span5' maxlength='50'> / 
                  <input type='text' data-date='01-01-1945' data-date-format='yyyy-mm-dd' value='' class='datepicker span5'  name='tgllahir' autocomplete='off'>
                </div>
              </div>



              <div class='control-group'>
                <label class='control-label'>Jenis Kelamin *</label>
                <div class='controls'>
                  <select name='jekel' id='jekel' class='span5'>
                    <option value=0>--Pilih Jenis Kelamin--</option> 
                    <option value='L'>Laki - laki</option>
                    <option value='P'>Perempuan</option>
                  </select>
                </div>
              </div>

              <div class='control-group'>
                <label class='control-label'>Agama *</label>
                <div class='controls'>
                  <select name='agama' id='agama' class='span5'>
                    <option value=0>--Pilih Agama--</option> 
                    <option value='ISLAM'>ISLAM</option>
                    <option value='KRISTEN'>KRISTEN</option>
                    <option value='HINDU'>HINDU</option>
                    <option value='BUDHA'>BUDHA</option>
                  </select>
                </div>
              </div>

              <div class='control-group'>
                <label class='control-label'>Pekerjaan *</label>
                <div class='controls'>
                  <input type='text' name='pekerjaan' id='pekerjaan' placeholder='Pekerjaan, ex: Mahasiswa' class='span5' maxlength='50'>
                </div>
              </div>

              <div class='control-group'>
                <label class='control-label'>Status Perkawinan</label>
                <div class='controls'>
                  <select name='statusperkawinan' id='statusperkawinan' class='span5'>
                    <option value=0>--Pilih Status Perkawinan--</option> 
                    <option value='KAWIN'>KAWIN</option>
                    <option value='BELUM KAWIN'>BELUM KAWIN</option>
                    <option value='JANDA'>JANDA</option>
                    <option value='DUDA'>DUDA</option>
                  </select>
                </div>
              </div>

              <div class='control-group'>
                <label class='control-label'>Nama Istri</label>
                <div class='controls'>
                  <input type='text' name='nama_istri' id='nama_istri' placeholder='Nama Istri Jika sudah menikah' class='span5' maxlength='50'>
                </div>
              </div>

              <div class='control-group'>
                <label class='control-label'>Nama anak ke-1,2</label>
                <div class='controls'>
                  <input type='text' name='anak1' id='anak1' placeholder='Nama anak ke-1' class='span5' maxlength='50'>
                  <input type='text' name='anak2' id='anak2' placeholder='Nama anak ke-2' class='span5' maxlength='50'>
                </div>
              </div>

              <div class='control-group'>
                <label class='control-label'>Nama anak ke-3,4</label>
                <div class='controls'>
                  <input type='text' name='anak3' id='anak3' placeholder='Nama anak ke-3' class='span5' maxlength='50'>
                  <input type='text' name='anak4' id='anak4' placeholder='Nama anak ke-4' class='span5' maxlength='50'>
                </div>
              </div>
";
              /*<div class='control-group'>
                <label class='control-label'>Tanggal MASUK</label>
                <div class='controls'>
                  <input type='text' data-date='01-01-2018' data-date-format='yyyy-mm-dd' value='' class='datepicker span5'  name='tanggal_masuk' autocomplete='off'>
                </div>
              </div>*/

echo "
              <div class='control-group'>
                <label class='control-label'>Alamat Sesuai KTP *</label>
                <div class='controls'>
                  <textarea class='span5' name='alamat_konsumen' id='alamat_konsumen' placeholder='Alamat' ></textarea>
                </div>
              </div>

              <div class='control-group'>
                <label class='control-label'>HP *</label>
                <div class='controls'>
                  <input type='number' name='hp' id='hp' maxlength='16' placeholder='ex : 081234567890' class='span5'>
                </div>
              </div>

              

              <div class='control-group'>
                <label class='control-label'>Status</label>
                <div class='controls'>
                  <select name='status' class='span5'>
                  <option value='aktif'>aktif</option>
                  <option value='nonaktif'>non-aktif</option>
                </select>
                </div>
              </div>
              
              <div class='form-actions'>
                <input type='submit' value='Validate' class='btn btn-success'>
                <a href='tambah-konsumen' class='btn btn-info'><i class=\"icon-refresh\"></i>Ulang</a>
                <a href='konsumen' class='btn btn-warning'><i class=\"icon-minus\"></i>Batal</a>
              </div>
            </form>
          </div>
        </div>
      </div>
      </div>";
   break;

    case "edit":
   foreach($konsumen->edit_konsumen($_GET['id']) as $d){
    echo"<div class='row-fluid'>
      <div class='span12'>
        <div class='widget-box'>
          <div class='widget-title'> <span class='icon'> <i class='icon-group'></i> </span>
            <h5>FORM UBAH ".strtoupper($_GET['page'])."</h5>
          </div>
          <div class='widget-content nopadding'>

            <form class='form-horizontal' method='post' action='update-konsumen/' name='add_konsumen_validate' id='add_konsumen_validate' novalidate='novalidate'>
                  <div class='control-group'>
                <label class='control-label'>id_konsumen</label>
                <div class='controls'>
                  <input type='text' name='id_konsumen' id='id_konsumen' class='span5' maxlength='5' value='$d[id_konsumen]' readonly='yes'>
                </div>
              </div>

              <div class='control-group'>
                <label class='control-label'>Nama *</label>
                <div class='controls'>
                  <input type='text' name='nama_konsumen' id='nama_konsumen' placeholder='Nama Konsumen' value='$d[nama_konsumen]' class='span5' maxlength='50'>
                </div>
              </div>

              <div class='control-group'>
                <label class='control-label'>NIK *</label>
                <div class='controls'>
                  <input type='text' name='nik' id='nik' placeholder='NIK / NO KTP / SIM / PASSPORT' value='$d[nik]' class='span5' maxlength='50'>
                </div>
              </div>

              <div class='control-group'>
                <label class='control-label'>Tempat / Tanggal Lahir *</label>
                <div class='controls'>
                  <input type='text' name='tempatlahir' id='tempatlahir' placeholder='Tempat Lahir ex: Jakarta' value='$d[tempatlahir]' class='span5' maxlength='50'> / 
                  <input type='text' data-date='01-01-1945' data-date-format='yyyy-mm-dd' value='$d[tgllahir]' class='datepicker span5'  name='tgllahir' autocomplete='off'>
                </div>
              </div>



              <div class='control-group'>
                <label class='control-label'>Jenis Kelamin *</label>
                <div class='controls'>
                  <select name='jekel' id='jekel' class='span5'>";
                  if ($d['jekel'] == 'L') {
                    echo "<option value='L'>Laki - laki</option>";
                    echo "<option value='P'>Perempuan</option>";
                  }else{
                    echo "<option value='P'>Perempuan</option>";
                    echo "<option value='L'>Laki - laki</option>";
                  }
                  echo"  
                  </select>
                </div>
              </div>

              <div class='control-group'>
                <label class='control-label'>Agama *</label>
                <div class='controls'>
                  <select name='agama' id='agama' class='span5'>";
                  if ($d['agama'] == 'ISLAM') {
                    echo "<option value='ISLAM'>ISLAM</option>";
                    echo "<option value='KRISTEN'>KRISTEN</option>
                          <option value='HINDU'>HINDU</option>
                          <option value='BUDHA'>BUDHA</option>
                    ";
                  }else if ($d['agama'] == 'KRISTEN'){
                    echo "<option value='KRISTEN'>KRISTEN</option>";
                    echo "<option value='ISLAM'>ISLAM</option>
                          <option value='HINDU'>HINDU</option>
                          <option value='BUDHA'>BUDHA</option>
                    ";
                  }else if ($d['agama'] == 'HINDU'){
                    echo "<option value='BUDHA'>BUDHA</option>";
                    echo "<option value='ISLAM'>ISLAM</option>
                          <option value='KRISTEN'>KRISTEN</option>
                          <option value='BUDHA'>BUDHA</option>
                          
                    ";
                  }else if ($d['agama'] == 'BUDHA'){
                    echo "<option value='BUDHA'>BUDHA</option>";
                    echo "<option value='ISLAM'>ISLAM</option>
                          <option value='KRISTEN'>KRISTEN</option>
                          <option value='HINDU'>HINDU</option>
                          
                    ";
                  }else{
                    echo"<option value=0>--Pilih Agama--</option> 
                    <option value='ISLAM'>ISLAM</option>
                    <option value='KRISTEN'>KRISTEN</option>
                    <option value='HINDU'>HINDU</option>
                    <option value='BUDHA'>BUDHA</option>";
                  }
                  echo"  
                  </select>
                </div>
              </div>

              <div class='control-group'>
                <label class='control-label'>Pekerjaan *</label>
                <div class='controls'>
                  <input type='text' name='pekerjaan' id='pekerjaan' value='$d[pekerjaan]' placeholder='Pekerjaan, ex: Mahasiswa' class='span5' maxlength='50'>
                </div>
              </div>

              <div class='control-group'>
                <label class='control-label'>Status Perkawinan</label>
                <div class='controls'>
                  <select name='statusperkawinan' id='statusperkawinan' class='span5'>";
                    if ($d['statuskawin'] == 'KAWIN') {
                    echo "<option value='KAWIN' selected>KAWIN</option>";
                    echo "<option value='BELUM'>BELUM KAWIN</option>
                          <option value='JANDA'>JANDA</option>
                          <option value='DUDA'>DUDA</option>
                    ";
                  }else if ($d['statuskawin'] == 'BELUM'){
                    echo "<option value='BELUM' selected>BELUM KAWIN</option>";
                    echo "<option value='KAWIN'>KAWIN</option>
                          <option value='HINDU'>HINDU</option>
                          <option value='BUDHA'>BUDHA</option>
                    ";
                  }else if ($d['statuskawin'] == 'JANDA'){
                    echo "<option value='JANDA' selected>JANDA</option>";
                    echo "<option value='KAWIN'>KAWIN</option>
                          <option value='BELUM'>BELUM KAWIN</option>
                          <option value='DUDA'>DUDA</option>
                          
                    ";
                  }else if ($d['statuskawin'] == 'DUDA'){
                    echo "<option value='DUDA' selected>DUDA</option>";
                    echo "<option value='KAWIN'>KAWIN</option>
                          <option value='BELUM'>BELUM KAWIN</option>
                          <option value='JANDA'>JANDA</option>
                          
                    ";
                  }else{
                    echo"
                          <option value=0>--Pilih Status Perkawinan--</option> 
                          <option value='KAWIN'>KAWIN</option>
                          <option value='BELUM KAWIN'>BELUM KAWIN</option>
                          <option value='JANDA'>JANDA</option>
                          <option value='DUDA'>DUDA</option>
                        ";
                  }
                  echo"  
                  </select>
                </div>
              </div>

              <div class='control-group'>
                <label class='control-label'>Nama Istri</label>
                <div class='controls'>
                  <input type='text' name='nama_istri' id='nama_istri' placeholder='Nama Istri Jika sudah menikah' value='$d[namaistri]' class='span5' maxlength='50'>
                </div>
              </div>

              <div class='control-group'>
                <label class='control-label'>Nama anak ke-1,2</label>
                <div class='controls'>
                  <input type='text' name='anak1' id='anak1' placeholder='Nama anak ke-1' class='span5' maxlength='50' value='$d[anak1]'>
                  <input type='text' name='anak2' id='anak2' placeholder='Nama anak ke-2' class='span5' maxlength='50' value='$d[anak2]'>
                </div>
              </div>

              <div class='control-group'>
                <label class='control-label'>Nama anak ke-3,4</label>
                <div class='controls'>
                  <input type='text' name='anak3' id='anak3' placeholder='Nama anak ke-3' class='span5' maxlength='50' value='$d[anak3]'>
                  <input type='text' name='anak4' id='anak4' placeholder='Nama anak ke-4' class='span5' maxlength='50'  value='$d[anak4]'>
                </div>
              </div>
";
              /*<div class='control-group'>
                <label class='control-label'>Tanggal MASUK</label>
                <div class='controls'>
                  <input type='text' data-date='01-01-2018' data-date-format='yyyy-mm-dd' value='$d[tanggal_masuk]' class='datepicker span5'  name='tanggal_masuk' autocomplete='off'>
                </div>
              </div>*/

echo "
              <div class='control-group'>
                <label class='control-label'>Alamat Sesuai KTP *</label>
                <div class='controls'>
                  <textarea class='span5' name='alamat_konsumen' value='$d[alamat_konsumen]' id='alamat_konsumen' placeholder='Alamat' > $d[alamat_konsumen]</textarea>
                </div>
              </div>

              <div class='control-group'>
                <label class='control-label'>HP *</label>
                <div class='controls'>
                  <input type='number' name='hp' id='hp' maxlength='16' value='$d[hp]' placeholder='ex : 081234567890' class='span5'>
                </div>
              </div>

              <div class='control-group'>
                <label class='control-label'>Tanggal KELUAR</label>
                <div class='controls'>
                  <input type='text' data-date='01-01-2018' data-date-format='yyyy-mm-dd' value='$d[tanggal_keluar]' class='datepicker span5'  name='tanggal_keluar' autocomplete='off'>
                </div>
              </div>

              <div class='control-group'>
                <label class='control-label'>Status</label>
                <div class='controls'>
                  <select name='status' class='span5'>
                  <option value='aktif'>aktif</option>
                  <option value='nonaktif'>non-aktif</option>
                </select>
                </div>
              </div>
              
              <div class='form-actions'>
                <input type='submit' value='Validate' class='btn btn-success'>
                <a href='edit-konsumen-$d[id_konsumen]' class='btn btn-info'><i class=\"icon-refresh\"></i>Ulang</a>
                <a href='konsumen' class='btn btn-warning'><i class=\"icon-minus\"></i>Batal</a>
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
