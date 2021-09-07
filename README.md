# Qiyana Fanclub Website

This is a WordPress website for Qiyana players (League of Legends).

## Getting Started

Create a `.env` file, you can copy from `.env.example`.

Install:

```
./cli.sh install
```

Run docker containers

```
./cli.sh run
```

## cli.sh

The `cli.sh` script was created to help manage the website.

* `cli.sh install` - Create docker volumes
* `cli.sh run` - Run docker containers locally
* `cli.sh stop` - Stop docker containers
* ============================================
* `cli.sh backup` - @TODO
* `cli.sh backup-restore` - @TODO
* `cli.sh dangerous-uninstall` - @TODO - **DANGEROUS SCRIPT** - Remove all docker containers and volumes, if you run this script you will lose all data and the software will be completely uninstalled from the current machine. You should do a backup before running this.


