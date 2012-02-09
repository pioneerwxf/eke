<script language="Javascript">
      function replaceText(text){
	      while(text.lastIndexOf("&") > 0){
		      text = text.replace('&', '[i-Stats]');
	      }
	      return text;
      }

      var web_referrer = replaceText(document.referrer);
      <!--
      istat = new Image(1,1);
      istat.src = "http://localhost/niim/count/counter.php?sw="+screen.width+"&sc="+screen.colorDepth+"&referer="+web_referrer+"&page="+location.href;
      //-->
      </script>
	  <script>window.location="http://localhost/eke/front/";</script>