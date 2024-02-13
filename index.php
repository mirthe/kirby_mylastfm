<?php

Kirby::plugin('mirthe/mylastfm', [
    // 'options' => [
    //     'apiKey'    => option('lastfm.apiKey'),
    //     'username' => option('lastfm.username')
    // ],
    'snippets' => [
        'lastfm-albums-played' => __DIR__ . '/snippets/albums.php',
        'lastfm-recenttracks' => __DIR__ . '/snippets/tracks.php',
        'lastfm-recenttracks-short' => __DIR__ . '/snippets/tracks-list.php',
        'lastfm-topartists' => __DIR__ . '/snippets/artists.php'

        // getTopArtists toevoegen?
        // recenttracks liever getTopTracks ?
    ]
]);