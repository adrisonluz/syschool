var url = window.location.host;
url = 'http://' + url + '/syschool';

ddaccordion.init({
	headerclass: "submenuheader", //Shared CSS class name of headers group
	contentclass: "submenu", //Shared CSS class name of contents group
	revealtype: "click", //Reveal content when user clicks or onmouseover the header? Valid value: "click", "clickgo", or "mouseover"
	mouseoverdelay: 200, //if revealtype="mouseover", set delay in milliseconds before header expands onMouseover
	collapseprev: true, //Collapse previous content (so only one open at any time)? true/false 
	defaultexpanded: [], //index of content(s) open by default [index1, index2, etc] [] denotes no content
	onemustopen: false, //Specify whether at least one header should be open always (so never all headers closed)
	animatedefault: false, //Should contents open by default be animated into view?
	persiststate: true, //persist state of opened contents within browser session?
	toggleclass: ["", ""], //Two CSS classes to be applied to the header when it's collapsed and expanded, respectively ["class1", "class2"]
	togglehtml: ["suffix", '<img src="' + url + '/assets/img/template/images/plus.gif" class="statusicon" />', '<img src="' + url + '/assets/img/template/images/minus.gif" class="statusicon" />'], //Additional HTML added to the header when it's collapsed and expanded, respectively  ["position", "html1", "html2"] (see docs)
	animatespeed: "fast", //speed of animation: integer in milliseconds (ie: 200), or keywords "fast", "normal", or "slow"
	oninit:function(headers, expandedindices){ //custom code to run when headers have initalized
		//do nothing
	},
	onopenclose:function(header, index, state, isuseractivated){ //custom code to run whenever a header is opened or closed
		//do nothing
	}
})

function mensagemRetorno(tipo, text){
    $('#main_container').append('<div id="msg"></div>');
    $('#msg').fadeIn(2000);
    
    setTimeout("$('#msg').fadeOut(2000)", 5000);
    setTimeout("$('#msg').remove()", 7000);
    
    switch(tipo){
        case 'sucess':
            $('#msg').addClass('valid_box').html(text);
            break;
        case 'error':
            $('#msg').addClass('error_box').html(text);
            break;
        case 'alert':
            $('#msg').addClass('warning_box').html(text);
            break;
    }
}

$(document).ready(function() {
    $('.ask').jConfirmAction();
    
    var current = $('#current').text();
    $(".menu a[rel="+current+"]").addClass('current');
    
    $('.niceform').submit(function(){
        
        $.post( 'enviar', $(this).serialize(), function(result){
            //console.log(result);
            var resposta = JSON.parse(result);
            if(resposta['msg'] == 'sucess'){
                mensagemRetorno(resposta['msg'], resposta['text']);
                setTimeout(function(){ window.location.pathname = 'syschool/' + current + '/listar'; }, 7000);                
            }else{
                mensagemRetorno(resposta['msg'], resposta['text']);
            }
        });
       
        return false;
    });
    
});