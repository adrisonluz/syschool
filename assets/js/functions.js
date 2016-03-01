var url = window.location.host;
if (url == 'localhost') {
    url = 'http://' + url + '/syschool';
} else {
    url = 'http://' + url;
}

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
    oninit: function (headers, expandedindices) { //custom code to run when headers have initalized
        //do nothing
    },
    onopenclose: function (header, index, state, isuseractivated) { //custom code to run whenever a header is opened or closed
        //do nothing
    }
})

function mensagemRetorno(tipo, text) {
    $('#main_container').append('<div id="msg"></div>');
    $('#msg').fadeIn(2000);

    setTimeout("$('#msg').fadeOut(2000)", 3000);
    setTimeout("$('#msg').remove()", 5000);

    switch (tipo) {
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

$(document).ready(function () {
    $('.ask').jConfirmAction();

    var current = $('#current').text();
    $(".menu a[rel=" + current + "]").addClass('current');

    /* Máscara dos formulários */
    $('.formDate').mask('00/00/0000');
    $('.formCEP').mask('00000-000');
    $('.formFone').mask('(00) 0000-0000');
    $('.formHora').mask('#00:00', {reverse: true});
    $('.formCPF').mask('000.000.000-00');
    $('.formDin').mask('000.000.000.000.000,00', {reverse: true});
    $('.formPorc').mask('##0,00%', {reverse: true});

    $('.niceform').submit(function () {
        $//('#submit').attr('disabled', 'disabled');
        $.post(url + '/' + current + '/enviar', $(this).serialize(), function (result) {
            console.log(result);
            var resposta = JSON.parse(result);
            if (resposta['msg'] == 'sucess') {
                mensagemRetorno(resposta['msg'], resposta['text']);
                setTimeout(function () {
                    window.location = url + '/' + current + '/listar';
                }, 5000);
            } else {
                mensagemRetorno(resposta['msg'], resposta['text']);
                $('#submit').removeAttr('disabled');
            }
        });

        return false;
    });

    if ($('.menorIdade').length) {
        $('.menorIdade').hide();
    }

    $('.consultIdade').change(function () {
        if ($(this).val() == 0) {
            return false;
        }

        $.post(url + '/alunos/consultaIdade', "id_consult=" + $(this).val(), function (result) {
            console.log(result);
            var resposta = JSON.parse(result);
            if (resposta['idade'] < 18) {
                $('.menorIdade').slideDown(2000);
            }
        });

        return false;
    });

});