<html>
    <head>
        <title>[{$course_code}] {$course_name} | Signup</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    </head>
    <body>
        <div id="header">
            <h1>[{$course_code}] {$course_name} <small>{$page_title}</small></h1>
        </div>        
		
		
		<div class="col-md-8">
			
			{if $logged_in}
				<nav class="navbar navbar-default" role="navigation">
					<div class="container-fluid">
						<ul class="nav navbar-nav">
							{if $is_admin}
								<li><a href="index.php">student list</a></li>  
							{else}
								<li><a href="index.php">profile</a></li> 
							{/if}
							<li><a href="index.php?action=info">info</a></li>  
							<li><a href="index.php?action=logout">logout</a></li>
						</ul>
					</div>
				</nav>
			{/if}
        
            {* display info text *}
            {if $page_info}
                <div class="alert alert-info" role="alert">
                    <p>{$page_info}</p>
                </div>
            {/if}

            {* display errors *}
            {if $page_errors}
                <div class="alert alert-danger" role="alert">
                    {foreach $page_errors as $error}
                        <p>{$error}</p>
                    {/foreach}
                </div>
            {/if}

            {* display page content *}
            {if $logged_in}
                {include file="$page.tpl"}
            {else}
                {if $page == "signup"}
                    {include file="signup.tpl"}
                {else}
                    {include file="login.tpl"}
                {/if}
            {/if}
        </div>
    </body>
</html>