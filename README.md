Auto Wordpress Settings API
===========================

An attempt to simplify and centralize the robust, but complicated Settings API in WordPress Core.

This is a section of code I'm working on for a new WordPress Starter theme I'm building called Starters. You can check out more info here starters.colegeissinger.com or https://github.com/colegeissinger/starters

NOTE: THIS REPO IS UNDER HEAVY DEV AND NOT QUITE READY FOR PRIME TIME. We need to fix up some parts to automate things further and provide the proper sanitization. But, if you are really interested, please feel free to fork and modify as you see fit.

How To Setup
============

Insert these files into your current theme and inport the the admin-init.php file with import('admin-init.php'); in your functions.php

If all goes well, you should now have a new section in Appearance called Theme Options.

How To Use
==========

This is setup to reduce the interfacing of the actual Settings API functions and automate the process. The current way to use the API is to create an overwhleming amount of functions, 80% of them dedicated to just one field in the forms.

All data is set in a secific page for each section (or tabbed area) in the theme options and sorted in an array. You can set these in the options directory included in the repo. Documentation will be placed here, but for now, it's all in the source code.
