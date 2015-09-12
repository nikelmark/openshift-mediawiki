# OpenShift - MediaWiki
========
QuickStart MediaWiki 1.25.2 on OpenShift.

As of today (12/09/2015), this is the latest version of mediawiki.
Follow the steps below to build on OpenShift.

PreInstalled Plugins: 
Cite,
CiteThisPage,
Gadgets,
ImageMap,
InputBox,
Interwiki,
LocalisationUpdate,
Nuke,
ParserFunctions,
PdfHandler,
Poem,
Renameuser,
SpamBlacklist,
SyntaxHighlight_GeSHi,
TitleBlacklist,
WikiEditor


Quickstart
==========

1. Create an account at https://www.openshift.com
2. Create a php application with mysql:
    ```
    $ rhc app create mediawiki php-5.4 mysql-5.5
    ```
3. Add this upstream mediawiki repo
    ```
    $ cd mediawiki
    $ git remote add upstream -m master https://github.com/negati-ve/openshift-mediawiki.git
    $ git pull -s recursive -X theirs upstream master
    ```
4. Then push the repo upstream
    ```
    $ git push
    ```
5. That's it, you can now checkout your application at:
    http://mediawiki-$yourlogin.rhcloud.com
6. Default Admin Username: admin
   Default Password: admin123

Updates
=======

In order to update or upgrade to the latest mediawiki, you'll need to re-pull
and re-push.

1. Pull from upstream:
    ```
    $ cd mediawiki/
    $ git pull -s recursive -X theirs upstream master
    ```
2. Push the new changes upstream
    ```
    $ git push
    ```



Repo layout
===========
php/ - Externally exposed php code goes here
libs/ - Additional libraries
misc/ - For not-externally exposed php code
../data - For persistent data
.openshift/pear.txt - list of pears to install
.openshift/action_hooks/build - Script that gets run every push, just prior to
    starting your app


Notes about layout
==================
Please leave php, libs and data directories but feel free to create additional
directories if needed.

Note: Every time you push, everything in your remote repo dir gets recreated
please store long term items (like an sqlite database) in ../data which will
persist between pushes of your repo.


