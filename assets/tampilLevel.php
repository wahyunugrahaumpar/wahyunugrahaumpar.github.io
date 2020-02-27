  <div class="loader"></div>
  <nav class="navbar fixed-top navbar-expand-md navbar-light bg-warning sidebarNavigation pl-0 pr-0 pt-2 pb-2">
    <div class="navbar-brand label-lvl">Pilih Level / Tingkat</div>          
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
      var html = '';
      $.each(kate, function(k, v){
        html += `<div class="col-sm text-center">
        <div class="p-2 bg-primary"><b>${v}</b></div>
        <img src="img/${v}.png" class="img-fluid" width="80" height="auto">
        <div class="">
          <button class="btn ${bgc[ Math.floor(Math.random()*(bgc.length + 1)) ]} mulai-${v.toLowerCase()}" disabled="" onclick="setAt('${v}')">Mulai</button>
          <p class="text-danger ket${v}"></p>
        </div>
      </div>`;
      })
      $('.data-tingkat').html(html);

       $('.ketSMP').text('Selesaikan Level SD untuk kelevel SMP!')
       $('.ketSMA').text('Selesaikan Level SD dan SMP untuk kelevel SMA!')
      if (tingkat == 'SD') {
        $('.mulai-sd').attr('disabled',false);
      }else if (tingkat == 'SMP') {
        $('.mulai-sd').attr('disabled',false);
        $('.ketSMP').hide();
        $('.mulai-smp').attr('disabled',false);
      }else{
        $('.ketSMP, .ketSMA').hide();
        $('.mulai-sd').attr('disabled',false);
        $('.mulai-smp').attr('disabled',false);
        $('.mulai-sma').attr('disabled',false);
      }
      
    })

    function setAt(a){
      aTingkat = a;
      loadPage('tampilKelas');
    } 
    // tampilLevel();
   </script>