<?php

shell_exec('php receipt.php > receipts/receipt.txt');
shell_exec('lpr -o raw -H localhost -P POS58 receipts/receipt.txt');

?>