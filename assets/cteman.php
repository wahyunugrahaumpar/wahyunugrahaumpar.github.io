 <div class="loader"></div>
  <nav class="navbar fixed-top navbar-expand-md navbar-light bg-warning sidebarNavigation pl-0 pr-0 pt-2 pb-2">
    <div class="navbar-brand label-teman">Pilih Teman Untuk ditantang</div>          
       <button class="btn btn-back btn-danger rounded btn-sm p-2 ml-1" type="button" onclick="loadPage('tampilMapelDuelXTeman')">
        <i class="ion-arrow-left-a"></i>
       </button>
   </nav>

<div class="bg-duel">
  <div class="duel-text">
    <i><b>Menunggu Teman...</b></i>
  </div>
</div>
   <div class="container duel-teman" style="margin-top: 70px">
   	
   </div>

<!-- Modal -->
<div class="modal fade" id="waktuModal" tabindex="-1" role="dialog" aria-labelledby="waktuModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="waktuModalLabel">Pilih Waktu Main</h5>
            </div>
            <div class="modal-body">
              <button type="button" class="btn btn-danger btn-block">10 Detik = 10 soal</button>
              <button type="button" class="btn btn-danger btn-block">20 Detik = 20 soal</button>
              <button type="button" class="btn btn-danger btn-block">30 Detik = 30 soal</button>
              <button type="button" class="btn btn-danger btn-block">40 Detik = 40 soal</button>
              <button type="button" class="btn btn-danger btn-block">50 Detik = 50 soal</button>
              <button type="button" class="btn btn-danger btn-block">60 Detik = 60 soal</button>
            </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
        </div>
    </div>
</div> 

   <script type="text/javascript">
   	tampilMyDuels()
   </script>