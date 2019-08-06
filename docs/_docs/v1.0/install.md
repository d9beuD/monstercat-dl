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
