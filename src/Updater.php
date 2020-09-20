<?php namespace lachee\fontawesome;

use Composer\Script\Event;
use Composer\Installer\PackageEvent;

class Updater {

    /** Event for composer update */
    public static function postUpdate(Event $event)
    {
        $composer = $event->getComposer();

        echo "Updated\n";
        self::update();
    }
    public static function postPackageInstall(PackageEvent $event)
    {
        echo "Package Installed\n";
        self::update();
    }

    /** Fetches the JSON of all items from fontawesome and saves them to disk */
    public static function update() {
        echo "Fetching Elements\n";
        $html = file_get_contents('https://fontawesome.com/cheatsheet/pro/light');
        $start = strpos($html, 'window.__inline_data__ = ') + 25;
        $end = strpos($html, '</script>', $start);
        $json = substr($html, $start, $end - $start);
        file_put_contents(__DIR__ . "/fontawesome.json", $json);

        echo "Reading Structure\n";
        $obj = json_decode($json, true);
        $elms = $obj[count($obj) - 1]['data'];

        $icons = [];
        foreach($elms as $e) {
            $icon = new Icon();
            $icon->name = $e['id'];
            $icon->unicode = $e['attributes']['unicode'];
            $icon->styles = [];
            
            foreach($e['attributes']['styles'] as $s) {
                $license = in_array($s, $e['attributes']['membership']['pro']) ? Icon::LICENSE_PRO : Icon::LICENSE_FREE;
                $icon->styles[$s] = $license;
            }

            $icons[$e['id']] = $icon;
        }

        echo "Saving Structure\n";
        file_put_contents(__DIR__ . '/icons.dat', serialize($icons));

        echo "Done\n";
    }
}