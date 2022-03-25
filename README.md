# :musical_note: monstercat-dl

Download Monstercat songs from your Terminal app! All the documentation you need is on the [monstercat-dl website](https://d9beud.com/monstercat-dl/). This tool isn't affiliated with Monstercat.

⚠️ This app allows you to download the free streaming audio file provided by Monstercat. This is not the high quality file you can access by subscribing to Monstercat Gold. If you realy like Monstercat songs, please consider subscribing. 

## Table of contents

- [Requirements](#requirements)
- [Installation](#installation)
- [Usage](#usage)
- [Other methods](#other-methods)
  - [Option 1](#option-1)
  - [Option 2](#option-2)

## Requirements

To get monstercat-dl working correctly, you will need this:
- [php](https://php.net) >= 7.0

## Installation

For UNIX systems users (macOS and Linux), clone this repository and follow those steps:

1. `git clone https://github.com/d9beuD/monstercat-dl.git`
2. `cd monstercat-dl`

Then you need to install the project's dependencies:

1. `composer install` (if you don't have [Composer](https://getcomposer.org) installed, read its [installation docs](https://getcomposer.org/doc/00-intro.md))

Finally, create the executable:

1. `php create-phar.php`
2. `bash install.sh`

If you don't want to install this tool, you can still use the `.phar` file like so `php monstercat-dl.phar`.

## Usage

### Download tracks

Using this command is pretty simple as it doesn't need any option. All you have to do is to find the release ID at the end of the release page URL.

```
monstercat-dl download <releases>...
```

For example, if you want to download `https://www.monstercat.com/release/MCLP016` and `https://www.monstercat.com/release/MCEP215` write your command as below:

```
monstercat-dl download MCLP016 MCEP215
```

## Other (manual) methods

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
