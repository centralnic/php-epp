<?php

    /**
     * @package Net_EPP
     */
    class Net_EPP_Frame_Command_Update_Contact extends Net_EPP_Frame_Command_Update
    {
        public function __construct()
        {
            parent::__construct('contact');
        }
    }
