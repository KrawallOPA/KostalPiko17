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
			
			$this->RegisterVariableFloat("ACLeistungAktuell", "AC Leistung Aktuell", "~Watt.3680");
			$this->RegisterVariableString("ACLeistungStatus", "AC Leistung Status", "~String");
			$this->RegisterVariableFloat("Gesamtertrag", "Gesamtertrag", "~Electricity");
                        $this->RegisterVariableFloat("Tagesertrag", "Tagesertrag", "~Electricity");			
                        $this->RegisterVariableFloat("SpannungString1", "Spannung String 1", "~Volt");
                        $this->RegisterVariableFloat("L1Spannung", "L1 Spannung", "~UnixTimestamp");
                        $this->RegisterVariableFloat("StromString1", "Strom String 1", "~Ampere");
                        $this->RegisterVariableFloat("L1Leistung", "L1 Leistung", "~Watt.3680");
                        $this->RegisterVariableFloat("SpannungString2", "Spannung String 2", "~Volt");
                        $this->RegisterVariableFloat("L2Spannung", "L2 Spannung", "~UnixTimestamp");
                        $this->RegisterVariableFloat("StromString2", "Strom String 2", "~Ampere");
                        $this->RegisterVariableFloat("L2Leistung", "L2 Leistung", "~Watt.3680");
                        $this->RegisterVariableFloat("SpannungString3", "Spannung String 3", "~Volt");
                        $this->RegisterVariableFloat("L3Spannung", "L3 Spannung", "~Volt");
                        $this->RegisterVariableFloat("StromString3", "Strom String 3", "~Ampere");
                        $this->RegisterVariableFloat("L3Leistung", "L3 Leistung", "~Watt.3680");                      
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
	
	}
?>