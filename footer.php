</main><!-- /#main -->
<?php
$navbar_scheme   = get_theme_mod('navbar_scheme', 'navbar-light bg-light'); // Get custom meta-value.
?>
<!-- ======= Footer ======= -->
<footer id="footer" class="<?php echo esc_attr($navbar_scheme) ?>">
	<div class="container">
		<div class="copyright">
			<?php printf(esc_html__('&copy; %1$s %2$s. All rights reserved.', 'yuri-lucas'), date_i18n('Y'), get_bloginfo('name', 'display')); ?>
		</div>
		<div class="credits">
			Designed by <a href="https://ericjumba.com/">Eric Jumba</a>
		</div>
	</div>
</footer><!-- End  Footer -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<?php
wp_footer();
?>
</body>

</html>