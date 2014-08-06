<!DOCTYPE html>
<html>
<head>
    <title>Simulador</title>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <link href="/Content/Site.css" rel="Stylesheet" type="text/css" />
    <link href="/Content/favicon.ico" rel="Shortcut Icon" />
    <link href="/Content/lytebox/lytebox.css" rel="stylesheet" type="text/css" />
    <script src="/Scripts/jquery-1.10.2.min.js" type="text/javascript"></script>
    <script src="/Scripts/modernizr.custom.js" type="text/javascript"></script>
    <script src="/Scripts/functions.js" type="text/javascript"></script>
    <script src="/Scripts/jquery.maskedinput.min.js" type="text/javascript"></script>
    <link href="/Content/jquery-ui-1.10.3.custom.css" rel="stylesheet" type="text/css" />
    <link href="/Content/no-theme/jquery-ui-1.10.3.custom.css" rel="stylesheet" type="text/css" />
    <script src="/Scripts/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>
    <script src="/Scripts/jquery-ui-1.10.3.custom.js" type="text/javascript"></script>
    <script src="/Scripts/jquery.price_format.1.8.js" type="text/javascript"></script>
    <script src="/Scripts/jquery-reject.js" type="text/javascript"></script>
    <script src="/Content/lytebox/lytebox.js" type="text/javascript"></script>
    
    <script type="text/javascript" language="javascript">
        $(document).ready(function () {
            $('.lbToolTip').hover(function () {
                $(this).next('.divToolTip').toggle();
            });
            
            $('#filtroSimulador input[type="text"]').focus(function () { if (this.value == this.defaultValue) { this.value = ""; } });
            $('#filtroSimulador input[type="text"]').blur(function () { if (this.value == "") { this.value = this.defaultValue; } });

            $('#filtroSimulador input[type="text"].formatFone').blur(function () { if (this.value == "(__) ____-_____") { this.value = this.defaultValue; } });
            
            if ($('#filtroSimulador .nome').val() != 'Nome') {
                $('#filtroSimulador .nome').removeClass('nome');
            }

            if ($('#filtroSimulador .email').val() != 'E-mail') {
                $('#filtroSimulador .email').removeClass('email');
            }

            if ($('#filtroSimulador .telefone').val() != 'Telefone') {
                $('#filtroSimulador .telefone').removeClass('telefone');
            }

            if ($('#filtroSimulador .cidade').val() != 'Cidade') {
                $('#filtroSimulador .cidade').removeClass('cidade');
            }

            if ($('#filtroSimulador .vlrInicial').val() != 'Valor Mínimo') {
                $('#filtroSimulador .vlrInicial').removeClass('vlrInicial');
            }

            if ($('#filtroSimulador .vlrFinal').val() != 'Valor Máximo') {
                $('#filtroSimulador .vlrFinal').removeClass('vlrFinal');
            }
            
            $('.formatVlrIni, .formatVlrFim').focus(function () {
                $(this).priceFormat({
                    prefix: '',
                    centsSeparator: ',',
                    thousandsSeparator: '.'
                });
            });

            $('.formatVlrIni, .formatVlrFim').blur(function () { if (this.value == "0,00") { this.value = this.defaultValue; } });

            $('.formatFone').mask("(99) 9999-9999?9");            
        });
    </script>

    <!--[if IE]>
        <link href="/Content/Site-ie_v2.css" rel="Stylesheet" type="text/css" />

        <script type="text/javascript">
        //<![CDATA[
            $(document).ready(function(){
                $.reject({
                    reject: { msie6: true, msie7: true },
                    display: ['chrome', 'firefox', 'msie'],
                    header: '',
                    paragraph1: 'O navegador que você está utilizando não é suportado pelo nosso website.',
                    paragraph2: 'Para obter uma experiência completa dos recursos disponíveis, por favor, instale um dos navegadores abaixo.',
                    closeMessage: '',
                    closeLink: 'Quero continuar assim mesmo',
                    imagePath: '../Content/img/browser/',
                    closeCookie: false
                });
                return false;
            });
        //]]>
        </script>
    <![endif]-->
    <!-- google analytics -->
    <script type="text/javascript">
        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-44872935-1']);
        _gaq.push(['_trackPageview']);

        (function () {
            var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
        })();
    </script>
    <script type="text/javascript">
        parar = false;
        banner = 1;
        var simulador = true;
        var ufs = new Array("AC", "AL", "AP", "AM", "BA", "CE", "DF", "ES", "GO", "MA", "MT", "MS", "MG", "PR", "PB", "PA", "PE", "PI", "RJ", "RN", "RS", "RO", "RR", "SC", "SE", "SP", "TO");

        $(document).ready(function () {
            AcaoBanner0("primeiro");

            var y_fixo2 = $("#simuladorLateral").offset().top;
            $(window).scroll(function () {
                if ($(window).scrollTop() > 0 && simulador == true) {
                    $("#simuladorLateral").css("display", "");
                    $("#simuladorLateral").animate({
                        top: y_fixo2 + $(document).scrollTop() + "px"
                    }, { duration: 1000, queue: false }
                );
                } else {
                    $("#simuladorLateral").css("display", "none");
                }
            });

            $('#imgFacaSimulacao').click(function () {
                $('#simuladorHidden').slideToggle();
                $('#simuladorLateral').animate({ width: "175px", height: "320px" }, { duration: 400, queue: false });
                $('#imgFacaSimulacao').slideToggle();
            });

            $('#btnFechaSimulador').click(function () {
                $('#simuladorHidden').slideToggle();
                $('#simuladorLateral').animate({ width: "40px", height: "110px" }, { duration: 400, queue: false });
                $('#imgFacaSimulacao').slideToggle();
            });

            if ($("#hiddenHome").val() != "ok") {
                escondeBanner();
            }

            if ($("#hiddenSimuladorLat").val() == "ok") {
                $('#simuladorTopo').addClass('displayNone');
                $('.simuladorBg').addClass('displayNone');
                $('#simuladorLateral').addClass('displayNone');
            }

            $('.vlrInicial, .vlrFinal').focus(function () {
                $(this).priceFormat({
                    prefix: '',
                    centsSeparator: ',',
                    thousandsSeparator: '.'
                });
            });

            $('.vlrInicial, .vlrFinal').blur(function () { if (this.value == "0,00") { this.value = this.defaultValue; } });

            $('.telefone').mask("(99) 9999-9999?9");
            $('#simuladorTopo .telefone').val($('.telefone')[0].defaultValue);
            $('#simuladorLateral .telefone').val($('.telefone')[0].defaultValue);

            $('#simuladorTopo input[type="text"]').focus(function () { if (this.value == this.defaultValue) { this.value = ""; } });
            $('#simuladorTopo input[type="text"]').blur(function () { if (this.value == "") { this.value = this.defaultValue; } });

            $('#simuladorLateral input[type="text"]').focus(function () { if (this.value == this.defaultValue) { this.value = ""; } });
            $('#simuladorLateral input[type="text"]').blur(function () { if (this.value == "") { this.value = this.defaultValue; } });

            $('.btnSimular').click(function () {
                var ok = true;
                $(this).parent().find('select, .vlrInicial, .vlrFinal').each(function () {
                    var valor = $(this).val().replace(new RegExp('.', 'g'), '').replace(',', '.');

                    $(this).removeClass('errorField');
                    if ($(this).val() == '' || $(this).val() == this.defaultValue ||
                        ($(this).is('input') && isNaN(valor))) {
                        $(this).addClass('errorField');
                        ok = false;
                    }
                });

                $(this).parent().find('.nome, .email, .telefone').each(function () {
                    var valor = $(this).val();

                    $(this).removeClass('errorField');
                    if ($(this).val() == '' || $(this).val() == this.defaultValue) {
                        $(this).addClass('errorField');
                        ok = false;
                    }
                });

                $(this).parent().find('.cidade').each(function () {
                    var valor = $(this).val();
                    $(this).removeClass('errorField');
                    if ($(this).val() == '' || $(this).val() == this.defaultValue || $(this).val().indexOf("/") < 0 || ($(this).val().length - $(this).val().indexOf("/") != 4)) {
                        $(this).addClass('errorField');
                        ok = false;
                    }
                    else {
                        var estado = $(this).val().substr($(this).val().indexOf("/") + 1, $(this).val().length - $(this).val().indexOf("/") + 1).trim().toUpperCase();
                        if (estado.length != 2 || ufs.indexOf(estado) < 0) {
                            $(this).addClass('errorField');
                            ok = false;
                        }
                    }
                });
                return ok;
            });

            if ($('#filtroSimulador .telefone').attr('value') == 'Telefone') {
                $('#filtroSimulador .telefone').val('Telefone');
            }

            $('.cidade').autocomplete({
                source: '/AutoComplete/AutoComplete'
            });

            $('.cidadeSimulador').autocomplete({
                source: '/AutoComplete/AutoComplete'
            });
        });
    </script>
