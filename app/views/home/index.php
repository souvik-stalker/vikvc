<script>
 function callAjax()
    {
//        var param=$("#login").serialize();
//        $.ajax({
//        type: 'POST',
//         url: '<?php echo UrlManager::getBaseUrl(); ?>Home/index',
//        data:param,
//        success:function(msg){ $("#content").html(msg);},
//        error: function(msg) {},
//
//       dataType:'html'
//       });
//       return false;
    }
</script>

 <?php
 $this->formWidget("login",
                array(
                    'id'=>"login",
                    'action'=>UrlManager::createUrl("Home/index"),
                    'method'=>'post'
                    ),array("csrf"=>true)); ?>
    <?php echo FormElement::label("Username:",""); ?>
    <?php echo FormElement::ActivetextField($data['user'],"username",array("id"=>'username',"class"=>"reqular")); ?>
    <?php echo FormElement::getError($data['user'],"username");?>
    
    <?php //echo FormElement::textField("User[username1]","",array("id"=>'username1',"class"=>"input_class",'onClick'=>'alert("frtret")'));  ?>
    <?php echo FormElement::label("Password:",""); ?>
    <?php echo FormElement::ActivepasswordField($data['user'],"password",array("id"=>'password',"class"=>"reqular")); ?>
    <?php echo FormElement::getError($data['user'],"password");?>

    <?php //echo FormElement::passwordField("User[password]","",array("id"=>'password',"class"=>"input_class"));  ?>
    <?php echo FormElement::label("Comments:",""); ?>
    <?php echo FormElement::textArea("User[comments]","",array("id"=>'comments',"class"=>"input_class"));  ?>
    <?php echo FormElement::label("Remember Me:",""); ?>
    <?php echo FormElement::checkBox("User[checkbox]","",array("id"=>'checkbox',"class"=>"input_class","value"=>"Y","unCheckedvalue"=>"N"));  ?>
    <?php echo FormElement::label("Radio Me:",""); ?>
    <?php echo FormElement::radioButton("User[radiobutton]","",array("id"=>'radio',"class"=>"input_class","value"=>"Y","unCheckedvalue"=>"N"));  ?>
    <?php echo "<br/>" ;?>
    <?php echo FormElement::radionButtonGroup("User[gender]", "", array('M'=>'Male', 'F'=>'Female'), array('unCheckedvalue'=>"N")); ?>
    <?php echo FormElement::submitButton("Login",array("name"=>"login","id"=>  uniqid(),"onClick"=>"return callAjax();")) ;?>
    <?php echo FormElement::createLink("Login",UrlManager::createUrl("Test/final1"),array("name"=>"login","onClick"=>"return callAjax();","id"=>"aaaa")) ;?>
<?php $this->endWidget(); ?>
      
  
