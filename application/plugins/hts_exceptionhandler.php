<?php
/**
 * HTS_ExceptionHandler
 *
 * HackThisSite Accounts Management exception handler.
 *
 * @package		HTS-AM
 * @author		Kage
 */

class HTS_ExceptionHandler extends ErrorException {

  /**
   * printException
   *
   * @access	public
   */
  public static function printException(Exception $e) {
    switch ($e->getCode()) {
      case E_ERROR:
         $code_name = 'E_ERROR';
         break;
      case E_WARNING:
	  $code_name = 'E_WARNING';
          break;
      case E_PARSE:
	  $code_name = 'E_PARSE';
          break;
      case E_NOTICE:
	  $code_name = 'E_NOTICE';
          break;
      case E_CORE_ERROR:
	  $code_name = 'E_CORE_ERROR';
          break;
      case E_CORE_WARNING:
	  $code_name = 'E_CORE_WARNING';
          break;
      case E_COMPILE_ERROR:
	  $code_name = 'E_COMPILE_ERROR';
          break;
      case E_COMPILE_WARNING:
	  $code_name = 'E_COMPILE_WARNING';
          break;
      case E_USER_ERROR:
	  $code_name = 'E_USER_ERROR';
          break;
      case E_USER_WARNING:
	  $code_name = 'E_USER_WARNING';
          break;
      case E_USER_NOTICE:
	  $code_name = 'E_USER_NOTICE';
          break;
      case E_STRICT:
	  $code_name = 'E_STRICT';
          break;
      case E_RECOVERABLE_ERROR:
	  $code_name = 'E_RECOVERABLE_ERROR';
          break;
      default:
	  $code_name = $e->getCode();
	  break;
    }

/*
When this is eventually sent to the view, this is how it'll be done

    $mvc = tmvc::instance();
    $mvc->controller->view->assign('err_name', $code_name);
    $mvc->controller->view->assign('err_msg', $e->getMessage());
    $mvc->controller->view->assign('err_file', $e->getFile());
    $mvc->controller->view->assign('err_line', $e->getLine());
    $mvc->controller->view->display('error_view');
*/

    echo '    <span style="text-align: left; background-color: #fcc; border: 1px solid #600; color: #600; display: block; margin: 1em 0; padding: .33em 6px">'."\n";
    echo '      <b>Error:</b> '.$code_name."<br />\n";
    echo '      <b>Message:</b> '.$e->getMessage()."<br />\n";
    echo '      <b>File:</b> '.$e->getFile()."<br />\n";
    echo '      <b>Line:</b> '.$e->getLine()."\n    </span>\n";
  }

  /**
   * handleException
   *
   * @access	public
   */
  public static function handleException(Exception $e) {
    return self::printException($e);
  }
}

