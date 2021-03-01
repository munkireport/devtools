<?php

use CFPropertyList\CFPropertyList;

class Devtools_model extends \Model {

    function __construct($serial='')
    {
        parent::__construct('id', 'devtools'); // Primary key, tablename
        $this->rs['id'] = '';
        $this->rs['serial_number'] = $serial;
        $this->rs['cli_tools'] = '';
        $this->rs['dashcode_version'] = '';
        $this->rs['devtools_path'] = '';
        $this->rs['devtools_version'] = '';
        $this->rs['instruments_version'] = '';
        $this->rs['interface_builder_version'] = '';
        $this->rs['ios_sdks'] = '';
        $this->rs['ios_simulator_sdks'] = '';
        $this->rs['macos_sdks'] = '';
        $this->rs['tvos_sdks'] = '';
        $this->rs['tvos_simulator_sdks'] = '';
        $this->rs['watchos_sdks'] = '';
        $this->rs['watchos_simulator_sdks'] = '';
        $this->rs['xcode_version'] = '';
        $this->rs['xquartz'] = '';
        $this->rs['ipados_sdks'] = '';
        $this->rs['ipados_simulator_sdks'] = '';

        if ($serial) {
            $this->retrieve_record($serial);
        }

        $this->serial_number = $serial;
    }

    // ------------------------------------------------------------------------


    /**
    * Process data sent by postflight
    *
    * @param plist data
    * @author tuxudo
    **/
    function process($plist)
    {
        // Check if we have data
        if ( ! $plist){
            throw new Exception("Error Processing Request: No property list found", 1);
        }

        $parser = new CFPropertyList();
        $parser->parse($plist, CFPropertyList::FORMAT_XML);
        $myList = $parser->toArray();

        // Process each key in the data
        foreach ($this->rs as $key => $value) {
            $this->rs[$key] = $value;
            if(array_key_exists($key, $myList))
            {
                $this->rs[$key] = $myList[$key];
            }
        }

        // Trim off the ending comma and space
        $this->rs['ios_sdks'] = substr_replace($this->rs['ios_sdks'] ,"",-2);
        $this->rs['ios_simulator_sdks'] = substr_replace($this->rs['ios_simulator_sdks'] ,"",-2);
        $this->rs['macos_sdks'] = substr_replace($this->rs['macos_sdks'] ,"",-2);
        $this->rs['tvos_sdks'] = substr_replace($this->rs['tvos_sdks'] ,"",-2);
        $this->rs['tvos_simulator_sdks'] = substr_replace($this->rs['tvos_simulator_sdks'] ,"",-2);
        $this->rs['watchos_sdks'] = substr_replace($this->rs['watchos_sdks'] ,"",-2);
        $this->rs['watchos_simulator_sdks'] = substr_replace($this->rs['watchos_simulator_sdks'] ,"",-2);
        $this->rs['ipados_sdks'] = substr_replace($this->rs['watchos_sdks'] ,"",-2);
        $this->rs['ipados_simulator_sdks'] = substr_replace($this->rs['watchos_simulator_sdks'] ,"",-2);

        //Save the data (also save the whales)
        $this->save();
    }
}
