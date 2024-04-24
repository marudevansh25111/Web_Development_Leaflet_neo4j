<nav aria-label="bread crumb">
<ol class="breadcrumb">
        <li><b><a href="index.php"><i class="fa fa-home"></b></i> Home /</a></li>
        <?php
            $pagename=basename($_SERVER['PHP_SELF']);
            $del=".";
            $token=strtok($pagename,$del);
            if(!($pagename=="index.php"))
            {
                echo`<li class="active"> `.$token.`</li>`;
            }
		?> 
        
</ol>
</nav>