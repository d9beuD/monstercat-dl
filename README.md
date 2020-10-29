# :musical_note: monstercat-dl

Download Monstercat songs from your Terminal app! All the documentation you need is on the [monstercat-dl website](https://d9beuD.github.io/monstercat-dl).

## Table of contents

- [Requirements](#requirements)
- [Installation](#installation)
- [Usage](#usage)
- [Other methods](#other-methods)
  - [Option 1](#option-1)
  - [Option 2](#option-2)

## Requirements

To get monstercat-dl working correctly, you will need this:
- [wget](https://www.gnu.org/software/wget/) (on macOS `brew install wget`)\[optional, see warning below]
- [php](https://php.net) >= 7.0

:warning: If you don't want to use `wget` and prefer `php` native functions, use `--without-get` argument.

## Installation

Read [installation](https://d9beuD.github.io/monstercat-dl/docs/v1.0/install.html) docs.

## Usage

Read [usage](https://d9beuD.github.io/monstercat-dl/docs/v1.0/usage.html) docs.

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
