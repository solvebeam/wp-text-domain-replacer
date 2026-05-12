<?php

__( 'Test 1', 'new' );
\__( 'Test 2', 'new' );

test__( 'Test 3', 'old' );

__( 'Test 4', 'new' );

load_plugin_textdomain( 'new', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
load_plugin_textdomain( 'new', false );
load_plugin_textdomain( 'new' );

\esc_html_e( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam mollis metus a nulla malesuada, id rutrum tellus pretium. Mauris ultricies dictum sagittis. Donec nec dui vel felis malesuada rhoncus nec.', 'new' );
