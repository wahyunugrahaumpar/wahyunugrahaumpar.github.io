    <div class="loader"></div>
   <div class="container-fluid userAll" style="overflow: auto;">
    <div class="jml-user">-</div>
    <table class="table table-small" id="dataTable">
    <thead class="thead-dark">
      <tr>
        <th scope="col">NO</th>
        <th scope="col">BANNED</th>
        <th scope="col">USERNAME</th>
        <th scope="col">EMAIL</th>
        <th scope="col">EMAIL ACTIVE ?</th>
        <th scope="col">PASSWORD</th>
        <th scope="col">IS ONLINE</th>
        <th scope="col">UID</th>
        <th scope="col">LAST CHANGED</th>
      </tr>
    </thead>
    <tbody class="body-user-all">
    </tbody>
    </table>


   </div>
   <script type="text/javascript">

     tampilUserAll();
    $('#dataTable').DataTable();
   </script>

