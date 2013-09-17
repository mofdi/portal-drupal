<?php
/**
*
* @defgroup  Cron
* @ingroup GBIF
*
* Attempt to keep the FileMaker related 
* functions separate from the main module 
*
*/


/**
*
* Break apart each of the data migration tasks 
*
*/
function _gbifims_doContact() {
	
		db_query('TRUNCATE {gbifims_Contact}');
	
		$resultSetError = FALSE;

		$FMAccess = new db ;

		$FMFindCMD = $FMAccess->newFindCommand( '__Contact' );
		$FMFindCMD->addFindCriterion( '', '');		

		$FMResult = $FMFindCMD->execute();

		if ( FileMaker::isError( $FMResult ) ) {
			$resultSetError = TRUE ;
			$resultSetErrorMessage = $FMResult->getMessage() ;
			$resultSetErrorCode = $FMResult->code ;
			drupal_set_message('FileMaker Error:'.$resultSetErrorMessage);
		} else {
			$resultSet = $FMResult->getRecords();
			$resultSetNumRecords = count( $resultSet ) ;		

			gbifims_queue_report_work(1,$item,'Contact:'.$resultSetNumRecords.' records');
			
			$FMResults = array() ;
			foreach ( $resultSet as $key => $record ) {
				$FMResults[] = array ();
				$tmp = '' ; 
				$FMResults[$key]['ContactID'] = $record->getField('__kp_ID') ;
				
				$tmp = $record->getField('_kf_CountryID_Address') ;
				$FMResults[$key]['CountryID_Address'] = (empty($tmp)) ? NULL : (int)$tmp ;
				
				$tmp = $record->getField('_kf_InstitutionID') ; 
				$FMResults[$key]['InstitutionID'] = (empty($tmp)) ? NULL : (int)$tmp ; 
				
				$FMResults[$key]['Name_First'] = $record->getField('Name_First') ;
				$FMResults[$key]['Name_Middle'] = $record->getField('Name_Middle') ;
				$FMResults[$key]['Name_Last'] =  $record->getField('Name_Last') ;
				
				$tmp = $record->getField('Address') ; 
				$FMResults[$key]['Address'] = (empty($tmp)) ? NULL : $tmp ; 
				
				$tmp = $record->getField('City') ; 
				$FMResults[$key]['City'] = (empty($tmp)) ? NULL : $tmp ; 
				
				$tmp = $record->getField('Email') ; 
				$FMResults[$key]['Email'] = (empty($tmp)) ? NULL : $tmp ; 
				
				$tmp = $record->getField('Fax') ; 
				$FMResults[$key]['Fax'] = (empty($tmp)) ? NULL : $tmp ; 
				
				$tmp = $record->getField('OnTheWeb') ; 
				$FMResults[$key]['OnTheWeb'] = (empty($tmp)) ? NULL : (int)$tmp ;
				
				$tmp = $record->getField('Job_Position') ; 
				$FMResults[$key]['Job_Position'] = (empty($tmp)) ? NULL : $tmp ; 
				
				$tmp = $record->getField('Phone_Office') ; 
				$FMResults[$key]['Phone_Office'] = (empty($tmp)) ? NULL : $tmp ; 
				
				$tmp = $record->getField('ZipCode') ; 
				$FMResults[$key]['ZipCode'] = (empty($tmp)) ? NULL : $tmp ; 
				
				$tmp = $record->getField('GBIF_Order') ;
				$FMResults[$key]['GBIF_Order'] = (empty($tmp)) ? NULL : (int)$tmp ;

				$tmp = 	$record->getField('GBIF_Staff') ;
				$FMResults[$key]['GBIF_Staff'] = (empty($tmp)) ? NULL : (int)$tmp ;
				
				$FMResults[$key]['Email'] = $record->getField('Email') ;
				$FMResults[$key]['zz__PEOP_SuperContainer_IMGURL__lct'] = $record->getField('zz__PEOP_SuperContainer_IMGURL__lct') ;
			}
			
			foreach ($FMResults as $values) 
				$mytmp = db_insert('gbifims_Contact') 
							->fields( $values )
							->execute();
			
		}
}



