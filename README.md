# fontawesome-5-cheatsheet
Font Awesome 5 cheatsheet lookup in PHP. Use it to look up icons from name or from unicode.

## What it do?
it does scrape cheatsheet from [fontawesome](https://fontawesome.com/cheatsheet/pro/) vary wel

## But how I do?
In order to use this tool, you need to first make sure its updated. You can do this by calling 
 `\lachee\fontawesome\Updater::update()`, however its recommended to use this in your composer settings under the post update/install cmd:
 ```
     "scripts": {
        "post-update-cmd": [
            "lachee\\fontawesome\\Updater::postUpdate"
        ],
        "post-install-cmd": [
            "lachee\\fontawesome\\Updater::postUpdate"
        ]
    }
```
 
Once its all updated, then you can simply call `\lachee\fontawesome\Cheatsheet::fromName('discord')` from within your code. It will return an [`\lachee\fontawesome\Icon`](https://github.com/Lachee/fontawesome-5-cheatsheet/blob/master/src/Icon.php) object that contains a name, unicode and available styles. 

* `\lachee\fontawesome\Cheatsheet::fromName($name)` Gets an icon from the name
* `\lachee\fontawesome\Cheatsheet::fromUNicode($name)` Gets the icon from the unicode codepoint (ie f601)
* `\lachee\fontawesome\Cheatsheet::all()` Gets all icons
* `\lachee\fontawesome\Updater::update()` Updates the icon lists

## Is it legal?
¯\_(ツ)_/¯

## What about composer?
`composer require lachee/fontawesome-5-cheatsheet`
You may need to tell explicitly to use the @dev

## What about Font Awesome 6
I dont care, this will probably break when they discontinue FA 5
