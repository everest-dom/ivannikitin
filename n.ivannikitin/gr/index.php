<?php
		// http://web4key.ru/testreoptin/?name=Александр&email=im@a-zalogin.com&phone_mobile=89185547586&id=5219001&u=rad4
		
		/*
		https://app.getresponse.com/add_contact_webform.html?u=			vBrY
		https://app.getresponse.com/add_contact_webform.html?u=			rad4
		*/
		
		
if(!empty($_GET['id']) && !empty($_GET['u'])){
?>

<script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$("#form1").submit();
	});
</script>
<form accept-charset="utf-8" action="http://www.email.ivannikitin.ru/add_contact_webform.html?u=<?php echo $_GET['u']; ?>" method="post" id="form1">
	<?php if(!empty($_GET['name'])){ ?><input class="wf-input" type="hidden" name="name" value="<?php echo $_GET['name']; ?>"><?php } ?>
	<?php if(!empty($_GET['email'])){ ?><input class="wf-input wf-req wf-valid__email" type="hidden" name="email" value="<?php echo $_GET['email']; ?>"><?php } ?>
	<?php if(!empty($_GET['phone_mobile']) && !strpos($_GET['phone_mobile'],'CUSTOM') && !strpos($_GET['phone_mobile'],'phone_mobile')){ ?>
		<input type="hidden" name="custom_phone" class="wf-input" value="<?php echo $_GET['phone_mobile']; ?>">
	<?php } ?>
    <input type="hidden" name="webform_id" value="<?php echo $_GET['id']; ?>">
</form>
<?php }else{ ?>
Нет id формы или id пользователя!!!!!
<?php } ?>
