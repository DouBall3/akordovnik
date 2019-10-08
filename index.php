<?php
session_start();
if(isset($_POST['constent']) && $_POST['constent']){
setcookie("constent", true, time()+(86400 * 30), "/");
unset($_POST['constent']);
header('Location: /');
exit();
}
$_SESSION['uri'] = $_SERVER['REQUEST_URI'];
if(!isset($_SESSION['login'])){
header('Location: /login/');
exit();
}
else{
if($_SESSION['login'] == false){
header('Location: /login/');
exit();
}
}

require_once "functions.php";
Load::files();
?>

<!DOCTYPE html>
<html lang="cs">
<?php require_once "includes/head.php"; ?>
<body id="page-top">
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark" id="mainNav">
		<a class="navbar-brand" href="/"><i class="fas fa-random" aria-hidden="true"></i>Akordovník</a>
		<button class="mb-1 navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarResponsive">
			<ul class="navbar-nav ml-auto">
				<li class="nav-item">
					<form class="form-inline">
						<input type="search" pattern=".{3,}" size="25" required title="Minimální počet jsou 3 znaky" class="form-control mr-sm-2" name="s" placeholder="Hledat">&nbsp;
						<button type="submit" class="btn btn-outline-light my-2 my-sm-0 form-control">
							<i class="fas fa-search"></i>
						</button>
					</form>
				</li>
			</ul>
			<ul class="navbar-nav navbar-right ml-auto">
				<li class="nav-item">
					<a target="_blank" class="nav-link" href="admin/">Administrace</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="logout/">Odhlásit se</a>
				</li>
			</ul>
		</div>
	</nav>
	<header class="bg-dark text-white">
        <div class="bg-primary">
                <?php
                echo "<span>Přihlášený uživatel: ".$_SESSION['username']."</span>";
                ?>
        </div>
	</header>
	<div class="content">
		<div class="bg-dark" style="height: 100%;">
			<div class="container bg-light pb-2">
				<div class="row pt-2">
					<div class="col-lg-8 mx-auto">
						<?php Load::c_generate(); ?>
					</div>
					<div class="col-md-3">
						<div class="sidebar-nav-fixed pull-right affix">
							<div class="well">
								<ul class="navbar-nav nav pt-4">
									<li class="nav-header">Nástroje</li>
									<li>
										<a href="#" id="hideTabs" class="btn btn-primary" style="margin-top: 1px;">Skrýt akordy</a>
                                        <a href="#" id="print" class="btn btn-primary" style="margin-top: 1px;">Tisk</a>
									</li>
									<li class="nav-header pt-5">Akordy</li>
									<?php Load::m_generate(); ?>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
		if(!isset($_COOKIE['constent']) || !$_COOKIE['constent']){?>
		
		<form class="form-inline" method="post">
			<div class="rounded mx-5 inline fixed-top mt-1 text-center bg-light" id="cookieConstent">
				Tyto webové stránky ukladají v souladu se zákony na vaše zařízení soubory, obecně nazývané cookies. Používáním těchto stránek s tím vyjadřujete souhlas.&nbsp;
				<button class="btn btn-outline-primary btn-sm" name="constent" value=1 type="submit" id="buttonConstent">Souhlasím</button>
			</div>
		</form>
<?php
}
?>
	<footer class="py-3 pb-0 bg-dark footer">
		<div class="container">
			<p class="m-0 text-center text-white">&copy; 2019 - DouBall. Všechna práva vyhrazena. Designed by DouBall.</p>
		</div>
	</footer>
</body>
</html>	