function _gbifims_ContactGrouproleNodeParticipant() {
	
		db_query('TRUNCATE {gbifims_ContactGrouproleNodeParticipant}');
	
		$resultSetError = FALSE;

		$FMAccess = new db ;

		$FMFindCMD = $FMAccess->newFindCommand( '__ContactGrouproleNodeParticipant' );
		$FMFindCMD->addFindCriterion( '', '');		

		$FMResult = $FMFindCMD->execute();

		if ( FileMaker::isError( $FMResult ) ) {
			$resultSetError = TRUE ;
			$resultSetErrorMessage = $FMResult->getMessage() ;
			$resultSetErrorCode = $FMResult->code ;
			gbifims_queue_report_work(1,$item,'FileMaker Error:'.$resultSetErrorMessage);
		} else {
			$resultSet = $FMResult->getRecords();
			$resultSetNumRecords = count( $resultSet ) ;		

			gbifims_queue_report_work(1,$item,'CGNP:'.$resultSetNumRecords.' records');
			
			$FMResults = array() ;
			foreach ( $resultSet as $key => $record ) {
				$FMResults[] = array ();
				$tmp = '' ;
				
				$FMResults[$key]['ContactGrouproleNodeParticipantID'] = $record->getField('__kp_ID') ;
				
				$tmp = $record->getField('_kf_ContactID') ;
				$FMResults[$key]['ContactID'] = (empty($tmp)) ? NULL : (int)$tmp ;
				
				$tmp = $record->getField('_kf_GrouproleID') ; 
				$FMResults[$key]['GrouproleID'] = (empty($tmp)) ? NULL : (int)$tmp ; 

				$tmp = $record->getField('_kf_NodeID') ;
				$FMResults[$key]['NodeID'] = (empty($tmp)) ? NULL : (int)$tmp ;

				$tmp = 	$record->getField('_kf_ParticipantID') ;
				$FMResults[$key]['ParticipantID'] = (empty($tmp)) ? NULL : (int)$tmp ;
				
				$FMResults[$key]['Active'] = $record->getField('Active') ;

			}
			
			foreach ($FMResults as $values) 
				$mytmp = db_insert('gbifims_ContactGrouproleNodeParticipant') 
							->fields( $values )
							->execute();
			
		}
}


function _gbifims_doGroup() {
	
		db_query('TRUNCATE {gbifims_Group}');
	
		$resultSetError = FALSE;

		$FMAccess = new db ;

		$FMFindCMD = $FMAccess->newFindCommand( '__Group' );
		$FMFindCMD->addFindCriterion( '', '');		

		$FMResult = $FMFindCMD->execute();

		if ( FileMaker::isError( $FMResult ) ) {
			$resultSetError = TRUE ;
			$resultSetErrorMessage = $FMResult->getMessage() ;
			$resultSetErrorCode = $FMResult->code ;
			drupal_set_message('FileMaker Error:'.$resultSetErrorMessage);
		} else {
			$resultSet = $FMResult->getRecords();
			$resultSetNumRecords = count( $resultSet ) ;		

			gbifims_queue_report_work(1,$item,'Group:'.$resultSetNumRecords.' records');
			
			$FMResults = array() ;
			foreach ( $resultSet as $key => $record ) {
				$FMResults[] = array ();
				$tmp = '' ; 
				
				$FMResults[$key]['GroupID'] = $record->getField('__kp_ID') ;
				
				$FMResults[$key]['Name'] = $record->getField('Name') ;
			}
			
			foreach ($FMResults as $values) 
				$mytmp = db_insert('gbifims_Group') 
							->fields( $values )
							->execute();
			
		}
}

