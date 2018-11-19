<?php global $smof_data ?>

    <footer id="footer">
        <div class="container">
            <div class="row">

                <?php
                switch ($smof_data['footer_col']) {

                    case "footer1":
                        get_template_part('include/footer/footer1');
                        break;

                    case "footer2":
                        get_template_part('include/footer/footer2');
                        break;

                    case "footer3":
                        get_template_part('include/footer/footer3');
                        break;

                    case "footer4":
                        get_template_part('include/footer/footer4');
                        break;

                    case "footer5":
                        get_template_part('include/footer/footer5');
                        break;

                    case "footer6":
                        get_template_part('include/footer/footer6');
                        break;

                    case "footer7":
                        get_template_part('include/footer/footer7');
                        break;

                    case "footer8":
                        get_template_part('include/footer/footer8');
                        break;

                } ?>

            </div><!-- end div.row -->
        </div><!-- end div.container -->
    </footer><!-- end footer#footer-->

        
    <?php if ($smof_data['copyright_enable'] == 1) : ?>
    <div class="copyright-area">
        <div class="container">

            <?php echo $smof_data['copyright']; ?> 

        </div><!-- end div.container -->
    </div><!-- end div.copyright-area -->
    <?php endif; ?>

</div><!-- end div #wrapper -->

<?php if ($smof_data['back_to_top'] == 1 ) : ?>
<a href="#top" id="top-link">Top of Page</a>
<?php endif; ?>

<?php echo $smof_data['tracking_code'] ?>
<?php wp_footer() ?>

</body>
</html>