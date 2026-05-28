<?php

Kirby::plugin('mirthe/mylastfm', [
    'options' => [
        'cache' => true
    ],
    'snippets' => [
        'lastfm-albums-played' => __DIR__ . '/snippets/albums.php',
        'lastfm-recenttracks' => __DIR__ . '/snippets/tracks.php',
        'lastfm-recenttracks-short' => __DIR__ . '/snippets/tracks-list.php', // experiment for my Now page
        'lastfm-recenttracks-imgs' => __DIR__ . '/snippets/tracks-imgs.php', // alt view for my Now page
        'lastfm-topartists' => __DIR__ . '/snippets/artists.php'

        // getTopArtists toevoegen?
        // recenttracks liever getTopTracks ?
    ]
]);