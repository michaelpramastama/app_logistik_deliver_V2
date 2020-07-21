<?php
include 'header.php';
include '../../koneksi.php';
            $country1 = '';
            $country2 = '';
          $barcode = date('YmdHis');
          $hasil = "LGST$barcode";  
          
          $querycon1 = "SELECT * from country ";
        $resultcon1 = mysqli_query($koneksi,$querycon1);
        while($rowcon1 = mysqli_fetch_array($resultcon1))
        {
            $country1 .= '<option value="'.$rowcon1[0].'">'.$rowcon1[1].'</option>';
        }

     $querycon2 = "SELECT * from country ";
        $resultcon2 = mysqli_query($koneksi,$querycon2);
        while($rowcon2 = mysqli_fetch_array($resultcon2))
        {
            $country2 .= '<option value="'.$rowcon2[0].'">'.$rowcon2[1].'</option>';
        }
?>

<div class="container" id="body" >
      <div class="card">
            <div class="card-body">
                  <h3><b>Barang Masuk</b></h3>
            </div>
      </div>
      <br>
      <form id="upload_form" action="insert.php" method="post">

            <?php
            $user =  $_SESSION['username'];  
            $data = mysqli_query($koneksi,"select * from user where username = '$user'");
            $cek_login = mysqli_fetch_assoc($data);
            $agent =  $cek_login['agent'];


            ?>
            <div class="form-group">
                  <label>NO Resi : </label>
                  <label  ><span ><?php  echo $hasil; ?></span></label><br>
                  <input type="hidden" name="no_resi" id="no_resi" class="active" value="<?php echo $hasil; ?>" >
                  <?php
                        echo "<img alt='testing' src='file/barcode/barcode.php?codetype=code39&size=50&text=".$hasil."&print=true'/>";
                  ?>
            </div>
            <div class="form-group">
                  <input type="hidden" name="agent" class="active" id="agent" value="<?php echo $agent; ?>">
            </div>
      
            <div class="form-group">
                  <label >Nama Penerima :</label>
                  <input type="text" class="form-control" name="nama_penerima" id="nama_penerima" placeholder="Nama Penerima" required>
            </div>

            <div class="form-group">
                  <label >Telfon Penerima :</label>
                  <input type="text" class="form-control" name="telfon_penerima" id="telfon_penerima" placeholder="Telfon Penerima" required>
            </div>

            <div class="form-group">
                  <label >Nama Pengirim :</label>
                  <input type="text" class="form-control" name="nama_pengirim" id="nama_pengirim" placeholder="Nama Pengirim" required>
            </div>

            <div class="form-group">
                  <label >Telfon Pengirim :</label>
                  <input type="text" class="form-control" name="telfon_pengirim" id="telfon_pengirim" placeholder="Telfon Pengirim" required>
            </div>

            <div class="form-group">
                  <label >Isi Barang:</label>
                  <textarea type="text" class="form-control" name="jenis_barang" id="jenis_barang" placeholder="Isi Barang" style="resize:none;width:100%;height:50px;" required></textarea>
            </div>

            <div class="form-group">
                  <label >Berat Barang (kg):</label>
                  <input type="text" class="form-control" name="berat" id="berat"  placeholder="berat" required>
            </div>

            <div class="form-group">
                  <label >Alamat:</label>
                  <input type="text" class="form-control" name="alamat_penerima" id="alamat_penerima"  placeholder="Alamat" >
            </div>

            <div class="row" style="background-color: grey; padding:20px; border-radius: 20px; color: white;">
                  <div class="col-md-4">
                        <div class="form-group">
                              <label>Asal</label><br>
                              <label>Pilih Negara :</label>
                              <select name="negara2" id="negara2" class="form-control action2" required>
                                    <option value="0">negara</option>
                                    <?php echo $country1; ?>
                                    </select>
                        </div>
                        <div class="form-group">
                              <label>Pilih Agent :</label>
                              <select name="agent2" id="agent2" class="form-control action2" required>
                                    <option value="0">Agent</option>
                              </select>
                          </div>
                  </div>
                  <div class="col-md-4">
                        <div class="form-group">
                              <label>Tujuan</label><br>
                              <label>Pilih Negara :</label>
                              <select name="negara1" id="negara1" class="form-control action1"required >
                                    <option value="0">negara</option>
                                    <?php echo $country2; ?>
                                    </select>
                        </div>
                        <div class="form-group">
                              <label>Pilih Agent :</label>
                              <select name="agent1" id="agent1" class="form-control action1" required>
                                    <option value="0">Agent</option>
                              </select>
                        </div>
                        <button class="btn btn-info cari" type="button" id="cari">Search</button>
                        <label>Rp. </label>
                        <span class="hasil">...</span>
                        <input type="hidden" id="gg" name="gg" class="active gg"> 
                  </div>
                  <div class="col-md-4">
                        <div class="form-group" >
                              <label>Volumetric</label>
                              <input type="text" class="form-control" name="panjang" id="panjang" placeholder="Panjang" required><br>
                              <input type="text" class="form-control" name="lebar" id="lebar" placeholder="Lebar" required><br>
                              <input type="text" class="form-control" name="tinggi" id="tinggi" placeholder="Tinggi" required>
                          </div>
                          <button class="btn btn-info hitung" type="button">Hitung</button>
                          <label  class="htng">...</label>
                          <input type="hidden" id="hh" name="hh" class="active"> 
                  </div>
           </div>
            <br> 
            <div class="row">
                  <div class="col-md-4">
                        <div class="form-group">
                              <button type="button" class="btn btn-info kg" id="kg" name="kg">Harga (KG)</button>
                              <label>Rp. <span class="cb" id="tkg"></span> </label>
                              <input type="hidden" name="harga" id="ikg" class="active" value="">
                        </div>
                        <div class="form-group">
                              <button type="button" class="btn btn-info vlm" id="vlm" name="vlm">Harga (VLM)</button>
                              <label>Rp. <span class="tvlm" id="tvlm"></span> </label>
                              <input type="hidden" name="harga" id="ivlm" class="active" value="">
                        </div>

                        <div class="form-group">
                              <button type="button" class="btn btn-info ttl" id="ttl" name="ttl">Total</button>
                              <label name="total" >Rp. <span id="total"></span> </label>
                              <input type="hidden" name="totall" id="totall"  class="active" value="">
                              <input type="hidden" name="totalmur" id="totalmur"  class="active" value="totmur">
                        </div>
                        <div class="form-group">
                              <?php
                                    $queri1 = mysqli_query($koneksi, "SELECT * FROM setting");
                                    $soc = mysqli_fetch_assoc($queri1);

                                    $queri2 = mysqli_query($koneksi, "SELECT * FROM agent WHERE id='$agent'");
                                    $soc1 = mysqli_fetch_assoc($queri2);

                                    if($soc1['komisi'] == '1'){
                              ?>
                                    <input type="hidden" name="putndpt" class="active" id="putndpt" placeholder="Pendapatan"> 
                                    <input type="hidden" name="putpket" class="active" id="putpket" placeholder="komisi">
                              <?php
                                    }else{
                              ?>
                                    <input type="hidden" name="putndpt" class="active" id="putndpt" placeholder="Pendapatan">
                              <?php
                                    }
                              ?>
                              <input type="hidden" name="pndpt" class="active" id="pndpt" value="<?php echo $soc['k_agent']; ?>">
                              <input type="hidden" name="p_pkt" class="active" id="p_pkt" value="<?php echo $soc['k_pkt']; ?>">
                              <input type="hidden" name="statkom" class="active" id="statkom" value="<?php echo $soc1['komisi']; ?>"> 
                              <input type="hidden" name="cago" class="active" id="cago" value="<?php echo $soc['cargo']; ?>">
                              <input type="hidden" name="i_hitung" class="active" id="i_hitung" value="">
                        </div>
                  </div>
                  <div class="col-md-4">
                        <div class="form-group">
                              <select class="form-control sel1" id="sel1" name="sel1" required>
                                    <option>- Transportasi -</option>
                                    <option value="CNTR">Container</option>
                                    <option value="CRGO">Cargo</option>
                              </select>
                        </div>
                  </div>
             </div>
                  <div class="text-left" style="margin-bottom: 50px;">
                        <button type="submit" name="insert" id="insert"  class="btn btn-primary submitBtn" >SUBMIT</button>					
                        <button type="button" name="reset" id="reset" onclick="reload()" class="btn btn-primary submitBtn">NEW</button>						
                  </div>
      </form>
