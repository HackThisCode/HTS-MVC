<?php
/**
 * HTS_ErrorHandler
 *
 * HackThisSite Accounts Management error handler.
 *
 * @package		HTS-AM
 * @author		Kage
 */
function HTS_ErrorHandler($errno, $errstr, $errfile, $errline) {
  // Do nothing if error reporting is turned off
  if (error_reporting() === 0) return;
  // Be sure received error is supposed to be reported
  if (error_reporting() & $errno) {
    throw new HTS_ExceptionHandler($errstr, $errno, $errno, $errfile, $errline);
  }
}