function _gbifims_doGrouprole() {
	
		db_query('TRUNCATE {gbifims_Grouprole}');
	
		$resultSetError = FALSE;

		$FMAccess = new db ;

		$FMFindCMD = $FMAccess->newFindCommand( '__Grouprole' );
		$FMFindCMD->addFindCriterion( '', '');		

		$FMResult = $FMFindCMD->execute();

		if ( FileMaker::isError( $FMResult ) ) {
			$resultSetError = TRUE ;
			$resultSetErrorMessage = $FMResult->getMessage() ;
			$resultSetErrorCode = $FMResult->code ;
			drupal_set_message('FileMaker Error:'.$resultSetErrorMessage);
		} else {
			$resultSet = $FMResult->getRecords();
			$resultSetNumRecords = count( $resultSet ) ;		

			gbifims_queue_report_work(1,$item,'Grouprole:'.$resultSetNumRecords.' records');
			
			$FMResults = array() ;
			foreach ( $resultSet as $key => $record ) {
				$FMResults[] = array ();
				$tmp = '';
				
				$FMResults[$key]['GrouproleID'] = $record->getField('__kp_ID') ;
				
				$tmp = $record->getField('_kf_GroupID') ;
				$FMResults[$key]['GroupID'] = (empty($tmp)) ? NULL : (int)$tmp ;
				
				$tmp = $record->getField('Sort_Order__lcn') ;
				$FMResults[$key]['SortOrder'] = (empty($tmp)) ? 0 : (int)$tmp ;

								
				$FMResults[$key]['Name'] = $record->getField('Name') ;
			}
			
			foreach ($FMResults as $values) 
				$mytmp = db_insert('gbifims_Grouprole') 
							->fields( $values )
							->execute();
			
		}
}


function _gbifims_doInstitution() {
	
		db_query('TRUNCATE {gbifims_Institution}');
	
		$resultSetError = FALSE;

		$FMAccess = new db ;

		$FMFindCMD = $FMAccess->newFindCommand( '__Institution' );
		$FMFindCMD->addFindCriterion( '', '');		

		$FMResult = $FMFindCMD->execute();

		if ( FileMaker::isError( $FMResult ) ) {
			$resultSetError = TRUE ;
			$resultSetErrorMessage = $FMResult->getMessage() ;
			$resultSetErrorCode = $FMResult->code ;
			drupal_set_message('FileMaker Error:'.$resultSetErrorMessage);
		} else {
			$resultSet = $FMResult->getRecords();
			$resultSetNumRecords = count( $resultSet ) ;		

			gbifims_queue_report_work(1,$item,'Institution:'.$resultSetNumRecords.' records');
			
			$FMResults = array() ;
			foreach ( $resultSet as $key => $record ) {
				$FMResults[] = array ();
				$tmp = '' ;
				$FMResults[$key]['InstitutionID'] = $record->getField('__kp_ID') ;
				
				$tmp = $record->getField('_kf_CountryID') ;
				$FMResults[$key]['CountryID'] = (empty($tmp)) ? NULL : (int)$tmp ;
				
				$FMResults[$key]['Acronym'] = $record->getField('Acronym') ;
				$FMResults[$key]['Address'] = $record->getField('Address') ;
				$FMResults[$key]['City'] =  $record->getField('City') ;
				$FMResults[$key]['Description'] = $record->getField('Description') ;
				$FMResults[$key]['Email'] = $record->getField('Email') ;
				$FMResults[$key]['Name'] = $record->getField('Name') ;
				$FMResults[$key]['State'] = $record->getField('State') ;
				$FMResults[$key]['Telephone'] = $record->getField('Telephone') ;
				$FMResults[$key]['ZipCode'] = $record->getField('ZipCode') ;
			}
			
			foreach ($FMResults as $values) 
				$mytmp = db_insert('gbifims_Institution') 
							->fields( $values )
							->execute();
			
		}
}



