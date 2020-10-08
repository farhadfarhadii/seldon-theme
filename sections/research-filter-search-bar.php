<?php 
global $filteredPostType;

$researchLPID = get_id_by_slug('research');
$researchLPurl = get_permalink($researchLPID);

?>

<div id="ResearchFilterSearch" class="row">

	<div class="col-xs-12">
		<div class="row maxout">
			<div class="col-sm-11 col-sm-offset-1">
				<div class="row pv-15">
					<div class="col-md-8">						
						<a href="<?php echo $researchLPurl; ?>" class="btn <?php echo $filteredPostType == "" ? "active" : ""; ?>">All</a>
						<a href="<?php echo $researchLPurl; ?>?type=Publications" class="btn <?php echo $filteredPostType == "Publications" ? "active" : ""; ?>">Publications</a>
						<a href="<?php echo $researchLPurl; ?>?type=OpenSource" class="btn <?php echo $filteredPostType == "OpenSource" ? "active" : ""; ?>">Open Source</a>
						<a href="<?php echo $researchLPurl; ?>?type=Blog" class="btn <?php echo $filteredPostType == "Blog" ? "active" : ""; ?>">Blog</a>
					</div>
					<div class="col-md-4">

						<form method="get" role="search" action="<?php echo esc_url( home_url( '/' ) ); ?>">
							<div class="search-wrap">
								<label class="screen-reader-text" for="s">Search for:</label>	    
								<input type="search" name="s" id="search-input" placeholder="Search publications..." value="<?php echo esc_attr( get_search_query() ); ?>" />
								<input type="hidden" name="posttype" value="research" />	
								<input class="sr-only" type="submit" id="search-submit" value="Search" />
							</div>
						</form>

					</div>
				</div>
			</div>					
		</div>
	</div>
</div>