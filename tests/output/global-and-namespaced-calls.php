<?php

namespace Test;

function __( $text, $domain ) {
	return $text . ' - ' . $domain;
}

__( 'Test 1', 'new' );

\__( 'Test 2', 'new' );