function _gbifims_doCountry() {
	
		db_query('TRUNCATE {gbifims_Country}');
	
		$resultSetError = FALSE;
		$FMAccess = new db ;

		$FMFindCMD = $FMAccess->newFindCommand( '__Country' );
		$FMFindCMD->addFindCriterion( '', '');		

		$FMResult = $FMFindCMD->execute();

		if ( FileMaker::isError( $FMResult ) ) {
			$resultSetError = TRUE ;
			$resultSetErrorMessage = $FMResult->getMessage() ;
			$resultSetErrorCode = $FMResult->code ;
			drupal_set_message('FileMaker Error:'.$resultSetErrorMessage);
		} else {
			$resultSet = $FMResult->getRecords();
			$resultSetNumRecords = count( $resultSet ) ;		

			gbifims_queue_report_work(1,$item,'Country:'.$resultSetNumRecords.' records');
			
			$FMResults = array() ;
			foreach ( $resultSet as $key => $record ) {
				$FMResults[] = array ();
				$tmp = '' ; 
				$FMResults[$key]['CountryID'] = $record->getField('__kp_ID') ;
				
				$tmp = $record->getField('_kf_RegionID') ;
				$FMResults[$key]['RegionID'] = (empty($tmp)) ? NULL : (int)$tmp ;
			
				$FMResults[$key]['ISO2'] = $record->getField('ISO2') ;
				$FMResults[$key]['ISO3'] = $record->getField('ISO3') ;
				$FMResults[$key]['Name'] =  $record->getField('Name') ;
			}
			
			foreach ($FMResults as $values) 
				$mytmp = db_insert('gbifims_Country') 
							->fields( $values )
							->execute();
			
		}
}


/**
*
* Break apart each of the data migration tasks 
*
*/
function _gbifims_doNode() {
	
		db_query('TRUNCATE {gbifims_Node}');
	
		$resultSetError = FALSE;

		$FMAccess = new db ;

		$FMFindCMD = $FMAccess->newFindCommand( '__Node' );
		$FMFindCMD->addFindCriterion( '', '');		

		$FMResult = $FMFindCMD->execute();

		if ( FileMaker::isError( $FMResult ) ) {
			$resultSetError = TRUE ;
			$resultSetErrorMessage = $FMResult->getMessage() ;
			$resultSetErrorCode = $FMResult->code ;
			drupal_set_message('FileMaker Error:'.$resultSetErrorMessage);
		} else {
			$resultSet = $FMResult->getRecords();
			$resultSetNumRecords = count( $resultSet ) ;		

			gbifims_queue_report_work(1,$item,'Node:'.$resultSetNumRecords.' records');
			
			$FMResults = array() ;
			foreach ( $resultSet as $key => $record ) {
				$FMResults[] = array ();
				$tmp = '' ; 
				$FMResults[$key]['NodeID'] = $record->getField('__kp_ID') ;
				
				$tmp = $record->getField('_kf_ParticipantID') ;
				$FMResults[$key]['ParticipantID'] = (empty($tmp)) ? NULL : (int)$tmp ;
			
				$FMResults[$key]['Name_Full'] = $record->getField('Name_Full') ;
				$FMResults[$key]['Name_Acronym'] = $record->getField('Name_Acronym') ;
				$FMResults[$key]['URL'] =  $record->getField('URL') ;
			}
			
			foreach ($FMResults as $values) 
				$mytmp = db_insert('gbifims_Node') 
							->fields( $values )
							->execute();
			
		}
}


