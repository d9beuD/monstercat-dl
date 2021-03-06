---
title: Installation
---
# Installation

> This is only if you want to use your own `.phar` file compiled from source, not the one provided in releases.

### Download

Download the source code from a [release]({{ site.href.repo }}/releases), not from master branch.
Unzip the archive and `cd` into it.

```bash
$ cd monstercat-dl/src
```

### Set up

For correct autoloading, download [Composer composer.phar file](https://getcomposer.org/composer.phar) and paste it in the `src` directory. Then let it update the class autoloading for you.

```bash
$ wget https://getcomposer.org/composer.phar
$ php composer.phar update
```

### Quick compile

Go back to the project directory where there is a script to create the Phar archive. It will somehow pack all the files of this tool into one executable file.

```bash
$ cd ..
$ php create-phar.php
```

Two files were created. You should use the one named `monstercat-dl.phar` as it's described on the [Usage]({{ site.href.docs }}/usage.html) page.

### Global access (Linux and macOS only)

You may want to use it like any other command line tool, in any directory without the need to copy the file where you go. Here are steps to "convert" your PHP archive into an executable.

```
$ echo '#!'$(which php) > monstercat-dl
$ echo ./monstercat-dl.phar >> monstercat-dl
$ chmod +x
$ sudo mkdir -p /usr/local/bin # If this dir does not exist yet
$ cp ./monstercat-dl /usr/local/bin
```

You can now use `{{ site.name }}` everywhere without having to prepend the command with `php`:
```
$ monstercat-dl MCEP157
```