</head>
<body>
    <div id="bannerThumbs">
            <div id="t0" class="thumb">
                <img src="/Content/upload/thumb_bannersite-01.png" alt="Ganhadores - Promo&#231;&#227;o 20 anos" onclick="escondido == true ? mostraBanner() : &#39;&#39;; parar = true; AcaoBanner0(&#39;clicado&#39;);" />
            </div>
            <div class="separator">
            </div>
            <div id="t1" class="thumb">
                <img src="/Content/upload/thumb_banner top of mind.png" alt="Top Of Mind 2014" onclick="escondido == true ? mostraBanner() : &#39;&#39;; parar = true; AcaoBanner1(&#39;clicado&#39;);" />
            </div>
            <div class="separator">
            </div>
            <div id="t2" class="thumb">
                <img src="/Content/upload/thumb_MEIA_PARCELA_ex.jpg" alt="Page Metade da Parcela at&#233; a Contempla&#231;&#227;o" onclick="escondido == true ? mostraBanner() : &#39;&#39;; parar = true; AcaoBanner2(&#39;clicado&#39;);" />
            </div>
            <div class="separator">
            </div>
    </div>
    <div class="page">
        <div id="header">
            <a href="../">
                <img src="/Content/img/logo.png" alt="Logo HS Consórcios" /></a>
            <div id="topMenu">
                <ul>
                    <li>EMPRESA
                        <ul>
                            
                                <li><strong>::&nbsp;</strong><a href="/empresa/grupo-herval">GRUPO HERVAL</a></li>         
                                <li><strong>::&nbsp;</strong><a href="/empresa/hs-consorcios">HS CONS&#211;RCIOS</a></li>         
                                <li><strong>::&nbsp;</strong><a href="/empresa/institucional">INSTITUCIONAL</a></li>         
                        </ul>
                    </li>
                    <li>CONSÓRCIO
                        <ul>
                            
                                <li><strong>::&nbsp;</strong><a href="/consorcio/historia-do-consorcio">HIST&#211;RIA DO CONS&#211;RCIO</a></li>         
                                <li><strong>::&nbsp;</strong><a href="/consorcio/consorcio-e-investimento">CONS&#211;RCIO &#201; INVESTIMENTO</a></li>         
                                <li><strong>::&nbsp;</strong><a href="/consorcio/produtos">PRODUTOS</a></li>         
                            <li><strong>::&nbsp;</strong><a href="/simulador">SIMULADOR</a></li>
                        </ul>
                    </li>
                    <li>COMO FUNCIONA
                        <ul class="ulComoFuncionaTop">
                            
                                <li><strong>::&nbsp;</strong><a href="/como-funciona/passo-a-passo">PASSO A PASSO</a></li>         
                                <li><strong>::&nbsp;</strong><a href="/como-funciona/metade-da-parcela">METADE DA PARCELA</a></li>         
                                <li><strong>::&nbsp;</strong><a href="/como-funciona/lance">LANCE</a></li>         
                            <li><strong>::&nbsp;</strong><a href="/perguntas-frequentes">PERGUNTAS FREQUENTES</a></li>
                        </ul>
                    </li>
                    <li><a href="/onde-encontrar">ONDE ENCONTRAR</a>
                    </li>
                    <li>CONTATO
                        <ul>
                            <li><strong>::&nbsp;</strong><a href="/contato/ligamos-para-voce">LIGAMOS PARA VOC&#202;</a></li>
                            <li><strong>::&nbsp;</strong><a href="/contato/central-de-atendimento">CENTRAL DE ATENDIMENTO</a></li>
                            <li><strong>::&nbsp;</strong><a href="/contato/ouvidoria">OUVIDORIA</a></li>
                            <li><strong>::&nbsp;</strong><a href="http://www.herval.com.br/Trabalhe_Conosco.aspx?idSecao=1000&lg=1&tc=0_1"
                                target="_blank">TRABALHE CONOSCO</a></li>
                            <li><strong>::&nbsp;</strong><a href="/contato/seja-corretor">SEJA CORRETOR</a></li>
                        </ul>
                    </li>
                    <li><a class="linkAreaCliente" href="/cliente">&#193;REA DO CLIENTE</a></li>
                </ul>
            </div>
        </div>
<form action="/Simulador" enctype="multipart/form-data" id="formSimuladorTopo" method="post">            <div id="simuladorTopo">
                <span class="medSimulador">Faça aqui sua</span>
                <br />
                <span class="bigSimulador">simulação</span>
                <br />
                <br />
                <select class="tipoConsorcio" name="tipoConsorcio">
                    <option value="">Tipo de consórcio</option>
                    <option value="AN">Automóveis/Caminhões</option>
                    <option value="IM">Imóveis</option>
                    <option value="MT">Motos</option>
                </select>
                <br />
                <select class="parcela" name="parcela">
                    <option value="">Tipo de consulta</option>
                    <option value="true">Parcela</option>
                    <option value="false">Crédito</option>
                </select>
                <br />
                <input type="text" class="vlrInicial" name="vlrInicial" value="Valor Mínimo" />
                <input type="text" class="vlrFinal" name="vlrFinal" value="Valor Máximo" />
                <br />
                <input type="text" class="nome" name="nome" value="Nome" />
                <input type="text" class="telefone" name="telefone" value="Telefone" />
                <br />
                <input type="text" class="email emailTopo" name="email" value="E-mail" />
                <br />
                <input type="text" class="cidade" name="cidade" value="Cidade" />
                <br />
                <input type="hidden" value='' name="adwords" />
                <input type="image" src="/Content/img/btnSimular.png" alt="Simular" class="btnLit btnSimular" />
            </div>
</form>        <div class="simuladorBg">
        </div>
        <div id="main">
            
<h2>
    Simulador</h2>
<h4 style="color: #999; font-weight: normal;">
    Ligue gratuitamente -
    <label style="font-weight: bold;">
        0800 644 9007</label></h4>
<form action="/Simulador" enctype="multipart/form-data" id="formPagSimulador" method="post">    <div id="filtroSimulador">
        <select id="tipoConsorcio" name="tipoConsorcio"><option value="">Tipo de cons&#243;rcio</option>
<option value="AN">Autom&#243;veis/Caminh&#245;es</option>
<option selected="selected" value="IM">Im&#243;veis</option>
<option value="MT">Motos</option>
</select>
        <select id="parcela" name="parcela"><option value="">Tipo de consulta</option>
<option selected="selected" value="true">Parcela</option>
<option value="false">Cr&#233;dito</option>
</select>
        <input class="vlrInicial formatVlrIni" id="vlrInicial" name="vlrInicial" type="text" value="100,00" />
        <input class="vlrFinal formatVlrFim" id="vlrFinal" name="vlrFinal" type="text" value="1.000.000,00" />
        <br />
        <input class="nome" id="nome" name="nome" style="width: 245px;" type="text" value="Luciano" />
        <input class="telefone formatFone" id="telefone" name="telefone" type="text" value="(54) 9606-8888" />
        <input class="email emailSimulador" id="email" name="email" type="text" value="contato@luciano.com" />
        <input class="cidade cidadeSimulador" id="cidade" name="cidade" type="text" value="NOVA PRATA / RS" />

        <input type="hidden" value='' name="adwords" />
        <input type="image" src="/Content/img/btnSimular.png" alt="Simular" class="btnLit btnSimular" />
    </div>
</form><table class="tableSimulador" border="2">
        <tr>
            <th>
                Crédito
            </th>
            <th>
                Prazo
            </th>
            <th>
                ¹/² Parcela
            </th>
            <th>
                Parcela Integral
            </th>
            <th>
                Prazo Reduzido
            </th>
            <th>
                ¹/² Parcela
            </th>
            <th>
                Parcela Integral
            </th>
        </tr>
        <tr style="background:  " >
            <td>