</div>

<?php
include 'footer.php';
?>

<script type="text/javascript">
  
//   function hasil(){
//    var p = document.getElementById('berat').value;
//    var l = document.getElementById('hasil').value;
//    var hasil =parseFloat(p * l);
//    var hsl =parseFloat(hasil * (20/100));




//    document.getElementById('total').innerHTML = hasil;
//       $('#totall').val(hasil);
//       $('#pendapatan').val(hsl);

//   }

var reload = function(){
  document.location = document.location;
}

  $(document).ready(function(){
    $('.action2').change(function(){
    if($(this).val() != '')
    {
      var action2 = $(this).attr("id");
      var query2 = $(this).val();
      var result2 = '';
      if(action2 == 'negara2')
      {
        result2 = 'agent2';
      }
      else
      {
       
      }
      $.ajax({
           url:"fetch.php",
           method:"POST",
           data:{action2:action2, query2:query2},
           success:function(data){
            $('#'+result2).html(data);
           }

      })
    }
    });
  });

  $(document).ready(function(){
    $('.action1').change(function(){
    if($(this).val() != '')
    {
      var action1 = $(this).attr("id");
      var query1 = $(this).val();
      var result1 = '';
      if(action1 == 'negara1')
      {
        result1 = 'agent1';
      }
      else
      {
       
      }
      $.ajax({
           url:"fetch1.php",
           method:"POST",
           data:{action1:action1, query1:query1},
           success:function(data){
            $('#'+result1).html(data);
           }

      })
    }
    });
  });

  $(document).ready(function(){
      $('.cari').click(function(){
            var cari = $(this).attr("id");
            var agent1 = $('#agent2').val();
            var agent2 = $('#agent1').val();
            $.ajax({
                  url:"cari.php",
                  method:"POST",
                  data:{agent1:agent1, agent2:agent2, cari:cari},
                  success:function(data){
                        $('.hasil').html(data);
                        $('.gg').val(data);
                  }
            })
                       
      });

      $('.hitung').click(function() {
            var panjang = $('#panjang').val();
            var lebar = $('#lebar').val();
            var tinggi = $('#tinggi').val();

            var result = Math.round(panjang * lebar * tinggi/5000);
            $('.htng').text(result);
            $('#hh').val(result);
      });
      
      $('.kg').click(function(){
            var berat = $('#berat').val();
            var harga = $('#gg').val();

            if(berat < 1){
                  var count = 1 * harga;
                  $('#ikg').val(count);
                  var 	bilangan = $('#ikg').val();
                  var	reverse = bilangan.toString().split('').reverse().join(''),
                  ribuan 	= reverse.match(/\d{1,3}/g);
                  ribuan	= ribuan.join('.').split('').reverse().join('');
                  $('#tkg').text(ribuan);
            }else{
                  var count = berat * harga;
                  $('#ikg').val(count);
                  var 	bilangan = $('#ikg').val();
                  var	reverse = bilangan.toString().split('').reverse().join(''),
                  ribuan 	= reverse.match(/\d{1,3}/g);
                  ribuan	= ribuan.join('.').split('').reverse().join('');
                  $('#tkg').text(ribuan);
            }
     });

     $('.vlm').click(function(){
            var volume = $('#hh').val();
            var harga = $('#gg').val();

            if(volume < 1){
            var count = 1 * harga;
            $('#ivlm').val(count);
            var 	bilangan = $('#ivlm').val();
            var	reverse = bilangan.toString().split('').reverse().join(''),
            ribuan 	= reverse.match(/\d{1,3}/g);
            ribuan	= ribuan.join('.').split('').reverse().join('');
            $('#tvlm').text(ribuan);
            }else{
                  var count = volume * harga;
                  $('#ivlm').val(count);
                  var 	bilangan = $('#ivlm').val();
                  var	reverse = bilangan.toString().split('').reverse().join(''),
                  ribuan 	= reverse.match(/\d{1,3}/g);
                  ribuan	= ribuan.join('.').split('').reverse().join('');
                  $('#tvlm').text(ribuan);
            }
     });

     $('.ttl').click(function(){
            var hsl1 = $('#ikg').val();
            var hsl2 = $('#ivlm').val();
            var r = parseInt(hsl2);
            var g = parseInt(hsl1);
            var trns = $('#sel1').val();
             var crg = $('#cago').val();
            var c = parseInt(crg);

            if(hsl1 <= hsl2 ){
                  $('#totalmur').val(hsl2);
                  $('#i_hitung').val('VLM');
                  if(trns == 'CRGO'){
                        var totl = r + c;
                        $('#total').text(totl);
                        $('#totall').val(totl);
                  }else{
                        var totl = r + 0;
                        $('#total').text(totl);
                        $('#totall').val(totl);
                  }
            }else{
                  $('#totalmur').val(hsl1);
                   $('#i_hitung').val('KG');
                   if(trns == 'CRGO'){
                        var totl = g + c;
                        $('#total').text(totl);
                        $('#totall').val(totl);
                  }else{
                        var totl = g + 0;
                        $('#total').text(totl);
                        $('#totall').val(totl);
                  }
            }

             var statkom = $('#statkom').val();
             var ihasil = $('#totalmur').val();
             var ipndpt = $('#pndpt').val();
             var ipket = $('#p_pkt').val();

            var inhasil = parseInt(ihasil);
            var inpndpt = parseInt(ipndpt);
            var inpket = parseInt(ipket);

             if(statkom == '1'){
                  haskom1 = inhasil * inpket/100;
                  $('#putpket').val(haskom1);

                  haskom2 = inhasil * inpndpt/100;
                  $('#putndpt').val(haskom2);
             }else{

                   haskom2 = inhasil * inpndpt/100;
                  $('#putndpt').val(haskom2);
             }
     });

           

  });
 </script>