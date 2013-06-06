<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
        <?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->theme->baseUrl. '/css/theme.css'); ?>
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>

	
</head>

<body>

<div class="container" id="page">

	<div id="header">
		<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
	</div><!-- header -->
<?php    $user = User::model()->findByPk(Yii::app()->user->id);
if($user){
        $approved = $user->approved;
        $enabled = $user->enabled;
}
else{
        $approved = 0;
}

        ?>
	<div id="mainmenu">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Home', 'url'=>array('/site/index')),
				array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
				array('label'=>'User', 'url'=>array('/user/index'),'visible'=>($approved == 1 && $enabled == 1)),
				array('label'=>'DOI', 'url'=>array('/doc/index'),'visible'=>($approved == 1 && $enabled == 1)),
				array('label'=>'Login', 'url'=>array('/site/loginoption'), 'visible'=>Yii::app()->user->name=='Guest'),
				array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>Yii::app()->user->name!='Guest')
			),
		));
             
                ?>
	</div><!-- mainmenu -->
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> Terrestrial Ecosystem Research Network.<br/>
		<img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/diisr_stacked.gif"/><br/><br/>
		TERN is supported by the Australian Government through the National Collaborative Research Infrastructure Strategy and the Super Science Initiative.
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>