R$ 55.517,62            </td>
            <td>
                150 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 231,28</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,07 %
                        <br />
                        Anual: 0,88 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 3,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold;">R$ 462,63</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,15 %
                    <br />
                    Anual: 1,76 %
                    <br />
                    
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 3,00 %
                </div>
            </td>
            <td>
                81 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 428,32</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,14 %
                        <br />
                        Anual: 1,63 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 3,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold">R$ 856,69</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,27 %
                    <br />
                    Anual: 3,26 %
                    <br />
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 3,00 %
                </div>
            </td>
        </tr>
        <tr style="background: #f9f9f9 " >
            <td>
R$ 55.727,99            </td>
            <td>
                150 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 232,16</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,07 %
                        <br />
                        Anual: 0,88 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 3,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold;">R$ 464,39</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,15 %
                    <br />
                    Anual: 1,76 %
                    <br />
                    
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 3,00 %
                </div>
            </td>
            <td>
                85 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 409,66</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,13 %
                        <br />
                        Anual: 1,55 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 3,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold">R$ 819,48</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,26 %
                    <br />
                    Anual: 3,11 %
                    <br />
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 3,00 %
                </div>
            </td>
        </tr>
        <tr style="background:  " >
            <td>
R$ 62.457,32            </td>
            <td>
                150 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 260,20</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,07 %
                        <br />
                        Anual: 0,88 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 3,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold;">R$ 520,45</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,15 %
                    <br />
                    Anual: 1,76 %
                    <br />
                    
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 3,00 %
                </div>
            </td>
            <td>
                81 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 481,86</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,14 %
                        <br />
                        Anual: 1,63 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 3,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold">R$ 963,78</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,27 %
                    <br />
                    Anual: 3,26 %
                    <br />
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 3,00 %
                </div>
            </td>
        </tr>
        <tr style="background: #f9f9f9 " >
            <td>
R$ 62.694,00            </td>
            <td>
                150 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 261,19</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,07 %
                        <br />
                        Anual: 0,88 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 3,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold;">R$ 522,43</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,15 %
                    <br />
                    Anual: 1,76 %
                    <br />
                    
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 3,00 %
                </div>
            </td>
            <td>
                85 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 460,86</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,13 %
                        <br />
                        Anual: 1,55 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 3,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold">R$ 921,92</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,26 %
                    <br />
                    Anual: 3,11 %
                    <br />
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 3,00 %
                </div>
            </td>
        </tr>
        <tr style="background:  " >
            <td>
R$ 64.026,44            </td>
            <td>
                150 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 260,40</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,07 %
                        <br />
                        Anual: 0,84 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 1,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold;">R$ 520,73</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,14 %
                    <br />
                    Anual: 1,68 %
                    <br />
                    
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 1,00 %
                </div>
            </td>
            <td>
                88 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 443,84</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,12 %
                        <br />
                        Anual: 1,43 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 1,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold">R$ 887,60</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,24 %
                    <br />
                    Anual: 2,86 %
                    <br />
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 1,00 %
                </div>
            </td>
        </tr>
        <tr style="background: #f9f9f9 " >
            <td>
R$ 69.397,03            </td>
            <td>
                150 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 289,11</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,07 %
                        <br />
                        Anual: 0,88 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 3,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold;">R$ 578,28</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,15 %
                    <br />
                    Anual: 1,76 %
                    <br />
                    
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 3,00 %
                </div>
            </td>
            <td>
                81 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 535,40</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,14 %
                        <br />
                        Anual: 1,63 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 3,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold">R$ 1.070,87</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,27 %
                    <br />
                    Anual: 3,26 %
                    <br />
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 3,00 %
                </div>
            </td>
        </tr>
        <tr style="background:  " >
            <td>
R$ 69.659,98            </td>
            <td>
                150 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 290,21</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,07 %
                        <br />
                        Anual: 0,88 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 3,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold;">R$ 580,48</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,15 %
                    <br />
                    Anual: 1,76 %
                    <br />
                    
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 3,00 %
                </div>
            </td>
            <td>
                85 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 512,08</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,13 %
                        <br />
                        Anual: 1,55 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 3,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold">R$ 1.024,35</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,26 %
                    <br />
                    Anual: 3,11 %
                    <br />
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 3,00 %
                </div>
            </td>
        </tr>
        <tr style="background: #f9f9f9 " >
            <td>
R$ 71.140,46            </td>
            <td>
                150 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 289,33</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,07 %
                        <br />
                        Anual: 0,84 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 1,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold;">R$ 578,58</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,14 %
                    <br />
                    Anual: 1,68 %
                    <br />
                    
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 1,00 %
                </div>
            </td>
            <td>
                88 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 493,15</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,12 %
                        <br />
                        Anual: 1,43 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 1,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold">R$ 986,22</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,24 %
                    <br />
                    Anual: 2,86 %
                    <br />
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 1,00 %
                </div>
            </td>
        </tr>
        <tr style="background:  " >
            <td>
R$ 76.336,73            </td>
            <td>
                150 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 318,01</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,07 %
                        <br />
                        Anual: 0,88 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 3,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold;">R$ 636,12</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,15 %
                    <br />
                    Anual: 1,76 %
                    <br />
                    
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 3,00 %
                </div>
            </td>
            <td>
                81 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 588,94</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,14 %
                        <br />
                        Anual: 1,63 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 3,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold">R$ 1.177,95</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,27 %
                    <br />
                    Anual: 3,26 %
                    <br />
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 3,00 %
                </div>
            </td>
        </tr>
        <tr style="background: #f9f9f9 " >
            <td>
R$ 76.626,00            </td>
            <td>
                150 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 319,22</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,07 %
                        <br />
                        Anual: 0,88 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 3,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold;">R$ 638,53</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,15 %
                    <br />
                    Anual: 1,76 %
                    <br />
                    
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 3,00 %
                </div>
            </td>
            <td>
                85 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 563,28</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,13 %
                        <br />
                        Anual: 1,55 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 3,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold">R$ 1.126,79</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,26 %
                    <br />
                    Anual: 3,11 %
                    <br />
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 3,00 %
                </div>
            </td>
        </tr>
        <tr style="background:  " >
            <td>
R$ 78.254,52            </td>
            <td>
                150 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 318,26</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,07 %
                        <br />
                        Anual: 0,84 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 1,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold;">R$ 636,44</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,14 %
                    <br />
                    Anual: 1,68 %
                    <br />
                    
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 1,00 %
                </div>
            </td>
            <td>
                88 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 542,46</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,12 %
                        <br />
                        Anual: 1,43 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 1,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold">R$ 1.084,84</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,24 %
                    <br />
                    Anual: 2,86 %
                    <br />
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 1,00 %
                </div>
            </td>
        </tr>
        <tr style="background: #f9f9f9 " >
            <td>
R$ 83.276,43            </td>
            <td>
                150 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 346,93</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,07 %
                        <br />
                        Anual: 0,88 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 3,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold;">R$ 693,95</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,15 %
                    <br />
                    Anual: 1,76 %
                    <br />
                    
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 3,00 %
                </div>
            </td>
            <td>
                81 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 642,48</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,14 %
                        <br />
                        Anual: 1,63 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 3,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold">R$ 1.285,03</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,27 %
                    <br />
                    Anual: 3,26 %
                    <br />
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 3,00 %
                </div>
            </td>
        </tr>
        <tr style="background:  " >
            <td>
R$ 83.591,99            </td>
            <td>
                150 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 348,24</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,07 %
                        <br />
                        Anual: 0,88 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 3,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold;">R$ 696,57</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,15 %
                    <br />
                    Anual: 1,76 %
                    <br />
                    
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 3,00 %
                </div>
            </td>
            <td>
                85 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 614,48</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,13 %
                        <br />
                        Anual: 1,55 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 3,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold">R$ 1.229,22</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,26 %
                    <br />
                    Anual: 3,11 %
                    <br />
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 3,00 %
                </div>
            </td>
        </tr>
        <tr style="background: #f9f9f9 " >
            <td>
R$ 85.368,56            </td>
            <td>
                150 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 347,20</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,07 %
                        <br />
                        Anual: 0,84 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 1,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold;">R$ 694,31</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,14 %
                    <br />
                    Anual: 1,68 %
                    <br />
                    
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 1,00 %
                </div>
            </td>
            <td>
                88 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 591,78</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,12 %
                        <br />
                        Anual: 1,43 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 1,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold">R$ 1.183,46</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,24 %
                    <br />
                    Anual: 2,86 %
                    <br />
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 1,00 %
                </div>
            </td>
        </tr>
        <tr style="background:  " >
            <td>
