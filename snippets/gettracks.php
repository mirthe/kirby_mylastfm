<?php 
     // TODO limit opnemen als option

     $apikey = option('lastfm.apiKey');
     $username = option('lastfm.username');
     $localfile =  __DIR__ . "/lastfm-tracks.xml";
     $feedurl = "http://ws.audioscrobbler.com/2.0/?method=user.getrecenttracks&user=$username&api_key=$apikey&format=xml&limit=50";
 
     if (!file_exists($localfile) OR time()-filemtime($localfile) > 2 * 3600 OR isset($_GET['forcecache'])) {
         
         $ch = curl_init();
         curl_setopt($ch, CURLOPT_URL, $feedurl);
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
         // curl_setopt($ch, CURLOPT_USERAGENT, "Mirthe.org");
         
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