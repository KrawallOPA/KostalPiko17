<?php
class KostalPiko extends IPSModule
{
		public function Create()
		{
			//Never delete this line!
			parent::Create();
			
			$this->RegisterPropertyString("url", "http://pvserver:pvwr@192.168.178.60");
			$this->RegisterPropertyInteger("Intervall", 10);
                        $this->RegisterPropertyBoolean("IsDay", 1);
                        $this->RegisterPropertyInteger("startzeith", 05);
                        $this->RegisterPropertyInteger("startzeitm", 00);
                        $this->RegisterPropertyInteger("stopzeith", 22);
                        $this->RegisterPropertyInteger("stopzeitm", 30);                        
                        $this->RegisterTimer("ReadKostalPiko", 0, 'KP_RequestInfo($_IPS[\'TARGET\']);');
                        $this->RegisterEvent("IsDay", "ReadKostalPiko", 1);
			
		}
                
                public function Destroy()
                {
                        $this->UnregisterTimer("ReadKostalPiko");
                        $this->UnregisterTimer("IsDay")
        
                        //Never delete this line!
                        parent::Destroy();
                }
	
		public function ApplyChanges()
		{
			//Never delete this line!
			parent::ApplyChanges();
			
			$this->RegisterVariableFloat("ACLeistungAktuell", "AC Leistung Aktuell", "~Watt.3680");
			$this->RegisterVariableString("ACLeistungStatus", "AC Leistung Status", "~String");
			$this->RegisterVariableFloat("Gesamtertrag", "Gesamtertrag", "~Electricity");
                        $this->RegisterVariableFloat("Tagesertrag", "Tagesertrag", "~Electricity");			
                        $this->RegisterVariableFloat("SpannungString1", "Spannung String 1", "~Volt");
                        $this->RegisterVariableFloat("L1Spannung", "L1 Spannung", "~Volt");
                        $this->RegisterVariableFloat("StromString1", "Strom String 1", "~Ampere");
                        $this->RegisterVariableFloat("L1Leistung", "L1 Leistung", "~Watt.3680");
                        $this->RegisterVariableFloat("SpannungString2", "Spannung String 2", "~Volt");
                        $this->RegisterVariableFloat("L2Spannung", "L2 Spannung", "~Volt");
                        $this->RegisterVariableFloat("StromString2", "Strom String 2", "~Ampere");
                        $this->RegisterVariableFloat("L2Leistung", "L2 Leistung", "~Watt.3680");
                        $this->RegisterVariableFloat("SpannungString3", "Spannung String 3", "~Volt");
                        $this->RegisterVariableFloat("L3Spannung", "L3 Spannung", "~Volt");
                        $this->RegisterVariableFloat("StromString3", "Strom String 3", "~Ampere");
                        $this->RegisterVariableFloat("L3Leistung", "L3 Leistung", "~Watt.3680");
                        $this->RequestInfo();
                        $this->SetTimerInterval("ReadKostalPiko", $this->ReadPropertyInteger("Intervall"));
                        $this->SetTimerIntervalTime("ReadKostalPiko", $this->ReadPropertyInteger("startzeith"), $this->ReadPropertyInteger("startzeitm"), $this->ReadPropertyInteger("stopzeith"), $this->ReadPropertyInteger("stopzeitm"));
                        $this->RegisterEvent("IsDay", "ReadKostalPiko", $this->ReadPropertyBoolean("IsDay"));
                        
		}
	
