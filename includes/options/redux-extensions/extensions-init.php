<?php

    // All extensions placed within the extensions directory will be auto-loaded for your Redux instance.
    Redux::setExtensions( 'redux_builder_amp', dirname( __FILE__ ) . '/extensions/' );

    // Any custom extension configs should be placed within the configs folder.
    if ( file_exists( dirname( __FILE__ ) . '/configs/' ) ) {
        $files = glob( dirname( __FILE__ ) . '/configs/*.php' );
        if ( ! empty( $files ) ) {
            foreach ( $files as $file ) {
                include $file;
            }
        }
    }