<?PHP load_template("frontend/element/header.php",$data);?>

<div id="site-container">
	<div class="content">
		<div class="article">
			<h1 class="font-20" >Projects</h1>
				<p class="padding-top10">
				CodenDev develops GNU Public Licensed free softwares. 
				Briefly Free software are those softwares allows you to share modify the softwares.
				</p>
				<p>
				We add new project which is mostly an offshoot of our commercial development effort.
			        These are some of the project that we are developing now. 
				</p>
				<div class="padding-top10">	
					<h2>Arity</h2>
					<div><img src="images/documentation.png"/> <a target="_blank" href="projects/arity/trunk/documentation">Documentation</a> - <img src="images/code.png"/> <a target="_blank"  href="https://github.com/codendev/arity">Sources</a></div>
					<div class="padding-top10">
						<p> Object relational mapping framework. Provide simple methods to access the data provider though object oriented instantiated
						classes.</p>
						<div style="padding-top:5px;">
							<strong>Provider Supported</strong>
							<ul>
								<li>
								PostgresSql.
								</li>
							</ul>
							<strong>Features</strong>
							<ul>
								<li>
								No XML configuration required.
								</li>
								<li>
								Support nth level of relationships.
								</li>
								<li>
								Table defination exist within mapping class.
								</li>
								<li>
								Supports sql independent providers.
								</li>
								
								
							</ul>
							</div>
					</div>
				</div>
				<div class="padding-top10">	
					<h2>rapidWSGI</h2>
					<div><img src="images/documentation.png"/> <a target="_blank" href="projects/rapidWSGI.git/INSTALL">Documentation</a> - <img src="images/code.png"/> <a target="_blank"  href="https://github.com/codendev/rapidwsgi">Sources</a></div>
					<div class="padding-top10">
						<p>Python WSGI Small MVC Framework.</p>
						<p> rapidWSGI is a small addon to existing WSGI framework for creating websites.</p>
						<div style="padding-top:5px;">
							<strong>Features</strong>
							<ul>
								<li>
								Simple and easy to configure.
								</li>
								<li>
								Support Model View Controller Architecture
								</li>
								<li>
								Mako Templates are included within distribution
								</li>
								
							</ul>
							</div>
					</div>
				</div>						
				<div class="padding-top10">	
					<h2>mCarousel</h2>
					<div><img src="images/documentation.png"/> <a target="_blank" href="projects/mCarousel/trunk/index.html">Demo</a> - <img src="images/code.png"/> <a target="_blank"  href="https://github.com/codendev/mCarousel">Sources</a></div>
					<div class="padding-top10">
						<p>mCarousel jQuery carousel plugin</p>
						<p> mCarousel jQuery carousel plugin for creating carousel and sliders.</p>
						<div style="padding-top:5px;">
							<strong>Features</strong>
							<ul>
								<li>Supports right to left languages like Arabic and Persian.</li>
								<li>Supports left to right languages like English and Spanish.</li>
								<li>Supports elastic carousel. </li>
								<li>Supports fixed width box carousel. </li>
							    <li>Can enable/disable pager. </li>
							</ul>
							</div>
					</div>
				</div>	

		</div>
		<div  class="sidebar">
			<?PHP load_template("frontend/element/sidebar.php",$data);?>
		</div>
<?PHP load_template("frontend/element/footer.php",$data);?>

