<div class="form-inline">
        <div class="input-group">
          <div class="form-control-sidebar">
          <div class="input-group-append">
          </div>
          </div>
        </div>
      </div>
      <script>
        $(document).ready(function(){
         $("div.list-group").click(function(){
          var a = $("a.list-group-item");
          for(var i=0;i<a.length;i++)
          {
          var d = $(a[i]).attr('href');
          var r = d.replaceAll("%3A", ":");
          $(a).attr('href',r);
          }
         });
        });
        </script>