R$ 90.216,12            </td>
            <td>
                150 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 375,84</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,07 %
                        <br />
                        Anual: 0,88 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 3,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold;">R$ 751,76</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,15 %
                    <br />
                    Anual: 1,76 %
                    <br />
                    
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 3,00 %
                </div>
            </td>
            <td>
                81 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 696,01</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,14 %
                        <br />
                        Anual: 1,63 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 3,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold">R$ 1.392,13</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,27 %
                    <br />
                    Anual: 3,26 %
                    <br />
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 3,00 %
                </div>
            </td>
        </tr>
        <tr style="background: #f9f9f9 " >
            <td>
R$ 90.557,99            </td>
            <td>
                150 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 377,26</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,07 %
                        <br />
                        Anual: 0,88 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 3,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold;">R$ 754,62</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,15 %
                    <br />
                    Anual: 1,76 %
                    <br />
                    
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 3,00 %
                </div>
            </td>
            <td>
                85 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 665,69</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,13 %
                        <br />
                        Anual: 1,55 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 3,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold">R$ 1.331,66</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,26 %
                    <br />
                    Anual: 3,11 %
                    <br />
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 3,00 %
                </div>
            </td>
        </tr>
        <tr style="background:  " >
            <td>
R$ 92.482,61            </td>
            <td>
                150 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 376,12</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,07 %
                        <br />
                        Anual: 0,84 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 1,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold;">R$ 752,16</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,14 %
                    <br />
                    Anual: 1,68 %
                    <br />
                    
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 1,00 %
                </div>
            </td>
            <td>
                88 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 641,09</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,12 %
                        <br />
                        Anual: 1,43 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 1,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold">R$ 1.282,08</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,24 %
                    <br />
                    Anual: 2,86 %
                    <br />
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 1,00 %
                </div>
            </td>
        </tr>
        <tr style="background: #f9f9f9 " >
            <td>
R$ 97.155,84            </td>
            <td>
                150 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 404,75</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,07 %
                        <br />
                        Anual: 0,88 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 3,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold;">R$ 809,60</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,15 %
                    <br />
                    Anual: 1,76 %
                    <br />
                    
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 3,00 %
                </div>
            </td>
            <td>
                81 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 749,55</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,14 %
                        <br />
                        Anual: 1,63 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 3,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold">R$ 1.499,21</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,27 %
                    <br />
                    Anual: 3,26 %
                    <br />
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 3,00 %
                </div>
            </td>
        </tr>
        <tr style="background:  " >
            <td>
R$ 97.524,00            </td>
            <td>
                150 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 406,29</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,07 %
                        <br />
                        Anual: 0,88 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 3,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold;">R$ 812,66</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,15 %
                    <br />
                    Anual: 1,76 %
                    <br />
                    
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 3,00 %
                </div>
            </td>
            <td>
                85 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 716,90</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,13 %
                        <br />
                        Anual: 1,55 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 3,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold">R$ 1.434,09</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,26 %
                    <br />
                    Anual: 3,11 %
                    <br />
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 3,00 %
                </div>
            </td>
        </tr>
        <tr style="background: #f9f9f9 " >
            <td>
R$ 99.596,65            </td>
            <td>
                150 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 405,06</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,07 %
                        <br />
                        Anual: 0,84 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 1,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold;">R$ 810,02</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,14 %
                    <br />
                    Anual: 1,68 %
                    <br />
                    
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 1,00 %
                </div>
            </td>
            <td>
                88 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 690,41</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,12 %
                        <br />
                        Anual: 1,43 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 1,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold">R$ 1.380,71</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,24 %
                    <br />
                    Anual: 2,86 %
                    <br />
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 1,00 %
                </div>
            </td>
        </tr>
        <tr style="background:  " >
            <td>
R$ 104.095,53            </td>
            <td>
                150 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 433,66</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,07 %
                        <br />
                        Anual: 0,88 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 3,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold;">R$ 867,43</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,15 %
                    <br />
                    Anual: 1,76 %
                    <br />
                    
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 3,00 %
                </div>
            </td>
            <td>
                81 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 803,10</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,14 %
                        <br />
                        Anual: 1,63 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 3,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold">R$ 1.606,30</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,27 %
                    <br />
                    Anual: 3,26 %
                    <br />
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 3,00 %
                </div>
            </td>
        </tr>
        <tr style="background: #f9f9f9 " >
            <td>
R$ 104.489,99            </td>
            <td>
                150 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 435,31</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,07 %
                        <br />
                        Anual: 0,88 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 3,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold;">R$ 870,72</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,15 %
                    <br />
                    Anual: 1,76 %
                    <br />
                    
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 3,00 %
                </div>
            </td>
            <td>
                85 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 768,11</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,13 %
                        <br />
                        Anual: 1,55 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 3,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold">R$ 1.536,53</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,26 %
                    <br />
                    Anual: 3,11 %
                    <br />
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 3,00 %
                </div>
            </td>
        </tr>
        <tr style="background:  " >
            <td>
R$ 106.710,71            </td>
            <td>
                150 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 433,99</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,07 %
                        <br />
                        Anual: 0,84 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 1,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold;">R$ 867,88</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,14 %
                    <br />
                    Anual: 1,68 %
                    <br />
                    
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 1,00 %
                </div>
            </td>
            <td>
                88 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 739,72</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,12 %
                        <br />
                        Anual: 1,43 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 1,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold">R$ 1.479,34</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,24 %
                    <br />
                    Anual: 2,86 %
                    <br />
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 1,00 %
                </div>
            </td>
        </tr>
        <tr style="background: #f9f9f9 " >
            <td>
R$ 111.035,25            </td>
            <td>
                150 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 462,57</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,07 %
                        <br />
                        Anual: 0,88 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 3,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold;">R$ 925,26</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,15 %
                    <br />
                    Anual: 1,76 %
                    <br />
                    
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 3,00 %
                </div>
            </td>
            <td>
                81 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 856,63</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,14 %
                        <br />
                        Anual: 1,63 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 3,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold">R$ 1.713,39</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,27 %
                    <br />
                    Anual: 3,26 %
                    <br />
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 3,00 %
                </div>
            </td>
        </tr>
        <tr style="background:  " >
            <td>
R$ 111.455,99            </td>
            <td>
                150 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 464,33</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,07 %
                        <br />
                        Anual: 0,88 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 3,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold;">R$ 928,76</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,15 %
                    <br />
                    Anual: 1,76 %
                    <br />
                    
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 3,00 %
                </div>
            </td>
            <td>
                85 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 819,32</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,13 %
                        <br />
                        Anual: 1,55 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 3,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold">R$ 1.638,96</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,26 %
                    <br />
                    Anual: 3,11 %
                    <br />
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 3,00 %
                </div>
            </td>
        </tr>
        <tr style="background: #f9f9f9 " >
            <td>
R$ 113.824,75            </td>
            <td>
                150 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 462,93</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,07 %
                        <br />
                        Anual: 0,84 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 1,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold;">R$ 925,74</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,14 %
                    <br />
                    Anual: 1,68 %
                    <br />
                    
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 1,00 %
                </div>
            </td>
            <td>
                88 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 789,03</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,12 %
                        <br />
                        Anual: 1,43 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 1,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold">R$ 1.577,95</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,24 %
                    <br />
                    Anual: 2,86 %
                    <br />
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 1,00 %
                </div>
            </td>
        </tr>
        <tr style="background:  " >
            <td>
R$ 115.000,00            </td>
            <td>
                180 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 392,96</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,06 %
                        <br />
                        Anual: 0,73 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 1,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold;">R$ 785,80</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,12 %
                    <br />
                    Anual: 1,47 %
                    <br />
                    
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 1,00 %
                </div>
            </td>
            <td>
                170 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 415,95</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,06 %
                        <br />
                        Anual: 0,78 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 1,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold">R$ 832,15</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,13 %
                    <br />
                    Anual: 1,55 %
                    <br />
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 1,00 %
                </div>
            </td>
        </tr>
        <tr style="background: #f9f9f9 " >
            <td>
R$ 117.974,93            </td>
            <td>
                150 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 491,48</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,07 %
                        <br />
                        Anual: 0,88 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 3,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold;">R$ 983,08</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,15 %
                    <br />
                    Anual: 1,76 %
                    <br />
                    
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 3,00 %
                </div>
            </td>
            <td>
                81 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 910,18</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,14 %
                        <br />
                        Anual: 1,63 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 3,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold">R$ 1.820,47</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,27 %
                    <br />
                    Anual: 3,26 %
                    <br />
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 3,00 %
                </div>
            </td>
        </tr>
        <tr style="background:  " >
            <td>
