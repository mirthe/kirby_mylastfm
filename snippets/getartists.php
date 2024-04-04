<?php 
     // TODO limit opnemen als option

     $apikey = option('lastfm.apiKey');
     $username = option('lastfm.username');
     $localfile =  __DIR__ . "/lastfm-artists.xml";
     $feedurl = "http://ws.audioscrobbler.com/2.0/?method=user.getTopArtists&user=$username&api_key=$apikey&format=xml&limit=30";
 
     if (!file_exists($localfile) || time()-filemtime($localfile) > 3600 || isset($_GET['forcecache'])) {
     // when file is not available, older than one hour, or forced

         $ch = curl_init();
         curl_setopt($ch, CURLOPT_URL, $feedurl);
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
         
         $feeds = curl_exec($ch);
         curl_close($ch);
         
         $fp = fopen($localfile, 'w');
         fwrite($fp, $feeds);
         fclose($fp);
 
     } else {
         $feeds = file_get_contents($localfile); 
     }
   
    $rss = simplexml_load_string($feeds);
?>