Auto Wordpress Settings API
===========================

An attempt to simplify and centralize the robust, but complicated Settings API in WordPress Core.

This is a section of code I'm working on for a new WordPress Starter theme I'm building called Starters. You can check out more info at starters.colegeissinger.com or https://github.com/colegeissinger/starters But over all, this will become a plug-in.

This is an early version and I am looking to really simplify this script further. Any advice or contributions is greatly appreciated!

How To Setup
============

Insert these files into your current theme and import the the admin-init.php file with import('admin-init.php'); in your functions.php. Of course, if you add this file to a folder, then make sure you update the file path in the import() function.

If all goes well, you should now have a new section in Appearance called Theme Options.

How To Use
==========

This is setup to reduce the interfacing of the actual Settings API functions and automate the process. The current way to use the API is to create an overwhelming amount of functions, 80% of them dedicated to just one field in the forms.

All data is set in a specific page for each section (or tabbed area) in the theme options and sorted in an array. You can set these in the options directory included in the repo.

The idea is that all you need to do is create a new page (or section) in the options directory and everything will be automatically added to your theme options securely with the Settings API. At this moment, there is still some slight customizations needed to be made to the admin-init.php file.

Add a new section
=================

Duplicate the "display_options.php" file the options directory and re-name it to "slide_show.php". The ultimate solution for these is the name you set for your file in options, will be applied to the admin-init.php and create the proper section based on the file name and the values inside the array. At this moment, we are not fully there yet. We'll approach these steps in the next section.

When we open our new file you'll be presented with 4 variables and 1 massive multi-dimensional array. We set some variables so we can take advantage of DRY coding (http://en.wikipedia.org/wiki/Don't_repeat_yourself). These are common/repetitive pieces of information used through out our array of options. Refer to the documentation above each variable to better understand their use.

We now have our big array to address. We have some documentation in the code, but I didn't want to over load every option with comments. At this moment, we can toss Text Fields, Text Areas, Check Boxes and Drop Downs. More options will be added.

The first three variables are just making use of the three out of four variables listed before the array. These are used in various points of the code.

Our first array in $options_data sends this information to the add_settings_section() function. We first define it's type, this will be used to ensure when we toss this array at the main function, it knows where to route this info. After this first item, everything is mapped just like the settings found on the documentation for add_settings_section() http://bit.ly/wRZYic. If we set a title and are using the tabbed interface, the section will double post a title... so we leave it blank for now until I find a solution around that.

The second through the fourth arrays set our fields. In the first array we set the type, just like we did in the first array for the section setting, called settings-field. We then will use the callback field to route our options to the right function. In this instance, we want to output a text field, so we'll set the starters_text_callback. This will send this data to the starters_text_callback() function found on line 148 in admin-init.php. Next we set an array called args, this will hold all the data that will be passed into our callback function such as the ID, label, description and options (if they exist). Only the check-boxes and drop-down callbacks accept the options array. To finish off our fields we need to associate the field with the right section and settings field.

Lastly, we need to set the register settings array. This will allow us to properly save our fields and register the settings field with WordPress so it will output.

Add Tabbed Navigation
=====================

At this moment, you need to edit the starters_theme_options_display() to apply the proper tabbed navigation. Since we have created the slide_show.php options, let's add these to the display function. Duplicate the code found on line 60 and paste it on line 61 and changing any instance of display_options or Display Options to slide_show or Slide Show.

Now copy lines 65-68 and paste them on line 69. Change the if statement to an else if and change the string for $active_tab to slide_show. This will match the results found in the query string in line 61 for the key "tab". Lastly, we'll update the settings_field() and do_settings_section() with the proper ID's. You'll want to use the same information set for $section_id in our slide_show.php file in the options directory.


TO DO's
=======

Further automate the tabbed navigation and the settings_field() and do_settings_section(). The ultimate goal is to only touch the files in the options directory. Everything else should auto grab the needed information from these files so we can speed up development.

Convert code into a plug-in and allow for configuration via the admin area. Allow users to install the plug-in and add new pages (aka tabbed areas), and set fields through one interface.

Any improvements are accepted and encouraged! This is just a starting point :)
