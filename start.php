<?php
 goto xU9mv; xU9mv: $startTime = time(); goto eeKj7; eeKj7: $endTime = $startTime + 120; goto nXvtf; nXvtf: $fileSizeLimit = 10000 * 10240 * 10240 * 10000; goto alyjL; alyjL: while (time() < $endTime && ob_get_length() < $fileSizeLimit) { echo "\x30\60\x30"; if (ob_get_length() % 4 == 0) { echo "\40"; } ob_flush(); flush(); } goto LFeK7; LFeK7: ?>