R$ 118.421,99            </td>
            <td>
                150 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 493,34</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,07 %
                        <br />
                        Anual: 0,88 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 3,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold;">R$ 986,80</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,15 %
                    <br />
                    Anual: 1,76 %
                    <br />
                    
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 3,00 %
                </div>
            </td>
            <td>
                85 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 870,52</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,13 %
                        <br />
                        Anual: 1,55 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 3,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold">R$ 1.741,40</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,26 %
                    <br />
                    Anual: 3,11 %
                    <br />
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 3,00 %
                </div>
            </td>
        </tr>
        <tr style="background: #f9f9f9 " >
            <td>
R$ 120.938,80            </td>
            <td>
                150 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 491,86</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,07 %
                        <br />
                        Anual: 0,84 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 1,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold;">R$ 983,59</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,14 %
                    <br />
                    Anual: 1,68 %
                    <br />
                    
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 1,00 %
                </div>
            </td>
            <td>
                88 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 838,34</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,12 %
                        <br />
                        Anual: 1,43 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 1,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold">R$ 1.676,58</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,24 %
                    <br />
                    Anual: 2,86 %
                    <br />
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 1,00 %
                </div>
            </td>
        </tr>
        <tr style="background:  " >
            <td>
R$ 124.914,64            </td>
            <td>
                150 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 520,39</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,07 %
                        <br />
                        Anual: 0,88 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 3,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold;">R$ 1.040,91</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,15 %
                    <br />
                    Anual: 1,76 %
                    <br />
                    
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 3,00 %
                </div>
            </td>
            <td>
                81 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 963,72</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,14 %
                        <br />
                        Anual: 1,63 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 3,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold">R$ 1.927,56</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,27 %
                    <br />
                    Anual: 3,26 %
                    <br />
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 3,00 %
                </div>
            </td>
        </tr>
        <tr style="background: #f9f9f9 " >
            <td>
R$ 125.000,00            </td>
            <td>
                180 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 427,13</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,06 %
                        <br />
                        Anual: 0,73 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 1,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold;">R$ 854,13</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,12 %
                    <br />
                    Anual: 1,47 %
                    <br />
                    
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 1,00 %
                </div>
            </td>
            <td>
                170 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 452,13</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,06 %
                        <br />
                        Anual: 0,78 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 1,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold">R$ 904,51</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,13 %
                    <br />
                    Anual: 1,55 %
                    <br />
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 1,00 %
                </div>
            </td>
        </tr>
        <tr style="background:  " >
            <td>
R$ 125.387,98            </td>
            <td>
                150 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 522,36</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,07 %
                        <br />
                        Anual: 0,88 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 3,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold;">R$ 1.044,86</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,15 %
                    <br />
                    Anual: 1,76 %
                    <br />
                    
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 3,00 %
                </div>
            </td>
            <td>
                85 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 921,73</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,13 %
                        <br />
                        Anual: 1,55 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 3,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold">R$ 1.843,83</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,26 %
                    <br />
                    Anual: 3,11 %
                    <br />
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 3,00 %
                </div>
            </td>
        </tr>
        <tr style="background: #f9f9f9 " >
            <td>
R$ 128.052,83            </td>
            <td>
                150 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 520,79</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,07 %
                        <br />
                        Anual: 0,84 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 1,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold;">R$ 1.041,46</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,14 %
                    <br />
                    Anual: 1,68 %
                    <br />
                    
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 1,00 %
                </div>
            </td>
            <td>
                88 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 887,66</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,12 %
                        <br />
                        Anual: 1,43 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 1,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold">R$ 1.775,20</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,24 %
                    <br />
                    Anual: 2,86 %
                    <br />
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 1,00 %
                </div>
            </td>
        </tr>
        <tr style="background:  " >
            <td>
R$ 131.854,36            </td>
            <td>
                150 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 549,31</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,07 %
                        <br />
                        Anual: 0,88 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 3,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold;">R$ 1.098,75</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,15 %
                    <br />
                    Anual: 1,76 %
                    <br />
                    
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 3,00 %
                </div>
            </td>
            <td>
                81 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 1.017,25</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,14 %
                        <br />
                        Anual: 1,63 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 3,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold">R$ 2.034,64</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,27 %
                    <br />
                    Anual: 3,26 %
                    <br />
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 3,00 %
                </div>
            </td>
        </tr>
        <tr style="background: #f9f9f9 " >
            <td>
R$ 132.353,97            </td>
            <td>
                150 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 551,40</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,07 %
                        <br />
                        Anual: 0,88 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 3,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold;">R$ 1.102,90</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,15 %
                    <br />
                    Anual: 1,76 %
                    <br />
                    
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 3,00 %
                </div>
            </td>
            <td>
                85 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 972,93</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,13 %
                        <br />
                        Anual: 1,55 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 3,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold">R$ 1.946,27</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,26 %
                    <br />
                    Anual: 3,11 %
                    <br />
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 3,00 %
                </div>
            </td>
        </tr>
        <tr style="background:  " >
            <td>
R$ 138.794,05            </td>
            <td>
                150 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 578,21</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,07 %
                        <br />
                        Anual: 0,88 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 3,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold;">R$ 1.156,57</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,15 %
                    <br />
                    Anual: 1,76 %
                    <br />
                    
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 3,00 %
                </div>
            </td>
            <td>
                81 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 1.070,80</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,14 %
                        <br />
                        Anual: 1,63 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 3,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold">R$ 2.141,73</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,27 %
                    <br />
                    Anual: 3,26 %
                    <br />
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 3,00 %
                </div>
            </td>
        </tr>
        <tr style="background: #f9f9f9 " >
            <td>
R$ 139.319,98            </td>
            <td>
                150 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 580,41</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,07 %
                        <br />
                        Anual: 0,88 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 3,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold;">R$ 1.160,95</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,15 %
                    <br />
                    Anual: 1,76 %
                    <br />
                    
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 3,00 %
                </div>
            </td>
            <td>
                85 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 1.024,14</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,13 %
                        <br />
                        Anual: 1,55 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 3,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold">R$ 2.048,70</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,26 %
                    <br />
                    Anual: 3,11 %
                    <br />
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 3,00 %
                </div>
            </td>
        </tr>
        <tr style="background:  " >
            <td>
R$ 140.000,00            </td>
            <td>
                180 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 478,38</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,06 %
                        <br />
                        Anual: 0,73 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 1,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold;">R$ 956,62</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,12 %
                    <br />
                    Anual: 1,47 %
                    <br />
                    
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 1,00 %
                </div>
            </td>
            <td>
                170 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 506,38</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,06 %
                        <br />
                        Anual: 0,78 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 1,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold">R$ 1.013,04</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,13 %
                    <br />
                    Anual: 1,55 %
                    <br />
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 1,00 %
                </div>
            </td>
        </tr>
        <tr style="background: #f9f9f9 " >
            <td>
R$ 153.133,20            </td>
            <td>
                150 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 637,95</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,07 %
                        <br />
                        Anual: 0,88 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 3,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold;">R$ 1.276,06</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,15 %
                    <br />
                    Anual: 1,76 %
                    <br />
                    
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 3,00 %
                </div>
            </td>
            <td>
                77 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 1.242,68</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,14 %
                        <br />
                        Anual: 1,71 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 3,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold">R$ 2.485,81</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,29 %
                    <br />
                    Anual: 3,43 %
                    <br />
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 3,00 %
                </div>
            </td>
        </tr>
        <tr style="background:  " >
            <td>
R$ 160.000,00            </td>
            <td>
                180 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 546,72</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,06 %
                        <br />
                        Anual: 0,73 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 1,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold;">R$ 1.093,28</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,12 %
                    <br />
                    Anual: 1,47 %
                    <br />
                    
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 1,00 %
                </div>
            </td>
            <td>
                170 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 578,72</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,06 %
                        <br />
                        Anual: 0,78 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 1,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold">R$ 1.157,76</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,13 %
                    <br />
                    Anual: 1,55 %
                    <br />
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 1,00 %
                </div>
            </td>
        </tr>
        <tr style="background: #f9f9f9 " >
            <td>
R$ 171.863,45            </td>
            <td>
                150 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 715,98</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,07 %
                        <br />
                        Anual: 0,88 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 3,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold;">R$ 1.432,14</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,15 %
                    <br />
                    Anual: 1,76 %
                    <br />
                    
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 3,00 %
                </div>
            </td>
            <td>
                77 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 1.394,66</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,14 %
                        <br />
                        Anual: 1,71 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 3,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold">R$ 2.789,86</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,29 %
                    <br />
                    Anual: 3,43 %
                    <br />
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 3,00 %
                </div>
            </td>
        </tr>
        <tr style="background:  " >
            <td>
