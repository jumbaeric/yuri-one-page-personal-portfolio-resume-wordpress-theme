<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">

	<!-- Favicons -->
	<link href="assets/img/favicon.png" rel="icon">
	<link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

	<?php wp_head(); ?>

	<?php
	$colorschemecss = get_stylesheet_directory() . '/inc/colorscheme.css.php';
	if (is_readable($colorschemecss)) {
		require_once($colorschemecss);
	}
	?>
</head>

<?php
// $navbar_scheme   = get_theme_mod('navbar_scheme', 'navbar-light bg-light'); // Get custom meta-value.
// $navbar_position = get_theme_mod('navbar_position', 'static'); // Get custom meta-value.

$search_enabled  = get_theme_mod('search_enabled', '1'); // Get custom meta-value.

$twitter  = get_theme_mod('contact_section_twitter', '#'); // Get custom meta-value.
$facebook  = get_theme_mod('contact_section_faceook', '#'); // Get custom meta-value.
$instagram  = get_theme_mod('contact_section_instagram', '#'); // Get custom meta-value.
$youtube  = get_theme_mod('contact_section_youtube', '#'); // Get custom meta-value.
$linkedin  = get_theme_mod('contact_section_linkedin', '#'); // Get custom meta-value.
$github  = get_theme_mod('contact_section_github', '#'); // Get custom meta-value.
?>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<a href="#main" class="visually-hidden-focusable"><?php esc_html_e('Skip to main content', 'yuri-lucas'); ?></a>

	<!-- ======= Mobile nav toggle button ======= -->
	<i class="bi bi-list mobile-nav-toggle d-xl-none"></i>

	<!-- ======= Header ======= -->
	<header id="header" class="primary-color-scheme">
		<div class="d-flex flex-column">

			<div class="profile">
				<?php
				$header_logo = get_theme_mod('header_logo'); // Get custom meta-value.
				if (!empty($header_logo)) :
				?>
					<img class="img-fluid rounded-circle" src="<?php echo esc_url($header_logo); ?>" alt="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" />
				<?php
				endif;
				?>

				<h1 class="text-light">
					<a href="<?php echo esc_url(home_url()); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>">
						<?php echo esc_attr(get_bloginfo('name', 'display')); ?>
					</a>
				</h1>
				<div class="social-links mt-3 text-center">
					<?php if (isset($twitter) && $twitter != "#") : ?><a href="<?php echo esc_url($twitter); ?>" class="twitter"><i class="bx bxl-twitter"></i></a> <?php endif; ?>
					<?php if (isset($facebook) && $facebook != "#") : ?><a href="<?php echo esc_url($facebook); ?>" class="facebook"><i class="bx bxl-facebook"></i></a> <?php endif; ?>
					<?php if (isset($instagram) && $instagram != "#") : ?><a href="<?php echo esc_url($instagram); ?>" class="instagram"><i class="bx bxl-instagram"></i></a> <?php endif; ?>
					<?php if (isset($youtube) && $youtube != "#") : ?><a href="<?php echo esc_url($youtube); ?>" class="google-plus"><i class="bx bxl-youtube"></i></a> <?php endif; ?>
					<?php if (isset($linkedin) && $linkedin != "#") : ?><a href="<?php echo esc_url($linkedin); ?>" class="linkedin"><i class="bx bxl-linkedin"></i></a> <?php endif; ?>
					<?php if (isset($github) && $github != "#") : ?><a href="<?php echo esc_url($github); ?>" class="linkedin"><i class="bx bxl-github"></i></a> <?php endif; ?>
				</div>
			</div>

			<nav id="navbar" class="nav-menu navbar">
				<?php
				// Loading WordPress Custom Menu (theme_location).
				wp_nav_menu(
					array(
						'menu_class'     => 'navbar-nav me-auto',
						'container'      => '',
						'fallback_cb'    => 'WP_Bootstrap_Navwalker::fallback',
						'walker'         => new WP_Bootstrap_Navwalker(),
						'theme_location' => 'main-menu',
					)
				);
				?>
				<!-- <ul>
								<li><a href="#hero" class="nav-link scrollto active"><i class="bx bx-home"></i> <span>Home</span></a></li>
								<li><a href="#about" class="nav-link scrollto"><i class="bx bx-user"></i> <span>About</span></a></li>
								<li><a href="#resume" class="nav-link scrollto"><i class="bx bx-file-blank"></i> <span>Resume</span></a></li>
								<li><a href="#portfolio" class="nav-link scrollto"><i class="bx bx-book-content"></i> <span>Portfolio</span></a></li>
								<li><a href="#services" class="nav-link scrollto"><i class="bx bx-server"></i> <span>Services</span></a></li>
								<li><a href="#contact" class="nav-link scrollto"><i class="bx bx-envelope"></i> <span>Contact</span></a></li>
							</ul> -->
			</nav><!-- .nav-menu -->
		</div>
	</header><!-- End Header -->

	<?php if (is_front_page()) : ?>
		<!-- ======= Hero Section ======= -->
		<style>
			#hero {
				background: url(<?php echo esc_url(get_theme_mod('upload_hero_image', get_template_directory_uri() . '/assets/img/hero-img.jpg')) ?>) top center;
				background-size: cover;
			}

			@media (min-width: 1024px) {
				#hero {
					background-attachment: fixed;
				}
			}
		</style>
		<section id="hero" class="d-flex flex-column justify-content-center align-items-center">
			<div class="hero-container" data-aos="fade-in">
				<div class="row align-items-center g-lg-5 py-5">
					<div class="col-lg-7 text-center text-lg-start">
						<h1><?php echo esc_html(get_theme_mod('resume_names', 'Yuri Lucas')) ?></h1>
						<p>I'm a <span class="typed" data-typed-items="<?php echo esc_attr(get_theme_mod('resume_skills', 'Designer, Developer, Freelancer, Photographer')) ?>"></span>
						</p>
					</div>
					<div class="col-md-10 mx-auto col-lg-5">
						<div class="p-4 rounded shadow-lg border border-light primary-color-scheme">
							<form class="form">
								<!-- <div class="form-floating mb-3">
									<input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
									<label for="floatingInput">Names</label>
								</div>
								<div class="form-floating mb-3">
									<input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
									<label for="floatingInput">Phone</label>
								</div> -->
								<div class="form-floating mb-3">
									<input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
									<label for="floatingInput">Email</label>
								</div>
								<div class="form-floating mb-3">
									<input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
									<label for="floatingInput">Service</label>
								</div>
								<div class="form-floating mb-3">
									<textarea class="form-control" id="floatingPassword"></textarea>
									<label for="floatingPassword">Description</label>
								</div>
								<button class="w-100 btn btn-lg btn-primary secondary-color-scheme" type="submit">Sign up</button>

							</form>
						</div>
					</div>
				</div>
			</div>
		</section><!-- End Hero -->
	<?php endif; ?>

	<main id="main">

		<?php if (!is_front_page()) : ?>
			<!-- ======= Breadcrumbs ======= -->
			<section class="breadcrumbs">
				<div class="container">

					<div class="d-flex justify-content-between align-items-center">
						<!-- <h2><?php // the_title(); 
									?></h2> -->
						<ol>
							<li><a href="<?php echo esc_url(home_url()) ?>">Home</a></li>
							<?php if (is_category() || is_single()) : echo "<li>";
								the_category(' &bull; ');
								echo "</li>"; ?>
								<?php if (is_single()) : echo "<li>";
									the_title();
									echo "</li>";
								endif; ?>
							<?php elseif (is_page()) : echo "<li>";
								the_title();
								echo "</li>";
							endif; ?>
							<!-- <li>Inner Page</li> -->
						</ol>
					</div>

				</div>
			</section><!-- End Breadcrumbs -->
		<?php endif; ?>