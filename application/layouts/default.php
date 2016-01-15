<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>{layout_title}</title>
<link rel="icon" type="image/png" href="<?= base_url('assets/img/favicon.png');?>" />
{layout_css}
{layout_js}
</head>
<body>
<div id="main_container">
	<div class="header">
    <div class="logo"><a href="<?= base_url();?>"><img src="<?= base_url('assets/img/logo.png');?>" alt="" title="" border="0" /></a></div>
    
    <div class="right_header">Bem vindo Adrison, <a href="#" class="messages">(3) Notificações</a> | <a href="#" class="logout">Sair</a></div>
    <!--<div id="clock_a"></div>-->
    </div>
    
    <div class="main_content">
            <?= '<span id="current" style="display:none;">' . $current . '</span>';?>
                    <div class="menu">
                    <ul>
                        <li><a rel="home" href="<?= base_url();?>">Home</a></li>
                        <li><a rel="alunos" href="#">Alunos<!--[if IE 7]><!--></a><!--<![endif]-->
                        <!--[if lte IE 6]><table><tr><td><![endif]-->
                            <ul>
                                <li><a href="<?= base_url('alunos/listar');?>" title="Listar alunos">Listar</a></li>
                                <li><a href="<?= base_url('alunos/cadastro');?>" title="Cadastrar aluno">Cadastro</a></li>
                                <li><a href="<?= base_url('alunos/relatorio');?>" title="Relatórios">Relatório</a></li>
                            </ul>
                         <!--[if lte IE 6]></td></tr></table></a><![endif]-->
                        </li>
                        <li><a rel="turmas" href="#">Turmas<!--[if IE 7]><!--></a><!--<![endif]-->
                        <!--[if lte IE 6]><table><tr><td><![endif]-->
                            <ul>
                                <li><a href="<?= base_url('turmas/listar');?>" title="Listar alunos">Listar</a></li>
                                <li><a href="<?= base_url('turmas/cadastro');?>" title="Cadastrar aluno">Cadastro</a></li>
                                <li><a href="<?= base_url('turmas/relatorio');?>" title="Relatórios">Relatório</a></li>
                            </ul>
                         <!--[if lte IE 6]></td></tr></table></a><![endif]-->
                        </li>
                        <li><a rel="funcionarios" href="#">Professores/Funcionários<!--[if IE 7]><!--></a><!--<![endif]-->
                        <!--[if lte IE 6]><table><tr><td><![endif]-->
                            <ul>
                                <li><a href="<?= base_url('funcionarios/listar');?>" title="Listar alunos">Listar</a></li>
                                <li><a href="<?= base_url('funcionarios/cadastro');?>" title="Cadastrar aluno">Cadastro</a></li>
                                <li><a href="<?= base_url('funcionarios/relatorio');?>" title="Relatórios">Relatório</a></li>
                            </ul>
                         <!--[if lte IE 6]></td></tr></table></a><![endif]-->
                        </li>
                    </ul>
                    </div> 
                    
                    
                    
                    
    <div class="center_content">  
    
    
    
    <div class="left_content">
    
    	<div class="sidebar_search">
            <form>
            <input type="text" name="" class="search_input" value="pesquisar" onclick="this.value=''" />
            <input type="image" class="search_submit" src="<?= base_url('assets/img/template/images/search.png');?>" />
            </form>            
            </div>
    
            <div class="sidebarmenu">
                <?php 
                    if(!empty($sidebar)){
                        foreach ($sidebar as $menuLat){
                            
                            if($menuLat['submenu'] !== false && is_array($menuLat['submenu'])){
                                echo '<a class="menuitem submenuheader" href="' . $menuLat['link'] . '">' . $menuLat['titulo'] . '</a>';
                                echo '<div class="submenu">';
                                    echo '<ul>';
                                        foreach ($menuLat['submenu'] as $submenu){
                                            echo '<li><a href="' . $submenu['link'] . '">' . $submenu['titulo'] . '</a></li>';
                                        }
                                    echo '</ul>';
                                echo '</div>';
                            }else{
                                echo '<a class="menuitem" href="' . $menuLat['link'] . '">' . $menuLat['titulo'] . '</a>';
                            }
                            
                        }
                    }
                ?>                    
            </div>
            
            <div class="sidebar_box">
                <div class="sidebar_box_top"></div>
                <div class="sidebar_box_content">
                <h3>Ponto eletrônico</h3>
                <img src="<?= base_url('assets/img/template/images/info.png');?>" alt="" title="" class="sidebar_icon_right" />
                <p>
Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                </p>                
                </div>
                <div class="sidebar_box_bottom"></div>
            </div>
            
            <div class="sidebar_box">
                <div class="sidebar_box_top"></div>
                <div class="sidebar_box_content">
                <h4>Lembretes</h4>
                <img src="<?= base_url('assets/img/template/images/notice.png');?>" alt="" title="" class="sidebar_icon_right" />
                <p>
Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                </p>                
                </div>
                <div class="sidebar_box_bottom"></div>
            </div>
            
            <div class="sidebar_box">
                <div class="sidebar_box_top"></div>
                <div class="sidebar_box_content">
                <h3>Agenda</h3>
                <img src="<?= base_url('assets/img/template/images/info.png');?>" alt="" title="" class="sidebar_icon_right" />
                <p>
Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                </p>                
                </div>
                <div class="sidebar_box_bottom"></div>
            </div>
    </div>  
    
    <div class="right_content">            
        {layout_content}
    </div> <!--end of right content -->
                
  </div>   <!--end of center content -->               
                    
                    
    
    
    <div class="clear"></div>
    </div> <!--end of main content-->
	
    
    <div class="footer">
    
    	<div class="left_footer">Developed by <a href="http://indeziner.com">Adrison Luz</a></div>
    	<div class="right_footer"><a href="http://indeziner.com"><img src="images/indeziner_logo.gif" alt="" title="" border="0" /></a></div>
    
    </div>

</div>		
</body>
</html>