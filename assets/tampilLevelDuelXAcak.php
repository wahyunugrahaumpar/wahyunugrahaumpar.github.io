  <div class="loader"></div>
  <nav class="navbar fixed-top navbar-expand-md navbar-light bg-warning sidebarNavigation pl-0 pr-0 pt-2 pb-2">
    <div class="navbar-brand label-lvl">Pilih Level / Tingkat Duel Acak</div>          
       <button class="btn btn-back btn-danger rounded btn-sm p-2 ml-1" type="button" onclick="loadPage('main')">
        <i class="ion-arrow-left-a"></i>
       </button>
   </nav>
   <div class="container lvl" style="margin-top: 70px">
     	<div class="row data-tingkat">

      </div>
   </div>

   <script type="text/javascript">
    $(function(){
      var html = '';ket='';disabled='';
      $.each(kate, function(k, v){

                ket='';
        disabled='';

        if (parseInt(gs('umur')) < 12) {
          if (v == 'SMP') {
            ket='Belum Cukup Umur! Kamu harus berusia 12 tahun untuk mengakses level SMP';
            disabled='disabled';
          }
        }

        if (parseInt(gs('umur')) < 15) {
          if (v == 'SMA') {
            ket='Belum Cukup Umur! Kamu harus berusia 15 tahun untuk mengakses level SMA';
            disabled='disabled';
          }
        }

        
        html += `<div class="col-sm text-center">
        <div class="p-2 bg-primary"><b>${v}</b></div>
        <img src="img/${v}.png" class="img-fluid" width="80" height="auto">
        <div class="">
          <button ${disabled} class="btn ${bgc[k]} mulai-${v.toLowerCase()}" onclick="setAt('${v}')">Mulai</button>
          <p class="text-danger">${ket}</p>
        </div>
      </div>`;
      })
      $('.data-tingkat').html(html);
     })

    function setAt(a){
      aTingkatDuel = a;
      loadPage('tampilKelasDuelXAcak');
    }
   </script>