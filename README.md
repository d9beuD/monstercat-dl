# :musical_note: monstercat-dl

Download Monstercat songs from your Terminal app!

## Requirements

To get monstercat-dl working correctly, you will need this:
- [wget](https://www.gnu.org/software/wget/) (on macOS `brew install wget`)
- [php](https://php.net) >= 7.0

:warning: If you don't want to use `wget` and prefer `php` native functions, use `--without-get` argument.

## Installation

Download the source code from a [release](https://github.com/d9beuD/monstercat-dl/releases), not from master branch.
Unzip the archive and `cd` into it.
For correct autoloading, download [Composer composer.phar file](https://getcomposer.org/composer.phar) and paste it in the `src` directory. Now execute :

```bash
php composer.phar update
```

Go back to the project directory and run `php create-phar.php`;
Two files were created. You should use `monstercat-dl.phar` as it's described in the Usage section.

## Usage

First, browse [monstercat.com](https://www.monstercat.com) and find the release you wish to download.

```
https://www.monstercat.com/release/MCEP157
```

We just need the release ID, in this case: `MCEP157`.
Download all songs in this release with this simple command:

```bash
php monstercat-dl.phar MCEP157
```

You can download more songs at once by adding other release IDs at the end of the command:
```bash
php monstercat-dl.phar MCEP157 MCX006 MCS778
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
