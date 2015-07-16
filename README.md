# midonet.org

This is the official website of [midonet.org](http://www.midonet.org).

## Production Server Environment

Production server is running **Apache HTTP Server 2.22** with **PHP 5.3.10**.

## Contribution Guide

Simply fork the repo and create pull request or open issue if you have any suggestion or bug reports. Even better there's [Slack channel](http://slack.midonet.org) waiting for you to join on live communication with other developers.

### Duplicated Files

Following files are duplicated and should not be used anymore.

- midonet-tv.php
- privacy-policy.html
- trademark-policy.html

These files were renamed to `index.php` and moved to corresponding folder (ex. `midonet-tv`) so that user can access to those pages by cleaner URL. The files are still kept in case of someone accessing the old URL but will be removed sometime in the future.
