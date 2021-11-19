<footer class="ferreycorp__footer"> 
	<hr>
	<div class="container g-0">
		<div class="footer__information">
			<div class="information__brand">
				<a class="brand" href="http://" title="Mundo Ferreycorp">
					<img src="<?php bloginfo( 'template_url' ); ?>/assets/images/svgs/brand-ferreycorp-footer.svg" alt="Mundo Ferreycorp"></a>
			</div>
			<div class="information__contact">
				<p class="telephone">Atención Telefónica<span>0-800-13372</span></p>
				<p class="Location">Dirección <span>Jr. Cristobal de Peralta 820, Santiago de Surco, Lima -Perú</span></p>
				<p>&nbsp;</p>
				<p>&nbsp;</p>
				<p>&nbsp;</p>
				<p>&nbsp;</p>
				<p>&nbsp;</p>
				<p>&nbsp;</p>
			</div>
			<div class="information__social">
				<!--ul class="social__list">
					<li class="social__item">
						<a class="permalink" href="http://"> 
							<span class="icon">
								<svg>
									<use xlink:href="<?php bloginfo( 'template_url' ); ?>/assets/images/icons/icons.svg#icon-facebook"></use>
									</svg>
							</span>
						</a>
					</li>
					<li class="social__item">
						<a class="permalink" href="http://">
							<span class="icon">
								<svg>
									<use xlink:href="<?php bloginfo( 'template_url' ); ?>/assets/images/icons/icons.svg#icon-twitter"></use>
								</svg>
							</span>
						</a>
					</li>
					<li class="social__item">
						<a class="permalink" href="http://">
							<span class="icon">
								<svg>
									<use xlink:href="<?php bloginfo( 'template_url' ); ?>/assets/images/icons/icons.svg#icon-linkedin"></use>
                            	</svg>
                            </span>
                        </a>
                    </li>
                 <li class="social__item">
                 	<a class="permalink" href="http://">
                    		<span class="icon">
                        		<svg>
                        			<use xlink:href="<?php bloginfo( 'template_url' ); ?>/assets/images/icons/icons.svg#icon-instagram"></use>
                        		</svg>
                        	</span>
                        </a>
                    </li>
                </ul-->
            </div>
        </div>
		<div class="footer__navigation">
			<?php
				$args = array(
					'theme_location' => 'menu-footer',
					'container' => 'nav',
					'container_class' => 'menu-footer',
				);
				wp_nav_menu($args);
			?>
		</div>
    </div>
	<div class="footer__copy">
		<span class="text">© 2021 <b>Ferreycorp. </b>All Rights Reserved.</span>
	</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>