<?php

namespace Test;

/**
 * Custom namespaced translation function (will be modified by replacer).
 *
 * This function has the same name as WordPress's __() function, but exists in a namespace.
 * However, the text replacer WILL still modify calls to this function. This is because
 * PHP-Parser cannot statically determine the fully qualified name (FQN) inside a namespace.
 *
 * According to PHP-Parser documentation, unqualified function names inside a namespace
 * cannot be resolved at parse time - they could refer to either the namespaced version
 * or the global version. The replacer conservatively treats them as potential WordPress
 * translation functions and modifies them.
 *
 * This test case demonstrates that limitation: the call __( 'Test 1', 'old' ) gets
 * modified to __( 'Test 1', 'new' ) even though it refers to the custom Test\__() function.
 *
 * @param string $text   Text to translate
 * @param string $domain Text domain
 * @return string
 */
function __( $text, $domain ) {
	return $text . ' - ' . $domain;
}

__( 'Test 1', 'old' );
