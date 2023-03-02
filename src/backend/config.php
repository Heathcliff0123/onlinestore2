<?php
    class connect extends PDO
    {
        public function __construct()
        {
            parent::__construct(mysql);
        }
    }
?>