		/**
		* This function will be available automatically after the module is imported with the module control.
		* Using the custom prefix this function will be callable from PHP and JSON-RPC through:
		*
		* KP_RequestInfo($id);
		*
		*/
		public function RequestInfo()
		{
		
			
			$url = $this->ReadPropertyString("url");
			$Ausgabe = file_get_contents("$url", "r");
			
                        //AC-Leistung_Aktuell

                        $pos1 = strpos($Ausgabe,"aktuell</td>");
                        $pos2 = strpos($Ausgabe,"</td>",$pos1+20);
                        $data = substr($Ausgabe,($pos1+65),$pos2-$pos1-65);
                        $data1 = (float) $data;	
			SetValue($this->GetIDForIdent("ACLeistungAktuell"), $data1);
                        
                        //AC_Leistung_Status

                        $pos1 = strpos($Ausgabe,"Status</td>");
                        $pos2 = strpos($Ausgabe,"</td>",$pos1+20);
                        $data = substr($Ausgabe,($pos1+33),$pos2-$pos1-33);
			SetValue($this->GetIDForIdent("ACLeistungStatus"), $data);
                        
                        //Energie_Gesamtertrag

                        $pos1 = strpos($Ausgabe,"Gesamtenergie</td>");
                        $pos2 = strpos($Ausgabe,"</td>",$pos1+30);
                        $data = substr($Ausgabe,($pos1+70),$pos2-$pos1-70);
                        $data1 = (float) $data;
                        SetValue($this->GetIDForIdent("Gesamtertrag"), $data1);
                        
                        //Energie_Tagesertrag_Aktuell

                        $pos1 = strpos($Ausgabe,"Tagesenergie</td>");
                        $pos2 = strpos($Ausgabe,"</td>",$pos1+20);
                        $data = substr($Ausgabe,($pos1+70),$pos2-$pos1-70);
                        $data1 = (float) $data;
                        SetValue($this->GetIDForIdent("Tagesertrag"), $data1);
                        
                        //PV_Generator_String1_Spannung

                        $pos1 = strpos($Ausgabe,"Spannung</td>",$pos2);
                        $pos2 = strpos($Ausgabe,"</td>",$pos1+20);
                        $data = substr($Ausgabe,($pos1+66),$pos2-$pos1-66);
                        $data1 = (float) $data;
                        SetValue($this->GetIDForIdent("SpannungString1"), $data1);
                        
                        //Ausgangsleistung_L1_Spannung

                        $pos1 = strpos($Ausgabe,"Spannung</td>",$pos2);
                        $pos2 = strpos($Ausgabe,"</td>",$pos1+20);
                        $data = substr($Ausgabe,($pos1+66),$pos2-$pos1-66);
                        $data1 = (float) $data;
                        SetValue($this->GetIDForIdent("L1Spannung"), $data1);
                              
                        //PV_Generator_String1_Strom

                        $pos1 = strpos($Ausgabe,"Strom</td>",$pos2);
                        $pos2 = strpos($Ausgabe,"</td>",$pos1+20);
                        $data = substr($Ausgabe,($pos1+63),$pos2-$pos1-63);
                        $data1 = (float) $data;
                        SetValue($this->GetIDForIdent("StromString1"), $data1);
                        
                        //Ausgangsleistung_L1_Leistung

                        $pos1 = strpos($Ausgabe,"Leistung</td>",$pos2);
                        $pos2 = strpos($Ausgabe,"</td>",$pos1+20);
                        $data = substr($Ausgabe,($pos1+66),$pos2-$pos1-66);
                        $data1 = (float) $data;
                        SetValue($this->GetIDForIdent("L1Leistung"), $data1);
                        
                        //PV_Generator_String2_Spannung

                        $pos1 = strpos($Ausgabe,"Spannung</td>",$pos2);
                        $pos2 = strpos($Ausgabe,"</td>",$pos1+20);
                        $data = substr($Ausgabe,($pos1+66),$pos2-$pos1-66);
                        $data1 = (float) $data;
                        SetValue($this->GetIDForIdent("SpannungString2"), $data1);
                        
                        //Ausgangsleistung_L2_Spannung

                        $pos1 = strpos($Ausgabe,"Spannung</td>",$pos2);
                        $pos2 = strpos($Ausgabe,"</td>",$pos1+20);
                        $data = substr($Ausgabe,($pos1+66),$pos2-$pos1-66);
                        $data1 = (float) $data;
                        SetValue($this->GetIDForIdent("L2Spannung"), $data1);
                        
                        //PV_Generator_String2_Strom

                        $pos1 = strpos($Ausgabe,"Strom</td>",$pos2);
                        $pos2 = strpos($Ausgabe,"</td>",$pos1+20);
                        $data = substr($Ausgabe,($pos1+63),$pos2-$pos1-63);
                        $data1 = (float) $data;
                        SetValue($this->GetIDForIdent("StromString2"), $data1);
                        
                        //Ausgangsleistung_L2_Leistung

                        $pos1 = strpos($Ausgabe,"Leistung</td>",$pos2);
                        $pos2 = strpos($Ausgabe,"</td>",$pos1+20);
                        $data = substr($Ausgabe,($pos1+66),$pos2-$pos1-66);
                        $data1 = (float) $data;
                        SetValue($this->GetIDForIdent("L2Leistung"), $data1);
                        
                        //PV_Generator_String3_Spannung

                        $pos1 = strpos($Ausgabe,"Spannung</td>",$pos2);
                        $pos2 = strpos($Ausgabe,"</td>",$pos1+20);
                        $data = substr($Ausgabe,($pos1+66),$pos2-$pos1-66);
                        $data1 = (float) $data;
                        SetValue($this->GetIDForIdent("SpannungString3"), $data1);
                        
                        //Ausgangsleistung_L3_Spannung

                        $pos1 = strpos($Ausgabe,"Spannung</td>",$pos2);
                        $pos2 = strpos($Ausgabe,"</td>",$pos1+20);
                        $data = substr($Ausgabe,($pos1+66),$pos2-$pos1-66);
                        $data1 = (float) $data;
                        SetValue($this->GetIDForIdent("L3Spannung"), $data1);
                        
                        //PV_Generator_String3_Strom

                        $pos1 = strpos($Ausgabe,"Strom</td>",$pos2);
                        $pos2 = strpos($Ausgabe,"</td>",$pos1+20);
                        $data = substr($Ausgabe,($pos1+63),$pos2-$pos1-63);
                        $data1 = (float) $data;
                        SetValue($this->GetIDForIdent("StromString3"), $data1);
                        
                        //Ausgangsleistung_L3_Leistung

                        $pos1 = strpos($Ausgabe,"Leistung</td>",$pos2);
                        $pos2 = strpos($Ausgabe,"</td>",$pos1+20);
                        $data = substr($Ausgabe,($pos1+66),$pos2-$pos1-66);
                        $data1 = (float) $data;
                        SetValue($this->GetIDForIdent("L3Leistung"), $data1);                       
                }
                
protected function RegisterTimer($Name, $Interval, $Script)
    {
        $id = @IPS_GetObjectIDByIdent($Name, $this->InstanceID);
        if ($id === false)
            $id = 0;
        if ($id > 0)
        {
            if (!IPS_EventExists($id))
                throw new Exception("Ident with name " . $Name . " is used for wrong object type", E_USER_WARNING);
            if (IPS_GetEvent($id)['EventType'] <> 1)
            {
                IPS_DeleteEvent($id);
                $id = 0;
            }
        }
        if ($id == 0)
        {
            $id = IPS_CreateEvent(1);
            IPS_SetParent($id, $this->InstanceID);
            IPS_SetIdent($id, $Name);
        }
        IPS_SetName($id, $Name);
        IPS_SetHidden($id, true);
        IPS_SetEventScript($id, $Script);
        if ($Interval > 0)
        {
            IPS_SetEventCyclic($id, 0, 0, 0, 1, 1, $Interval);
            IPS_SetEventActive($id, true);
        } else
        {
            IPS_SetEventCyclic($id, 0, 0, 0, 1, 1, 1);
            IPS_SetEventActive($id, false);
        }
    }
    
