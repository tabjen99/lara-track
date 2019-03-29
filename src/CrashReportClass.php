<?php
namespace miketan\laraTrack;

use  miketan\laraTrack\CrashReport;
use Exception;

class CrashReportClass
{

    public function CountOrCreate(Exception $e)
    {
    	$description= $e->getFile().' at line '.$e->getLine();
    	$card = $this->find($description);
    	if($card)
    	{
    		$card->count +=1;
    		$card->save();

	    	$Trello_card = \Trello::manager()->getCard($card->trello_id);
	        $fixed=false;

	        if($Trello_card->isClosed()==true)
	        {
    	    	$fixed=true;
            	$card->delete();
	        }
	        else if(count($Trello_card->getLabels()) >0)
	        {

	        	foreach($Trello_card->getLabels() as $label)
		        {
		            if($label['name']=='done')
		            {
		            	$fixed=true;
		            	$card->delete();
		                break;
		            }
		        }	
	        }
	        
	        if(!$fixed)
	        {
	        	$Trello_card->setName($card->subject.' Appeared: '.$card->count. " times")
	        				->save();
	        }
	        else
	        {
	        	//dd('create card after delete');
	        	$this->create($e);
	        }
	        
    	}
    	else
    	{
    		//dd('create card ');
    		$this->create($e);
    		
    	}
    	return true;
    }

    public function find($description)
    {
    	//return null;
    	
    	return CrashReport::where('content',$description)->first();
    }

    public function create(Exception $e)
    {
    	$description= $e->getFile().' at line '.$e->getLine();
    	$Trello_card = \Trello::manager()->getCard();
        $Trello_card
        ->setBoardId(\Trello::getDefaultBoardId())
        ->setListId(\Trello::getDefaultListId())
        ->setName($e->getMessage())
        ->setDescription($description)
        ->save();

        $card = CrashReport::create(array('subject'=>$e->getMessage(),'content'=>$description,'trello_id'=>$Trello_card->getId()));
    }
}