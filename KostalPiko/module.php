<?
	class KostalPiko extends IPSModule
	{
		public function Create()
		{
			//Never delete this line!
			parent::Create();
			
			$this->RegisterPropertyString("url", "http://pvserver:pvwr@192.168.178.60");
			$this->RegisterPropertyString("refresh", "60");
			
		}		
	
		public function ApplyChanges()
		{
			//Never delete this line!
			parent::ApplyChanges();
			
			$this->RegisterVariableFloat("ACLeistungAktuell", "AC Leistung Aktuell", "~UnixTimestamp");
			$this->RegisterVariableString("ACLeistungStatus", "AC Leistung Status", "~UnixTimestamp");
			$this->RegisterVariableFloat("Gesamtertrag", "Gesamtertrag", "~UnixTimestamp");
                        $this->RegisterVariableFloat("Tagesertrag", "Tagesertrag", "~UnixTimestamp");
                        $this->RegisterVariableFloat("SpannungString1", "Spannung String 1", "~UnixTimestamp");
                        $this->RegisterVariableFloat("L1Spannung", "L1 Spannung", "~UnixTimestamp");
                        $this->RegisterVariableFloat("StromString1", "Strom String 1", "~UnixTimestamp");
                        $this->RegisterVariableFloat("L1Leistung", "L1 Leistung", "~UnixTimestamp");
                        $this->RegisterVariableFloat("SpannungString2", "Spannung String 2", "~UnixTimestamp");
                        $this->RegisterVariableFloat("L2Spannung", "L2 Spannung", "~UnixTimestamp");
                        $this->RegisterVariableFloat("StromString2", "Strom String 2", "~UnixTimestamp");
                        $this->RegisterVariableFloat("L2Leistung", "L2 Leistung", "~UnixTimestamp");
                        $this->RegisterVariableFloat("SpannungString3", "Spannung String 3", "~UnixTimestamp");
                        $this->RegisterVariableFloat("L3Spannung", "L3 Spannung", "~UnixTimestamp");
                        $this->RegisterVariableFloat("StromString3", "Strom String 3", "~UnixTimestamp");
                        $this->RegisterVariableFloat("L3Leistung", "L3 Leistung", "~UnixTimestamp");                      
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
			$refresh = $this->ReadPropertyString("refresh");
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
                        
                        
                                        
                }   	
	
	}
?>