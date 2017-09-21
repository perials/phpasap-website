<?php echo View::render('modules/header',['nav'=>$nav]); ?>
        <div class="container content">
            <div class="row">
                <div class="col-md-3 toc">
                    <div class="toc-header">
                        <h3>Table of Content</h3>
                    </div>
                    <div class="toc-wrap">
                        <?php
                        $total = count(nav_array($ver));
                        $count = 0;
                        foreach(nav_array($ver) as $section=>$sub_section_array) {
                            $count++;
                            ?>
                            <h3><?php echo $section; ?></h3>
                            <ul class="<?php echo $count==$total ? 'last' : ''; ?>">
                                <?php foreach($sub_section_array as $sub_section) { ?>
                                <li class=""><?php echo nav_link($sub_section[0], $sub_section[1]); ?></li>
                                <?php } ?>
                            </ul>
                            <?php                            
                        }
                        ?>
                        
                    </div>
                </div>
                <div class="col-md-9">
                    <?php echo $content; ?>
                    <?php prev_next(isset($nav['prev'][0]) ? $nav['prev'][0] : null, isset($nav['next'][0]) ? $nav['next'][0] : null); ?>
                </div>
            </div>    
        </div>
<?php echo View::render('modules/footer'); ?>