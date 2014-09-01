jQuery(document).ready(function($){
	
	$('#loginform input[type="text"]').attr('placeholder', 'gebruikersnaam');
	$('#loginform input[type="password"]').attr('placeholder', 'wachtwoord');
	
	$('#loginform label[for="user_login"]').contents().filter(function() {
		return this.nodeType === 3;
	}).remove();
	$('#loginform label[for="user_pass"]').contents().filter(function() {
		return this.nodeType === 3;
	}).remove();
	
	$("label[for='rememberme']").html('<input name="rememberme" type="checkbox" id="rememberme" value="forever">Onthouden');
	$("#nav").find("a").attr("id", "pass_forget");
	$("#nav").attr("class", "clearfix").append("<div id='tel-nr'>  (0573) 28 97 60</div>");
	
});