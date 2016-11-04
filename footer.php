          <div class="mastfoot">
            <div class="inner">
              <p>By <a href="http://www.pamhardy.net">Pam Hardy</a>.</p>
            </div>
          </div>

        </div>

      </div>

    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="/js/ie10-viewport-bug-workaround.js"></script>
    <script>$(document).ready(function () {
    var checkbox = $('#trigger');
    var hidden = $('#vanityURL');
    hidden.hide();
    checkbox.change(function () {
        if (checkbox.is(':checked')) {
            hidden.show();
        } else {
            hidden.hide();
        }
    });
});
</script>
  </body>
</html>
