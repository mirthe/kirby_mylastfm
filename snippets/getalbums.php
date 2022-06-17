<?php 
     // period (Optional) : overall | 7day | 1month | 3month | 6month | 12month - The time period over which to retrieve top albums for.
    
    // TODO limit en period opnemen als option

     $apikey = option('lastfm.apiKey');
     $username = option('lastfm.username');
     $localfile =  __DIR__ . "/lastfm-albums.xml";
     $feedurl = "http://ws.audioscrobbler.com/2.0/?method=user.getTopAlbums&user=$username&api_key=$apikey&format=xml&period=7day&limit=30";
 
     if (!file_exists($localfile) OR time()-filemtime($localfile) > 2 * 3600 OR isset($_GET['forcecache'])) {
         
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