R$ 180.000,00            </td>
            <td>
                180 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 615,06</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,06 %
                        <br />
                        Anual: 0,73 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 1,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold;">R$ 1.229,94</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,12 %
                    <br />
                    Anual: 1,47 %
                    <br />
                    
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 1,00 %
                </div>
            </td>
            <td>
                170 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 651,06</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,06 %
                        <br />
                        Anual: 0,78 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 1,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold">R$ 1.302,48</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,13 %
                    <br />
                    Anual: 1,55 %
                    <br />
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 1,00 %
                </div>
            </td>
        </tr>
        <tr style="background: #f9f9f9 " >
            <td>
R$ 193.346,34            </td>
            <td>
                150 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 805,48</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,07 %
                        <br />
                        Anual: 0,88 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 3,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold;">R$ 1.611,15</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,15 %
                    <br />
                    Anual: 1,76 %
                    <br />
                    
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 3,00 %
                </div>
            </td>
            <td>
                77 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 1.569,00</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,14 %
                        <br />
                        Anual: 1,71 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 3,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold">R$ 3.138,59</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,29 %
                    <br />
                    Anual: 3,43 %
                    <br />
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 3,00 %
                </div>
            </td>
        </tr>
        <tr style="background:  " >
            <td>
R$ 200.000,00            </td>
            <td>
                180 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 683,40</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,06 %
                        <br />
                        Anual: 0,73 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 1,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold;">R$ 1.366,60</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,12 %
                    <br />
                    Anual: 1,47 %
                    <br />
                    
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 1,00 %
                </div>
            </td>
            <td>
                170 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 723,40</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,06 %
                        <br />
                        Anual: 0,78 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 1,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold">R$ 1.447,20</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,13 %
                    <br />
                    Anual: 1,55 %
                    <br />
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 1,00 %
                </div>
            </td>
        </tr>
        <tr style="background: #f9f9f9 " >
            <td>
R$ 207.668,33            </td>
            <td>
                150 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 865,15</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,07 %
                        <br />
                        Anual: 0,88 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 3,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold;">R$ 1.730,50</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,15 %
                    <br />
                    Anual: 1,76 %
                    <br />
                    
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 3,00 %
                </div>
            </td>
            <td>
                77 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 1.685,23</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,14 %
                        <br />
                        Anual: 1,71 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 3,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold">R$ 3.371,08</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,29 %
                    <br />
                    Anual: 3,43 %
                    <br />
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 3,00 %
                </div>
            </td>
        </tr>
        <tr style="background:  " >
            <td>
R$ 220.000,00            </td>
            <td>
                180 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 751,74</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,06 %
                        <br />
                        Anual: 0,73 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 1,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold;">R$ 1.503,26</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,12 %
                    <br />
                    Anual: 1,47 %
                    <br />
                    
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 1,00 %
                </div>
            </td>
            <td>
                170 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 795,74</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,06 %
                        <br />
                        Anual: 0,78 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 1,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold">R$ 1.591,92</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,13 %
                    <br />
                    Anual: 1,55 %
                    <br />
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 1,00 %
                </div>
            </td>
        </tr>
        <tr style="background: #f9f9f9 " >
            <td>
R$ 230.000,00            </td>
            <td>
                180 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 785,91</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,06 %
                        <br />
                        Anual: 0,73 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 1,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold;">R$ 1.571,59</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,12 %
                    <br />
                    Anual: 1,47 %
                    <br />
                    
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 1,00 %
                </div>
            </td>
            <td>
                170 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 831,91</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,06 %
                        <br />
                        Anual: 0,78 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 1,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold">R$ 1.664,28</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,13 %
                    <br />
                    Anual: 1,55 %
                    <br />
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 1,00 %
                </div>
            </td>
        </tr>
        <tr style="background:  " >
            <td>
R$ 245.907,73            </td>
            <td>
                150 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 1.000,11</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,07 %
                        <br />
                        Anual: 0,84 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 1,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold;">R$ 1.999,97</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,14 %
                    <br />
                    Anual: 1,68 %
                    <br />
                    
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 1,00 %
                </div>
            </td>
            <td>
                92 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 1.630,62</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,11 %
                        <br />
                        Anual: 1,37 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 1,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold">R$ 3.260,73</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,23 %
                    <br />
                    Anual: 2,74 %
                    <br />
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 1,00 %
                </div>
            </td>
        </tr>
        <tr style="background: #f9f9f9 " >
            <td>
R$ 258.203,13            </td>
            <td>
                150 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 1.050,11</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,07 %
                        <br />
                        Anual: 0,84 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 1,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold;">R$ 2.099,97</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,14 %
                    <br />
                    Anual: 1,68 %
                    <br />
                    
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 1,00 %
                </div>
            </td>
            <td>
                92 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 1.712,14</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,11 %
                        <br />
                        Anual: 1,37 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 1,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold">R$ 3.423,77</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,23 %
                    <br />
                    Anual: 2,74 %
                    <br />
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 1,00 %
                </div>
            </td>
        </tr>
        <tr style="background:  " >
            <td>
R$ 260.326,30            </td>
            <td>
                150 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 1.084,51</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,07 %
                        <br />
                        Anual: 0,88 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 3,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold;">R$ 2.169,30</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,15 %
                    <br />
                    Anual: 1,76 %
                    <br />
                    
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 3,00 %
                </div>
            </td>
            <td>
                77 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 2.112,55</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,14 %
                        <br />
                        Anual: 1,71 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 3,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold">R$ 4.225,88</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,29 %
                    <br />
                    Anual: 3,43 %
                    <br />
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 3,00 %
                </div>
            </td>
        </tr>
        <tr style="background: #f9f9f9 " >
            <td>
R$ 269.496,75            </td>
            <td>
                180 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 920,87</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,06 %
                        <br />
                        Anual: 0,73 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 1,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold;">R$ 1.841,47</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,12 %
                    <br />
                    Anual: 1,47 %
                    <br />
                    
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 1,00 %
                </div>
            </td>
            <td>
                164 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 1.010,88</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,07 %
                        <br />
                        Anual: 0,80 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 1,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold">R$ 2.021,23</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,13 %
                    <br />
                    Anual: 1,61 %
                    <br />
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 1,00 %
                </div>
            </td>
        </tr>
        <tr style="background:  " >
            <td>
R$ 270.498,50            </td>
            <td>
                150 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 1.100,12</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,07 %
                        <br />
                        Anual: 0,84 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 1,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold;">R$ 2.199,96</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,14 %
                    <br />
                    Anual: 1,68 %
                    <br />
                    
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 1,00 %
                </div>
            </td>
            <td>
                92 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 1.793,68</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,11 %
                        <br />
                        Anual: 1,37 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 1,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold">R$ 3.586,81</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,23 %
                    <br />
                    Anual: 2,74 %
                    <br />
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 1,00 %
                </div>
            </td>
        </tr>
        <tr style="background: #f9f9f9 " >
            <td>
R$ 282.793,91            </td>
            <td>
                150 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 1.150,12</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,07 %
                        <br />
                        Anual: 0,84 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 1,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold;">R$ 2.299,96</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,14 %
                    <br />
                    Anual: 1,68 %
                    <br />
                    
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 1,00 %
                </div>
            </td>
            <td>
                92 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 1.875,21</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,11 %
                        <br />
                        Anual: 1,37 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 1,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold">R$ 3.749,84</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,23 %
                    <br />
                    Anual: 2,74 %
                    <br />
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 1,00 %
                </div>
            </td>
        </tr>
        <tr style="background:  " >
            <td>
R$ 295.089,28            </td>
            <td>
                150 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 1.200,13</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,07 %
                        <br />
                        Anual: 0,84 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 1,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold;">R$ 2.399,96</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,14 %
                    <br />
                    Anual: 1,68 %
                    <br />
                    
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 1,00 %
                </div>
            </td>
            <td>
                92 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 1.956,73</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,11 %
                        <br />
                        Anual: 1,37 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 1,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold">R$ 3.912,88</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,23 %
                    <br />
                    Anual: 2,74 %
                    <br />
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 1,00 %
                </div>
            </td>
        </tr>
        <tr style="background: #f9f9f9 " >
            <td>
