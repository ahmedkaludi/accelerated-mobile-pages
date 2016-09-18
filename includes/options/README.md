## Cust Redux Build Instructions

### NEVER modify anything in the redux-framework folder
Redux works because it's extensible by hooks. If you modify the core directory,
or attempt to add your own stuff within the core directory, any other version of
Redux WILL override your code. Never ever modify the ReduxCore, only extend it
via hooks and filters.  ;)

#### ~/admin/options-init.php
Your options configuration.


#### ~/admin/tgm/tgm-init.php (If you opted to use it)
You can add additional plugins if desired.

#### Learn About Redux Extensions
https://docs.reduxframework.com/extensions/using-extensions/

#### ~/admin/redux-extensions/extensions
Place all extensions within this directory. An example would look like:

* ~admin
  * redux-extensions
    * extension
      * metaboxes
        * extension_metaboxes.php

#### ~/admin/redux-extensions/configs
Place any custom configs extensions, that should not be added to the standard 
options-init.php file, within this folder. These will be auto-loaded.


### For further instructions or assistance, please visit http://docs.reduxframework.com