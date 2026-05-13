<?php

namespace Test;

/**
 * Custom namespaced translation function with different signature.
 *
 * This function has the same name as WordPress's __() translation function,
 * but with a completely different parameter signature (array, int, bool instead of strings).
 * Calls to this function are NOT modified by the replacer, because the second argument
 * is not a string that matches any of the search domains.
 *
 * @param array $data    Array containing name data
 * @param int   $count   Count parameter
 * @param bool  $enabled Enabled flag
 * @return string
 */
function __( array $data, int $count, bool $enabled ) {
	return $data['name'] . ' - Count: ' . $count . ' - Enabled: ' . ($enabled ? 'yes' : 'no');
}

__( ['name' => 'Test 3'], 42, true );
