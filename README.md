# monstercat-dl

Download Monstercat songs from your Terminal app!

## Requirements

To get monstercat-dl working correctly, you will need this:
- [wget](https://www.gnu.org/software/wget/) (on macOS `brew install wget`)
- [php](https://php.net) >= 7.0

## Usage

First, browse [monstercat.com](https://www.monstercat.com) and find the release you wish to download.

```
https://www.monstercat.com/release/MCEP157
```

We just need the release ID, in this case: `MCEP157`.
Download all songs in this release with this simple command:

```bash
php monstercat-dl.php MCEP157 MCX006 MCS778
```

All songs will be downloaded in your current directory, you can `cd` into another one.

## Other methods

If you're not familiar with the command line, you can do it manualy on [monstercat.com](https://www.monstercat.com) by two ways:

#### Option 1
- Go on any page with a play button
- Right click on it and inspect the button element
- Copy the `data-play-link` attribute value
- Paste it in a new browser tap
- Let's download this amazing music!

#### Option 2
- Go on any page with a play button
- Simple click on it to start playing a song
- Go to the network tab in the browser dev tools
- Find a string that looks like a hash
- Right click on the line and copy the link
- Paste it in a new browser tap
- Let's download this amazing music!
