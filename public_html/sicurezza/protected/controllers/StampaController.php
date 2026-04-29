<?php

class StampaController extends Controller
{
	
	

	public function actionIndex()
	{   
                
                
            
                $this->renderPartial('index',array(
			'model'=>$test,
		));
                
	}

	
        
        
}