function _gbifims_doParticipant() {
	
		db_query('TRUNCATE {gbifims_Participant}');
	
		$resultSetError = FALSE;

		$FMAccess = new db ;

		$FMFindCMD = $FMAccess->newFindCommand( '__Participant' );
		$FMFindCMD->addFindCriterion( '', '');		

		$FMResult = $FMFindCMD->execute();

		if ( FileMaker::isError( $FMResult ) ) {
			$resultSetError = TRUE ;
			$resultSetErrorMessage = $FMResult->getMessage() ;
			$resultSetErrorCode = $FMResult->code ;
			drupal_set_message('FileMaker Error:'.$resultSetErrorMessage);
		} else {
			$resultSet = $FMResult->getRecords();
			$resultSetNumRecords = count( $resultSet ) ;		

			gbifims_queue_report_work(1,$item,'Participant:'.$resultSetNumRecords.' records');
			
			$FMResults = array() ;
			foreach ( $resultSet as $key => $record ) {
				$FMResults[] = array ();
				$tmp = '' ; 
				$FMResults[$key]['ParticipantID'] = $record->getField('__kp_ID') ;
				
				$tmp = $record->getField('_kf_RegionID') ;
				$FMResults[$key]['RegionID'] = (empty($tmp)) ? NULL : (int)$tmp ;
				
				$tmp = $record->getField('_kf_CountryID') ; 
				$FMResults[$key]['CountryID'] = (empty($tmp)) ? NULL : (int)$tmp ; 
				
				$tmp = $record->getField('_kf_InstitutionID') ; 
				$FMResults[$key]['InstitutionID'] = (empty($tmp)) ? NULL : (int)$tmp ; 
				
				$FMResults[$key]['GBIFmembership'] = $record->getField('GBIFmembership') ;
				
				$tmp = $record->getField('Member_AsOf') ; 
				if ( !empty( $tmp ) ) {
					// original field is returned as "April 2001"
					$tmp = '01 '. $tmp . ' 00:00' ;
					$cur_format = 'd F Y H:i';
					$date = DateTime::createFromFormat($cur_format, $tmp);
  					$member_asof = $date->format('Y-m-d h:i') ;
					$FMResults[$key]['Member_AsOf'] = $member_asof ;
				} else {
					$FMResults[$key]['Member_AsOf'] = NULL ;
				}
				
				
				$FMResults[$key]['Name_Full'] = $record->getField('Name_Full') ;
				$FMResults[$key]['Name_Short'] =  $record->getField('Name_Short') ;
				
				$FMResults[$key]['PublicDescription'] = $record->getField('PublicDescription') ; 
				
				$tmp = $record->getField('MOU2012_Date') ;
				if ( !empty( $tmp ) ) {
					// format is (so far...) 'mm/dd/yyyy' so we only patch the time
 					$tmp .= ' 00:00' ;
					$cur_format = 'm/d/Y H:i';
					$date = DateTime::createFromFormat($cur_format, $tmp);
  					$mou2012_date = $date->format('Y-m-d h:i') ;
					$FMResults[$key]['MOU2012_Date'] = $mou2012_date ;
				} else {
					$FMResults[$key]['MOU2012_Date'] = NULL ;
				}
				
				$FMResults[$key]['Host_URL'] = $record->getField('Host_URL') ; 

			}
			
			foreach ($FMResults as $values) 
				$mytmp = db_insert('gbifims_Participant') 
							->fields( $values )
							->execute();
			
		}
}

