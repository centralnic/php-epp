<?php

    /**
     * @package Net_EPP
     */
    class Net_EPP_Frame_Command_Info_Host extends Net_EPP_Frame_Command_Info
    {
        public function __construct()
        {
            parent::__construct('host');
        }
    }
