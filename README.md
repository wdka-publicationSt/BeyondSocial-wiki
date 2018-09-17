Beyond Social wiki skin
==================

a custom MediaWiki skin based on the Vector skin.

This wiki skin is developed for [Beyond Social](http://beyond-social.org/), a publishing project around Social Art & Design at the [Willem de Kooning Academie](http://www.wdka.nl/) in Rotterdam. The skin and the other wiki developments are a collaborative product of the Hybrid Publishing research group and the Social Practices department in collaboration with André Castro and Manetta Berends. 

## Install the BeyondSocial skin and customize your own
The Beyond Social skin is based on the Vector skin and is implemented in a Mediawiki 1.28 installation. Make sure you install this version or higher. It is recommended to make an installation of MediaWiki locally, where you can test your changes to the skin. 

Install MediaWiki in the /var/www/html/ of your server or computer by following the [MediaWiki installation guide](https://www.mediawiki.org/wiki/Manual:Installation_guide) into a folder called "wiki" for example. 

Download or clone the BeyondSocial-wiki git repository in the /var/www/html/ of your server or computer.

    cd /var/www/html/

    git clone https://github.com/wdka-publicationSt/BeyondSocial-wiki.git


It will create a folder called BeyondSocial-wiki that contains one folder called "skins" in which the BeyondSocial skin is located. If you want to rename the skin to make it your own, there is a useful command line tool called "rename", to rename all the BeyondSocial / beyondsocial / Beyond Social mentions to your own name.

Copy all the files of your MediaWiki installation from the folder "wiki" to the folder "BeyondSocial-wiki" EXCEPT the "skins" folder. 

    cd /var/www/html/wiki/

    cp -r !(skins) ../BeyondSocial-wiki


 You can copy the deafult wiki skins if you want to have these available too.

     cp -r skins/Vector ../BeyondSocial-wiki/skins/

     cp -r skins/Monobook ../BeyondSocial-wiki/skins/

     cp -r skins/Modern ../BeyondSocial-wiki/skins/

     cp -r skins/CologneBlue ../BeyondSocial-wiki/skins/


Remove the "wiki" folder, and rename the BeyondSocial-wiki folder to "wiki".

    cd /var/www/html/

    rm -r wiki

    mv BeyondSocial-wiki wiki


To make the BeyondSocial skin your default skin, edit the settings in the LocalSettings.php file that is located in the main "wiki" folder. 

    cd /var/www/html/wiki/

    nano LocalSettings.php


Firstly, the skin need to be loaded by MediaWiki. Enable the Beyond Social skin by adding this line (with the Uppercases in place!):

    wfLoadSkin( 'BeyondSocial' );


Edit the line that sets the default skin to the following (all lowercase!): 

    $wgDefaultSkin = "beyondsocial";


Exit nano with CTRL+X, and type a Y to save the changes. Now go to your MediaWiki installation through the browser and see if it worked!

    localhost/wiki (for local installations)

    example.com/wiki/ (for server installations)


## Editing the skin
**skin.json**: This file is the settings file for the Beyond Social skin. Here, you can add media queries to make the wiki respond to different screen sizes and include a stylesheet for printing. See line 33, "ResourceModules".

**css**: All the css files of the skin are included in the /skin/BeyondSocial/components/ folder. Another option could have been to use the common.css page on the wiki, but due to the amount of css we needed to add, we decided to store it in the skin folder itself. The skin works with .less in stead of .css files. We continued to work with less as the Vector skin was based on these files. There is a .less file for different sections of the wiki: for example there is a footer.less, navigation.less and personalMenu.less. These .less files originated from the Vector skin, but are edited according to match our wishes. The files bs-editorials.less, bs-mainpage.less and bs-namespaces.less are added for Beyond Social. Less enabled us to work with variables in css, something new for me but very useful. There is a variables.less file in the main /BeyondSocial/ folder in which all the main variables are stored that are called in the other .less files.

**php**: BeyondSocialTemplate.php is the most important php file. Some elements have been moved around here, and a few lines of html have been added, but we tried to add as less as possible. The lines that are changed are marked with comments. 

**js**: beyondsocial.js is where you can add javascript functions. The only javascript that is added to the skin is called by the Share option in the menu. It selects the first image of a page, and include that as a header in the html. Facebook's sharing function reads this image and places it next to the link you want to share. 

## plugins
To make the use of the wiki more accessible, we installed a few plugins, such as the Page Form plugin for the Editorials, and the Category Selector. The latter one is used for the small category-selection interface that appears under a text input field to make it easy to categorize your article. We tried to install a visual text-editor as well, but without success unfortunately. See [the Special:Version page](http://beyond-social.org/wiki/index.php/Special:Version) for the plugins that are currently installed. 

## license
This skin is licenced under a free software [GNU GPL v3](https://www.gnu.org/licenses/gpl.html) license.

Because the BS wiki is part of the education of the Willem de Kooning Acedemy we can not open the BS wiki skin up for any contributions. However, we are happy to share our work with you and allow anyone to clone this repository, and use it to create your own custom wiki skin.

## links
* Vector skin https://www.mediawiki.org/wiki/Skin:Vector 
* Beyond Social wiki http://beyond-social.org/


