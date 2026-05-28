<?php 
     // period (Optional) : overall | 7day | 1month | 3month | 6month | 12month - The time period over which to retrieve top albums for.
    
    // TODO limit en period opnemen als option

     $apikey = option('lastfm.apiKey');
     $username = option('lastfm.username');
     $cacheSection = 'albums';
     $feedurl = "http://ws.audioscrobbler.com/2.0/?method=user.getTopAlbums&user=$username&api_key=$apikey&format=xml&period=7day&limit=30";
     $cache = kirby()->cache('mirthe.mylastfm');
     $cacheKey = 'lastfm-' . strtolower($username) . '-' . $cacheSection;
     $feeds = $cache->get($cacheKey);
     $force = isset($_GET['forcecache']);
 
     if ($feeds === null || $force) {
     // when file is not available, older than 10 minutes, or forced

         $previousFeeds = $feeds;
         $ch = curl_init();
         curl_setopt($ch, CURLOPT_URL, $feedurl);
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
         curl_setopt($ch, CURLOPT_USERAGENT, kirby()->site()->title());
         
         $feeds = curl_exec($ch);
         $error = curl_errno($ch);
         curl_close($ch);
         
         if ($feeds !== false && $error === 0 && $feeds !== '') {
             $cache->set($cacheKey, $feeds, 3600);
         } else {
             $feeds = $previousFeeds;
         }
 
     }

     if ($feeds === null) {
         $feeds = '';
     }
   
    $rss = simplexml_load_string($feeds);
?>