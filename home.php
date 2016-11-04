
          <div class="inner cover">
            <p class="lead">Turn a long link into a short one. Enter your long URL here.</p>
            <form class="form-shortenme" action="/" method="post">
		      <label for="inputURL" class="sr-only">Paste a link to shorten it</label>
		      <input type="url" name="inputURL" id="inputURL" class="form-control" placeholder="Paste a link to shorten it" required autofocus>
		      I want a vanity URL: <input type="checkbox" id="trigger" name="vanityURLDesired"><br /><br />
		      <input type="text" name="vanityURL" class="form-control" id="vanityURL" placeholder="Enter desired vanity URL" pattern="[A-Za-z0-9]+" title="Please enter a string 1-20 characters long containing only letters and numbers">
		      <input type="submit" class="btn btn-lg btn-default" value="Shorten Me">
		    </form>
		    
          </div>