    protected function UnregisterTimer($Name)
    {
        $id = @IPS_GetObjectIDByIdent($Name, $this->InstanceID);
        if ($id > 0)
        {
            if (!IPS_EventExists($id))
                throw new Exception('Timer not present', E_USER_NOTICE);
            IPS_DeleteEvent($id);
        }
    }
    
    protected function SetTimerInterval($Name, $Interval)
    {
        $id = @IPS_GetObjectIDByIdent($Name, $this->InstanceID);
        if ($id === false)
            throw new Exception('Timer not present', E_USER_WARNING);
        if (!IPS_EventExists($id))
            throw new Exception('Timer not present', E_USER_WARNING);
        $Event = IPS_GetEvent($id);
        if ($Interval < 1)
        {
            if ($Event['EventActive'])
                IPS_SetEventActive($id, false);
        }
        else
        {
            if ($Event['CyclicTimeValue'] <> $Interval)
                IPS_SetEventCyclic($id, 0, 0, 0, 1, 1, $Interval);
            if (!$Event['EventActive'])
                IPS_SetEventActive($id, true);
        }
    }
    
    protected function SetTimerIntervalTime($Name, $startzeith, $startzeitm, $stopzeith, $stopzeitm)
    {
        $id = @IPS_GetObjectIDByIdent($Name, $this->InstanceID);
        if ($id === false)
            throw new Exception('Timer not present', E_USER_WARNING);
        if (!IPS_EventExists($id))
            throw new Exception('Timer not present', E_USER_WARNING);
        $Event = IPS_GetEvent($id);
        if ($startzeith > 23)
            {
                if ($Event['EventActive'])
                    IPS_SetEventActive($id, false);
            }
        else
            {
                IPS_SetEventCyclicTimeFrom($id, $startzeith, $startzeitm, 0);
                IPS_SetEventCyclicTimeTo($id, $stopzeith, $stopzeitm, 0);
            }
    }
    
    protected function RegisterEvent($Name, $ParentName, $IsDay)
    {
        $Parent = IPS_GetObjectIDByIdent($ParentName, $this->InstanceID);
        $id = @IPS_GetObjectIDByIdent($Name, $Parent);
        if ($id === false)
            $id = 0;
        if ($id > 0)
        {
            if (!IPS_EventExists($id))
                throw new Exception("Ident with name " . $Name . " is used for wrong object type", E_USER_WARNING);
            if (IPS_GetEvent($id)['EventType'] <> 0)
            {
                IPS_DeleteEvent($id);
                $id = 0;
            }
        }
        if ($id == 0)
        {
            $id = IPS_CreateEvent(0);
            IPS_SetIdent($id, $Name);            
            IPS_SetParent($id, $Parent);
        }
        IPS_SetName($id, $Name);
        IPS_SetHidden($id, true);
        if ($IsDay = 1)
        {
            $locationisday = IPS_GetInstanceListByModuleID("{45E97A63-F870-408A-B259-2933F7EABF74}");
            $locationisday = IPS_GetObjectIDByName('Is Day', $locationisday[0]);
            IPS_SetEventTrigger($id, 4, $locationisday);
            IPS_SetEventTriggerValue($id, true);
            IPS_SetEventActive($id, true);            
        } 
        else
        {
            IPS_SetEventActive($id, false);
        }
    }
}
?>