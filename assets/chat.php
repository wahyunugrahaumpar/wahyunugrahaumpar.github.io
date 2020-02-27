    <div class="loader"></div>
  <nav class="navbar fixed-top navbar-expand-md navbar-light bg-warning sidebarNavigation pl-0 pr-0 pt-2 pb-2">
    <div class="navbar-brand label-chat">Undefined</div>          
       <button class="btn btn-back btn-danger rounded btn-sm p-2 ml-1" type="button" onclick="loadPage('friend')">
        <i class="ion-arrow-left-a"></i>
       </button>
   </nav>
   <div class="container chat" style="margin-top: 70px">
      <div class="text-center"><h2>Tidak Ada History Chat</h2></div>
   </div> 
   <div class="footer-chat p-2">
      <div class="row">
        <div class="col-10">
            <input type="text" name="isi-chat" class="isi-chat form-control rounded-20" placeholder="Type text" required="">
        </div>
        <div class="col-2 my-auto mx-auto">
          <i class="ion-arrow-right-a p-2 bg-warning" onclick="sendPesan()"></i>
        </div>
      </div>
   </div>
   <script type="text/javascript">
     tampilChat();
   </script>
