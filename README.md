# midonet.org

This is the official website of [MidoNet](https://www.midonet.org).

## Production Server Environment

Production server is running **Apache HTTP Server (httpd) 2.4** with **PHP (php-fpm) 5.4** on **CentOS 7**.

## Contribution Guide

All patches to MidoNet and its related repositories are submitted to [Gerrit](https://gerrit-review.googlesource.com/Documentation/), an open source web-based code review system that enables a more centralized usage of Git. The Gerrit code review system for MidoNet is publicly hosted on GerritHub.

Please see [Developer's Guide](https://github.com/midonet/midonet/wiki/Developer%27s-Guide) on official MidoNet wiki for detailed contribution workflow.

### Duplicated Files

Following files are duplicated and should not be used anymore.

- midonet-tv.php
- privacy-policy.html
- trademark-policy.html

These files were renamed to `index.php` and moved to corresponding folder (ex. `midonet-tv`) so that user can access to those pages by cleaner URL. The files are still kept in case of someone accessing the old URL but will be removed sometime in the future.

## Community

There's [Slack channel](https://slack.midonet.org) waiting for you to join on live communication with other developers.
