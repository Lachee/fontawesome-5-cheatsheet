<?php namespace lachee\fontawesome;

/**
*  A sample class
*
*  Use this section to define what this class is doing, the PHPDocumentator will use this
*  to automatically generate an API documentation using this information.
*
*  @author yourname
*/
class Cheatsheet{
   private static $_cache = null;
   private static $_lookup = [];

   /** Loads the icons */
   public static function init() {
      if (!file_exists(__DIR__ . "/icons.dat")) 
         throw new \Exception("Content does not exist. Please check your composer configuration.");

      $content = file_get_contents(__DIR__ . "/icons.dat");
      self::$_cache = unserialize($content);
      self::$_lookup = [];

      foreach(self::$_cache as $name => $icon) {
         self::$_lookup[$icon->unicode] = $name;
      }
   }

   /** Clears the icons */
   public static function deinit() {
      self::$_cache = null;
   }

   private static function checkinit() { 
      if (self::$_cache === null)
         self::init();
   }

   /** Gets an icon from the name
    * @return Icon|null the icon that matches the name, otherwise null
    */
   public static function fromName($name) {
      self::checkinit();
      $name = strtolower($name);
      return self::$_cache[$name] ?? null;
   }

   /** Gets the icon from the unicode codepoint (ie f601)
    * @return Icon|null
    */
   public static function fromUnicode($unicode) {
      self::checkinit();
      $unicode = strtolower($unicode);
      return self::fromName(self::$_lookup[$unicode]) ?? null;
   }

   /** Gets all the icons
    * @return Icon[] the icons
    */
   public static function all() {
      self::checkinit();
      return self::$_cache;
   }

}