# Kirby Plugin: MyLastFM

This plugin allows you to show recent tracks and albums for a Last.fm account on your Kirby site

## Git submodule

```
git submodule add https://github.com/mirthe/kirby_mylastfm site/plugins/mylastfm
```

## Usage

Add your LastFM API key and username to your config

    'lastfm.apiKey'     => 'xxx',
    'lastfm.username'   => 'xxx',

Include one or more of the following snippets to display your recently played albums, tracks or favorite artists on a page

### Albums played
<p><?php snippet('lastfm-albums-played'); ?></p>
    
### Recent tracks
<p><?php snippet('lastfm-recenttracks'); ?></p>
    
### Top artists
<p><?php snippet('lastfm-topartists'); ?></p>

## Example 

<img src="example-albums.png" alt="Example albums">
<img src="example-tracks.png" alt="Example tracks">
<img src="example-artists.png" alt="Example artists">

## Todo

- Add band photo to artist view, LastFM currently doesn't offer one
- Add translations for labels
- Offer as an official Kirby plugin
- Add sample SCSS to this readme
- Cleanup code
- Lots..