function _gbifims_get_ParticipantsList( $type ) {
$PList = '' ;

switch ($type) {
	case 'Voting Participant':
		$where = 'gbifims_Participant.GBIFMembership = :ptype';
	case 'Associate Country Participant':
		$where = 'gbifims_Participant.GBIFMembership = :ptype';
	case 'Other Associate Participant':
		$where = 'gbifims_Participant.GBIFMembership = :ptype';
		// explicitelly fall through from all above
		$ptype = array ( ':ptype'=> $type );
		break ;
	case 'All':
		$where = "(gbifims_Participant.GBIFMembership = 'Voting Participant' OR gbifims_Participant.GBIFMembership = 'Associate Country Participant' OR gbifims_Participant.GBIFMembership = 'Other Associate Participant') ";
		$ptype = array ();
}
	
$result = db_query('SELECT gbifims_Participant.Name_Full, gbifims_Contact.Name_First, gbifims_Contact.Name_Last, c2.Name, gbifims_Contact.Name_First, 
					gbifims_Contact.Name_Last, gbifims_Grouprole.Name, gbifims_Contact.Address, gbifims_Contact.Email, gbifims_Contact.City, gbifims_Contact.ZipCode, gbifims_Contact.Phone_Office, gbifims_Contact.Fax
					FROM gbifims_Participant
					LEFT JOIN gbifims_Institution ON gbifims_Participant.InstitutionID = gbifims_Institution.InstitutionID
					LEFT JOIN gbifims_Country ON gbifims_Participant.CountryID = gbifims_Country.CountryID
					LEFT JOIN gbifims_ContactGrouproleNodeParticipant ON gbifims_Participant.ParticipantID = gbifims_ContactGrouproleNodeParticipant.ParticipantID
					LEFT JOIN gbifims_Contact ON gbifims_ContactGrouproleNodeParticipant.ContactID = gbifims_Contact.ContactID
					LEFT JOIN gbifims_Country c2 ON gbifims_Contact.CountryID_Address = c2.CountryID 
					LEFT JOIN gbifims_Grouprole ON gbifims_ContactGrouproleNodeParticipant.GrouproleID = gbifims_Grouprole.GrouproleID
					WHERE '.$where.' AND gbifims_ContactGrouproleNodeParticipant.Active = 1
					ORDER BY gbifims_Participant.Name_Full', $ptype );

$PList = '<table style="" class="table table-bordered table-stripped"><tbody>';

foreach ( $result as $row) {
	$PList .= "<tr><td>
		<div class='contact'>
			<a name='$row->Name_First,$row->Name_Last'></a>
			<div class='contactName'>$row->Name_First $row->Name_Last</div>
			<div style='display: none;'>
				<div class='contactPosition'>$row->Job_Position</div>
				<div class='contactInstitution'></div>
				<div class='address'>
					<span>$row->Address</span>
					<span class='city'>$row->City</span>
					<span class='country'>$row->Country</span>
					<span class='email'><a href='mailto:$row->Email' title='email'>$row->Email</a></span>
					<span class='phone'>$row->Phone_Office</span>
					<span class='phone'>$row->Fax</span>
				</div>
			</div>
		</div>
	</td><td>$row->Name</td>";
}
$PList .= '</tbody></table>' ;

return $PList ;

}


function _gbifims_get_CommitteeList( $committee ) {
	$CList = '';

	$result = db_query('SELECT DISTINCT Name_First, Name_Last, Address, Email, City, ZipCode, Phone_Office, Fax, Job_Position, gbifims_Country.Name, gbifims_Grouprole.Name, gbifims_Grouprole.SortOrder 
						FROM {gbifims_Contact}, {gbifims_ContactGrouproleNodeParticipant}, {gbifims_Grouprole}, {gbifims_Country}
						WHERE gbifims_Contact.ContactID = gbifims_ContactGrouproleNodeParticipant.ContactID 
							AND gbifims_Contact.CountryID_Address = gbifims_Country.CountryID
							AND gbifims_Grouprole.GrouproleID = gbifims_ContactGrouproleNodeParticipant.GrouproleID 
							AND gbifims_ContactGrouproleNodeParticipant.Active = 1  
							AND gbifims_ContactGrouproleNodeParticipant.GrouproleID IN 
										(SELECT GrouproleID FROM {gbifims_Grouprole} 
										WHERE gbifims_Grouprole.GroupID IN (SELECT GroupID FROM {gbifims_Group} WHERE gbifims_Group.Name= :rcom)
										AND gbifims_Grouprole.Name <> :rSS  AND gbifims_Grouprole.Name <> :rscis) ORDER BY gbifims_Grouprole.SortOrder, gbifims_Contact.GBIF_Order, Name_Last', array(':rcom'=>$committee, ':rSS'=>'Secretariat Support', ':rscis'=>'Sci-staff')) ;

	// hook_theme? What hook_theme... :-| 
	$CList = '<table style="" class="table table-bordered table-stripped"><tbody>';
	// <thead><tr><th colspan="2" >'.$options[1].'</th><tr></thead>
	foreach ( $result as $row) {
		$job_or_role = ( $committee == 'GBIF Secretariat' ) ? $row->Job_Position : $row->Name ;
		$CList .= "<tr><td>
			<div class='contact'>
				<a name='$row->Name_First,$row->Name_Last'></a>
				<div class='contactName'>$row->Name_First $row->Name_Last</div>
				<div style='display: none;'>
					<div class='contactPosition'>$row->Job_Position</div>
					<div class='contactInstitution'></div>
					<div class='address'>
						<span>$row->Address</span>
						<span class='city'>$row->City</span>
						<span class='country'>$row->Country</span>
						<span class='email'><a href='mailto:$row->Email' title='email'>$row->Email</a></span>
						<span class='phone'>$row->Phone_Office</span>
						<span class='phone'>$row->Fax</span>
					</div>
				</div>
			</div>
		</td><td>$job_or_role</td>";
	}
	$CList .= '</tbody></table>' ;
	return $CList ;
}

/* 
 * Nodes committee is special! =:-o
 *
 */
function _gbifims_get_NCList( ) {

	$CList = '';

	$result = db_query('SELECT Name_First, Name_Last, gbifims_Contact.Address, Email, gbifims_Contact.City, ZipCode, Phone_Office, Fax, gbifims_Node.Name_Full, gbifims_Grouprole.Name AS Role, gbifims_Group.Name, gbifims_Participant.Name_Short,gbifims_Grouprole.SortOrder 
							FROM gbifims_Contact, gbifims_ContactGrouproleNodeParticipant, gbifims_Grouprole, gbifims_Group, gbifims_Country, gbifims_Node, gbifims_Participant
							WHERE 	gbifims_Contact.ContactID = gbifims_ContactGrouproleNodeParticipant.ContactID 
								AND gbifims_Grouprole.GrouproleID = gbifims_ContactGrouproleNodeParticipant.GrouproleID 
								AND gbifims_Grouprole.GroupID = gbifims_Group.GroupID
								AND gbifims_ContactGrouproleNodeParticipant.NodeID = gbifims_Node.NodeID 
								AND gbifims_Node.ParticipantID = gbifims_Participant.ParticipantID
								AND gbifims_Contact.CountryID_Address = gbifims_Country.CountryID
								AND gbifims_ContactGrouproleNodeParticipant.Active = 1  
								AND gbifims_Group.Name = :nc
								AND ( gbifims_Grouprole.Name = :nm OR gbifims_Grouprole.Name = :chair OR gbifims_Grouprole.Name = :vc)
								AND gbifims_Grouprole.Name <> :rSS
							ORDER BY gbifims_Grouprole.SortOrder, gbifims_Participant.Name_Short', array(':nc'=>'Nodes Committee', 'nm'=>'Node Manager', ':chair'=>'Chair', ':vc'=>'Vice Chair',':rSS'=>'Secretariat Support')) ;
	// hook_theme? What hook_theme... :-| 
	$CList = '<table style="" class="table table-bordered table-stripped"><tbody>';
	// <thead><tr><th colspan="2" >'.$options[1].'</th><tr></thead>
	foreach ( $result as $row) {
		$CList .= "<tr><td>
			<div class='contact'>
				<a name='$row->Name_First,$row->Name_Last'></a>
				<div class='contactName'>$row->Name_First $row->Name_Last</div>
				<div style='display: none;'>
					<div class='contactPosition'>$row->Job_Position</div>
					<div class='contactInstitution'></div>
					<div class='address'>
						<span>$row->Address</span>
						<span class='city'>$row->City</span>
						<span class='country'>$row->Country</span>
						<span class='email'><a href='mailto:$row->Email' title='email'>$row->Email</a></span>
						<span class='phone'>$row->Phone_Office</span>
						<span class='phone'>$row->Fax</span>
					</div>
				</div>
			</div>
		</td><td width='18%'>$row->Role</td><td width='20%'>$row->Name_Short</td>";
	}
	$CList .= '</tbody></table>' ;

	return $CList ;
}


?>