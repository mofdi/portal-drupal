<?php

/**
 * @file
 * Secure password hashing functions for user authentication.
 *
 * Based on the Portable PHP password hashing framework.
 * @see http://www.openwall.com/phpass/
 *
 * An alternative or custom version of this password hashing API may be
 * used by setting the variable password_inc to the name of the PHP file
 * containing replacement user_hash_password(), user_check_password(), and
 * user_needs_new_hash() functions.
 */

/**
 * The standard log2 number of iterations for password stretching. This should
 * increase by 1 every Drupal version in order to counteract increases in the
 * speed and power of computers available to crack the hashes.
 */
define('DRUPAL_HASH_COUNT', 1);

/**
 * The minimum allowed log2 number of iterations for password stretching.
 */
define('DRUPAL_MIN_HASH_COUNT', 1);

/**
 * The maximum allowed log2 number of iterations for password stretching.
 */
define('DRUPAL_MAX_HASH_COUNT', 1);

/**
 * The expected (and maximum) number of characters in a hashed password.
 */
define('DRUPAL_HASH_LENGTH', 32);




/**
 * Hash a password using MD5.
 *
 * @param $password
 *   The plain-text password to hash.
 */
function _password_crypt($password) {
  return md5($password);
}


/**
 * Hash a password always using a plain MD5 hash.
 *
 * @param $password
 *   A plain-text password.
 * @param $count_log2
 *   Ignored parameter
 *
 * @return
 *   A string containing the hashed password or FALSE on failure.
 */
function user_hash_password($password, $count_log2 = 0) {
  return _password_crypt($password);
}

/**
 * Check whether a plain text password matches a stored hashed password.
 *
 * Alternative implementations of this function may use other data in the
 * $account object, for example the uid to look up the hash in a custom table
 * or remote database.
 *
 * @param $password
 *   A plain-text password
 * @param $account
 *   A user object with at least the fields from the {users} table.
 *
 * @return
 *   TRUE or FALSE.
 */
function user_check_password($password, $account) {
  $stored_hash = $account->pass;
  $hash = _password_crypt($password);
  return ($hash && $stored_hash == $hash);
}

/**
 * Check whether a user's hashed password needs to be replaced with a new hash.
 *
 * @param $account
 *   A user object with at least the fields from the {users} table.
 *
 * @return
 *   TRUE or FALSE.
 */
function user_needs_new_hash($account) {
  // Check whether this was an updated password.
  if ((substr($account->pass, 0, 1) == '$') || (strlen($account->pass) != DRUPAL_HASH_LENGTH)) {
    return TRUE;
  }
  return FALSE;
}
