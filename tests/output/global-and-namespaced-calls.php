<?php

namespace Test;

/**
 * Test file demonstrating the difference between unqualified and fully qualified calls.
 *
 * This file contains two translation function calls:
 *
 * 1. __( 'Test 1', 'old' ) — unqualified call, modified by the replacer.
 *    PHP-Parser cannot resolve the FQN, so the replacer conservatively treats it as
 *    a potential WordPress translation function call.
 *
 * 2. \__( 'Test 2', 'old' ) — fully qualified global call, also modified by the replacer.
 *    The leading backslash explicitly references the global WordPress __() function.
 *
 * @param string $text   Text to translate
 * @param string $domain Text domain
 * @return string
 */
function __( $text, $domain ) {
	return $text . ' - ' . $domain;
}

__( 'Test 1', 'new' );

\__( 'Test 2', 'new' );
