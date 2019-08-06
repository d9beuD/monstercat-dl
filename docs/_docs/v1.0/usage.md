---
title: usage
---
# Usage

### Find the release you want

First, browse [monstercat.com](https://www.monstercat.com) and find the release you wish to download. The URL where you are should look like the following:

```
https://www.monstercat.com/release/MCEP157
```

We just need the release ID, in this case it's **`MCEP157`**. Save it in your clipboard, we'll use it in the next step.

### Download

Download all songs in this release with this simple command:

```bash
php monstercat-dl.phar MCEP157
```

<div class="row justify-content-center">
    <div class="col-md-8 col-lg-6 col-xl-7">
        <img src="{{ site.href.images }}/home-terminal-demo.png" class="img-fluid">
    </div>
</div>

You can download more songs at once by adding other release IDs at the end of the command:

```bash
php monstercat-dl.phar MCEP157 MCX006 MCS778
```

All songs will be downloaded in your current directory, you can `cd` into another one.

### Without `wget`

There are many reasons why you may not want to use `wget` to download songs.

- You don't have it installed on your computer and don't want to install it
- You don't know how to install it ([Windows user?](https://eternallybored.org/misc/wget/))
- You prefere to use PHP native functions to download files
- You don't like the ugly output of `wget`

Fortunaly, there is an option for `monstercat-dl` to download files with PHP native functions. Just add `--without-wget` wherever you want in your command.

```bash
php monstercat-dl.phar MCEP157 MCX006 MCS778 --without-wget
```
