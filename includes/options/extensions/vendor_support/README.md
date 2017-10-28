## Redux Vendor Support

This plugin (or extension) acts as a backup and/or replacement for the CDN based files for Select2 and ACE Editor used within Redux Framework.

## Usage Instructions
First, set `use_cdn => false` in your config if you want this to be permamently used, but if not it will only be used when the CDN fails.

### Installation as a Plugin
Take this entire repo and load it as an extension. The CDN files will now be served locally.

### Installation as an Extension
Take the ~/vendor_support folder and load it as an extension for your version of Redux.

```
Redux::setExtensions( 'OPT_NAME', 'PATH_TO_vendor_support'  );
```

## Reducing the Plugin/Extensions Size
If you wish to reduce the size of this plugin/extension, you may decide to remove folders within `~/vendor_support/vendor/` according to your needs. It is strongly suggested that you leave the Select2 folder, as so many different fields heavily use this code.