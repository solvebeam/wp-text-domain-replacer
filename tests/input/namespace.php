<?php

namespace Test;

function __( $text, $domain ) {
	return $text . ' - ' . $domain;
}

// This text domain should not be replaced, because this is a namespaced Test\__() call.
__( 'Test 1', 'old' );

// This text domain should be replaced, because this is a FQN root namespace \__() call.
\__( 'Test 2', 'old' );