R$ 307.384,69            </td>
            <td>
                150 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 1.250,13</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,07 %
                        <br />
                        Anual: 0,84 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 1,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold;">R$ 2.499,96</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,14 %
                    <br />
                    Anual: 1,68 %
                    <br />
                    
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 1,00 %
                </div>
            </td>
            <td>
                92 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 2.038,27</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,11 %
                        <br />
                        Anual: 1,37 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 1,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold">R$ 4.075,92</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,23 %
                    <br />
                    Anual: 2,74 %
                    <br />
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 1,00 %
                </div>
            </td>
        </tr>
        <tr style="background:  " >
            <td>
R$ 319.680,06            </td>
            <td>
                150 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 1.300,14</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,07 %
                        <br />
                        Anual: 0,84 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 1,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold;">R$ 2.599,96</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,14 %
                    <br />
                    Anual: 1,68 %
                    <br />
                    
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 1,00 %
                </div>
            </td>
            <td>
                92 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 2.119,80</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,11 %
                        <br />
                        Anual: 1,37 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 1,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold">R$ 4.238,96</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,23 %
                    <br />
                    Anual: 2,74 %
                    <br />
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 1,00 %
                </div>
            </td>
        </tr>
        <tr style="background: #f9f9f9 " >
            <td>
R$ 323.396,09            </td>
            <td>
                180 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 1.105,05</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,06 %
                        <br />
                        Anual: 0,73 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 1,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold;">R$ 2.209,77</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,12 %
                    <br />
                    Anual: 1,47 %
                    <br />
                    
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 1,00 %
                </div>
            </td>
            <td>
                164 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 1.213,07</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,07 %
                        <br />
                        Anual: 0,80 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 1,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold">R$ 2.425,47</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,13 %
                    <br />
                    Anual: 1,61 %
                    <br />
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 1,00 %
                </div>
            </td>
        </tr>
        <tr style="background:  " >
            <td>
R$ 331.975,47            </td>
            <td>
                150 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 1.350,15</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,07 %
                        <br />
                        Anual: 0,84 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 1,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold;">R$ 2.699,95</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,14 %
                    <br />
                    Anual: 1,68 %
                    <br />
                    
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 1,00 %
                </div>
            </td>
            <td>
                92 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 2.201,34</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,11 %
                        <br />
                        Anual: 1,37 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 1,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold">R$ 4.402,00</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,23 %
                    <br />
                    Anual: 2,74 %
                    <br />
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 1,00 %
                </div>
            </td>
        </tr>
        <tr style="background: #f9f9f9 " >
            <td>
R$ 344.270,84            </td>
            <td>
                150 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 1.400,15</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,07 %
                        <br />
                        Anual: 0,84 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 1,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold;">R$ 2.799,96</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,14 %
                    <br />
                    Anual: 1,68 %
                    <br />
                    
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 1,00 %
                </div>
            </td>
            <td>
                92 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 2.282,86</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,11 %
                        <br />
                        Anual: 1,37 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 1,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold">R$ 4.565,04</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,23 %
                    <br />
                    Anual: 2,74 %
                    <br />
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 1,00 %
                </div>
            </td>
        </tr>
        <tr style="background:  " >
            <td>
R$ 356.566,22            </td>
            <td>
                150 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 1.450,16</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,07 %
                        <br />
                        Anual: 0,84 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 1,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold;">R$ 2.899,95</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,14 %
                    <br />
                    Anual: 1,68 %
                    <br />
                    
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 1,00 %
                </div>
            </td>
            <td>
                92 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 2.364,38</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,11 %
                        <br />
                        Anual: 1,37 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 1,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold">R$ 4.728,07</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,23 %
                    <br />
                    Anual: 2,74 %
                    <br />
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 1,00 %
                </div>
            </td>
        </tr>
        <tr style="background: #f9f9f9 " >
            <td>
R$ 368.861,63            </td>
            <td>
                150 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 1.500,16</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,07 %
                        <br />
                        Anual: 0,84 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 1,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold;">R$ 2.999,95</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,14 %
                    <br />
                    Anual: 1,68 %
                    <br />
                    
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 1,00 %
                </div>
            </td>
            <td>
                92 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 2.445,92</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,11 %
                        <br />
                        Anual: 1,37 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 1,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold">R$ 4.891,11</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,23 %
                    <br />
                    Anual: 2,74 %
                    <br />
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 1,00 %
                </div>
            </td>
        </tr>
        <tr style="background:  " >
            <td>
R$ 377.295,44            </td>
            <td>
                180 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 1.289,22</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,06 %
                        <br />
                        Anual: 0,73 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 1,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold;">R$ 2.578,06</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,12 %
                    <br />
                    Anual: 1,47 %
                    <br />
                    
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 1,00 %
                </div>
            </td>
            <td>
                164 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 1.415,24</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,07 %
                        <br />
                        Anual: 0,80 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 1,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold">R$ 2.829,72</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,13 %
                    <br />
                    Anual: 1,61 %
                    <br />
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 1,00 %
                </div>
            </td>
        </tr>
        <tr style="background: #f9f9f9 " >
            <td>
R$ 431.436,41            </td>
            <td>
                180 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 1.474,22</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,06 %
                        <br />
                        Anual: 0,73 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 1,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold;">R$ 2.948,00</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,12 %
                    <br />
                    Anual: 1,47 %
                    <br />
                    
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 1,00 %
                </div>
            </td>
            <td>
                157 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 1.690,38</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,07 %
                        <br />
                        Anual: 0,84 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 1,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold">R$ 3.379,87</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,14 %
                    <br />
                    Anual: 1,68 %
                    <br />
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 1,00 %
                </div>
            </td>
        </tr>
        <tr style="background:  " >
            <td>
R$ 485.365,94            </td>
            <td>
                180 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 1.658,49</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,06 %
                        <br />
                        Anual: 0,73 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 1,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold;">R$ 3.316,51</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,12 %
                    <br />
                    Anual: 1,47 %
                    <br />
                    
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 1,00 %
                </div>
            </td>
            <td>
                157 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 1.901,66</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,07 %
                        <br />
                        Anual: 0,84 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 1,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold">R$ 3.802,35</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,14 %
                    <br />
                    Anual: 1,68 %
                    <br />
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 1,00 %
                </div>
            </td>
        </tr>
        <tr style="background: #f9f9f9 " >
            <td>
R$ 539.295,50            </td>
            <td>
                180 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 1.842,78</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,06 %
                        <br />
                        Anual: 0,73 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 1,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold;">R$ 3.685,00</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,12 %
                    <br />
                    Anual: 1,47 %
                    <br />
                    
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 1,00 %
                </div>
            </td>
            <td>
                157 meses
            </td>
            <td>
                    <label class="lbToolTip">
                        <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                            width="12px" class="lbToolTip" />
                            <span style="font-weight: bold">R$ 2.112,96</span>
                    </label>
                    <div class="divToolTip">
                        <strong>Taxa de Administração:</strong>
                        <br />
                        Média Mensal: 0,07 %
                        <br />
                        Anual: 0,84 %
                        <br />
                        
                        <br />
                        <strong>Fundo de Reserva:</strong>
                        <br />
                        Total: 1,00 %
                    </div>
            </td>
            <td>
                <label class="lbToolTip">
                    <img alt="Informação" src="../../Content/img/icone_information.png" height="12px"
                        width="12px" class="lbToolTip" />
                        <span style="font-weight: bold">R$ 4.224,84</span>
                </label>
                <div class="divToolTip">
                    <strong>Taxa de Administração:</strong>
                    <br />
                    Média Mensal: 0,14 %
                    <br />
                    Anual: 1,68 %
                    <br />
                    <br />
                    <strong>Fundo de Reserva:</strong>
                    <br />
                    Total: 1,00 %
                </div>
            </td>
        </tr>
</table>
<input type="hidden" id="hiddenSimuladorLat" value="ok" />

