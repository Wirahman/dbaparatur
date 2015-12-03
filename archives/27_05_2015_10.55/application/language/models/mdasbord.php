<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class mdasbord extends CI_Model {

        public function __construct() {
            parent::__construct();
        }
    
        function index() {
            
        }
    	//untuk chart line
        //daily
        function dasborddata($month){
	   //yyyy-mm-dd
           // $month='2012-07';

        $sql = "SELECT SUBSTR(log_time,9,2) AS tgl, sum(sum_volume) AS volume FROM data_daily
        WHERE SUBSTR(log_time,1,7)='$month' group by log_time ORDER BY log_time";
		
        return $this->db->query($sql)->result();
    
        }
        //hourly
        function monthly($year)
        {
        	           $sql = "SELECT log_time,sum(sum_volume)as sum_volume FROM data_monthly
        WHERE substr(log_time,1,4)='$year' group by log_time order by log_time";
		
        return $this->db->query($sql)->result();
         }

        
        //yearly
        function yearly($begin, $end) {
        //$res = $this->db->query("SELECT Timestamp,OperatingDifference,Temperature,Pressure FROM data_hourly_sync Limit 10");
        //return $res;
		
        $sql = "SELECT * FROM data_yearly
        WHERE log_time between $begin AND $end group by log_time order by log_time";
		
        return $this->db->query($sql)->result();
        }
        //hourly
        function hourly($day)
        {
            $sql = "SELECT Timestamp,sum(OperatingDifference)as OperatingDifference FROM data_hourly_sync WHERE substr(Timestamp,1,10)='$day' group by Timestamp order by Timestamp ";
		
        return $this->db->query($sql)->result();
            
        }

//untuk table line
  public function clientdaily($bulan, $guid) {
        $data = $this->db->query("SELECT log_time,sum_volume,sum_temperature,sum_pressure FROM data_daily
		WHERE SUBSTR(log_time,1,7)='$month' ORDER BY log_time");
        return $data->result();
    }

	function dasborddata_sbuhourly($hari,$sbu) {
        $sql = "SELECT b.Guid,sum(a.OperatingAmount) AS volume,a.Timestamp as tgl FROM data_hourly_sync a JOIN customers b ON a.Guid=b.guid  WHERE substr(Timestamp,1,10)='$hari' AND SUBSTR(b.ConsumerId,2,1) = '$sbu' GROUP BY a.Timestamp";
       
        return $this->db->query($sql)->result();

    }
    //sbu daily
    function dasborddata_sbudaily($bulan,$sbu) {
        $sql = "SELECT b.Guid,sum(a.sum_volume) AS volume,substr(a.log_time,9,2) as tgl 
        FROM data_daily a JOIN customers b ON a.guid=b.guid 
        WHERE SUBSTR(log_time,1,7)='$bulan' AND SUBSTR(b.ConsumerId,2,1) = '$sbu' GROUP BY a.sum_volume";
       
        return $this->db->query($sql)->result();
    }
    
    function dasborddata_sbumonthly($tahun,$sbu) {
       $sql = "SELECT b.Guid,sum(a.sum_volume) AS volume,substr(`log_time`,1,6) as tgl FROM data_monthly a JOIN customers b ON a.guid=b.guid where  substr(log_time,1,4)='$tahun' AND SUBSTR(b.ConsumerId,2,1) ='$sbu' GROUP BY a.log_time ";
     
        return $this->db->query($sql)->result();

    }
    function dasborddata_sbuyearly($sbu) {
    	 $al = date('Y') - 10;
	     $ar = date('Y');
         $sql = "SELECT b.Guid,sum(a.`sum_volume`) AS volume,substr(`log_time`,1,4) as tgl FROM data_yearly a JOIN customers b ON a.guid=b.guid where log_time between $al AND $ar AND SUBSTR(b.ConsumerId,2,1) = '$sbu' GROUP BY a.log_time ";
         //echo"$sql";
		 return $this->db->query($sql)->result();

    }
    //chart line area
    function linearea_hourly($hari,$sbu,$kota)
    {
    	$sql = "SELECT b.Guid,b.City as nm_kota,sum(a.OperatingAmount) AS volume,substr(Timestamp,11,3) as tgl 
		FROM data_hourly_sync a JOIN customers b ON a.Guid=b.guid where SUBSTR(b.ConsumerId,1,2)='$sbu' AND SUBSTR(b.ConsumerId,1,3)='$kota' AND substr(Timestamp,1,10)='$hari' group by a.Timestamp";
	
	  return $this->db->query($sql)->result();

    }
    function linearea_daily($hari,$sbu,$kota)
    {
    	$sql = "SELECT b.Guid,a.sum_volume AS volume,substr(a.log_time,9,2) as tgl 
		FROM data_daily a JOIN customers b ON a.guid=b.guid WHERE SUBSTR(log_time,1,7)='$hari' AND SUBSTR(b.ConsumerId,1,3)='$kota' AND SUBSTR(b.ConsumerId,1,2)='$sbu' group by a.log_time";
        
		return $this->db->query($sql)->result();
    }
     function linearea_monthly($tahun,$sbu,$kota) {
       $sql = "SELECT b.Guid,a.`sum_volume` AS volume,substr(`log_time`,1,6) as tgl 
	   FROM data_monthly a JOIN customers b ON a.guid=b.guid where substr(log_time,1,4)='$tahun' AND SUBSTR(b.ConsumerId,1,3) = '$kota' AND SUBSTR(b.ConsumerId,1,2) ='$sbu' group by a.log_time";
      
        return $this->db->query($sql)->result();

    }
function linearea_yearly($sbu,$kota) {
    	 $al = date('Y') - 10;
	     $ar = date('Y');
         $sql = "SELECT b.Guid,sum(a.`sum_volume`) AS volume,substr(`log_time`,1,4) as tgl 
		 FROM data_yearly a JOIN customers b ON a.guid=b.guid where log_time between $al AND $ar AND SUBSTR(b.ConsumerId,1,3) = '$kota' AND SUBSTR(b.ConsumerId,1,2) = '$sbu' group by a.log_time ";
        
		  return $this->db->query($sql)->result();

    }
	
	public function get_pie_per_sbu() {
		$res = $this->db->query("SELECT s.nama as nama_sbu, k.nama as nama_kota FROM customers c, r_kota k, r_sbu s
			WHERE SUBSTR(ConsumerId,1,3)=k.kode AND k.sbu=s.kode");
		$arr = array();
		$out = '';
		$total = $res->num_rows();
		foreach ($res->result() as $row) {
			if (isset($arr[$row->nama_sbu][$row->nama_kota]))
				$arr[$row->nama_sbu][$row->nama_kota]++;
			else
				$arr[$row->nama_sbu][$row->nama_kota] = 1;
		}

        function dasborddata_sbudaily($sbu)
        {
            $sql  = "SELECT b.Guid,a.sum_volume AS volume,substr(a.log_time,9,2) as tgl FROM data_daily a JOIN customers b ON a.guid=b.guid WHERE SUBSTR(b.ConsumerId,2,1) = '$sbu'";
       // echo $sql;
       return $this->db->query($sql)->result();
        }

		//print_r($arr);
		/*
		contoh:
		Array
		(
			[SBU II] => Array
				(
					[Pasuruan] => 272
					[Sidoarjo] => 148
					[Surabaya] => 296
				)

			[SBU III] => Array
				(
					[Medan] => 102
				)

			[SBU I] => Array
				(
					[Jakarta] => 380
					[Bogor] => 342
					[Tangerang] => 434
					[Cilegon] => 44
					[Bekasi] => 272
					[Karawang] => 146
					[Cirebon] => 56
					[Palembang] => 8
				)

		)
		*/
		foreach ($arr as $nama_sbu=>$array) {
			foreach ($array as $nama_kota=>$num) {
				$out .= "$nama_sbu ".ucwords($nama_kota)."\t".($num*100/$total)."%\n";
			}
		}
		// $out = "SBU I aa\t1%\n";
		// $out .= "SBU I bb\t2%\n";
		// $out .= "SBU II cc\t3%\n";
		return $out;

	}
	
	public function get_top_customer($limit) {
		$res = $this->db->query("
		SELECT c.Name as Guid, SUM(dh.OperatingDifference) AS sum_volume
		FROM data_hourly_sync dh 
		join customers c on dh.Guid=c.Guid
		WHERE Timestamp>=(SUBDATE((SELECT MAX(Last) FROM last_timestamp),1))
		GROUP BY c.Guid
		ORDER BY SUM(dh.OperatingDifference) DESC
		LIMIT 0, $limit
		");
		$customers = array();
		$values = array();
		foreach ($res->result() as $row) {
			$customers[] = $row->Guid;
			$values[] = floatval($row->sum_volume);
		}
		return array(
			'customers' => $customers,
			'values' => $values
		);
	}

	public function get_top_customer_sbu($limit,$sbu) {
	    $sql = "SELECT c.Name as Guid, SUM(dh.OperatingDifference) AS sum_volume
		FROM data_hourly_sync dh 
		join customers c on dh.Guid=c.Guid
		WHERE SUBSTR(c.ConsumerId,2,1) = '$sbu' and dh.Timestamp>=(SUBDATE((SELECT MAX(Last) FROM last_timestamp),1))
		GROUP BY c.Guid
		ORDER BY SUM(dh.OperatingDifference) DESC
		LIMIT 0, $limit";
        
		$res = $this->db->query($sql);
		$customers = array();
		$values = array();
		foreach ($res->result() as $row) {
			$customers[] = $row->Guid;
			$values[] = floatval($row->sum_volume);
		}
		return array(
			'customers' => $customers,
			'values' => $values
		);
	}
    
	//ticker untuk 10 pelanggan teratas
function get_customers($limit)
{
    $sql = "SELECT c.Name AS Guid, 
	SUM(dh.OperatingDifference) AS sum_volume 
	FROM data_daily_sync dh 
	JOIN customers c ON dh.Guid=c.Guid 
	WHERE TIMESTAMP>=(SUBDATE((SELECT MAX(LAST) FROM last_timestamp),1)) 
	GROUP BY c.Guid ORDER BY SUM(dh.OperatingDifference) DESC LIMIT 0, $limit";
	$res = $this->db->query($sql);
	return $res;
}
	
	public function get_bottom_customer($limit) {
		$res = $this->db->query("
		SELECT Guid, SUM(OperatingDifference) AS sum_volume
		FROM data_hourly_sync WHERE Timestamp>=(SUBDATE((SELECT MAX(Last) FROM last_timestamp),1))
		GROUP BY Guid
		ORDER BY SUM(OperatingDifference) ASC
		");
		return $res;
	}

	public function get_bottom_customer_sbu($limit,$sbu) {
	    $sql = "SELECT a.Guid, SUM(a.OperatingDifference) AS sum_volume
		FROM data_hourly a,customers b WHERE a.guid=b.Guid and SUBSTR(b.ConsumerId,2,1) = '$sbu' and a.Timestamp>=(SUBDATE((SELECT MAX(Last) FROM last_timestamp),1))
		GROUP BY Guid
		ORDER BY SUM(OperatingDifference) ASC";
        //echo $sql;
		$res = $this->db->query($sql);
		return $res;
	}
    
//pemakaian terbanyak per area dari tanggal 1
	public function get_top_area($limit)
	{
		$Y=date('Y');
		$M=date('m');
		$D=date('d')-1;
		$date_akhir="$Y-$M-$D";
		$date_awal ="$Y-$M-1";
		
	$res = $this->db->query("
		SELECT c.nama, SUBSTR(b.ConsumerId,1,2)as nm_sbu ,SUM(a.sum_volume)/1000 AS vol,
		(SUBSTR(b.ConsumerId,1,3)) as id_kota FROM data_daily a	JOIN customers b ON a.guid=b.guid JOIN r_kota c ON SUBSTR(b.ConsumerId,1,3)=c.kode WHERE 
		a.log_time between '$date_awal' AND '$date_akhir' AND SUBSTR(b.ConsumerId,1,2) = '01' GROUP BY SUBSTR(b.ConsumerId,1,3) ORDER BY c.nama Limit 10");
		return $res;	

	}

	public function get_top_sbu($limit)
	{
		$Y=date('Y');
		$M=date('m');
		$D=date('d')-1;
		$date="$Y-$M-$D";
	/*$res = $this->db->query("
		SELECT c.nama, SUBSTR(b.ConsumerId,2,1)as id_sbu ,SUM(a.sum_volume)/1000 AS vol,
		(SUBSTR(b.ConsumerId,1,3)) as id_kota FROM data_daily a	JOIN customers b ON a.guid=b.guid JOIN r_kota c ON SUBSTR(b.ConsumerId,1,3)=c.kode WHERE 
		SUBDATE(Now(),1) AND SUBSTR(b.ConsumerId,2,1) = '1' GROUP BY SUBSTR(b.ConsumerId,1,3) ORDER BY c.nama Limit 10");
		return $res;	
*/
		$res = $this->db->query("
		SELECT c.nama, SUBSTR(b.ConsumerId,2,1)as id_sbu ,SUM(a.sum_volume)/1000 AS vol,
		(SUBSTR(b.ConsumerId,1,3)) as id_kota FROM data_daily a	JOIN customers b ON a.guid=b.guid JOIN r_kota c ON SUBSTR(b.ConsumerId,1,3)=c.kode WHERE 
		a.log_time=$date AND SUBSTR(b.ConsumerId,2,1) = '1' GROUP BY SUBSTR(b.ConsumerId,1,3) ORDER BY c.nama Limit 10");
		return $res;	
	}

	
	//by irvan	
	function sum_daily($date){
		$sql  = "select sum(sum_volume) as value from data_daily where log_time = '$date'";
		//echo $sql;
		return $this->db->query($sql)->row();
	}

	function sum_daily_sbu($date,$sbu){
		$sql  = "select sum(a.sum_volume) as value from data_daily a,customers b where a.guid=B.Guid and SUBSTR(b.ConsumerId,2,1) = '$sbu' and a.log_time = '$date'";
		//echo $sql;
		return $this->db->query($sql)->row();
	}
    
	function sbu($date,$sbu){
		$sql  = "SELECT SUM(a.sum_volume) AS value,SUBSTR(b.ConsumerId,2,1)as id_sbu FROM data_daily a JOIN customers b ON a.guid=b.guid WHERE SUBSTR(b.ConsumerId,2,1) = '$sbu' and a.log_time = '$date'";
       
	   return $this->db->query($sql)->row();
	}
    
    function get_volume_by_area($sbu){
        $logtime  = "SELECT MAX(log_time) AS log_time FROM data_daily";
        $row      = $this->db->query($logtime)->row();
        $log_time = $row->log_time;
        
        $sbu = '0'.$sbu;
        
        if ($sbu == '0') {
            $sbunya = "";
        } else {
            $sbunya = "AND SUBSTR(b.ConsumerId,1,2) = '$sbu'";
        }
        $sql = "SELECT c.nama, SUBSTR(b.ConsumerId,1,2)as nm_sbu ,SUM(a.sum_volume)/1000 AS vol,(SUBSTR(b.ConsumerId,1,3)) as id_kota
				FROM data_daily a 
                JOIN customers b ON a.guid=b.guid 
                JOIN r_kota c ON SUBSTR(b.ConsumerId,1,3)=c.kode
                WHERE a.log_time='$log_time' $sbunya GROUP BY SUBSTR(b.ConsumerId,1,3)
				ORDER BY c.nama";
        //die($sql);
				
    	return $this->db->query($sql);
    }
    
    function not_sent_sbu($sbu){
        $sql = "SELECT COUNT(a.Guid) AS total_not_send  
                FROM data_daily_sync a 
                JOIN customers b ON a.Guid=b.Guid
                WHERE SUBSTR(b.ConsumerId,2,1) = '$sbu' and a.is_sent = '0';";
        $row = $this->db->query($sql)->row(); 
        
        return $row->total_not_send;
    }

    function not_sent_bysbu($sbu){
        $sql = "SELECT COUNT(a.Guid) AS total_not_send  
                FROM data_daily_sync a 
                JOIN customers b ON a.Guid=b.Guid
                WHERE SUBSTR(b.ConsumerId,2,1) = '$sbu' and a.is_sent = '0';";
        $row = $this->db->query($sql)->row(); 
        
        return $row->total_not_send;
    }
    
    function not_valid_sbu($sbu){
        $sql = "SELECT COUNT(a.Guid) AS total_not_valid  
                FROM data_daily_sync a 
                JOIN customers b ON a.Guid=b.Guid
                WHERE SUBSTR(b.ConsumerId,2,1) = '1$sbu' and a.is_valid = '0';";
        $row = $this->db->query($sql)->row(); 
        
        return $row->total_not_valid;
    }
}

?>