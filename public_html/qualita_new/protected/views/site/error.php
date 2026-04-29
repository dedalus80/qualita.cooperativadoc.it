<?php
/* @var $this SiteController */
/* @var $error array */
?>

<div class="container">
	<div class="row login-logo">
		<div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
				<div class="panel-heading" style=" text-align: left; padding: 10px ; border-radius: none;border-bottom: #dadfe3 1px solid">
                     <img class='img-responsive' src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo-login-qualita.png" />
                </div>
				<div class="panel-body" style="border: none !important; border-radius: 0px" >
					<div id="general-box">
						<h2>Error <?php echo $code; ?></h2>
						<div id="box-login">
							<div class="error">
								<?php echo CHtml::encode($message); ?>
							</div>
						</div>
					</div>
				</div>
				<div class="panel-footer">
                    <div class="clearfix" style='padding:15px'>
                        <div id="btn-login">
                            <?php echo CHtml::link('Torma al login', '/qualita_new/index.php/site/login', array("class" => "btn btn-orange pull-right login-btn" ,'id' => 'back-to-login')); ?>
                        </div>
                    </div>
                </div>
			</div>
		</div>
	</div>
</div>