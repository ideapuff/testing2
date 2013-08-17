<?php

/**
 * Description of FrameworkException
 *
 * @author xz71
 */
class FrameworkException extends Exception {

    public function __construct($message, $previous = null, $code = 0) {
        parent::__construct($message, $code, $previous);
    }

    public function log() {
        try {
            $exception = $this;
            $loggingMessage = date('Y-m-d h:i:s - ');
            while (!empty($exception)) {
                $loggingMessage .= get_class($exception) . ": " . $exception->getMessage() . "\n";
                $exception = $exception->getPrevious();
            }
            $loggingMessage .= "\n---------------------------------------------------------\n\n";
            $fileName = BASE_DIR . '/log/log_' . date('Y') . date('m') . date('d') . 'txt';
            $fileHandle = fopen($fileName, 'a+');
            fwrite($fileHandle, $loggingMessage);
            fclose($fileHandle);
        } catch (Exception $e) {
            exit("Error in FrameworkException::log");
        }
    }

}

?>