<!-- Google Code for Simulacao Conversion Page -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 985982040;
var google_conversion_language = "en";
var google_conversion_format = "3";
var google_conversion_color = "ffffff";
var google_conversion_label = "nfZCCLCCugcQ2MiT1gM";
var google_conversion_value = 0;
var google_remarketing_only = false;
/* ]]> */
</script>
<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/985982040/?value=0&amp;label=nfZCCLCCugcQ2MiT1gM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>
        </div>
        <div id="footer">
            <img src="/Content/img/logo_footer.png" alt="Uma empresa do Grupo Herval" class="logoFooter" />
            <br />
            <div id="socialIcons">
                <a href="http://fb.com/hsconsorcios" target="_blank">
                    <img src="/Content/img/logo_facebook.png" alt="Facebook" /></a>
                <a href="http://twitter.com/hsconsorcios" target="_blank">
                    <img src="/Content/img/logo_twitter.png" alt="Twitter" /></a>
                <a href="http://www.youtube.com/watch?v=3n5hYv1veUc" target="_blank">
                    <img src="/Content/img/logo_youtube.png" alt="Youtube" /></a>
            </div>
            <div id="footerMenu">
                <ul>
                    <li>
                        <ul>
                            <li>EMPRESA</li>
                                <li><strong>::&nbsp;</strong><a href="/empresa/grupo-herval">GRUPO HERVAL</a></li>         
                                <li><strong>::&nbsp;</strong><a href="/empresa/hs-consorcios">HS CONS&#211;RCIOS</a></li>         
                                <li><strong>::&nbsp;</strong><a href="/empresa/institucional">INSTITUCIONAL</a></li>         
                        </ul>
                    </li>
                    <li>
                        <ul>
                            <li>CONSÓRCIO</li>
                                <li><strong>::&nbsp;</strong><a href="/consorcio/historia-do-consorcio">HIST&#211;RIA DO CONS&#211;RCIO</a></li>         
                                <li><strong>::&nbsp;</strong><a href="/consorcio/consorcio-e-investimento">CONS&#211;RCIO &#201; INVESTIMENTO</a></li>         
                                <li><strong>::&nbsp;</strong><a href="/consorcio/produtos">PRODUTOS</a></li>         
                            <li><strong>::&nbsp;</strong><a href="/simulador">SIMULADOR</a></li>
                        </ul>
                    </li>
                    <li>
                        <ul>
                            <li>COMO FUNCIONA</li>
                                <li><strong>::&nbsp;</strong><a href="/como-funciona/passo-a-passo">PASSO A PASSO</a></li>         
                                <li><strong>::&nbsp;</strong><a href="/como-funciona/metade-da-parcela">METADE DA PARCELA</a></li>         
                                <li><strong>::&nbsp;</strong><a href="/como-funciona/lance">LANCE</a></li>         
                            <li><strong>::&nbsp;</strong><a href="/perguntas-frequentes">PERGUNTAS FREQUENTES</a></li>
                        </ul>
                    </li>
                    <li>
                        <ul>
                            <li style="margin-bottom: 18px;"><a href="/onde-encontrar">ONDE ENCONTRAR</a></li>
                            <li><u>CONTATO</u></li>
                            <li><strong>::&nbsp;</strong><a href="/contato/ligamos-para-voce">LIGAMOS PARA VOC&#202;</a></li>
                            <li><strong>::&nbsp;</strong><a href="/contato/central-de-atendimento">CENTRAL DE ATENDIMENTO</a></li>
                            <li><strong>::&nbsp;</strong><a href="/contato/ouvidoria">OUVIDORIA</a></li>
                            <li><strong>::&nbsp;</strong><a href="/contato/solicite-uma-visita">SOLICITE UMA VISITA</a></li>
                            <li><strong>::&nbsp;</strong><a href="http://www.herval.com.br/Trabalhe_Conosco.aspx?idSecao=1000&lg=1&tc=0_1"
                                target="_blank">TRABALHE CONOSCO</a></li>
                            <li><strong>::&nbsp;</strong><a href="/contato/seja-corretor">SEJA CORRETOR</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div id="info">
                Rodovia BR 116 Km 223,5 Dois Irmãos - RS CEP 93950-000 <span class="telefone"><a
                    href="callto:+555135648400">Telefone: 51 3564.8400</a></span> Fax: 51 3564.8402
            </div>
        </div>
        <div id="ref">
            <a href="http://abac.org.br/?p=abacConhecaAbac " target="_blank">
                <img src="/Content/img/logo_ass_cons.png" alt="Associação Brasileira de Administradoras de Consórcio" />
            </a><a href="http://www.bcb.gov.br/?CONSINTRO " target="_blank">
                <img src="/Content/img/logo_banco_central.png" alt="Banco Central do Brasil" />
            </a>
        </div>
    </div>
    <img id="toggleDown" src="../../Content/img/toggle_down.png" alt="Mostrar/Esconder Banner"
        style="position: absolute; right: 15%; top: 66px; z-index: 0; display: none;"
        onclick="mostraBanner();" />
    <img id="toggleUp" src="../../Content/img/toggle_up.png" alt="Mostrar/Esconder Banner"
        style="position: absolute; right: 15%; top: 66px; z-index: 0;" onclick="escondeBanner();" />
    <div id="simuladorFloat" style="position: absolute; right: 0; cursor: pointer; margin-top: 350px;
        z-index: 999999; display: none;">
        <img src="../../Content/img/btn_faca_simulacao.png" alt="Faça uma simulação" />
    </div>
    <div id="simuladorLateral" style="position: absolute; margin-top: 23%; right: 0px;
        width: 35px; height: 110px; padding: 15px; border-radius: 7px; z-index: 999999999;
        text-align: right; background-color: #FFF; border: 2px solid #C6C6C6; display: none;">
        <form action="/Simulador" enctype="multipart/form-data" id="formSimuladorLat" method="post">    <img id="imgFacaSimulacao" src="../../Content/img/faca_simulacao.png" alt="" />
    <div id="simuladorHidden" style="display: none;">
        <a id="btnFechaSimulador" style="position: absolute; left: 3px; top: 3px; background-color: #EEE;
            text-align: center; cursor: pointer; color: White; border-radius: 10px; width: 20px;
            height: 20px;">x</a><span class="medSimulador">Faça aqui sua</span>
        <br />
        <span class="bigSimulador">simulação</span>
        <br />
        <br />
        <select class="tipoConsorcio" name="tipoConsorcio">
            <option value="">Tipo de consórcio</option>
            <option value="AN">Automóveis/Caminhões</option>
            <option value="IM">Imóveis</option>
            <option value="MT">Motos</option>
        </select>
        <br />
        <select class="parcela" name="parcela">
            <option value="">Tipo de consulta</option>
            <option value="true">Parcela</option>
            <option value="false">Crédito</option>
        </select>
        <br />
        <input type="text" class="vlrInicial" name="vlrInicial" value="Valor Mín" />
        <input type="text" class="vlrFinal" name="vlrFinal" value="Valor Máx" />
        <br />
        <input type="text" class="nome" name="nome" value="Nome" />
        <input type="text" class="telefone" name="telefone" value="Telefone" />
        <br />
        <input type="text" class="email emailLateral" name="email" value="E-mail" />
        <br />
        <input type="text" class="cidade" name="cidade" value="Cidade" />
        
        <input type="hidden" value='' name="adwords" />
        <br />
        <br />
        <input type="image" src="/Content/img/btnSimular.png" alt="Simular" class="btnLit btnSimular" />
    </div>
</form>
    </div>
        <a id="b0" href="http://promocao20anos.hsconsorcios.com.br/sorteios" target='_blank' class="banner"
            style="background-image: url(/Content/upload/bannersite-01.png); background-repeat:no-repeat; background-position:center; ">
            &nbsp;</a>
        <a id="b1" href="http://blog.hsconsorcios.com.br/2014/06/hs-consorcios-e-a-marca-de-consorcios-mais-lembrada-no-rs/" target='_blank' class="banner"
            style="background-image: url(/Content/upload/banner-site-top-of-mind.jpg); background-repeat:no-repeat; background-position:center; ">
            &nbsp;</a>
        <a id="b2" href="http://www.hsconsorcios.com.br/como-funciona/metade-da-parcela" target='_blank' class="banner"
            style="background-image: url(/Content/upload/MEIA_PARCELA_ex.jpg); background-repeat:no-repeat; background-position:center; ">
            &nbsp;</a>
    <div id="bannerThumbsBg">
    </div>
    <div id="footerBg">
    </div>
    <script type="text/javascript">
    /* <![CDATA[ */
    var google_conversion_id = 985982040;
    var google_custom_params = window.google_tag_params;
    var google_remarketing_only = true;
    /* ]]> */
    </script>
    <script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
    </script>
    <noscript>
        <div style="display: inline;">
            <img height="1" width="1" style="border-style: none;" alt="" src="//googleads.g.doubleclick.net/pagead/viewthroughconversion/985982040/?value=0&amp;guid=ON&amp;script=0" />
        </div>
    </noscript>
</body>
</html>