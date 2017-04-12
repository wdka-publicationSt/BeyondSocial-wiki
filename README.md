Beyond Social wiki skin
==================

a custom MediaWiki skin based on the Vector skin, by Manetta Berends & André Castro. README by Manetta Berends.

This wiki skin is developed for [Beyond Social](http://beyond-social.org/), a publishing project around Social Art & Design at the [Willem de Kooning Academie](http://www.wdka.nl/), Rotterdam. The skin and the other wiki developments are a collaborative product of the Hybrid Publishing research group and the Social Practices department in collaboration with André Castro and Manetta Berends, and took place between November 2016 and February 2017. 

In between 2014 & 2016, Beyond Social already used a wiki as part of their publishing workflow, where it had a backend function for a [wiki2web workflow](https://github.com/wdka-publicationSt/BeyondSocial). The wiki was a workarea, where articles and images were collected and brought together to generate the online Beyond Social Issues. 

In November 2016 we made the choice to change the Beyond Social publishing workflow. The wiki2web workflow made it difficult to make relatively small changes to the structure of the Beyond Social issues, for example to the topic and section categories. The collaboration between editors and developers was sometimes difficult. The specific expectations did often not match with the wealth of possibilities that the wiki software offered. As a response to this, we decided to not use the wiki as a backend anymore, but instead, we decided to start to use the wiki as a wiki in itself: both as back- and frontend of Beyond Social. 

Next to the Beyond Social skin, in which we designed a custom wiki layout, we developed custom functions for the Beyond Social wiki: a transclusion-driven Main Page, a form to create editorials, a share function to share an article on Facebook and Twitter* and we included the visual category-selection extension. The choice for a wiki publishing platform is part of an ongoing research around the term 'hybrid publishing'. The following README file introduces thoughts about 'hybridity' and offers practical information about the skin itself.

*written by [Template](http://template01.info/) (Marlon Harder & Lasse van den Bosch Christenson), as part of the previous [wiki2web workflow](https://github.com/wdka-publicationSt/BeyondSocial).

## MediaWiki software
Beyond Social is using the same piece of software as Wikipedia is running on, called MediaWiki. MediaWiki software is specifically made for Wikipedia and is written and maintained by the community around the encyclopedia project since 2002. MediaWiki is therefore a community-driven publishing platform, built to fit the needs of a large-scale publishing project that is maintained by a big and distributed community. It is therefore a clearly different type of platform as other content management systems like WordPress. Where a WordPress publishing workflow follows the traditional publishing workflow of authors, editors and readers, a MediaWiki publishing workflow is characterized by collective authorship, a versioning system that saves the editing history of an article, a social-hierarchy — a division between administrators, bureaucrats and editors, and a large set of special pages that display user activity. But the biggest difference between a WordPress or MediaWiki publishing system is perhaps the division between the reading and writing mode. In a WordPress system these two modes are clearly divided in a backend and seperate frontend. But in a MediaWiki they are intentionally blurred, which enables users to not only read the wiki, but to also be involved as a writer. MediaWiki is built to be used as a front- and backend at the same time, and can therefore be written and maintained collectively by its community. 

Before i started to work on the Beyond Social project, i had become familiar with the MediaWiki software already for a few years. And to be honest, both in a visual and structural way, i had bumped into a learning curve before the wiki started to function as an attractive platform to me. It is interesting to realize how the closeness between the option to read and/or write appears to be a quite non-intuitive feature, perhaps driven by the nature of many other platforms where the two modes are more strictly divided from eachother. Also the multiplicity of features and listings that lead to the content of a MediaWiki seems to be rather confusing. As a beginning wiki-user, it can be a bit of an adventure to navigate through the large amounts of options and special pages and find the ones that are useful for you to access the content that sometimes seems so deeply sunk into the wiki. Working with the wiki can be a learning curve, but the software comes with a large set of interesting tools and a rich pool of information once this curve is defeated. After having worked in wiki's now for a few years, i really feel that the effort of familiarizing with a wiki pays back at the moment it found its community. The specific social information that the platform produces, such as recent changes or the most recent discussions on talk pages, is deeply rooted in the social dimensions between the people of the community itself. These features show how a MediaWiki platform is built to publish more than only articles and essays. It surrounds its content with social, contextual and proces-based layers of information such as discussions on talk pages, the history of a page and recent user activity information. Social user information transforms in this way into another layer of information and offers an alternative way of connecting to the community of Social Art & Design. 

## Hybrid publishing
Our approach to turn a MediaWiki into a publishing platform for Social Art & Design has been very much software-driven. During the project we suggested to 'listen to the wiki' as much as possible, to develop a publishing workflow based on the community-driven features that are built-in in MediaWiki software. Next to that, we wanted to have the freedom to work on our own design, which lead to the decision to make a custom wiki skin. And as we acknowledged how non-intuitive a wiki can appear to some, we also worked on the implementation of some additional user-friendly wiki functions. 

Thinking about the 'hybrid' aspect in our MediaWiki developments, yields multiple aspects that might qualify, such as hybridity between user and developers, or between community and software. But the most important one is perhaps the interwoven appearances of hybridity between reading and writing. A division that is traditionally reflected in a clear distinction between front- and backend, but is blurred in a MediaWiki where both reading and writing happens in the same frontend interface. The hybridity lies at the side of the wiki visitor, pending between its role as reader and the possibility to write. In combination with MediaWiki's built-in contextual layer of social information, it feels like the MediaWiki software tries to activate its readers and to involve them in a more engaged way. 

The reading and writing hybridity does not only effect the role of the reader, but touches each role within the publishing process. The role of the editorial team is for example expanded and spread throughout the community, as any student, professional or teacher can make a page and publish an article. As a result, tasks like proof-reading or editorial editing don't disappear, but become a task that can be executed by any user of the wiki. This will probably not happen automatically however. Within the Wikipedia community it is for example very common to organize 'editathons' to concentrate and stimulate the editing and proof-reading process of the platform. But the possibility to transform the editorial roles into a distributed mode of working, is an exciting experiment to unroll within a community that works on a range of social themes and subjects.

Also the role of a designer and developer resonates the reading and writing hybridity in some form. Also here, the division of a front- and backend does not follow the distinction between writing code and previewing how this code works in the interface. Working with the software more intensively revealed how Mediawiki software actually is a sort of programming platform in itself. Within its frontend, it has its own built-in language—such as the special wiki syntax codes like '~~~~' to add a personal signature and timestamp, functions—such as templates, forms and transclusion tools. 

### Transclusion
One of the built-in MediaWiki features that has been central in the development of the BS skin is the transclusion technique. It turned out to be a useful way to work with a Main Page that we wanted to structure and style, but therefore became quite fragile and difficult to read in terms of many html elements and strict break lines. Within this fragile structure, we wanted to include a few sections on the Main Page that would need curation and therefore writing access, such as the highlighted articles, the category selection and the list of upcoming events. By transcluding single pages into <div> elements on the Main Page, the Main Page can be edited by not touching the Main Page itself: the curated sections are edited in a set of other (normal) pages. To do this, we used standard wiki templates. In order to transclude a short 'about' description of the Beyond Social project on the Main Page, we used this template markup

    {{:About_Beyond_Social}} 

to include the page "About_Beyond_Social" into the Main Page. By default, this line trancludes the full page into the Main Page. But as we only wanted to have the first paragraph of the page, we added <noinclude> tags around the rest of the text. These no-inclusion tags mark which text should never be transluded into another page, and make sure that this text will still be visible when someone visits the page "About_Beyond_Social" itself. Another way to include a specific part of text is by using the <includeonly> tags. For us these tags were less useful, as these tags mark which text should be transcluded, but will make this text invisible when visiting the page itself. Visit the MediaWiki documentation pages to read more about on [transclusion](https://www.mediawiki.org/wiki/Transclusion) and [templates](https://www.mediawiki.org/wiki/Help:Templates). 

A second type of transclusion that we wanted to include for the Main Page were the listings of recent user activity that are built-in wiki functions, such as recent files, new pages, wanted pages (red links) and listings of articles using the Editorial template. Some of these lists can be transcluded into other pages using standard wiki templates, such as the recent files list that can be queried like this: 

    {{:Special:Newimages/12}} 

For the more specific lists that we wanted to use, such as a list of all the pages that use the Template:Editorial for example, we needed a few more transclusion options . MediaWiki software comes with many functions, but there is also a large amount of plugins available, called extensions, of which some are more stable then other. (See [this page](https://www.mediawiki.org/wiki/Category:All_extensions) listing all available extensions in the MediaWiki database.) We decided to use an external plugin called [DynamicPageList](https://www.mediawiki.org/wiki/Extension:DynamicPageList_%28third-party%29) (DPL) that offers specific transclusion options to create lists of a specific category or query the last batch of activity from a special page such as all the pages that use the Template:Editorial. A DPL transclusion to do this looks like this: 

    <DPL>

      uses=Template:Editorial

      ordermethod=firstedit

      order=descending

      count=10

    </DPL> 

## Editorials
Beside a custom Main Page, we developed a special type of article page for the Beyond Social wiki: editorials. An editorial is a type of article that anyone can create. It is a page where a list of various articles can be collected, and accompanied with a short introduction and image. Editorials can be used for example to highlight a specific theme that appears in Beyond Social, or to bring a set of student projects together that have been created in the same year. These are example, the author of an editorial is free to curate article together according to his own interests. 

Editorials are created through a [form](http://beyond-social.org/wiki/index.php/Form:Editorial), for which we used the Semantic MediaWiki page forms. (See [this test editorial](http://beyond-social.org/wiki/index.php/Special:FormEdit/Editorial/example) for an example). Thanks to the form and its predefined structure, it is easier to create an editorial. The form includes input fields with an autofill function, which makes it easier to search for specific articles and image files on the wiki. The form is connected to a [template](http://beyond-social.org/wiki/index.php/Template:Editorial) by including this syntax:

    {{{for template|Editorial|label=Form to create an Editorial}}}


The template displays every editorial in the same layout, which makes them easily recognizable as being a special type of page. At the moment that a form is published, the wiki creates an article page and writes the content of the form into the structure of the template. 

To create the list of article selections, we needed an option which would let the author free in deciding how many article he/she wanted to include in his/her editorial. To add a # number of articles, we looked for a way in which a single part of a form can be repeated for a # of times. As we only wanted this smaller part of the form to be repeated, we created a seperate [Article Selection](http://beyond-social.org/wiki/index.php/Template:Article_Selection) template:

    {{{for template|Article Selection|multiple|label=Select articles|add button text=Add article}}}


The 'multiple' option in this line enables an add button in the interface of the form, together with a drag-and-drop function to change the order and a delete button to remove items from the list. At the moment that a form is published, the content of the list is placed in the Template:Article Selection. In the template, the wiki receives the list with the '#arraymap' function, which is a function that work with a list of items and repeats the Article Selection template as many times as there are items in the list: 

    {{#arraymap:{{{Articles|}}}|,|x|[[x]]}}


For more detailed information, there is a longer explanation [here](https://www.mediawiki.org/wiki/Extension:Page_Forms/Page_Forms_and_templates#arraymap) on the MediaWiki site.

After publishing an editorial, the page can be edited through the form again. To do this, Semantic MediaWiki offers the option to add an "Edit with form" option to the action menu, see for example [here](http://beyond-social.org/wiki/index.php/Social_Design_Projects_and_Positions). For more info see this [MediaWiki documentation page](https://www.mediawiki.org/wiki/Extension:Page_Forms/The_%22edit_with_form%22_tab).

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


