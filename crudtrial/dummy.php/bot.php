<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

	function __construct(){
        parent::__construct();
    }


    /*------------------
    Form Input Laporan
    ------------------*/
    function index()
	{
	     $this->load->view('views_laporan_harian');
	}


	/*----------------------
    Function Submit Laporan
    ---------------------- */
    function submit_report(){
    	$tanggal = date("Y-m-d H:i:s");
        $nama = $this->input->post('nama');
        $penjualan = $this->input->post('sales');

        $report_data = array(
            'tanggal' => $tanggal,
            'nama' => $nama,
            'penjualan' => $penjualan
            );

        $this->db->insert('laporan_harian', $report_data);
        $this->load->view('views_laporan_harian_result');
        }

}
?>

<div class="container">
<div class="small text-muted">Home » Report</div>
<hr />
<div class="col-md-6">
<h4>Input Laporan Harian</h4>
<form action="./submit_report" method="POST">
      <div class="form-group">
          <label for="nama">Nama:</label>
          <input id="nama" class="form-control" name="nama" required="" type="nama" placeholder="Masukkan nama anda . . ." />
        </div>
        <div class="form-group">
                  <label for="sales">Jumlah Penjualan:</label>
                  <input id="sales" class="form-control" name="sales" required="" type="number" placeholder="Jumlah penjualan . . ." />
                </div>
        <div class="form-group form-check"> </div>

        <button class="btn btn-primary" type="submit">Input</button>
      </form>
    </div>
</div>

<div class="container">
  <br />
<div class="small text-muted">Home » Results</div>
<hr />
<div class="col-md-12">
<h5>Hasil Input Laporan Harian</h5>
      <div class="panel panel-body">
          Hi, data Anda berhasil diinput!<br /><br /><form id="telegramForm" method="POST">
          <input id="telegram_id" class="form-control" name="chat_id" type="hidden" value="-810564218" /> 
          <input class="form-control" name="text" type="hidden" value='Waktu : <?php echo date("Y-m-d H:i:s");?> <?php echo "\n";?>Nama : * <?php echo $this->input->post('nama');?> <?php echo "\n";?>Jumlah Penjualan : *<?php echo $this->input->post('sales');?> <?php echo "\n\n\n*>>>* _Laporan via bot Telegram_ *<<<*";?> '/>
          <br />

          <button id="sendToGroup" class="btn btn-primary" type="submit">Posting ke Group</button>
        </form>
      
      </div>

  </div>

</div>

<script>
$(document).on('click', '#sendToGroup', function(e){
      SwalTelegram();
          e.preventDefault();
      });
    
    function SwalTelegram(){
      if ($("#telegram_id").val()) {
        swal({
          title: 'Posting ke group?',
          text: "Pastikan Laporan anda sudah benar",
          type: 'question',
          showCancelButton: true,
          confirmButtonColor: '#3FC3EE',
          cancelButtonColor: '#E91E63',
          confirmButtonText: 'Ya!',
          showLoaderOnConfirm: true,
            
          preConfirm: function() {
            return new Promise(function(resolve) {
              $.ajax({
                url: 'https://api.telegram.org/bot5885434176:AAEaQF0_ZXfCu30gWdYQTAooZePDGO_fcGs/sendMessage?parse_mode=Markdown',
                  type: 'POST',
                    data: $('#telegramForm').serialize(),
                    dataType: 'html'
                 })
                 .done(function(response){
                  swal({
                  title: "Sukses!",
                  html: "Silahkan laporan berhasil dikirim",
                  type: "success", 
                  allowOutsideClick: false,
                  timer:5000,
                  showConfirmButton: false,
                  animation: false,
                  customClass: 'animated jackInTheBox',
                })
                 })
                 .fail(function(){
                  swal('Oops...', 'Ada kesalahan &#x2639;&#xfe0f;', 'error');
                 });
              });
            },
          allowOutsideClick: false        
        }); 
      }
      else {
            swal({
              title: "Warning!",
              html: "Ooops ada kesalahan system!",
              type: "warning", 
              allowOutsideClick: false,
              timer:3000,
              showConfirmButton: false
            });
          }
    }

  </script>